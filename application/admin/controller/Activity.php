<?php
namespace app\admin\controller;
use alipay\Refund;
use app\admin\logic\ActivityLogic;
use think\Controller;
use think\Session;
use think\Request;
use think\Cache;
use wxpay\database\WxPayRefund;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
use wxpay\database\WxPayRefundQuery;

class Activity extends Base
{
    
    //活动列表
    public function index(){
        //获取活动信息
        $ActivityInfo = db('Activity')->alias('a')->field('a.*,t.name')->join('mfw_activity_type t','a.a_type=t.id','left')->select();
        $this->assign('ActivityInfo',$ActivityInfo);
    	return $this->fetch();
    }

    //修改活动字段
    public function saveActivityField(){
        $data = input('post.');
        if(empty($data['aid'])){
            return_info(-1,'活动id不能为空');
        }
        $res = model('Activity')->save($data,$data['aid']);

        if($res){
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }

    //添加活动列表
    public function addActivityList(){
        //获取活动类型

        //获取标题父id
        $fidInfo = db('activity_type')->where('fid',0)->select();
        
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
        $a_type = input('post.activity_type_son');
        if(empty($a_type)){
            $a_type = input('post.activity_type');
        }
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
                echo $a_inde_img->getError();die;
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
                echo $a_img->getError();die;
            }
        }
        
        //新增
        $data['a_title'] = $a_title;
        $data['a_remark'] = $a_remark;
        $data['a_begin_time'] = strtotime($a_begin_time);
        $data['a_end_time'] = strtotime($a_end_time);
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
        $Activity->insert($data);
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
        //活动价格
        $price = input('post.price');
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
        $data['a_price'] = $price;
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

    //修改评论状态
    public function saveCommonsStatus(){
        $data = input();
        $res = model('ActivityComments')->save(['status'=>$data['status']],['comment_id'=>$data['id']]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->success('修改失败');
        }
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
        $data = input('get.');

        $where1 = array();
        if(!empty($data['aid'])){
            if($data['aid'] == 0 ){
                $where1['o.aid'] = array('>',0);
            }else{
                $where1['o.aid'] = $data['aid'];
            }
        }

        $where2 = array();
        if(!empty($data['begin_time'])){
            $where2['o.addtime'] = array('>=',strtotime($data['begin_time']));
        }

        $where3 = array();
        if(!empty($data['end_time'])){
            $where3['o.addtime'] = array('<=',strtotime($data['end_time'])+3600*12);
        }

        $orderInfo = model('ActivityOrder')
                            ->alias('o')->field('o.*,a.a_title,s.name as source_name,t.begin_time,t.end_time')
                            ->join('mfw_activity a','o.aid=a.aid','left')
                            ->join('mfw_activity_time t','t.t_id=o.t_id','left')
                            ->join('mfw_source s','o.source=s.id','left')
                            ->where($where1)->where($where2)->where($where3)
                            ->select();
        $activityInfo = model('Activity')->getActivityAll('aid,a_title');

        $this->assign('activityInfo',$activityInfo);
        $this->assign('orderInfo',$orderInfo);
        return $this->fetch();
    }

    //显示添加订单
    public function dis_add_order(){
        //活动信息
        $activity = model('Activity')->getNewActivity();
        //来源信息
        $source = model('source')->select();
        $this->assign('source',$source);
        $this->assign('activity',$activity);
        return $this->fetch();
    }

