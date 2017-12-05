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

    }



    /**
     * 添加违纪类型
     */
    public function add_type()
    {

    }

}