<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\logic\UserLogic;

class User extends Base
{

    //会员列表
    public function index(){
        $userInfo = model('user')->alias('u')->field('u.*,s.name as source_name')
                    ->join('mfw_source s','u.source=s.id')
                    ->select();
        $this->assign('userInfo',$userInfo);
    	return $this->fetch();
    }
    
    //获取个人用户信息
    public function getUserInfo(){
        //检测是否为ajax请求
        if(request()->isajax()){
            $uid = input("post.uid");
            //获取用户信息
            $user = model('user');
            $userInfo = $user->getIdUser($uid);
            //获取省市区
            $region = model('region');
            $province = $region->getAnyData($userInfo['province']);//省
            $city = $region->getAnyData($userInfo['city']);//市
            $district = $region->getAnyData($userInfo['district']);//区
            //转换数据格式
            $userInfo['reg_time'] = date("Y-m-d H:i:s",$userInfo['reg_time']);
            $userInfo['last_time'] = date("Y-m-d H:i:s",$userInfo['last_time']);
            $userInfo['birthday'] = date("Y-m-d H:i:s",$userInfo['birthday']);
            if($userInfo['status'] == 1){
                $userInfo['status'] = "正常";
            }else{
                $userInfo['status'] = "被禁";
            }
            $userInfo['province'] = $province['name'];
            $userInfo['city'] = $city['name'];
            $userInfo['district'] = $district['name'];

            //获取小孩信息
            $child = db('user_child')->where('uid',$uid)->select();
            foreach($child as $k=>$v){
                if($v['gender'] == 1){
                    $child[$k]['gender'] = '男';
                }else{
                    $child[$k]['gender'] = '女';
                }
            }
            //消费金额，余额，参加活动次数，信用积分
            $map['uid'] = $uid;
            $map['sign_time'] = array('gt',0);
            $consumption = db('activity_order')->where($map)->sum('order_price');
            if(empty($consumption)){
                $consumption = 0;
            }

            $join_num = db('activity_order')->where($map)->count();

            $enrol_num = db('activity_order')->where('uid',$uid)->count();

            $source = db('source')->find($userInfo['source']);

            $result = array(
                'probably' => array(//会员概况
                    'nickname' => $userInfo['nickname'],
                    'mobile'   => $userInfo['mobile'],
                    'balance'  => $userInfo['balance'], //余额
                    'consumption'=> $consumption,       //消费金额
                    'join_num'  => $join_num,           //参加活动次数
                    'credit'    => 100,                  //信用积分，此功能暂时没有，默认100
                    'enrol_num' => $enrol_num,           //报名次数
                    'source'    => $source['name']       //来源

                ),
                'detail' => objectArray($userInfo),  //会员详情
                'child'  => $child      //孩子信息
            );
            return_info(200,'成功',$result);
        }else{
            return_info(-1,'请求失败');
        }
    }

    //根据手机号获取用户基本信息
    public function getUserMobile(){
        if(request()->isAjax()){
            $mobile = input('post.mobile');
            if(!isMobile($mobile)){
                return_info(-1,'手机号不正确');
            }
            $userInfo = db('user')->where('mobile',$mobile)->find();
            if(!empty($userInfo)){
                return_info(200,'成功',$userInfo);
            }else{
                return_info(-1,'数据为空','');
            }
        }else{
            return_info(-1,'请求失败');
        }

    }
    
    //修改个人信息展示
    public function saveUserList($uid){
        //获取用户信息
        $user = model('user');
        $userInfo = $user->getIdUser($uid);
        
        //获取所有的省市区
        $region = model('region');
        $provinces = $region->getAnyLevelData(1);
        $citys = $region->getSonData($userInfo['province']);
        $districts = $region->getSonData($userInfo['city']);
        
        //转换数据格式
        $userInfo['reg_time'] = date("Y-m-d H:i:s",$userInfo['reg_time']);
        $userInfo['last_time'] = date("Y-m-d H:i:s",$userInfo['last_time']);
        $userInfo['birthday'] = date("Y-m-d",$userInfo['birthday']);
  
        $this->assign('provinces',$provinces);
        $this->assign('citys',$citys);
        $this->assign('districts',$districts);
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }
    
