<?php
/**
 * 登录注册控制器
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/27
 * Time: 上午9:55
 */

namespace Home\Controller;

use Think\Controller;

class SignController extends Controller
{
    public function login()
    {
        if (session('user_info')) {
            //如果用户已经登录，则不能访问登录方法
            $this->redirect('Home/Index/index');
        }

        if (IS_GET) {
            $this->display();
        }

        if (IS_POST) {
            $string = I('post.string', '');
            $password = I('post.password', '');
            if (empty($string) || empty($password)) {
                $this->error('用户名或者密码有误');
            }
            if (id_card_available($string)) {
                //身份证号登录
                $this->sign_in($string, $password, 'id_card');
            }

            if (check_email($string)) {
                //使用邮箱登录
                $this->sign_in($string, $password, 'email');
            }

            if (check_mobile($string)) {
                //使用手机号登录
                $this->sign_in($string, $password, 'mobile');
            }

            //使用编号登录
            $this->sign_in($string, $password);

        }
    }

    /**
     * 登录处理
     * @param $string
     * @param $password
     * @param string $type
     */
    protected function sign_in($string, $password, $type = 'number')
    {
        $user_info = D('User')->user_info($string, $type);
        if (empty($user_info)) {
            //根本不存在该用户
            $this->error('用户不存在');
        }
        if (!password_verify($password, $user_info['pswd'])) {
            $this->error('密码有误');
        }
        //登录成功的后续操作
        //获取用户的角色信息
        $user_info['role_name'] = M('role')->where(['role_id' => $user_info['role']])->getField('role_name');
        session('user_info', $user_info);
        $this->success('登录成功', U('Home/Index/index'));
        exit();
    }

    public function verify()
    {
        $Verify = new \Think\Verify();
        $Verify->entry();
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        if (!session('user_info')) {
            //如果用户没有登录，则不能退出方法
            $this->redirect('Home/Sign/login');
        }
        session('user_info', null);
        $this->redirect('Home/Sign/login');
    }


}