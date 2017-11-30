<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/30
 * Time: 上午10:16
 */
namespace Common\Model;

use Think\Model;

class ClassModel extends Model
{

    public function class_list($where, $page = 1, $num = 12 ,$order = 'end_time DESC')
    {
        $where_string = format_where($where);
        if(!$where_string)
        {
            return ['status'=>0,'info'=>'查询条件有误'];
        }
        $fix = C('DB_PREFIX');
        $start = ($page - 1) * $num;
        $sql = 'SELECT * FROM (SELECT * FROM '.$fix.'class '.$where_string.' ORDER BY '.$order.' LIMIT '.$start.','.$num.') AS A LEFT JOIN (SELECT `user_id`,`nickname`,`mobile`,`email`,`number`,`sex` FROM '.$fix.'user WHERE role=3) AS B ON B.`user_id`=A.`manager`';
        $list = $this->query($sql);
        $count      = $this->where($where)->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        return ['status'=>1,'info'=>'成功', 'data'=>['list'=>$list,'page'=>$show]];
    }
}