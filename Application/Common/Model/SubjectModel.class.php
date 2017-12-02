<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/2
 * Time: 下午2:46
 */
namespace Common\Model;
use Think\Model;

class SubjectModel extends Model
{
    /**
     * 学科列表（简单）
     * @param int $page
     * @param int $num
     * @return array
     */
    public function lists($page=1, $num=12)
    {
        $list = $this->page($page.','.$num)->select();
        $count      = $this->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        return ['list'=>$list, 'page'=>$show];
    }

    public function class_subject_necessary()
    {
        $sql = 'UPDATE `jw_class_subject_teacher` SET `necessary`=abs(`necessary`-1) WHERE `class_id`=2 AND `subject_id`=1';
    }
}