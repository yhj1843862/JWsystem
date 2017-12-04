<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/4
 * Time: 上午8:45
 */


namespace Common\Model;

use Think\Model;

class ClassModel extends Model
{
    public function class_list($where,$page=1,$num=12,$order = 'end_time DESC')
    {
        $where_string = fromat_where($where);
        if(!$where_string)
        {
            return ['status'=>0,'info'=>'查询条件有误'];
        }
        $fix = C('DB_PREFIX');
        $start = ($page - 1) * $num;
        $sql = 'SELECT * FROM (SELECT * FROM '.$fix.'class '.$where_string.' ORDER BY '.$order.' LIMT '.$start.','.$num.') AS A LEFT JOIN (SELECT `user_id`,`nickname`,`mobile`,`email`,`number`,`sex` FROM '.$fix.'user WHERE role=3) AS B ON B>`user_id`= A.`manger`';
        $list =$this->query($sql);
        $count = $this->where($where)->count();
        $Page =  new \Think\myPage($count,$num);
        $show = $Page->show();
        return ['status'=>1,'info'=>'成功','data'=>['list'=>$list,'page'=>$show]];
    }

    /**
     * 获取一个班级的基本信息
     * @param $value
     * @param string $key
     * @return mixed
     */
    public function clas_info($value,$key = 'class_id')
    {
        return $this->where(['$key'=>$value])->find();
    }
}