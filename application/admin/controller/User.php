<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\logic\UserLogic;

class User extends Base
{

    //会员列表
    public function index(){
        $zhengZhou = model('Region')->getSonData(149);
        return $this->fetch('',[
            'zhengZhou' => $zhengZhou,
        ]);
    }

    public function ajax_user_index(){
        $data = input('get.');

        //按新增时间筛选用户，1本月，其他本周
        $reg_time = '';
        if($data['add'] != ''){
            $data['add'] == 1 ? $reg_time = 'month' : $reg_time = 'week';
        }

        //条件
        $map = array();
        $data['address'] != '' ? $map['u.district'] = $data['address'] : false;
        $data['is_member'] != '' ? $map['u.member_grade'] = $data['is_member'] : false;
        $data['mobile'] != '' ? $map['u.mobile'] = ['like',"%".$data['mobile']."%"] : false;
        $data['nickname'] != '' ? $map['u.nickname'] = ['like',"%".$data['nickname']."%"] : false;

        $order_str = "`{$data['orderby1']}` {$data['orderby2']}";

        //按孩子姓名搜索
        if($data['childName'] != ''){
            $childInfo = model('UserChild')->getChildNameData($data['childName']);
            $uidArray = array();
            foreach($childInfo as $key=>$val){
                if(!in_array($val['uid'],$uidArray)){
                    $uidArray[] = $val['uid'];
                }
            }
            $uids = implode(",",$uidArray);
            $map['uid'] = ['in',$uids];
        }

        //来源搜索
        if($data['source'] != ''){
            $sourceData = model('Source')->where('name','like',"%".$data['source']."%")->select();
            $sidArray = array();
            foreach($sourceData as $key=>$val){
                if(!in_array($val['id'],$sidArray)){
                    $sidArray[] = $val['id'];
                }
            }
            $sid = implode(",",$sidArray);
            $map['source'] = ['in',$sid];
        }

        $userInfo = model('user')->alias('u')->field('u.*,s.name as source_name')
            ->join('mfw_source s','u.source=s.id','left')
            ->whereTime('reg_time',$reg_time)
            ->where($map)
            ->order($order_str)
            ->paginate(10);

        $page = $userInfo->render();

        return $this->fetch('',[
            'userInfo' => $userInfo,
            'page'  => $page
        ]);
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
        //获取来源数据
        $source = model('Source')->getSources();
  
        $this->assign('provinces',$provinces);
        $this->assign('citys',$citys);
        $this->assign('districts',$districts);
        $this->assign('userInfo',$userInfo);
        $this->assign('source',$source);
        return $this->fetch();
    }
    
