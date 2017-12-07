<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/27
 * Time: 上午11:24
 */
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{

    protected $user_info = null;

    public function __construct()
    {
        parent::__construct();
        //验证用户是否已经登录，如果没有登录，直接跳转到登录页
        $user_info = session('user_info');
        if(!$user_info)
        {
            $this->redirect('Home/Sign/login');
        }
        $this->user_info = $user_info;
        $this->assign('user_info', $user_info);
    }
}