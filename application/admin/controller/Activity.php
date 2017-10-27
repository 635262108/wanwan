<?php
namespace app\admin\controller;
use app\admin\Logic\ActivityLogic;
use think\Controller;
use think\Session;
use think\Request;
use think\Cache;


class Activity extends Base
{
    
    //活动列表
    public function index(){
        //获取活动信息
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getActivityAll();
        $this->assign('ActivityInfo',$ActivityInfo);
    	return $this->fetch();
    }
    
    //添加活动列表
    public function addActivityList(){
        //获取活动类型
        $ActivityType = model('ActivityType');
        $title = $ActivityType->getTitleSon(0);
        //获取标题父id
        $fidInfo = $ActivityType->getTitle();
        
        $this->assign('fidInfo',$fidInfo);
        return $this->fetch();
    }
    
    //添加活动
    public function addActivity(){
        //活动标题
        $a_title = input('post.activityTitle');
        //活动描述
        $a_remark = input('post.remark');
        //活动开始时间
        $a_begin_time = input('post.begin_time');
        //活动结束时间
        $a_end_time = input('post.end_time');
        //活动剩余名额
        $a_num = input('post.residue');
        //活动大人价格
        $a_adult_price= input('post.adult_price');
        //活动小孩价格
        $a_child_price = input('post.child_price');
        //活动地址
        $a_address = input('post.address');
        //总价格
        $a_price = $a_adult_price+$a_child_price;
        //活动状态
        $a_status = input('post.activity_status');
        //活动类型
        $a_type = input('post.activity_type');
        //是否推荐
        $a_is_recommend = input('post.recommend');
        //活动内容
        $a_content = input('post.myContent');
        //首页小图
        $inde_img = request()->file('index_img');
        if(!empty($inde_img)){
            $a_inde_img = $inde_img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_inde_img){
                $data['a_index_img'] = $a_inde_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }        
        //主页大图
        $img = request()->file('a_img');
        if(!empty($img)){
            $a_img = $img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_img){
                $data['a_img'] = $a_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
        
        //新增
        $data['a_title'] = $a_title;
        $data['a_remark'] = $a_remark;
        $data['a_begin_time'] = time($a_begin_time);
        $data['a_end_time'] = time($a_end_time);
        $data['a_num'] = $a_num;
        $data['a_adult_price'] = $a_adult_price;
        $data['a_child_price'] = $a_child_price;
        $data['a_price'] = $a_price;
        $data['a_status'] = $a_status;
        $data['a_address'] = $a_address;
        $data['a_type'] = $a_type;
        $data['a_is_recommend'] = $a_is_recommend;
        $data['a_content'] = $a_content;
        $Activity = model('Activity');
        $Activity->addActivity($data);
        $this->success('添加成功','activity/index');
    }

    //活动修改列表
    public function saveActivityList($aid){
        //获取活动信息
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getIdActivity($aid);
        //获取活动类型
        $ActivityType = model('ActivityType');
        $title = $ActivityType->getTitleSon(0);
        //获取标题父id
        $fidInfo = $ActivityType->getAnyTitle($ActivityInfo['a_type']);
        //获取子活动类型
        $titleSon = $ActivityType->getTitleSon($fidInfo['fid']);
        $this->assign('titleSon',$titleSon);
        $this->assign('title',$title);
        $this->assign('fidInfo',$fidInfo);
        $this->assign('ActivityInfo',$ActivityInfo);
        return $this->fetch();
    }
    
    //获取子级商品属性
    public function getSonType(){
        $id = input('get.id');
        $ActivityType = model('ActivityType');
        $sonData = $ActivityType->getTitleSon($id);
        //拼成option集合
        $str = "<option value=''>请选择</option>";
        foreach($sonData as $k=>$v){
            $str .= "<option value='".$v['id']."'>".$v['name']."</option>";
        }
        return_info(200,'成功',$str);
    }
    
    //活动修改
    public function saveActivity(){
        //活动id
        $aid = input('post.activityId');
        //活动标题
        $a_title = input('post.activityTitle');
        //活动描述
        $a_remark = input('post.remark');
        //活动开始时间
        $a_begin_time = input('post.begin_time');
        //活动结束时间
        $a_end_time = input('post.end_time');
        //活动地址
        $a_address = input('post.address');
        //活动剩余名额
        $a_num = input('post.residue');
        //活动大人价格
        $a_adult_price= input('post.adult_price');
        //活动小孩价格
        $a_child_price = input('post.child_price');
        //活动状态
        $a_status = input('post.activity_status');
        //活动类型
        $a_type = input('post.activity_type');
        //是否推荐
        $a_is_recommend = input('post.recommend');
        //活动内容
        $a_content = input('post.myContent');
        //首页小图
        $inde_img = request()->file('index_img');
        if(!empty($inde_img)){
            $a_inde_img = $inde_img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_inde_img){
                $data['a_index_img'] = $a_inde_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }        
        //主页大图
        $img = request()->file('a_img');
        if(!empty($img)){
            $a_img = $img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_img){
                $data['a_img'] = $a_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
        //修改
        $data['aid'] = $aid;
        $data['a_title'] = $a_title;
        $data['a_remark'] = $a_remark;
        $data['a_begin_time'] = strtotime($a_begin_time);
        $data['a_end_time'] = strtotime($a_end_time);
        $data['a_address'] = $a_address;
        $data['a_num'] = $a_num;
        $data['a_adult_price'] = $a_adult_price;
        $data['a_child_price'] = $a_child_price;
        $data['a_status'] = $a_status;
        $data['a_type'] = $a_type;
        $data['a_is_recommend'] = $a_is_recommend;
        $data['a_content'] = $a_content;
        $Activity = model('Activity');
        $Activity->saveActivity($data);
        $this->success('修改成功','activity/index');
    }
    
    //删除活动
    public function delActivity(){
        if(request()->isAjax()){
            $aid = input('post.aid');
            $Activity = model('Activity');
            $Activity->delActivity($aid);
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }

    //活动分类列表
    public function activityType(){
        //获取分类名称
        $ActivityType = model('ActivityType');
        $typeInfo = $ActivityType->getTitle();
        $this->assign('typeInfo',$typeInfo);
        return $this->fetch('activityType');
    }
    
    //活动子分类
    public function activityTypeSon($fid){
        //获取分类名称
        $ActivityType = model('ActivityType');
        $typeInfo = $ActivityType->getTitleSon($fid);
        $this->assign('typeInfo',$typeInfo);
        $this->assign('fid',$fid);
        return $this->fetch();
    }
    
    //显示添加分类
    public function addTypeList(){
        return $this->fetch();
    }
    
    //添加分类
    public function addType(){
        //名称
        $name = input('post.name');
        if(empty($name)){
            $this->error('名称不能为空');
        }
        $sort = input('post.sort');
        $activityType = model('activityType');
        $activityType->addTitle($name,$sort);
        $this->success('添加成功','activity/activityType');
    }
    
    //显示修改分类
    public function saveTypeList($tid){
        $activityType = model('activityType');
        $titleInfo = $activityType->getAnyTitle($tid);
        $this->assign('titleInfo',$titleInfo);
        return $this->fetch();
    }


    //修改分类
    public function updataType(){
        //名称
        $data['id'] = input('post.id');
        $data['name'] = input('post.name');
        if(empty($data['name'])){
            $this->error('名称不能为空');
        }
        $data['sort'] = input('post.sort');
        //var_dump($data);die;
        $activityType = model('activityType');
        $activityType->saveTitle($data);
        $this->success('修改成功','activity/activityType');
    }
    
    //删除分类
    public function delType(){
        if(request()->isAjax()){
            $id = input('post.id');
            $activityType = model('activityType');
            $activityType->delTitle($id);
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }
    
    //显示增加子分类
    public function addTypeSonList(){
        return $this->fetch();
    }
    
    //增加子分类
    public function addTypeSon(){
        //父类id
        $fid = input('post.fid');
        //名称
        $name = input('post.name');
        if(empty($name)){
            $this->error('名称不能为空');
        }
        //排序
        $sort = input('post.sort');
        //添加
        $activityType = model('activityType');
        $activityType->addTitle($name,$sort,$fid);
        $this->success('添加成功','activity/activityTypeSon?fid='.$fid);
    }
    
    //提问列表
    public function activity_ask(){
        $ActivityComments = model('ActivityComments');
        $askInfo = $ActivityComments->getAllAsk();
        $this->assign('askInfo',$askInfo);
        return $this->fetch();
    }
    
    //回复列表
    public function activity_reply_list(){
        //获取回复内容
        $replyId = input('rid');
        $ActivityComments = model('ActivityComments');
        $reply = $ActivityComments->getAnyReply($replyId);
        $this->assign('reply',$reply);
        return $this->fetch();
    }
    
    //提交回复
    public  function commit_reply(){
        //回复id
        $replyId = input('post.replyId');
        //回复内容
        $content = input('post.content');
        //评论id
        $cid = input('post.cid');
        //活动id
        $aid = input('post.aid');
        $ActivityComments = model('ActivityComments');
        if($cid > 0){
            $data['comment_id'] = $cid;
            $data['content'] = $content;
            $data['time'] = time();
            $ActivityComments->saveComment($data);
        }else{
            $ActivityComments->replyAsk($content,$replyId,$aid);
        }
        $this->success('回复成功','admin/activity/activity_ask');
    }
    
    //删除评论
    public function delAnyReply(){
        if(request()->isAjax()){
            $id = input('post.id');
            $ActivityComments = model('ActivityComments');
            $ActivityComments->delAnyReply($id);
            //连同回复一起删
            $reply = $ActivityComments->getAnyReply($id);
            if(!empty($reply)){
                $ActivityComments->delAnyReply($reply['comment_id']);
            }
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }
    
    //活动评论
    public function activity_comment(){
        $ActivityComments = model('ActivityComments');
        $comInfo = $ActivityComments->getAllComment();
        $this->assign('comInfo',$comInfo);
        return $this->fetch();
    }
    
    //请假列表
    public function leave_for(){
        $ActivityRefund = model('ActivityRefund');
        $leaInfo = $ActivityRefund->getAllLeave();
        $this->assign('leaInfo',$leaInfo);
        return $this->fetch();
    }
    
    //订单列表
    public function order(){
        $ActivityOrder = model('ActivityOrder');
        $orderInfo = $ActivityOrder->getAllOrder();
        $this->assign('orderInfo',$orderInfo);
        return $this->fetch();
    }
    
    //退款列表
    public function refund(){
        $ActivityRefund = model('ActivityRefund');
        $refundInfo = $ActivityRefund->getAllRefund();
        $this->assign('refundInfo',$refundInfo);
        return $this->fetch();
    }
    
    //修改退款状态展示
    public function order_amend(){
        $rid = input('rid');
        $ActivityRefund = model('ActivityRefund');
        $refundInfo = $ActivityRefund->getAnyRefund($rid);
        $this->assign('refundInfo',$refundInfo);
        return $this->fetch();
    }
    
    //修改退款状态
    public function save_refund(){
        $rid = input('post.rid');
        $status = input('post.status');
        $order_sn = input('post.order_sn');
        $ActivityRefund = model('ActivityRefund');
        //修改退款表状态
        $data['id'] = $rid;
        $data['type'] = $status;
        $ActivityRefund->saveRefund($data);

        //修改订单表状态
        $ActivityOrder = model('ActivityOrder');
        //退款列表状态为1订单表状态改为5，退款表状态为3订单表状态改为6
        if($status == 1){
            $ActivityOrder->setOrderStatus($order_sn,5);
        }else{
            $ActivityOrder->setOrderStatus($order_sn,6);
        }
        $this->success('处理成功','activity/refund');
    }
    
    //活动扩展
    public function extension(){
        $ActivityExtension = model('ActivityExtension');
        $extInfo = $ActivityExtension->getAll();
        $this->assign('extInfo',$extInfo);
        return $this->fetch();
    }
    
    //删除扩展
    public function del_extension(){
        if(request()->isAjax()){
            $id = input('post.id');
            $ActivityExtension = model('ActivityExtension');
            $map['extension_id'] = $id;
            $extInfo = $ActivityExtension->delExtension($map);
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }


    //修改扩展列表
    public function saveExtensionList(){
        $eid = input('eid');
        $ActivityExtension = model('ActivityExtension');
        $extInfo = $ActivityExtension->getAnyExtActivity($eid);
        $this->assign('extInfo',$extInfo);
        return $this->fetch();
    }
    
    //修改扩展
    public function updataExtension(){
        $eid = input('post.id');
        $title = input('post.title');
        $remark = input('post.remark');
        $content = input('post.content');
        //扩展图
        $inde_img = request()->file('img');
        if(!empty($inde_img)){
            $a_inde_img = $inde_img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_inde_img){
                $data['extension_img'] = $a_inde_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
        $data['extension_id'] = $eid;
        $data['extension_title'] = $title;
        $data['extension_remark'] = $remark;
        $data['extension_content'] = $content;
        
        $ActivityExtension = model('ActivityExtension');
        $ActivityExtension->updataExtension($data);
        
        $this->success('修改成功','activity/extension');
    }
    
    //新增活动扩展列表
    public function addextensionlist(){
        //获取活动标题
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getActivity('','','aid,a_title');
        $this->assign('ActivityInfo',$ActivityInfo);
        return $this->fetch();
    }
    
    //新增活动
    public function addExtension(){
        $aid = input('post.aid');
        $title = input('post.title');
        $remark = input('post.remark');
        $content = input('post.content');
        //扩展图
        $inde_img = request()->file('img');
        if(!empty($inde_img)){
            $a_inde_img = $inde_img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_inde_img){
                $data['extension_img'] = $a_inde_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
        $data['aid'] = $aid;
        $data['extension_title'] = $title;
        $data['extension_remark'] = $remark;
        $data['extension_content'] = $content;
        
        $ActivityExtension = model('ActivityExtension');
        $ActivityExtension->addExtension($data);
        
        $this->success('增加成功','activity/extension');
    }
    
    //安排列表
    public function specification(){
        $ActivityTime = new ActivityLogic();
        $speInfo = $ActivityTime->getActivityTime();
        $this->assign('speInfo',$speInfo);
        return $this->fetch();
    }
    
    //添加规格列表
    public function addSpeList(){
        //获取活动标题
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getActivityAll();
        //获取负责人
        $map['role_id'] = 3;
        $AdminUser = model('AdminUser');
        $userInfo = $AdminUser->getUsers($map);
        $this->assign('userInfo',$userInfo);
        $this->assign('ActivityInfo',$ActivityInfo);
        return $this->fetch();
    }
    
    //添加规格
    public function addSpe(){
        $data['aid'] = input('post.aid');
        $data['t_content'] = input('post.content');
        $data['ticket_num'] = input('post.num');
        $data['head'] = input('post.head');
        $ActivityTime = model('ActivityTime');
        $ActivityTime->add($data);
        $this->success('添加成功','activity/specification');
    }
    
    //删除规格
    public function delAnySpe(){
        if(request()->isAjax()){
            $id = input('post.id');
            $ActivityTime = model('ActivityTime');
            $ActivityTime->delAnySpe($id);
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }
}
