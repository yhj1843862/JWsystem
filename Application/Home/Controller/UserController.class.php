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


    public function import_student()
    {
        if(IS_POST)
        {
            $class_id = I('post.class_id',0);
            if(empty($class_id))
            {
                $this->error('班级信息有误');
            }
            $root = 'upload/excel/';
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('xls','xlsx');// 设置附件上传类型
            $upload->rootPath  =      $root; // 设置附件上传根目录
            $upload->savePath  =      ''; // 设置附件上传（子）目录
            //// 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{
                // 上传成功 获取上传文件信息
                $file = $root.$info['xls']['savepath'].$info['xls']['savename'];
                $data = read_excel($file,2,['number','nickname','id_card','mobile','email','area']);
                session('import_student_'.$class_id, $data);
                $this->assign('user_list',$data);
                $this->assign('class_id',$class_id);
                $this->display('import_student_list');
            }
        }

        if(IS_GET)
        {
            $class_id = I('get.id',0);
            $this->assign('class_id',$class_id);
            $this->display();
        }
    }

    public function import_student_handler()
    {
        $cid = I('post.cid',0);
        //从session中读取数据
        $data = session('import_student_'.$cid);
        foreach ($data as $k=>$v)
        {
            $v['area'];
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