    //添加订单,余额扣款待添加
    public function add_order(){
        $data = input('post.');

        //手机号
        $data['mobile'] = input('post.mobile');
        if(!isMobile($data['mobile'])){
            $this->error('手机号错误');
        }

        $data['pay_time'] = time();
        $data['order_status'] = 3;
        $data['addtime'] = time();
        
        $data['order_price'] = $data['order_price'] * $data['child_num'];

        //订单号
        if(!empty($data['uid'])){
            $data['order_sn'] = getOrderSn($data['uid'],$data['aid']);
        }else{
            $data['uid'] = -1;
            $data['order_sn'] = getOrderSn($data['uid'],$data['aid']);
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

    //退款，原路返回
    public function refundOrder(){
        $rid = input('post.rid');
        $order_sn = input('post.order_sn');
        $orderInfo = model('ActivityOrder')->getSnOrderInfo($order_sn);
        if(empty($orderInfo)){
            $this->error('订单错误');
        }
        if($orderInfo['pay_way'] == 1){     //支付宝
            $this->error('支付宝请手工退款');
        }elseif ($orderInfo['pay_way'] == 2){   //微信
            $input = new WxPayRefund();
            $input->setOutTradeNo($order_sn);   //订单号
            $input->setOutRefundNo($order_sn); //退款订单号
            $input->setTotalFee($orderInfo['order_price']*100);     //订单金额
            $input->setRefundFee($orderInfo['order_price']*100);  //退款金额
            $input->setOpUserId(config('wxpay.mch_id'));
            $orders = WxPayApi::refund($input);
            if(isset($orders['err_code'])){
                if($orders['err_code'] == 'NOTENOUGH'){//尝试用余额退费
                    $input->setRefundAccount('REFUND_SOURCE_RECHARGE_FUNDS');
                    $orders = WxPayApi::refund($input);
                }
                $this->error($orders['err_code']);
            }
            if($orders['return_code'] == 'SUCCESS'){
                model('ActivityOrder')->setOrderStatus($order_sn,6);
                model('ActivityRefund')->setStatus($rid,3);
                //恢复名额
                model('ActivityTime')->IncTicketNum($orderInfo->t_id);
                $this->success('金额已原路返回',url('activity/refund'));
            }
        }elseif ($orderInfo['pay_way'] == 4){   //余额
            $userInfo = model('user')->find($orderInfo['uid']);
            if(empty($userInfo)) {
                $this->error('用户不存在');
            }

            $userInfo->balance = $userInfo->balance+$orderInfo['order_price'];
            $userInfo->save();

            $res = model('ActivityOrder')->setOrderStatus($order_sn,6);
            if($res){
                $this->success('金额已原路返回',url('activity/refund'));
            }else{
                $this->success('退款失败');
            }

        }
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

    //修改列表
    public function save_spe(){
        $data = input('param.');
        //获取活动标题
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getActivityAll();
        $timeInfo = db('ActivityTime')->find($data['t_id']);
        return $this->fetch('',[
            'ActivityInfo' => $ActivityInfo,
            'timeInfo'  => $timeInfo
        ]);
    }

    //修改活动安排是否显示
    public function saveAvtivityTimeDis(){
        $data = input('param.');
        $res = model('ActivityTime')->save(['is_display'=>$data['dis']],['t_id'=>$data['t_id']]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    //添加规格列表
    public function addSpeList(){
        //获取活动标题
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getActivityAll();
        $this->assign('ActivityInfo',$ActivityInfo);
        return $this->fetch();
    }
    
    //添加规格
    public function addSpe(){
        $data = input('post.');
        if(!empty($data['t_id'])){
            $res = model('ActivityTime')->save($data,['t_id'=>$data['t_id']]);
            if($res) {
                $this->success('成功','activity/specification');
            }else{
                $this->success('失败','activity/specification');
            }
        }

        $num = count($data['begin_time']);
        $add_data = array();
        for ($i=0;$i<$num;$i++){
            $add_data[$i]['aid'] = $data['aid'];
            $add_data[$i]['begin_time'] = strtotime($data['begin_time'][$i]);
            $add_data[$i]['end_time'] = strtotime($data['end_time'][$i]);
            $add_data[$i]['ticket_num'] = $data['ticket_num'][$i];
            $add_data[$i]['remark'] = $data['remark'][$i];
            $add_data[$i]['is_display'] = $data['is_display'][$i];
        }

        $res = model('ActivityTime')->insertAll($add_data);

        if($res) {
            $this->success('成功','activity/specification');
        }else{
            $this->success('失败','activity/specification');
        }

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
        //只支持.xls文件
        $exten_name = substr(strrchr($_FILES['file']['name'], '.'), 1);
        if($exten_name != 'xls'){
            $this->error('支持支.xls文件格式');
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
            $A = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//获取A列的值，用户名
            if(is_object($A))  $A= $A->__toString();    //转文本格式
            $B = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//获取B列的值，手机号
            if(is_object($A))  $A= $A->__toString();    //转文本格式
            $C = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//获取C列的值，下单时间
            $D = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();//获取D列的值，支付时间
            $E = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();//获取E列的值，付款金额
            $F = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();//获取F列的值，来源
            $G = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();//获取G列的值，孩子姓名
            if(is_object($G))  $G= $G->__toString();    //转文本格式
            $H = $objPHPExcel->getActiveSheet()->getCell("H".$j)->getValue();//获取H列的值，孩子性别
            if(is_object($H))  $H= $H->__toString();    //转文本格式
            $I = $objPHPExcel->getActiveSheet()->getCell("I".$j)->getValue();//获取I列的值，孩子生日
            $J = $objPHPExcel->getActiveSheet()->getCell("J".$j)->getValue();//获取J列的值，孩子可玩耍时间
            if(is_object($J))  $J= $J->__toString();    //转文本格式
            $K = $objPHPExcel->getActiveSheet()->getCell("K".$j)->getValue();//获取K列的值，孩子学校
            if(is_object($K))  $K= $K->__toString();    //转文本格式
            $L = $objPHPExcel->getActiveSheet()->getCell("L".$j)->getValue();//获取L列的值，是否签到
            if(is_object($L))  $L= $L->__toString();    //转文本格式

            //手机号，来源为必填项，任何一个为空就不记录
            if(empty($B) || empty($F)){
                continue;
            }
            //下单时间，支付时间为空时默认导入时间，付款金额为空是默认0
            if(empty($C)){
                $C = date('Y-m-d H:i:s');
            }
            if(empty($D)){
                $D = date('Y-m-d H:i:s');
            }
            if(empty($E)){
                $E = 0;
            }
            $excel_data[$k]['name'] = $A?$A:'';
            $excel_data[$k]['mobile'] = (string)$B;
            $excel_data[$k]['addtime'] = strtotime($C);
            $excel_data[$k]['pay_time'] = strtotime($D);
            $excel_data[$k]['order_price'] = $E;
            $excel_data[$k]['source'] = $F;
            $excel_data[$k]['child_name'] = $G?$G:'';
            $excel_data[$k]['child_gender'] = $H?$H:'';
            $excel_data[$k]['child_birthday'] = $I?$I:'';
            $excel_data[$k]['child_play_time'] = $J?$J:'';
            $excel_data[$k]['child_school'] = $K?$K:'';
            if($L == '是'){
                $excel_data[$k]['order_status'] = 4;
                $excel_data[$k]['sign_time'] = time();
            }else{
                $excel_data[$k]['order_status'] = 3;
                $excel_data[$k]['sign_time'] = 0;
            }
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
            $add_data[$i]['mobile'] = $excel_data[$i]['mobile'];
            $add_data[$i]['name'] = $excel_data[$i]['name'];
            $add_data[$i]['adult_num'] = 1;
            $add_data[$i]['child_num'] = 1;
            $add_data[$i]['order_price'] = $excel_data[$i]['order_price'];
            $add_data[$i]['pay_way'] = 5;
            $add_data[$i]['pay_time'] = $excel_data[$i]['pay_time'];
            $add_data[$i]['order_status'] = $excel_data[$i]['order_status'];
            $add_data[$i]['addtime'] = $excel_data[$i]['addtime'];
            $add_data[$i]['source'] = $source;
            $add_data[$i]['t_id'] = $tid;
            $add_data[$i]['sign_time'] = $excel_data[$i]['sign_time'];

            //孩子信息
            $child_data[$i]['mobile'] = $excel_data[$i]['mobile'];
            $child_data[$i]['child_name'] = $excel_data[$i]['child_name'];
            $child_data[$i]['child_gender'] = $excel_data[$i]['child_gender'];
            $child_data[$i]['child_birthday'] = $excel_data[$i]['child_birthday'];
            $child_data[$i]['child_play_time'] = $excel_data[$i]['child_play_time'];
            $child_data[$i]['child_school'] = $excel_data[$i]['child_school'];
        }


        if(!isset($add_data)){
            $this->error('导入失败，请检查数据是否正确');
        }

        //去除重复,用于添加到客户表
        $result = array();
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
                $result_child[] = $child_data[$key];
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

        if(isset($add_user)){
            db('user')->insertAll($add_user);
        }

        //找uid，添加订单
        $i = 0;
        foreach ($add_data as $k=>$v){
            $uid = db('user')->where('mobile',$v['mobile'])->value('uid');
            $add_data[$i]['uid'] = $uid;
            $i++;
        }

        //添加孩子
        $i=0;
        foreach($result_child as $k=>$v){
            if(!empty($v['child_name'])){
                $uid = db('user')->where('mobile',$v['mobile'])->value('uid');
                $add_child_data[$i]['uid'] = $uid;
                $add_child_data[$i]['name'] = $v['child_name'];
                if($v['child_gender'] != ''){
                    if($v['child_gender'] == '男'){
                        $add_child_data[$i]['gender'] = 1;
                    }else{
                        $add_child_data[$i]['gender'] = 2;
                    }
                }else{
                    $add_child_data[$i]['gender'] = 0;
                }
                $add_child_data[$i]['birthday'] = $v['child_birthday'];
                $add_child_data[$i]['school'] = $v['child_school'];
                $add_child_data[$i]['play_time'] = $v['child_play_time'];
                $add_child_data[$i]['addtime'] = time();
                $i++;
            }
        }
        if(isset($add_child_data)){
            db('user_child')->insertAll($add_child_data);
        }

        $k_num = count($add_data);
        //减库存
        $Activity->where('aid',$aid)->setDec('a_num',$k_num);
        //增加报名人员
        $Activity->where('aid',$aid)->setInc('a_sold_num',$k_num);
        //减时间库存
        $ActivityTime->where('t_id',$tid)->setDec('ticket_num',$k_num);
        $ActivityTime->where('t_id', $tid)->setInc('sold_num', $k_num);

        $order = model('ActivityOrder')->insertAll($add_data);
        if($order){
            $this->success('导入成功','activity/specification');
        }else{
            $this->success('数据库插入失败','activity/specification');
        }
    }

    //得到活动时间
    public function getActivityTime(){
        if(!request()->isAjax()) {
            return_info(-1,'请求错误');
        }

        $aid = input('post.aid');
        $res = model('ActivityTime')->getDisAidTime($aid);
        if(!empty($res)){
            return_info(200,'成功',$res);
        }else{
            return_info(-1,'没有安排时间');
        }
    }
}
