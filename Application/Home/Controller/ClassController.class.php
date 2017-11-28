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
        $list = M('class')->where(['profession'=>$profession_id])->select();
        $this->assign('list', $list);
        $this->display();
    }
}