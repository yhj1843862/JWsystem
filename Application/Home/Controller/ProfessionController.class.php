<?php
/**
 * 专业控制器
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/27
 * Time: 上午9:52
 */
namespace Home\Controller;

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
}