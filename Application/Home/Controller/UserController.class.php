<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/1
 * Time: 下午10:12
 */
namespace Home\Controller;

class UserController extends BaseController
{

    public function add()
    {
        if(IS_POST)
        {
            $data = I('post.');
            $this->ajaxReturn(D('User')->add_user($data));
        }
        if(IS_GET)
        {
            //读取角色列表(neq 不等于)
            $role_list = M('role')->where(['role_id'=>['neq',1]])->select();
            $this->assign('role_list',$role_list);
            //读取地区列表
            $area_list = M('Area')->where(['parent_id'=>0])->select();
            $this->assign('area_list',$area_list);
            $this->display();
        }
    }
}