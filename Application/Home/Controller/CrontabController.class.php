<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/5
 * Time: 上午10:35
 */
namespace Home\Controller;

use Think\Controller;

class CrontabController extends Controller
{
    public function update_duty()
    {
        if(IS_POST)
        {
            if(I('post.auth') == 'sdgbndfxbgnhbdfhsnjsetamgfdvhbzaxbvnchbfg')
            {
                //执行一些更新操作
                $data = F('plan');
                $data = $data[date('Y-m-d')];
                M('duty_logs')->add(['nickname'=>$data['nickname'],'user_id'=>$data['user_id'],'email'=>$data['email'],'mobile'=>$data['mobile']]);
                //重新编排一下第二天的值班顺序
            }else{
                echo "你是不是傻\r\n";
            }
        }
    }
}