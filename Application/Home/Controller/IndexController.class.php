<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/23
 * Time: 上午9:54
 */
namespace Home\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        U('Home/User/id');
        $this->assign('page_title','后台首页');
        $this->display();
    }

    public function welcome()
    {

        $this->display();
    }
}