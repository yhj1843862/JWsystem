<?php
namespace Home\Controller;

class IndexController extends BaseController {
    public function index(){
        U('Home/User/id');
        $this->assign('page_tile','后台首页');
        $this->display();
    }

    public function welcome(){
        $this->display();
    }
}