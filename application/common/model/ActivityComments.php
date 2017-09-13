<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityComments extends Model
{

    /**
	* 根据aid获取某条活动的评论
	*@aid 活动id
	*@field 需要字段，默认全查
    */
    public function getActivityComment($aid = 0,$field = '*'){
    	$map['aid'] = $aid;
        $map['type'] = 1;
    	$data = $this->field($field)->where($map)->select();
    	return $data;
    }

    /**
    * 根据aid获取某条活动的答疑
    *@aid 活动id
    *@field 需要字段，默认全查
    */
    public function getActivityQuestionComment($aid = 0,$field = '*'){
        $map['aid'] = $aid;
        $map['type'] = 2;
        $data = $this->field($field)->where($map)->order('comment_id desc')->select();
        return $data;
    }
    
    /**
     * 添加商品评论
     * @param type $uid
     * @param type $headicon
     * @param type $nickname
     * @param type $content
     * @param type $aid
     */
    public function addComments($nickname,$headIcon,$content,$aid){
        if(!empty($headIcon)){
            $data['headIcon'] = $headIcon;
        }
        $data['nickname'] = $nickname;
        $data['content'] = $content;
        $data['aid'] = $aid;
        $data['time'] = time();
        $data['type'] = 1;
        $this->insert($data);
    }
    
     /**
     * 插入答疑
     * @param type $nickname 昵称
     * @param type $headIcon 头像
     * @param type $aid     活动id
     * @param type $content 内容
     */
    public function insertAnswerQuestions($nickname,$headIcon,$aid,$content) {
        $data['nickname'] = $nickname;
        $data['headIcon'] = $headIcon;
        $data['aid'] = $aid;
        $data['content'] = $content;
        $data['time'] = time();
        $data['type'] = 2;
        
        $this->insert($data);
    }
    //获取所有答疑
    public function getAllAsk(){
        $map['a.type'] = 2;
        $map['a.reply_id'] = array('eq',0);
        $field = 'a.*,b.a_title';
        return $this->alias('a')->field($field)->join('mfw_activity b','a.aid = b.aid')->where($map)->select();
    }
    
    /**
     * 回复答疑
     * @param type $content
     * @param type $id
     * @return type
     */
    public function replyAsk($content,$id,$aid){
        
        $data['content'] = $content;
        $data['reply_id'] = $id;
        $data['nickname'] = '玩翫碗客服';
        $data['headIcon'] = '__IMG__/wan.jpg';
        $data['time'] = time();
        $data['aid'] = $aid;
        $data['type'] = 2;
        return $this->insert($data);
    }
    
    //修改评论
    public function saveComment($data = array()){
        return $this->update($data);
    }
    
    //获取任意回复信息
    public function getAnyReply($id){
        return $this->where('reply_id',$id)->find();
    }
    
    //删除评论
    public function delAnyReply($id){
        return $this->where('comment_id',$id)->delete();
    }
    
    //获取所有评论
    public function getAllComment(){
        $map['a.type'] = 1;
        $field = 'a.*,b.a_title';
        return $this->alias('a')->field($field)->join('mfw_activity b','a.aid = b.aid')->where($map)->select();
    }
}