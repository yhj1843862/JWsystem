<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/4
 * Time: 下午2:49
 */

namespace Home\Controller;
class DutyController extends BaseController
{
    protected $dutys = [1, 2, 3, 4, 5];

    /**
     * 值班人员列表
     */
    public function lists()
    {
        //由于值班人员数量不会太多，就不考虑分页了
        $fix = C('DB_PREFIX');
        $list = M()->query('SELECT A.*,B.ranking FROM (SELECT * FROM `' . $fix . 'user` WHERE `role` <> 1 ) AS A RIGHT JOIN (SELECT * FROM `' . $fix . 'duty_user`) AS B ON B.`user_id`=A.`user_id`  ORDER BY `ranking` ASC');
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 添加值班人员列表
     */
    public function add_user()
    {
        if (IS_GET) {
            //获取符合值班条件但不在值班列表中的人员列表
            $fix = C('DB_PREFIX');
            $sql = 'SELECT * FROM `' . $fix . 'user` WHERE `role` <> 1 AND `user_id` NOT IN (SELECT `user_id` FROM `' . $fix . 'duty_user`)';
            $list = M()->query($sql);
            $this->assign('list', $list);
            $this->display();
        }

        if (IS_POST) {
            $user_id = I('post.uid', 0);
            $ranking = I('post.ranking', 0);
            //验证该用户是否已经在值班列表中
            if (M('Duty_user')->where(['user_id' => $user_id])->find()) {
                $this->ajaxReturn(['status' => 0, 'info' => '该用户已经在值班列表中']);
            }
            //将值班用户加入到值班人员中
            if (M('Duty_user')->add(['user_id' => $user_id, 'ranking' => $ranking])) {
                $this->ajaxReturn(['status' => 1, 'info' => '成功']);
            } else {
                $this->ajaxReturn(['status' => 0, 'info' => '失败']);
            }
        }
    }

    /**
     * 值班日志
     */
    public function logs()
    {

    }

    /**
     * 近两个周期的值班安排
     */
    public function plan()
    {
        //计算值班人员的总量
        $user_list = M('Duty_user')->select();
        $num = count($user_list) * 2;
        $plans = [];
        //$start_time = time() + 86400;
        $time = time();
        //echo date('w',$time);

//        while (count($plans) == $num)
//        {
//            if(in_array(date('w',$time), $this->dutys))
//            {
//                $plans[date('Y-m-d', $time)] = current($user_list);
//
//            }
//        }
    }
}