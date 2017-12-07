<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/7
 * Time: 下午2:39
 */
namespace Common\Model;
use Think\Model;

class DisorderModel extends Model
{

    /**
     * 学生违纪列表
     * @param int $page
     * @param int $num
     * @param string $order
     * @return array
     */
    public function lists( $page = 1, $num = 12, $start_time = '', $end_time = null, $order = 'id DESC')
    {
        $where = '';
        $start_time = empty($start_time) ? '0000-00-00' : $start_time;
        $where .= ' disorder_time > "'.$start_time.'" ';

        if(!empty($end_time))
        {
            $where .= ' AND disorder_time <= "'.$end_time.' 23:59:59" ';
        }
        $fix = C('DB_PREFIX');
        $start = ($page - 1) * $num;
        $list = $this->query("SELECT E.*,GROUP_CONCAT(user_info) AS users FROM (SELECT *,GROUP_CONCAT(type_name,'-',type_id) AS types  FROM (SELECT * FROM `".$fix."disorder` WHERE ".$where." ORDER BY ".$order." LIMIT ".$start.",".$num.") AS C LEFT JOIN (SELECT B.*,A.`disorder_id` FROM `".$fix."disorder_type_r` AS A INNER JOIN `".$fix."disorder_type` AS B ON A.type_id=B.type_id) AS D ON C.`id`=D.`disorder_id` GROUP BY id) AS E LEFT JOIN (SELECT CONCAT(Z.`user_id`,'-',Z.`nickname`,'-',Z.`number`,'-',Z.`mobile`,'-',Z.`email`,'-',Z.`sex`,'-',Z.`class`,'-',Z.`profession`,'-',Z.`department`) AS user_info,Y.* FROM `".$fix."disorder_user` AS Y  INNER JOIN (SELECT * FROM `".$fix."user` WHERE role=1) AS Z ON Y.`user_id`=Z.`user_id`) AS F ON F.`disorder_id`=E.`id` GROUP BY id ORDER BY id DESC");
        foreach ($list as $k=>$v)
        {
            if(!empty($v['types']))
            {
                $t = explode(',', $v['types']);
                foreach ($t as $kk=>$vv)
                {
                    $t_tmp = explode('-',$vv);
                    unset($t[$kk]);
                    $t[$kk]['type_name'] = $t_tmp[0];
                    $t[$kk]['type_id'] = $t_tmp[1];
                }
                $list[$k]['types'] = $t;
            }


            if(!empty($v['users']))
            {
                $u = explode(',', $v['users']);
                foreach ($u as $kk=>$vv)
                {
                    $u_tmp = explode('-',$vv);
                    unset($u[$kk]);
                    $u[$kk]['user_id'] = $u_tmp[0];
                    $u[$kk]['nickname'] = $u_tmp[1];
                    $u[$kk]['number'] = $u_tmp[2];
                    $u[$kk]['mobile'] = $u_tmp[3];
                    $u[$kk]['email'] = $u_tmp[4];
                    $u[$kk]['sex'] = $u_tmp[5];
                    $u[$kk]['class'] = $u_tmp[6];
                    $u[$kk]['profession'] = $u_tmp[7];
                    $u[$kk]['department'] = $u_tmp[8];
                }
                $list[$k]['users'] = $u;
            }

        }
        $count = $this->where($where)->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        return ['list'=>$list, 'page'=>$show];
    }

}