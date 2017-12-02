<?php
/**
 * 专业控制器
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/27
 * Time: 上午9:52
 */
namespace Home\Controller;

use Common\ViewModel\ProfessionViewModel;

class ProfessionController extends BaseController
{
    public function add()
    {
        if(IS_GET)
        {
            $id = I('get.id',0);
            $this->assign('department_id', $id);
            $this->display();
        }

        if(IS_POST)
        {
            $name = I('post.name', '');
            $number = I('post.n', '');
            $remark = I('post.r', '');
            $department_id = (int)I('post.department_id',0);
            if(empty($department_id))
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'所属院系有误']);
            }

            if(mb_strlen($name,'UTF-8') > 20 || mb_strlen($name,'UTF-8') < 2)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'专业名称长度应该在2-20之间']);
            }

            if(mb_strlen($number,'UTF-8') > 15 || mb_strlen($number,'UTF-8') < 1)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'编号长度应该在1-15之间']);
            }
            if(mb_strlen($remark,'UTF-8') > 255 || mb_strlen($remark,'UTF-8') < 10)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'专业介绍长度应该在10-255之间']);
            }
            $m = M('Profession');
            //验证重名现象
            if($m->where(['profession_name'=>$name])->find())
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'"'.$name.'"已存在']);
            }

            if($m->where(['profession_number'=>$number])->find())
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'编号"'.$number.'"已存在']);
            }


            //将数据插入到数据库
            if($m->add(['profession_name'=>$name, 'profession_number'=>$number, 'department'=>$department_id , 'profession_remark'=>$remark]))
            {
                $this->ajaxReturn(['status'=>1, 'info'=>'成功']);
            }else{
                $this->ajaxReturn(['status'=>0, 'info'=>'失败']);
            }
        }
    }

    /**
     * 专业列表
     */
    public function lists()
    {
        $did = I('get.id',0);
        $from = I('get.from',0);
        $where = [];
        if (!empty($did))
        {
            $where['department'] = $did;
        }
        $m = new ProfessionViewModel();
        $num = 12;
        $page = I('get.p',1);
        $list = $m->where($where)->page($page.','.$num)->select();
        $count      = $m->where($where)->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        $this->assign('data', ['list'=>$list, 'page'=>$show]);
        $this->assign('did', $did);
        $this->assign('from', $from);
        $this->display();
    }

    public function ajax_class_list()
    {
        //获取某个专业下的班级列表
        $profession = I('post.pid',0);
        $data = D('Class')->class_list(['profession'=>$profession],1,999999);
        if($data['status'])
        {
            $str = '';
            foreach ($data['data']['list'] as $k=>$v)
            {
                $str .= '<option value="'.$v['class_id'].'">'.$v['class_name'].'</option>';
            }
            $this->ajaxReturn($str);
        }else{
            $this->ajaxReturn('');
        }
    }


    /**
     * 某个专业的学科配置
     */
    public function set_subject()
    {
        if(IS_GET)
        {
            $pid = I('get.id',0);
            $data = D('Subject')->lists(I('get.p'),12);
            $this->assign('data', $data);
            $this->assign('pid', $pid);
            $this->display();
        }

        if(IS_POST)
        {
            $subject_id =  I('post.id',0);
            $profession_id =  I('post.pid',0);
            $type = I('post.type',0);
            //自动的为该专业下的所有班级添加"学科对应关系"
            $data = D('Class')->class_list(['profession'=>$profession_id],1,999999);
            $class_list = $data['data']['list'];
            $data = [];
            foreach ($class_list as $k=>$v)
            {
                $data[$k]['class_id'] = $v['class_id'];
                $data[$k]['subject_id'] = $subject_id;
                $data[$k]['necessary'] = $type;
                $data[$k]['teacher_id'] = 0;
            }
            //todo 用户多次插入的可能，添加重复数据的可能

            //将班级和学科关系加入到数据库中
            if(M('class_subject_teacher')->addAll($data))
            {
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0,'info'=>'失败']);
            }




        }
    }

}