<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/1
 * Time: 下午6:56
 */
namespace Home\Controller;

use Think\Controller;

class SignController extends Controller
{
    /**
     *
     */
    public function login()
    {

//        if(session('user_info'))
//        {
//            //如果用户已经登录,则不能访问登录方法
//            $this->redirect('Home/Index/index');
//        }

        if(IS_GET)
        {
            $this->assign('page_tile','注册页面');
            $this->display();
        }
        if(IS_POST)
        {
           $string = I('post.string','');
           $password = I('post.password','');
           if(empty($password) || empty($string))
           {
               $this->error('用户名或密码有误');
           }
           //用身份证号登录
            if(id_card_available($string))
            {
                $this->sign_in($string,$password,'id_card');
            }
            //用手机号登录
            if(check_mobile($string))
            {
                $this->sign_in($string,$password,'mobile');
            }
            //使用邮箱登录
            if(check_email($string))
            {
                $this->sign_in($string,$password,'email');
            }
            //使用编号登录
            $this->sign_in($string,$password);
        }
    }

    /**
     * 登录处理
     * @param $string       用户账号
     * @param $password     密码
     * @param string $type  登录类型
     */
    public function sign_in($string,$password,$type = 'number')
    {
        $user_info = D('User')->user_info($string,$type);
        if(empty($user_info))
        {
            //用户不存在
            $this->error('用户不存在');
        }
        if(!password_verify($password,$user_info['pswd']))
        {
            $this->error('密码有误');
        }
        //登录成功的操作

        //获取用户角色信息
        $user_info['role_name'] = M('role')->where(['role_id'=>$user_info['role']])->getField('role_name');
        // 写入 session
        session('user_info',$user_info);
        $this->success('登录成功',U('Home/Index/index'));
        exit();
    }


    public function logout()
    {
        if(!session('user_info'))
        {
            //如果用户没有登录，则不能退出方法
            $this->redirect('Home/Index/index');
        }
        session('user_info','');
        $this->redirect('Home/Sign/login');
    }
}