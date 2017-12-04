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
        $list = $this->duty_user_list();
        $this->assign('list', $list);
        $this->display();
    }

    protected function duty_user_list()
    {
        $fix = C('DB_PREFIX');
        return M()->query('SELECT A.*,B.ranking FROM (SELECT * FROM `'.$fix.'user` WHERE `role` <> 1 ) AS A RIGHT JOIN (SELECT * FROM `'.$fix.'duty_user`) AS B ON B.`user_id`=A.`user_id`  ORDER BY `ranking` ASC');
    }

    /**
     * 添加值班人员列表
     */
    public function add_user()
    {
        if(IS_GET)
        {
            //获取符合值班条件但不在值班列表中的人员列表
            $fix = C('DB_PREFIX');
            $sql = 'SELECT * FROM `'.$fix.'user` WHERE `role` <> 1 AND `user_id` NOT IN (SELECT `user_id` FROM `'.$fix.'duty_user`)';
            $list = M()->query($sql);
            $this->assign('list',$list);
            $this->display();
        }

        if(IS_POST)
        {
            $user_id = I('post.uid', 0);
            $ranking = I('post.ranking', 0);
            //验证该用户是否已经在值班列表中
            if(M('Duty_user')->where(['user_id'=>$user_id])->find()){
                $this->ajaxReturn(['status'=>0, 'info'=>'该用户已经在值班列表中']);
            }
            //将值班用户加入到值班人员中
            if(M('Duty_user')->add(['user_id'=>$user_id, 'ranking'=>$ranking]))
            {
                $this->ajaxReturn(['status'=>1, 'info'=>'成功']);
            }else{
                $this->ajaxReturn(['status'=>0, 'info'=>'失败']);
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
        $user_list = $this->duty_user_list();
        //todo 等做完值班日志后，从日志中可以读取到
        $prev_user = 32;
        //我们先要将当前周期中，已值过班的用户排除掉
        foreach ($user_list as $v)
        {
            if($v['user_id'] == $prev_user)
            {
                break;
            }else{
                //将数组指针向后移动一位
                if(next($user_list) === false)
                {
                    //如果数组指针已经移到末尾，则将指针移到最前面
                    reset($user_list);
                }
            }
        }
        //生成3轮值班的顺序表
        $num = count($user_list) * 3;
        $plans = [];
        $i = 0;
        while (count($plans) < $num)
        {
            $time = time() + $i * 86400;
            if(in_array(date('w',$time), $this->dutys))
            {
                //获取数组指针指向的当前元素
                $cur = current($user_list);
                $plans[date('Y-m-d', $time)] = $cur;
                //将数组指针向后移动一位
                if(next($user_list) === false)
                {
                    //如果数组指针已经移到末尾，则将指针移到最前面
                    reset($user_list);
                }
            }
            $i++;
        }
        //todo 考虑调班的情况
        F('plan',$plans);
        $this->assign('plan', $plans);
        $this->display();
    }

    public function change_duty()
    {
        $date = I('get.d','');
        $duty_list = F('plan');
        //不能和要调班的同一天对调
        unset($duty_list[$date]);
        foreach ($duty_list as $key => $item) {
            //不能和自己的值班对调
            if ($item['id_card'] == $this->user_info['id_card'])
            {
                unset($duty_list[$key]);
            }
        }
        $this->assign('plan', $duty_list);
        $this->display();
    }
}