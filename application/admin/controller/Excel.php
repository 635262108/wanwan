<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/18 0018
 * Time: 下午 5:52
 */

namespace app\admin\controller;


class Excel extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        require EXTEND_PATH.'excel/PHPExcel/IOFactory.php';
        require EXTEND_PATH."excel/PHPExcel.php";
        require EXTEND_PATH.'excel/PHPExcel/Writer/Excel5.php';
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

        //获取时间段信息
        if($tid != 0){
            $timeInfo = db('ActivityTime')->where('t_id',$tid)->find();
        }

        //只支持.xls文件
        $exten_name = substr(strrchr($_FILES['file']['name'], '.'), 1);
        if($exten_name != 'xls'){
            $this->error('支持支.xls文件格式');
        }
        //获取文件
        $filename = $_FILES['file']['tmp_name'];

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
            $E = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();//获取E列的值，大人数量
            $F = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();//获取F列的值，小孩数量
            $G = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();//获取G列的值，付款金额
            $H = $objPHPExcel->getActiveSheet()->getCell("H".$j)->getValue();//获取H列的值，来源
            $I = $objPHPExcel->getActiveSheet()->getCell("I".$j)->getValue();//获取I列的值，孩子姓名
            if(is_object($G))  $G= $G->__toString();    //转文本格式
            $J = $objPHPExcel->getActiveSheet()->getCell("J".$j)->getValue();//获取J列的值，孩子性别
            if(is_object($H))  $H= $H->__toString();    //转文本格式
            $K = $objPHPExcel->getActiveSheet()->getCell("K".$j)->getValue();//获取K列的值，孩子生日
            $L = $objPHPExcel->getActiveSheet()->getCell("L".$j)->getValue();//获取L列的值，孩子可玩耍时间
            if(is_object($J))  $J= $J->__toString();    //转文本格式
            $M = $objPHPExcel->getActiveSheet()->getCell("M".$j)->getValue();//获取M列的值，孩子学校
            if(is_object($K))  $K= $K->__toString();    //转文本格式
            $N = $objPHPExcel->getActiveSheet()->getCell("N".$j)->getValue();//获取N列的值，是否签到
            if(is_object($L))  $L= $L->__toString();    //转文本格式
            $O = $objPHPExcel->getActiveSheet()->getCell("O".$j)->getValue();//获取O列的值，支付方式
            if(is_object($O))  $O= $O->__toString();    //转文本格式
            $P = $objPHPExcel->getActiveSheet()->getCell("P".$j)->getValue();//获取P列的值，订单备注
            if(is_object($P))  $P= $P->__toString();    //转文本格式

            //手机号，来源为必填项，任何一个为空就不记录
            if(empty($B) || empty($H)){
                continue;
            }
            //下单时间，支付时间为空时默认导入时间，付款金额为空是默认0
            if(empty($C)){
                $C = date('Y-m-d H:i:s');
            }
            if(empty($D)){
                $D = date('Y-m-d H:i:s');
            }
            if(empty($G)){
                $G = 0;
            }
            $excel_data[$k]['name'] = $A?$A:'';
            $excel_data[$k]['mobile'] = (string)$B;
            $excel_data[$k]['addtime'] = strtotime($C);
            $excel_data[$k]['pay_time'] = strtotime($D);
            $excel_data[$k]['adult_num'] = intval($E);
            $excel_data[$k]['child_num'] = intval($F);
            $excel_data[$k]['pay_time'] = strtotime($D);
            $excel_data[$k]['order_price'] = $G;
            $excel_data[$k]['source'] = $H;
            $excel_data[$k]['child_name'] = $I?$I:'';
            $excel_data[$k]['child_gender'] = $J?$J:'';
            $excel_data[$k]['child_birthday'] = $K?$K:'';
            $excel_data[$k]['child_play_time'] = $L?$L:'';
            $excel_data[$k]['child_school'] = $M?$M:'';
            $excel_data[$k]['pay_way'] = $O?$O:0;
            $excel_data[$k]['remark'] = $P?$P:'';
            if($N == '是'){
                $excel_data[$k]['order_status'] = 4;
                $excel_data[$k]['sign_time'] = $timeInfo['begin_time'];
            }else{
                $excel_data[$k]['order_status'] = 3;
                $excel_data[$k]['sign_time'] = 0;
            }
            $k++;
        }
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
            $add_data[$i]['adult_num'] = $excel_data[$i]['adult_num'];
            $add_data[$i]['child_num'] = $excel_data[$i]['child_num'];
            $add_data[$i]['order_price'] = $excel_data[$i]['order_price'];
            $add_data[$i]['pay_way'] = array_search($excel_data[$i]['pay_way'],config('other.pay_way'));
            $add_data[$i]['pay_time'] = $excel_data[$i]['pay_time'];
            $add_data[$i]['order_status'] = $excel_data[$i]['order_status'];
            $add_data[$i]['addtime'] = $excel_data[$i]['addtime'];
            $add_data[$i]['source'] = $source;
            $add_data[$i]['t_id'] = $tid;
            $add_data[$i]['sign_time'] = $excel_data[$i]['sign_time'];
            $add_data[$i]['remark'] = $excel_data[$i]['remark'];

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
}