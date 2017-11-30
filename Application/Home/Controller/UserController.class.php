<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/23
 * Time: 上午9:48
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
            //读取角色列表
            $role_list = M('role')->where(['role_id'=>['neq',1]])->select();
            $this->assign('role_list', $role_list);
            //读取地区列表
            $area_list = M('Area')->where(['parent_id'=>0])->select();
            $this->assign('area_list', $area_list);
            $this->display();
        }
    }

    public function add_student()
    {
        if(IS_GET)
        {
            //读取院系列表
            $this->assign('d_list',M('department')->select());
            //读取地区列表
            $area_list = M('Area')->where(['parent_id'=>0])->select();
            $this->assign('area_list', $area_list);
            $this->display();
        }

        if(IS_POST)
        {
            $data = I('post.');
            if(!isset($data['department']) || empty($data['department']))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'请选择正确的院系信息']);
            }

            if(!isset($data['profession']) || empty($data['profession']))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'请选择正确的专业信息']);
            }

            if(!isset($data['class']) || empty($data['class']))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'请选择正确的班级信息']);
            }
            $data['role'] = 1;
            $this->ajaxReturn(D('User')->add_user($data));
        }
    }

    public function user_list()
    {
        //$data = D('User')->user_list([], I('get.p'), 2);
        $data = D('User')->user_list2(I('get.p',1), 12);
        foreach ($data['list'] as $k=>$v)
        {
            $data['list'][$k]['id_card'] = hide_id_card($v['id_card']);
        }
        $this->assign('user_list', $data['list']);
        $this->assign('page', $data['page']);
        $this->display();
    }

    public function ajax_user_list()
    {
        $where = [];
        $role = I('post.role', 0);
        $where['role'] = $role;
        $page = I('post.page',1);
        $num = I('post.num', 999999);
        $data = D('User')->user_list($where,$page, $num);
        $this->ajaxReturn($data);
    }
}