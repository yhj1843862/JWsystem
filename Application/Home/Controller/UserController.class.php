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


    /**
     * 从excel中导入学生信息
     */
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
                //将读出的数据先放入session中，临时存放
                session('import_student_'.$class_id, $data);
                //删除上传的文件
                unlink($file);
                //在数据入库前给用户预览一下要导入的数据
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

    /**
     * 确认导入用户操作，就是入库
     */
    public function import_student_handler()
    {
        $cid = I('post.cid',0);
        $class_info = D('Class')->class_info($cid);
        //从session中读取数据
        $data = session('import_student_'.$cid);
        $errors = [];
        //循环的将用户插入到数据库中
        foreach ($data as $k=>$v)
        {
            //处理籍贯问题的（将用户写的汉字籍贯转成数据库里面的地区信息）
            $a = explode('/',$v['area']);
            if(count($a) == 3)
            {
                $a[1] = $a[2];
            }
            $tmp = D('Area')->posterity(['area_name'=>$a[0],'parent_id'=>0],true);
            foreach ($tmp['list'] as $vv)
            {
                    if($a[1] == $vv['area_name'])
                    {
                        $v['area'] = $vv['area_id'];
                        //只要找到正确的，就直接退出循环
                        break;
                    }else{
                    //数据库中没有地区信息的情况
                    $errors[] = ['code'=>$v['number'],'info'=>'籍贯信息有误'];
                }
            }

            //组合用户的信息
            $v['department'] = $class_info['department'];
            $v['profession'] = $class_info['profession'];
            $v['class'] = $cid;
            //将该条信息插入到数据库中
            $res = D('User')->add_student($v);
            if(!$res['status'])
            {
                $errors[] = ['code'=>$v['number'],'info'=>$res['info']];
            }
        }
        //清空防在session中的临时数据
        session('import_student_'.$cid,null);
        $this->ajaxReturn($errors);
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