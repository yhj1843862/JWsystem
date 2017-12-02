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

    public function add_student()
    {
        
    }

    public function user_list()
    {
        $data = D('User')->user_list2(I('get.p',1),12);
        foreach ($data['list'] as $k=>$v)
        {
            $data['list'][$k]['id_card'] = hide_id_card($v['id_card']);
        }
        $this->assign('user_list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }
}