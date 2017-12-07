<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/1
 * Time: 上午11:31
 */
namespace Common\Model;

use Think\Model;

class AreaModel extends Model
{

    /**
     * 获取一个地区的所有子级
     * @param $area_id
     * @return array
     */
    public function sons($area_id)
    {
        $list = $this->where(['parent_id'=>$area_id])->select();
        return ['list'=>$list];
    }

    /**
     * 获取一个地区的所有后代
     * @param $where
     * @param bool $sons
     * @return array
     */
    public function posterity(array $where,$sons=false)
    {
        $info = $this->where($where)->find();
        $path = $info['path'].$info['area_id'].'-';
        if($sons)
        {
            $where = "path LIKE '".$path."%'";
        }else{
            $where = "path LIKE '".$path."%' AND path <> '".$path."'";
        }
        $list = $this->where($where)->select();
        return ['list'=>$list];
    }

    /**
     * 添加一个地区
     * @param $name
     * @param int $parent_id
     * @return array
     */
    public function add_area($name,$parent_id = 0)
    {
        //检验数据是否符合规范
        if(mb_strlen($name,'UTF-8') < 2 || mb_strlen($name,'UTF-8') > 20)
        {
            return ['status'=>0, 'info'=>'地区名称长度应在2-20之间'];
        }
        //验证地区是否重复
        if($this->where(['area_name'=>$name, 'parent_id'=>$parent_id])->find())
        {
            return ['status'=>0, 'info'=>'地区已存在'];
        }

        if(empty($parent_id))
        {
            //处理顶级分类
            $res = $this->add(['area_name'=>$name,'parent_id'=>0,'path'=>'0-']);
        }else{
            //处理非顶级的分类
            //获取父级
            $parent_info = $this->where(['area_id'=>$parent_id])->find();
            if(empty($parent_info))
            {
                return ['status'=>0, 'info'=>'非法操作'];
            }

            $path = $parent_info['path'].$parent_id.'-';
            $res = $this->add(['area_name'=>$name,'parent_id'=>$parent_id,'path'=>$path]);
        }
        if($res)
        {
            return ['status'=>1, 'info'=>'成功'];
        }else{
            return ['status'=>0, 'info'=>'失败'];
        }

    }
}