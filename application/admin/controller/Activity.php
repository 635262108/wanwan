<?php
namespace app\admin\controller;
use app\admin\logic\ActivityLogic;
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
    public function activity_type(){
        //获取分类名称
        $ActivityType = model('ActivityType');
        $typeInfo = $ActivityType->getTitle();
        $this->assign('typeInfo',$typeInfo);
        return $this->fetch();
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
        $orderInfo = model('ActivityOrder')
                            ->alias('o')->field('o.*,a.a_title,s.name as source_name')
                            ->join('mfw_activity a','o.aid=a.aid')
                            ->join('mfw_source s','o.source=s.id','LEFT')
                            ->select();
        $this->assign('orderInfo',$orderInfo);
        return $this->fetch();
    }

    //显示添加订单
    public function dis_add_order(){
        //活动信息
        $activity = db('activity')->select();
        //来源信息
        $source = db('source')->select();
        $this->assign('source',$source);
        $this->assign('activity',$activity);
        return $this->fetch();
    }

    //添加订单
    public function add_order(){
        //活动id
        $data['aid'] = input('post.aid');
        //手机号
        $data['mobile'] = input('post.mobile');
        if(!isMobile($data['mobile'])){
            $this->error('手机号错误');
        }
        //用户uid
        $data['uid'] = input('post.uid');
        //姓名
        $data['name'] = input('post.name');
        //小孩数量
        $data['child_num'] = input('post.child_num');
        //支付方式
        $data['pay_way'] = input('post.pay_way');
        //支付时间
        $data['pay_time'] = time();
        //状态，管理员添加默认为已付款
        $data['order_status'] = 3;
        //下单时间
        $data['addtime'] = time();
        //活动时间
        $data['t_id'] = input('post.t_id');
        //订单备注
        $data['record'] = input('post.record');
        //来源
        $data['source'] = input('post.source');
        //价格
        $data['order_price'] = input('post.order_price') * $data['child_num'];
        //订单号
        if($data['uid'] > 0){
            $data['order_sn'] = getOrderSn($data['uid'],$data['aid']);
        }else{
            $data['order_sn'] = getOrderSn(000,$data['aid']);
        }
        //添加订单
        $model = new ActivityLogic();
        $res = $model->save_order($data);
        if($res['status'] == 200){
            $this->success($res['msg'],'activity/order');
        }else{
            $this->error($res['msg']);
        }
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
    
    //活动安排
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

    //显示订单导入,选择好时间段导入
    public function dis_import_user($aid,$t_id){
        //获取来源数据
        $this->assign('aid',$aid);
        $this->assign('t_id',$t_id);
        return $this->fetch();
    }

    //显示订单导入，没有时间段直接导入
    public function dis_import_order(){
        //获取活动标题
        $a_title = model('Activity')->field('aid,a_title')->select();
        $this->assign('a_title',$a_title);
        return $this->fetch();
    }


    //会员导入
    public function import_user(){
        //活动id
        $aid = input('post.aid');
        //时间id
        $tid = input('post.t_id');
        if(empty($tid)){
            $tid = 0;
        }
        //获取文件
        $filename = $_FILES['file']['tmp_name'];
        require EXTEND_PATH.'excel/PHPExcel/IOFactory.php';
        require EXTEND_PATH."excel/PHPExcel.php";
        require EXTEND_PATH.'excel/PHPExcel/Writer/Excel5.php';

        $objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        $objPHPExcel = $objReader->load($filename); //$filename可以是上传的文件，或者是指定的文件
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
//        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        //循环读取excel文件,读取一条,插入一条
        $k = 0;
        for($j=2;$j<=$highestRow;$j++)
        {
            $a = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//获取A列的值，用户名
            $b = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//获取B列的值，手机号
            $c = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//获取C列的值，下单时间
            $d = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();//获取D列的值，支付时间
            $e = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();//获取E列的值，付款金额
            $f = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();//获取列的值，来源

            //用户名，手机号，来源为必填项，任何一个为空就不记录
            if(empty($a) || empty($b) || empty($f)){
                continue;
            }
            //下单时间，支付时间为空时默认导入时间，付款金额为空是默认0
            if(empty($c)){
                $c = date('Y-m-d H:i:s');
            }
            if(empty($d)){
                $d = date('Y-m-d H:i:s');
            }
            if(empty($e)){
                $e = 0;
            }
            $excel_data[$k]['name'] = $a;
            $excel_data[$k]['mobile'] = $b;
            $excel_data[$k]['addtime'] = strtotime($c);
            $excel_data[$k]['pay_time'] = strtotime($d);
            $excel_data[$k]['order_price'] = $e;
            $excel_data[$k]['source'] = $f;
            $k++;
        }
        /*//获取时间段信息
        if($tid != 0){
            $timeInfo = model('ActivityTime')->getAnyTime($tid);
            //定义最多报名数
            $num = $timeInfo['ticket_num'];
            if($num == 0){
                $this->error('活动已报满啦');
            }
        }*/
        $num = count($excel_data);

        //为空直接返回
        if(!isset($excel_data)){
            $this->error('导入失败，请检查姓名，手机号，来源是否已填');
        }

        //添加订单
        $Activity = model('Activity');
        $ActivityTime = model('ActivityTime');
        $sourceModel = model('Source');
        for($i=0;$i<$num;$i++){
            //获取来源id
            $source = $sourceModel->where('name',$excel_data[$i]['source'])->value('id');
            $mob = substr($excel_data[$i]['mobile'],7,4);
            $add_data[$i]['order_sn'] = getOrderSn($mob,$aid);
            $add_data[$i]['aid'] = $aid;
            $add_data[$i]['uid'] = -1;
            $add_data[$i]['mobile'] = $excel_data[$i]['mobile'];
            $add_data[$i]['name'] = $excel_data[$i]['name'];
            $add_data[$i]['adult_num'] = 1;
            $add_data[$i]['child_num'] = 1;
            $add_data[$i]['order_price'] = $excel_data[$i]['order_price'];
            $add_data[$i]['pay_way'] = 5;
            $add_data[$i]['pay_time'] = $excel_data[$i]['pay_time'];
            $add_data[$i]['order_status'] = 3;
            $add_data[$i]['addtime'] = $excel_data[$i]['addtime'];
            $add_data[$i]['source'] = $source;
            $add_data[$i]['t_id'] = $tid;
        }
        //去除重复,用于添加到客户表
        $result = array();
        if(isset($add_data)){
            foreach($add_data as $key=>$val){
                $set = false;
                foreach($result as $k=>$v){
                    if($v['mobile'] == $val['mobile']){
                        $set = true;
                        break;
                    }
                }
                if(!$set){
                    $result[] = $val;
                }
            }
        }
        //导入进来的名单如果没有在客户表里，就添加到表中
        $i = 0;
        foreach($result as $k=>$v){
            $isset_user = db('user')->where('mobile',$v['mobile'])->find();
            if(!$isset_user){
                $add_user[$i]['mobile'] = $v['mobile'];
                $add_user[$i]['nickname'] = $v['name'];
                $add_user[$i]['sex'] = 0;
                $add_user[$i]['reg_time'] = time();
                $add_user[$i]['source'] = $v['source'];
                $i++;
            }
        }
        db('user')->insertAll($add_user);
        /*$k_num = count($add_data);
        //减库存
        $Activity->where('aid',$aid)->setDec('a_num',$k_num);
        //增加报名人员
        $Activity->where('aid',$aid)->setInc('a_sold_num',$k_num);
        //减时间库存
        $ActivityTime->where('t_id',$tid)->setDec('ticket_num',$k_num);*/

        $order = model('ActivityOrder')->insertAll($add_data);
        if($order){
            $this->success('导入成功','activity/specification');
        }else{
            $this->success('数据库插入失败','activity/specification');
        }
    }

    //得到活动时间
    public function getActivityTime(){
        if(request()->isAjax()){
            $aid = input('post.aid');
            $res = model('ActivityTime')->getActivityTime($aid);
            if(!empty($res)){
                return_info(200,'成功',$res);
            }else{
                return_info(-1,'没有安排时间');
            }

        }else{
            return_info(-1,'请求错误');
        }

    }
}
