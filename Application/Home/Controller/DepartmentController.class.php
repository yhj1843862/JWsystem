<?php
/**
 * 院系控制器
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/27
 * Time: 上午9:52
 */

namespace Home\Controller;

class DepartmentController extends BaseController
{

    /**
     * 院系列表
     */
    public function lists()
    {
        $m = M('Department');
        $num = 12;
        $page = I('get.p',1);
        $list = $m->order('department_id')->page($page.','.$num)->select();
        $count      = $m->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        $this->assign('data', ['list'=>$list, 'page'=>$show]);
        $this->display();
    }


    /**
     * 添加院系
     */
    public function add()
    {
        if(IS_POST)
        {
            $name = I('post.name', '');
            $number = I('post.n', '');
            $remark = I('post.r', '');
            //todo 验证数据
            if(mb_strlen($name,'UTF-8') > 30 || mb_strlen($name,'UTF-8') < 2)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'院系名称长度应该在2-30之间']);
            }

            if(mb_strlen($number,'UTF-8') > 15 || mb_strlen($number,'UTF-8') < 1)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'编号长度应该在1-15之间']);
            }
            if(mb_strlen($remark,'UTF-8') > 255 || mb_strlen($remark,'UTF-8') < 10)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'院系介绍长度应该在10-255之间']);
            }
            $m = M('Department');
            //验证重名现象
            if($m->where(['department_name'=>$name])->find())
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'"'.$name.'"已存在']);
            }

            if($m->where(['department_number'=>$number])->find())
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'编号"'.$number.'"已存在']);
            }


            //将数据插入到数据库
            if($m->add(['department_name'=>$name, 'department_number'=>$number, 'department_remark'=>$remark]))
            {
                $this->ajaxReturn(['status'=>1, 'info'=>'成功']);
            }else{
                $this->ajaxReturn(['status'=>0, 'info'=>'失败']);
            }

        }

        if(IS_GET)
        {
            $this->display();
        }
    }

}