    //修改个人信息
    public function saveUser(){
        //uid
        $uid = input('post.userId');
        //手机号
        $mobile = input('post.userTel');
        //昵称
        $nickname = input('post.userName');
        //状态
        $status = input('post.status');
        //生日
        $birthday = input('post.userBirthday');
        //爱好
        $hobby = input('post.userLike');
        //省
        $province = input('post.userProvince');
        //市
        $city = input('post.userCountry');
        //区
        $district = input('post.userArea');
        //详细地址
        $province = input('post.detailAddress');
        
        //修改
        $data['mobile'] = $mobile;
        $data['nickname'] = $nickname;
        $data['status'] = $status;
        $data['birthday'] = time($birthday);
        $data['hobby'] = $hobby;
        $data['city'] = $city;
        $data['district'] = $district;
        $data['address'] = $province;
        
        $user = model('user');
        $user->saveUserInfo($uid,$data);
        $this->success('修改成功',"user/index");
    }

    //签到概况
    public function attendance(){
        //获取数据
        $actinfo = model('Activity')->query("select a_title,aid,
                        (select count(*) from mfw_activity_order where aid=mfw_activity.aid and order_status<>2) as join_num,
                        (select count(*) from mfw_activity_order where aid=mfw_activity.aid and is_enter>0) as enter_num,
                        (select count(*) from mfw_activity_order where aid=mfw_activity.aid and sign_time>0) as sign_num
                        from mfw_activity");

        $this->assign('actinfo',$actinfo);
        return $this->fetch();
    }

    //签到分类
    public function attendance_class($aid){
        //获取数据
        $actinfo = model('ActivityTime')->query("select t.*,a.a_title,
                                    (select count(*) from mfw_activity_order o where o.aid=t.aid and o.order_status<>2 and o.t_id=t.t_id) as join_num,
                                    (select count(*) from mfw_activity_order o where o.aid=t.aid and o.is_enter>0 and o.t_id=t.t_id) as enter_num,
                                    (select count(*) from mfw_activity_order o where o.aid=t.aid and o.sign_time>0 and o.t_id=t.t_id) as sign_num
                                    from mfw_activity_time t right join mfw_activity a on t.aid=a.aid where t.aid=".$aid);

        $this->assign('actinfo',$actinfo);
        return $this->fetch();
    }

    //考勤详情
    public function attendance_detail(){
        $aid = input('aid');
        $tid = input('tid');
        $is_sign = input('is_sign');
        if($is_sign == 1 ) {
            $map['sign_time'] = ['>',0];
        }elseif($is_sign == 2) {
            $map['sign_time'] = ['=',0];
        }
        $ActivityOrder = model('ActivityOrder');
        $map['aid'] = $aid;
        $map['t_id'] = $tid;
        $map['order_status'] = array('neq',2);
        $actinfo = $ActivityOrder->getOrders($map);
        $this->assign('actinfo',$actinfo);
        $this->assign('aid',$aid);
        return $this->fetch();
    }


    //导出签到
    public function conversions_attendance($aid=0){
        //活动信息
        $Activity = model('Activity');
        $actinfo = $Activity->getIdActivity($aid,'a_title');

        $ActivityOrder = model('ActivityOrder');
        $map['aid'] = $aid;
        $map['order_status'] = array('neq',2);
        $order = $ActivityOrder->getOrders($map);
        //整理数据
        $ActivityTime = model('ActivityTime');
        $i = 1;
        $key = 0;
        $result = array();
        foreach($order as $k=>$v){
            //获取参加时间
            $time = $ActivityTime->getAnyTime($v['t_id']);
            $key++;
            $result[$key]['id'] = $i++;     //序列号
            $result[$key]['name'] = $v['name']; //报名姓名
            $result[$key]['mobile'] = $v['mobile']; //完整电话
            $result[$key]['mobile2'] = substr($v['mobile'],0,3)."玩翫碗".substr($v['mobile'],7);    //报名电话
            $result[$key]['time'] = $time['t_content']; //报名时间
            switch ($v['order_status']) {
                case 1:
                    $result[$key]['sign'] = '已参加';
                    break;
                case 4:
                    $result[$key]['sign'] = '已参加';
                    break;
                case 3:
                    $result[$key]['sign'] = '未参加';
                        break;
                case 5:
                    $result[$key]['sign'] = '正在退款';
                    break;
                case 6:
                    $result[$key]['sign'] = '已退款';
                    break;
                case 7:
                    $result[$key]['sign'] = '已请假';
                    break;
                default:
                    break;
            }
        }

        //导出excel
        $filename = "玩翫碗".$actinfo['a_title']."活动签到表";
        $title = '玩翫碗-'.$actinfo['a_title']."活动签到表";
        $key = array('id','name','mobile','mobile2','time','sign');
        $this->exportExcel($result,$filename,$key,$title);
    }

    /**
    * 创建(导出)Excel数据表格
    * @param  array   $list        要导出的数组格式的数据
    * @param  string  $filename    导出的Excel表格数据表的文件名
    * @param  array   $indexKey    $list数组中与Excel表格表头$header中每个项目对应的字段的名字(key值)
    * 比如: $indexKey与$list数组对应关系如下:
    *     $indexKey = array('id','username','sex','age');
    *     $list = array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24));
    */
    public function exportExcel($list,$filename,$indexKey=array(),$title){
        require EXTEND_PATH.'excel/PHPExcel/IOFactory.php';
        require EXTEND_PATH."excel/PHPExcel.php";
        require EXTEND_PATH.'excel/PHPExcel/Writer/Excel2007.php';

        $header_arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M', 'N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        $objPHPExcel = new \PHPExcel();                        //初始化PHPExcel(),不使用模板
//        $template = EXTEND_PATH.'excel/attendance.xlsx';          //使用模板
//        $inputFileType = \PHPExcel_IOFactory::identify($template);
//        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
//        $objReader->setReadDataOnly(true);//解决load一直加载不出来问题,原因是excel表格中有特殊字符
//        $objPHPExcel = $objReader->load($template);
        $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);  //设置保存版本格式

        //写数据到表格里面去
        $objActSheet = $objPHPExcel->getActiveSheet();
        //设置单元格样式
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');    //合并单元格
        //设置默认字体大小加粗
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName("微软雅黑")->setSize(16)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        //居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objActSheet->setCellValue('A1',  $title);
        $objActSheet->setCellValue('A2',  '序号');
        $objActSheet->setCellValue('B2',  '姓名');
        $objActSheet->setCellValue('C2',  '联系方式');
        $objActSheet->setCellValue('D2',  '联系方式');
        $objActSheet->setCellValue('E2',  '活动时间');
        $objActSheet->setCellValue('F2',  '签到');
        $objActSheet->setCellValue('G2',  '备注');
        $i = 3;
        foreach ($list as $row) {
            foreach ($indexKey as $key => $value){
                //这里是设置单元格的内容
                $objActSheet->setCellValue($header_arr[$key].$i,$row[$value]);
            }
            $i++;
        }

        // 1.保存至本地Excel表格
        //$objWriter->save($filename.'.xls');

        // 2.接下来当然是下载这个表格了，在浏览器输出就好了
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="'.$filename.'.xls"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }

    //充值记录
    public function recharge_record(){
        $model = new UserLogic();
        $res = $model->getUseRechargeRecord();
        $this->assign('res',$res);
        return $this->fetch();
    }

    //明细
    public function  consumption_details($uid){
        $model = new UserLogic();
        $res = $model->getUserRecord($uid);
        $this->assign('res',$res);
        return $this->fetch();
    }

    //充值
    public function recharge($uid){
        $user = model('user');
        $userInfo = $user->getIdUser($uid);
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }

    //添加充值
    public function add_recharge(){
        //用户id
        $data['uid'] = input('post.uid');
        //金额
        $data['amount'] = input('post.amount');
        //支付方式
        $data['pay_way'] = input('post.pay_way');
        //支付状态.后台添加默认已收款
        $data['status'] = 1;
        //充值赠送
        $data['giveaway'] = input('post.giveaway');
        //是否全部领取
        $data['is_get'] = input('post.is_get');
        //备注
        $data['remark'] = input('post.remark');

        //添加
        $model = new UserLogic();
        $res = $model->saveRecharge($data);
        if($res['status']== 200){
            $this->success($res['msg'],'user/index');
        }else{
            $this->error($res['msg']);
        }
    }

    //添加扣费
    public function add_deduction(){
        //用户id
        $data['uid'] = input('post.uid');
        //扣除金额
        $data['money'] = input('post.money');
        //备注
        $data['remark'] = input('post.remark');
        //定义扣款属性
        $data['type'] = 2;

        //扣费
        $userInfo = model('user')->find($data['uid']);
        if(empty($userInfo)){
            $this->error('用户不存在');
        }
        $userInfo->balance = $userInfo->balance-$data['money'];
        $userInfo->save();
        $data['balance'] = $userInfo->balance;      //操作完后余额
        //记录明细
        $model = new UserLogic();
        $res = $model->saveDetail($data);
        if($res['status']== 200){
            $this->success($res['msg'],'user/index');
        }else{
            $this->error($res['msg']);
        }
    }

    //修改充值
    public function save_recharge(){
        //id
        $id = input('post.id');
        if(empty($id)){
            return_info(-1,'id不能为空');
        }
        $data['id'] = $id;
        //赠品
        $giveaway = input('post.giveaway');
        if(!empty($giveaway)){
            $data['giveaway'] = $giveaway;
        }
        //是否全部领取完毕
        $is_get = input('post.is_get');
        if(isset($is_get)){
            $data['is_get'] = $is_get;
        }
        //描述
        $remark = input('post.remark');
        if(!empty($remark)){
            $data['remark'] = $remark;
        }
        $model = new UserLogic();
        $res = $model->saveRecharge($data);
        if($res['msg'] == 200){
            return_info($res['status'],$res['msg']);
        }else{
            return_info($res['status'],$res['msg']);
        }
    }

    //添加会员
    public function add_member(){
        if(request()->ispost()){
            //昵称
            $data['nickname'] = input('post.nickname');
            //手机号
            $data['mobile'] = input('post.mobile');
            //密码
            $data['password'] = input('post.password');
            //性别
            $data['sex'] = input('post.sex');
            //省
            $data['province'] = input('post.province');
            //市
            $data['city'] = input('post.city');
            //区
            $data['district'] = input('post.district');
            //详细地址
            $data['address'] = input('post.address');
            //生日
            $data['birthday'] = time(input('post.birthday'));
            //余额
            $data['balance'] = input('post.balance');
            //来源
            $data['source'] = input('post.source');
            //支付方式
            $data['pay_way'] = input('post.pay_way');
            //赠品
            $data['giveaway'] = input('post.giveaway');
            //赠品是否领取
            $data['is_get'] = input('post.is_get');
            //赠品备注
            $data['remark'] = input('post.remark');
            //孩子姓名
            $data['child_name'] = input('post.child_name/a');
            //孩子性别
            $data['child_gender'] = input('post.child_gender/a');
            //孩子生日
            $data['child_birthday'] = input('post.child_birthday/a');
            //孩子学校
            $data['child_school'] = input('post.child_school/a');
            //可以玩耍时间
            $data['child_play_time'] = input('post.child_play_time/a');

            $model = new UserLogic();
            $result = $model->addUser($data);
            if($result['status'] == 200){
                $this->success('添加成功','user/index');
            }else{
                $this->error($result['msg']);
            }
        }else{
            //获取所有的省市区
            $region = model('region');
            $provinces = $region->getAnyLevelData(1);
            $citys = $region->getSonData(2);
            $districts = $region->getSonData(3);
            //获取来源数据
            $source = model('Source')->getSources();

            $this->assign('source',$source);
            $this->assign('provinces',$provinces);
            $this->assign('citys',$citys);
            $this->assign('districts',$districts);
            return $this->fetch();
        }
    }

    //更新孩子
    public function  save_child(){
        //id,存在时为更新
        $id = input('post.id');
        if(!empty($id)){
            $data['id'] = $id;
        }

        //用户id,更新时不做修改
        $uid = input('post.uid');
        if(empty($id)){
            $data['uid'] = $uid;
        }

        //孩子姓名
        $data['name'] = input('post.child_name');
        if(empty($data['name'])){
            return_info(-1,'姓名不能为空');
        }
        //孩子性别
        $data['gender'] = input('post.child_gender');
        //孩子生日
        $data['birthday'] = input('post.child_birthday');
        //孩子学校
        $data['school'] = input('post.child_school');
        //可以玩耍时间
        $data['play_time'] = input('post.child_play_time');
        //添加时记录时间
        if(empty($id)){
            $data['time'] = date('Y-m-d H:i:s');
        }
        $model = new UserLogic();
        $res = $model->saveChild($data);
        if(isset($res['data'])){
            return_info($res['status'],$res['msg'],$res['data']);
        }else{
            return_info($res['status'],$res['msg']);
        }

    }

    //删除孩子
    public function del_child(){
        $id = input('post.id');
        if(empty($id)){
            return_info(-1,'参数不完整');
        }
        $res = db('user_child')->delete($id);
        if($res){
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }

    //成单记录
    public function deal(){
        //获取数据
        $res = model('DealRecord')->field('d.*,u.nickname,u.mobile,t.begin_time,t.end_time,a.a_title')
                    ->alias("d")
                    ->join('mfw_user u','d.uid=u.uid','LEFT')
                    ->join('mfw_activity a','d.aid=a.aid','LEFT')
                    ->join('mfw_activity_time t','d.tid=t.t_id','LEFT')
                    ->select();
        $this->assign('res',$res);
        return $this->fetch();
    }

    //显示添加成单记录
    public function dis_add_deal(){
        //获取活动标题
        $activity = model('Activity')->field('aid,a_title')->select();
        $this->assign('activity',$activity);
        return $this->fetch();
    }

    //添加成单记录
    public function add_deal(){
        //接收数据
        $data['mobile'] = input('post.mobile');
        $data['aid'] = input('post.aid');
        $data['tid'] = input('post.tid');
        $data['money'] = input('post.money');
        $data['remark'] = input('post.remark');

        //添加
        $model = new UserLogic();
        $res = $model->addDealRecord($data);
        if($res['status'] == 200){
            $this->success($res['msg'],'user/deal');
        }else{
            $this->error($res['msg']);
        }
    }

    //删除成单记录
    public function del_deal(){
        $id = input('post.id');
        $res = model('DealRecord')->where('id',$id)->delete();
        if($res){
            return_info(200,'删除成功');
        }else{
            return_info(-1,'删除失败');
        }
    }

    //记录签到
    public function userSign(){
        header('Content-type: application/json');
        //获取回调函数名
        $jsoncallback = htmlspecialchars($_REQUEST ['callback']);//把预定义的字符转换为 HTML 实体。

        $arr = [
            'code' => 200,
            'msg'  => '成功',
        ];

        $json_data=json_encode($arr);//转换为json数据

        //输出jsonp格式的数据
        echo $jsoncallback . "(" . $json_data . ")";
    }
}
