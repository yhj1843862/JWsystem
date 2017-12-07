<?php
/**
 * 班级控制器
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/27
 * Time: 上午9:53
 */
namespace Home\Controller;

class ClassController extends BaseController
{
    /**
     * 添加班级操作
     */
    public function add()
    {
        if(IS_GET)
        {
            $id = I('get.id',0);
            $this->assign('profession_id', $id);
            //读取辅导员的信息列表
            //获取角色列表
            $this->assign('role_list', M('role')->select());
            $this->display();
        }

        if(IS_POST)
        {
            $name = I('post.name', '');
            $number = I('post.n', '');
            $profession_id = (int)I('post.pid',0);

            if(empty($profession_id))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'所属专业有误']);
            }

            if(mb_strlen($name,'UTF-8') > 20 || mb_strlen($name,'UTF-8') < 2)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'班级名称长度应该在2-20之间']);
            }

            if(mb_strlen($number,'UTF-8') > 15 || mb_strlen($number,'UTF-8') < 1)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'编号长度应该在1-15之间']);
            }

            $max = I('post.logmax','');
            $min = I('post.logmin','');
            $manager = I('post.uid',0);

            if(strtotime($max) <= strtotime($min))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'毕业时间不能早于或等于入学时间']);
            }
            if(empty($manager))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'请选择正确的辅导员']);
            }

            $m = M('Class');
            //验证重名现象
            if($m->where(['class_name'=>$name])->find())
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'"'.$name.'"已存在']);
            }

            if($m->where(['class_number'=>$number])->find())
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'编号"'.$number.'"已存在']);
            }
            $department = M('Profession')->where(['profession_id'=>$profession_id])->getField('department');

            //将数据插入到数据库
            if($m->add(['class_name'=>$name, 'class_number'=>$number, 'start_time'=>$min, 'end_time'=>$max,'student_num'=>0, 'manager'=>$manager,'profession'=>$profession_id,'department'=>$department] ))
            {
                $this->ajaxReturn(['status'=>1, 'info'=>'成功']);
            }else{
                $this->ajaxReturn(['status'=>0, 'info'=>'失败']);
            }
        }
    }


    public function class_list()
    {
        $profession_id = I('get.id',0);
        $page = I('get.p', 1);
        $result = D('Class')->class_list(['profession'=>$profession_id],$page,10);
        if(!$result['status'])
        {
            $this->error($result['info']);
        }
        $this->assign('data', $result['data']);
        $this->display();
    }

    /**
     * 某个班级下的学生列表
     */
    public function class_student_list()
    {
        $page = I('get.p',1);
        $data = D('User')->user_list(['class'=>I('get.id',0)], $page, 10);
        foreach ($data['list'] as $k=>$v)
        {
            $data['list'][$k]['id_card'] = hide_id_card($v['id_card']);
        }
        $this->assign('user_list', $data['list']);
        $this->assign('page', $data['page']);
        $this->display();
    }

    /**
     * 某个班级的学科列表
     */
    public function subject_list()
    {
        $class_id = I('get.id',0);
        $data = D('Subject')->class_subject_list($class_id, I('get.p',1));
        $this->assign('data', $data);
        $this->display();
    }

    public function set_teacher()
    {
        if(IS_GET)
        {
            $cid = I('get.cid',0);
            $sid = I('get.sid',0);
            $teachers = M('User')->where(['role'=>2])->select();
            $this->assign('teachers', $teachers);
            $this->assign('class_id', $cid);
            $this->assign('subject_id', $sid);
            $this->display();
        }

        if(IS_POST)
        {
            $cid = I('post.cid', 0);
            $sid = I('post.sid', 0);
            $tid = I('post.tid', 0);
            if(empty($sid) || empty($cid) || empty($tid))
            {
                $this->error('信息不全');
            }
            if(M('class_subject_teacher')->where(['class_id'=>$cid, 'subject_id'=>$sid])->save(['teacher_id'=>$tid]))
            {
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }

    }
}