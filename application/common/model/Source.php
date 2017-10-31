<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 上午 11:13
 */

namespace app\common\model;


use think\Model;

class Source extends Model
{
    /**
     * 获取单个数据
     * @param array $map
     * @param string $offset
     * @param string $limit
     */
    public function getSource($map = array()){
        return $this->where($map)->find();
    }

    /**
     * 获取一组数据
     * @param array $map
     * @param string $offset
     * @param string $limit
     */
    public function getSources($map = array(),$offset = '',$limit = ''){
        return $this->where($map)->limit($offset,$limit)->order('id desc')->select();
    }

    /**
     * 根据id获取一条数据
     * @param $id
     * @return mixed
     */
    public function getSourceId($id){
        return $this->find($id);
    }
}