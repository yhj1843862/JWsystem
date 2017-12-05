<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/2
 * Time: 上午11:43
 */

namespace Home\Controller;

class SubjectController extends BaseController
{
    /**
     * 添加学科
     */
    public function add()
    {
        if (IS_POST) {
            $name = I('post.name', '');
            $number = I('post.n', '');
            $remark = I('post.r', '');


            if (mb_strlen($name, 'UTF-8') > 25 || mb_strlen($name, 'UTF-8') < 2) {
                $this->ajaxReturn(['status' => 0, 'info' => '学科名称长度应该在2-25之间']);
            }

            if (mb_strlen($number, 'UTF-8') > 15 || mb_strlen($number, 'UTF-8') < 1) {
                $this->ajaxReturn(['status' => 0, 'info' => '编号长度应该在1-15之间']);
            }
            if (mb_strlen($remark, 'UTF-8') < 10) {
                $this->ajaxReturn(['status' => 0, 'info' => '学科介绍长度最少需要10个字符']);
            }
            $m = M('Subject');
            //验证重名现象
            if ($m->where(['subject_name' => $name])->find()) {
                $this->ajaxReturn(['status' => 0, 'info' => '学科名称已存在']);
            }
            if ($m->where(['subject_number' => $number])->find()) {
                $this->ajaxReturn(['status' => 0, 'info' => '学科编号已存在']);
            }

            //将数据插入到数据库
            if ($m->add(['subject_name' => $name, 'subject_number' => $number, 'subject_remark' => $remark])) {
                $this->ajaxReturn(['status' => 1, 'info' => '成功']);
            } else {
                $this->ajaxReturn(['status' => 0, 'info' => '失败']);
            }
        }
        if (IS_GET) {
            $this->display();
        }
    }

    /**
     * 学科列表
     */
    public function lists()
    {
        $m = M('Subject');
        $num = 12;
        $page = I('get.p', 1);
        $list = $m->page($page . ',' . $num)->select();
        $count = $m->count();
        $Page = new \Think\myPage($count, $num);
        $show = $Page->show();
        $this->assign('data', ['list' => $list, 'page' => $show]);
        $this->display();
    }
}