<?php


namespace app\common\model;

use think\Model;
use think\Db;

class Message extends Model
{
    /**
     * 发送一条消息
     * @param type $uid
     * @param type $content
     * @param type $type 1:订单消息2:系统消息
     * 
     */
    public function sendMessage($uid,$content,$type){
        $data['uid'] = $uid;
        $data['content'] = $content;
        $data['type'] = $type;
        $data['send_time'] = time();
        $this->insert($data);
    }
    /**
     * 获取用户消息
     * @param type $uid
     */
    public function getMessage($uid){
        $map['uid'] = $uid;
        return $this->where($map)->order('send_time desc')->select();
    }
    /**
     * 消息改为已读
     * @param type $uid
     */
    public function saveStatus($uid){
        $map['uid'] = $uid;
        $data['status'] = 1;
        $this->where($map)->update($data);
    }
    //获取未读消息数
    public function getUnReadMessageCount($uid){
        $map['uid'] = $uid;
        $map['status'] = 0;
        return $this->where($map)->count();
    }
    
    //获取消息
    public function getMessages($map=array()){
        return $this->where($map)->select();
    }
}