    //修改个人信息
    public function saveUser(){
        $data = input('post.');
        $data['birthday'] = strtotime($data['birthday']);
        
        $user = model('user');
        $res = $user->save($data,['uid'=>$data['uid']]);
        if($res){
            $this->success('修改成功',$_SERVER['HTTP_REFERER']);
        }else{
            $this->success('修改失败');
        }
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
    public function attendance_class(){
        $data = input('param.');
        $where = '';
        if(isset($data['time'])){
            if($data['time'] == 1){
                $begintime =getTimePeriod('BeginThisWeek');
                $endtime = getTimePeriod('EndThisWeek');
            }else{
                $begintime = getTimePeriod('BeginLastWeek');
                $endtime = getTimePeriod('EndLastWeek');
            }

            $where = ' and t.begin_time > '.$begintime.' and t.end_time < '.$endtime;
        }else{
            if(isset($data['begin_time']) && $data['begin_time'] != ''){
                $begintime = strtotime($data['begin_time']);
                $where .= ' and t.begin_time > '.$begintime;
            }
            if(isset($data['end_time']) && $data['end_time'] != ''){
                $endtime = strtotime($data['end_time']);
                $where .= ' and t.end_time < '.$endtime;
            }
        }

        //获取数据
        $actinfo = model('ActivityTime')->query("select t.*,a.a_title,
                                    (select sum(o.child_num) from mfw_activity_order o where o.aid=t.aid and o.is_enter>0 and o.t_id=t.t_id) as enter_num,
                                    (select sum(o.child_num) from mfw_activity_order o where o.aid=t.aid and o.sign_time>0 and o.t_id=t.t_id) as sign_num
                                    from mfw_activity_time t right join mfw_activity a on t.aid=a.aid where t.aid=".$data['aid'].$where);
        foreach($actinfo as $k=>$v){
            $actinfo[$k]['enter_num'] = (int)$v['enter_num'];
            $actinfo[$k]['sign_num'] = (int)$v['sign_num'];
        }
        $this->assign('actinfo',$actinfo);
        return $this->fetch();
    }

    //考勤详情
    public function attendance_detail(){
        $aid = input('aid');
        $tid = input('tid');
        $is_sign = input('is_sign');
        $intent = input('intent');

        //条件：已参加或者未参加 1已参加,2未参加
        if($is_sign == 1 ) {
            $map['sign_time'] = ['>',0];
        }elseif($is_sign == 2) {
            $map['sign_time'] = ['=',0];
        }

        //条件：意向客户
        if($intent == 1){
            $map = [
                'label' => 1
            ];
        }
        //获取签到信息，来源等确定之后写成静态表
        $ActivityOrder = model('ActivityOrder');
        $map['aid'] = $aid;
        $map['t_id'] = $tid;
        $map['order_status'] = array('neq',2);
        $field = 'order_id,o.name username,o.order_price,o.mobile,u.uid,adult_num,child_num,sign_time,o.source,s.name,order_status,u.label,pay_way';
        $orderInfo = $ActivityOrder->getSignDetail($map,$field);

        //获取小孩姓名，便于工作人员查看
        $uids = '';
        foreach ($orderInfo as $k => $v) {
            $uids .= $v['uid'].",";
        }

        $uids = rtrim($uids,',');

        $children = model('UserChild')->where('uid','in',$uids)->select();

        //组装数据，让小孩姓名跟在家长后面
        $childName = '';
        foreach($orderInfo as $key => $val){
            foreach ($children as $k => $v){
                if($val['uid'] == $v['uid']){
                    $childName .= "/".$v['name'];
                }
            }
            $childName = ltrim($childName,'/');
            $orderInfo[$key]['childName'] = $childName;
            $childName = '';
        }

        $activityInfo = model('Activity')->get($aid);
        $timeInfo = model('ActivityTime')->get($tid);
        $this->assign('activityInfo',$activityInfo);
        $this->assign('timeInfo',$timeInfo);
        $this->assign('orderInfo',$orderInfo);
        $this->assign('aid',$aid);
        return $this->fetch();
    }


    //导出签到
    public function conversions_attendance($aid=0,$tid=0){
        //活动信息
        $Activity = model('Activity');
        $actinfo = $Activity->getIdActivity($aid,'a_title');

        $ActivityOrder = model('ActivityOrder');
        $map = [
            't_id' => $tid,
            'order_status' => array('neq',2)
        ];
        $order = $ActivityOrder->getOrders($map);

        //整理数据
        $ActivityTime = model('ActivityTime');
        $source = model('Source');
        $i = 1;
        $key = 0;
        $result = array();
        foreach($order as $k=>$v){
            //获取参加时间
            $time = $ActivityTime->getAnyTime($v['t_id']);
            //来源
            $sourceName = $source->where('id',$v['source'])->value('name');
            $key++;
            $result[$key]['id'] = $i++;     //序列号
            $result[$key]['name'] = $v['name']; //报名姓名
            $result[$key]['mobile'] = $v['mobile']; //完整电话
            $result[$key]['mobile2'] = substr($v['mobile'],0,3)."玩翫碗".substr($v['mobile'],7);    //报名电话
            $result[$key]['child_num'] = $v['child_num']; //小孩数量
            $result[$key]['adult_num'] = $v['adult_num']; //大人数量
            $result[$key]['time'] = $time['begin_time']."--".$time['end_time']; //报名时间
            $result[$key]['sign'] = getOrderStatus($v['order_status']);
            $result[$key]['source'] = $sourceName;
        }

        //导出excel
        $filename = "玩翫碗".$actinfo['a_title']."活动签到表";
        $title = '玩翫碗-'.$actinfo['a_title']."活动签到表";
        $key = array('id','name','mobile','mobile2','adult_num','child_num','time','sign','source');
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
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J2')->getFont()->setName("微软雅黑")->setSize(14)->setBold(true);
        //居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objActSheet->setCellValue('A1',  $title);
        $objActSheet->setCellValue('A2',  '序号');
        $objActSheet->setCellValue('B2',  '姓名');
        $objActSheet->setCellValue('C2',  '联系方式');
        $objActSheet->setCellValue('D2',  '联系方式');
        $objActSheet->setCellValue('E2',  '大人数量');
        $objActSheet->setCellValue('F2',  '小孩数量');
        $objActSheet->setCellValue('G2',  '活动时间');
        $objActSheet->setCellValue('H2',  '签到');
        $objActSheet->setCellValue('I2',  '报名渠道');
        $objActSheet->setCellValue('J2',  '备注');
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
        $data = input('get.');

        if(isset($data['beginTime']) && isset($data['endTime'])){
            $beginTime = $data['beginTime'];
            $endTime = $data['endTime'];
        }else{
            $beginTime = 0;
            $endTime = time();
        }

        $model = model('RechargeRecord');

        $field = 'r.*,u.nickname,u.mobile,u.balance';
        $res = $model->getUserBetweenTimeRechargeRecord($field,$beginTime,$endTime);
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
        $data = input('post.');
        $data['status'] = 1;
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
        if(!request()->ispost()){
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
        $data = input('post.');

        $model = new UserLogic();
        $result = $model->addUser($data);
        if($result['status'] == 200){
            $this->success('添加成功','user/index');
        }else{
            $this->error($result['msg']);
        }
    }

    //充值政策
    public function recharge_policy(){
        $data = model('Recharge')->select();

        return $this->fetch('',[
            'data' => $data
        ]);
    }

    //获取政策内容
    public function getPolicyCon(){
        $data = input('get.');
        $res = model('RechargePolicy')->getRechargeIdData($data['id'],'id,content');
        return_info(200,'成功',$res);
    }
    
    //添加充值政策
    public function dis_add_policy(){
    	return $this->fetch();
    }

    //添加政策
    public function addPolicy(){
        $data = input('post.');

        $recharge['money'] = $data['money'];
        $recharge['addtime'] = time();
        $id = model('Recharge')->insertGetId($recharge);
        if(!$id){
            $this->error('政策添加失败');
        }
        //添加政策内容
        $num = count($data['content']);
        $add_data = array();
        for($i=0;$i<$num;$i++){
            $add_data[$i]['recharge_id'] = $id;
            $add_data[$i]['content'] = $data['content'][$i];
            $add_data[$i]['addtime'] = time();
        }
        $res = model('RechargePolicy')->insertAll($add_data);
        if ($res){
            $this->success('添加成功');
        }else{
            $this->error('政策内容添加失败');
        }
    }

    //修改充值政策
    public function dis_save_policy($id){
        $policyInfo = model('Recharge')->get($id);
        $policyInfo->policy;
        return $this->fetch('',[
            'policyInfo'=>$policyInfo,
        ]);
    }

    //修改政策
    public function save_policy(){
        $data = input('post.');

        $rechargeData = [
            'money' => $data['money'],
        ];
        model('Recharge')->save($rechargeData,['id'=>$data['rechargeId']]);

        if(empty($data['policyId'])){
            $num = 0;
        }else{
            $num = count($data['policyId']);
        }

        $list = array();
        for ($i=0;$i<$num;$i++){
            $list[] = [
                'id' => $data['policyId'][$i],
                'content' => $data['content'][$i],
            ];
        }

        $con_num = count($data['content']);
        //内容比id多，代表有添加
        if($con_num > $num){
            for ($i=$num;$i<$con_num;$i++){
                $add_list[] = [
                    'recharge_id' => $data['rechargeId'],
                    'content' => $data['content'][$i],
                    'addtime' => time()
                ];
            }
            model('RechargePolicy')->insertAll($add_list);
        }

        model('RechargePolicy')->saveAll($list);
        $this->success('更新成功','user/recharge_policy');
    }

    //删除充值政策
    public function delRecharge(){
        $data = input('post.');
        $rechargeData = model('Recharge')->get($data['id']);
        if(empty($rechargeData)){
            $this->error('参数错误');
        }

        $rechargeData->delete();
        $rechargeData->policy()->delete();
        return_info('200','成功');
    }

    //删除政策内容
    public function delPolicy(){
        $data = input('get.');
        $res = model('RechargePolicy')->where('id',$data['id'])->delete();
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

    //签到管理
    public function sign(){
        return $this->fetch();
    }

    //记录签到
    public function rechargeSign(){
        $data = input('param.');
        if(!isset($data['u']) || !isset($data['o'])){
            return_info(-1,'无效请求');
        }
        $uid = str_decode($data['u']);
        $userInfo = model('user')->find($uid);
        if(empty($uid) || empty($userInfo)){
            return_info(-1,'用户不存在',['name'=>$userInfo['无效用户']]);
        }

        $oid = str_decode($data['o']);
        $orderInfo = model('ActivityOrder')->find($oid);
        $activityInfo = model('Activity')->find($orderInfo['aid']);

        $data = [
            'name' => $userInfo['nickname'],
            'activity' => $activityInfo['a_title'],
            'adult_num' => $orderInfo['adult_num'],
            'child_num' => $orderInfo['child_num']
        ];

        if(empty($orderInfo) || empty($oid)){
            return_info(-1,'订单为空，请检查客户订单，如无误请手动记录',$data);
        }

        if($orderInfo['sign_time'] > 0){
            return_info(-1,'此订单已签到，请检查客户订单是否有误',$data);
        }

        if($orderInfo['uid'] != $uid){
            return_info(-1,'订单号和用户不对称，请检查客户订单，如无误请手动记录',$data);
        }

        $orderInfo->sign_time = time();
        $orderInfo->order_status = 4;
        $res = $orderInfo->save();
        if($res){
            return_info(200,'签到成功',$data);
        }else{
            return_info(-1,'签到失败，请进行手动记录',$data);
        }
//        header('Content-type: application/json');
//        //获取回调函数名
//        $jsoncallback = htmlspecialchars($_REQUEST ['callback']);//把预定义的字符转换为 HTML 实体。
//
//        $arr = [
//            'code' => 200,
//            'msg'  => '成功',
//        ];
//
//        $json_data=json_encode($arr);//转换为json数据
//
//        //输出jsonp格式的数据
//        echo $jsoncallback . "(" . $json_data . ")";
    }

    //手机号签到管理
    public function mobile_sign(){
        return $this->fetch();
    }

    //根据手机号获取订单，签到界面用
    public function getMobileOrders(){
        $mobile = input('get.mobile');

        $map = [
            'mobile' => ['like',"%$mobile"],
            'order_status' => 3
        ];
        $field = 'order_id,a_title,mobile,name,adult_num,child_num,pay_way,pay_time';
        $orderInfo = model('ActivityOrder')->getOrderJoinActivity($map,$field);

        if(empty($orderInfo)){
            return_info(-1,'没有已付款的订单');
        }

        foreach ($orderInfo as $k => $v){
            $orderInfo[$k]['pay_way'] = payWay($v['pay_way']);
            $orderInfo[$k]['pay_time'] = date('Y-m-d H:i',$v['pay_time']);
        }

        return_info(200,'成功',$orderInfo);
    }

    //根据订单id签到
    public function orderIdSign(){
        $id = input('get.id');
        $orderInfo = model('ActivityOrder')->find($id);
        if(empty($orderInfo)){
            return_info(-1,'订单不存在');
        }
        $orderInfo->sign_time = time();
        $orderInfo->order_status = 4;
        $res = $orderInfo->save();
        if($res){
            return_info(200,'签到成功');
        }else{
            return_info(-1,'签到失败，请进行手动记录');
        }
    }

    //用户详情
    public function user_detail(){
        $uid = input('param.uid');
        //uid为手机号时用手机号查，导入的订单没有uid
        if(isMobile($uid)){
            $userInfo = model('user')->getMobileUserInfo($uid);
            $uid = $userInfo->uid;
        }else{
            $userInfo = model('user')->get($uid);
        }
        if(empty($userInfo)){
            $this->error('这条数据没有对应的用户');
        }
        $childInfo = model('UserChild')->getAnyUserChilds($uid);
        $detaiInfo = model('UserDetail')->getAnyUserDetail($uid);
        $orderInfo = model('ActivityOrder')
            ->alias('o')->field('o.*,a.a_title,s.name as source_name,t.begin_time,t.end_time')
            ->join('mfw_activity a','o.aid=a.aid','LEFT')
            ->join('mfw_activity_time t','t.t_id=o.t_id','LEFT')
            ->join('mfw_source s','o.source=s.id','LEFT')
            ->where(['o.uid'=>$uid,'o.order_status'=>['<>',2]])
            ->select();
        $sourceInfo = model('Source')->get($userInfo->source);
        //获取报名次数，消费金额，参加次数,充值次数
        $order_price_map = [
            'uid'=>$uid,
            'order_status' => ['in','1,3,4'],
        ];
        $result = [
            'enrol' => model('ActivityOrder')->getUserOrder($uid)->count(),
            'order_price' => model('ActivityOrder')->where($order_price_map)->sum('order_price'),
            'join_num' => model('ActivityOrder')->getUserSuccessJoinOrder($uid)->count(),
            'recharge_num' => model('RechargeRecord')->getUserRecharge($uid)->count(),
        ];
//        print_r($result);die;
        return $this->fetch('',[
            'userInfo' => $userInfo,
            'childInfo' => $childInfo,
            'detaiInfo' => $detaiInfo,
            'orderInfo' => $orderInfo,
            'sourceInfo' => $sourceInfo,
            'result' => $result
        ]);
    }

    //显示添加现场购票
    public function dis_add_ticket($tid = 0){
        $tInfo = model('ActivityTime')->get($tid);
        if(empty($tInfo)){
            $this->error('场次不正确');
        }
        $activityInfo = model('Activity')->get($tInfo->aid);
        $source = model('Source')->select();
        return $this->fetch('',[
            'source' => $source,
            'activityInfo' => $activityInfo,
            'tInfo' => $tInfo,
            'pay_way' => config('PAY_WAY')
        ]);
    }

    //给会员发送余额通知
    public function send_balance(){
        $res = \Sms::multi_send('123123','123213123');
        var_dump($res);
    }
}
