<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Cache;


class User extends Base
{    
    //登录
    public function login(){
        // 检测是否为ajax请求
        if(request()->isAjax()){
            //用户名
            $name = input('post.name');
            //密码
            $password = input('post.pwd');

            //登录验证
            if($password == 'wanwanwan123!@#' & $name=='admin'){
                //存储用户信息
                $data['nickname'] = 'admin';
                Session::set('adminInfo',$data);
                return return_info(200,'登录成功');
            }else{
                return return_info(-1,'帐号或密码错误');
            }
        }else{
            return $this->fetch();
        }
    }
    
    //会员列表
    public function index(){
        $user = model('user');
        $userInfo = $user->getAllUser();
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
            
            return_info(200,'成功',$userInfo);
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
    
    //考勤首页
    public function attendance(){
        $Activity = model('Activity');
        $actinfo = $Activity->getAttendance();
        $this->assign('actinfo',$actinfo);
        return $this->fetch();
    }
    
    //考勤详情
    public function attendance_detail($aid=0){
        $ActivityOrder = model('ActivityOrder');
        $map['aid'] = $aid;
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
        $this->fetch();
    }
}
