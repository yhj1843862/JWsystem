<?php
/**
 * 违纪处理控制器
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/5
 * Time: 下午2:44
 */

namespace Home\Controller;

class DisorderController extends BaseController
{
    /**
     * 添加学生违纪信息（第一步）
     */
    public function add_student()
    {
        if(IS_GET)
        {
            $this->display();
        }

        if(IS_POST)
        {
            $time = I('post.t','');
            $remark = I('post.remark','');
            //todo 数据验证
            $id = M('Disorder')->add(['disorder_time'=>$time,'remark'=>$remark]);
            if($id)
            {
                //添加成功
                $this->success('记录添加成功',U('add_student_2',['id'=>$id]));
            }else{
                $this->error('添加失败');
            }

        }
    }

    /**
     * 添加学生违纪信息（第二步）
     */
    public function add_student_2()
    {
        //echo M('User')->where(['role'=>1])->select(false);
        if(IS_POST)
        {
            $did = I('post.did', 0);
            $users = (array)I('post.users',[]);
            //todo 数据格式的验证
            $users = array_unique($users);
            $data = [];
            //todo 验证该用户是否已经存在本记录的违纪人员名单中
            foreach ($users as $k=>$v)
            {
                $data[$k]['user_id'] = $v;
                $data[$k]['disorder_id'] = $did;
            }
            if(M('disorder_user')->addAll($data))
            {
                $this->ajaxReturn(['status'=>1,'info'=>'成功','url'=>U('add_student_3',['id'=>$did])]);
            }else{
                $this->ajaxReturn(['status'=>0,'info'=>'失败']);
            }
        }

        if(IS_GET)
        {
            $id = I('get.id',0);
            $this->assign('did',$id);
            $this->display();
        }
    }

    /**
     * 添加违纪记录第3步
     */
    public function add_student_3()
    {
        $id = I('get.id',0);
        $this->assign('did', $id);
        //读取该违纪记录的已有的违纪类型
        $fix = C('DB_PREFIX');
        $list = M()->query('SELECT * FROM `'.$fix.'disorder_type` WHERE `type_id` IN (SELECT `type_id` FROM `'.$fix.'disorder_type_r` WHERE `disorder_id`='.$id.')');
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 添加违纪记录和违纪类型的关联关系
     */
    public function add_disorder_type()
    {
        //违纪记录id
        $did = I('post.did', 0);
        $name = I('post.name','');
        if(mb_strlen($name,'UTF-8') < 2)
        {
            $this->ajaxReturn(['status'=>0, 'info'=>'违纪类型长度过短']);
        }
        //检验该类型是否已经存在于数据库中
        $info = M('disorder_type')->where(['type_name'=>$name])->find();
        //准备关联表的数据
        $data['disorder_id'] = $did;
        if($info)
        {
            //已存在于数据库
            $data['type_id'] = $info['type_id'];
        }else{
            //目前不存在，则需要首先添加到数据库中
            $tid = M('disorder_type')->add(['type_name'=>$name]);
            if($tid)
            {
                $data['type_id'] = $tid;
            }else{
                $this->ajaxReturn(['status'=>0,'info'=>'失败']);
            }
        }
        //验证该类型是否已经与该违纪记录关联过
        if(M('disorder_type_r')->where($data)->find())
        {
            $this->ajaxReturn(['status'=>0,'info'=>'该类型已经被添加过']);
        }
        if(M('disorder_type_r')->add($data))
        {
            //添加成功
            $this->ajaxReturn(['status'=>1,'info'=>'成功']);
        }else{
            $this->ajaxReturn(['status'=>0,'info'=>'失败']);
        }
    }

    

    /**
     * 添加违纪类型
     */
    public function add_type()
    {

    }

    /**
     * 违纪列表
     */
    public function lists()
    {
        $start = I('get.start', '');
        $end = I('get.end', '');
        $page = I('get.p', 1);
        $data = D('Disorder')->lists($page, 12, $start, $end);
        $this->assign('start', $start);
        $this->assign('end', $end);
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 为违纪记录上传附件
     */
    public function add_attachment()
    {
        if (IS_GET)
        {
            $id = I('get.id', 0);
            $this->assign('id', $id);
            $this->display();
        }

        if(IS_POST)
        {
            $id = I('post.id', 0);
            if(empty($id))
            {
                $this->error('非法操作');
            }
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','zip','doc','docx','xls', 'xlsx');// 设置附件上传类型
            $upload->rootPath  =     'uploads/disorder/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            print_r($info);
//            if(!$info) {// 上传错误提示错误信息
//                $this->error($upload->getError());
//            }else{// 上传成功
//                $this->success('上传成功！');
//            }
        }
    }
}