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
     * @param array $where
     * @return array
     */
    public function lists($page=1, $num=12,$where = [])
    {
        $list = $this->where($where)->page($page.','.$num)->select();
        $count      = $this->where($where)->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        return ['list'=>$list, 'page'=>$show];
    }

    public function class_subject_necessary()
    {
        $sql = 'UPDATE `jw_class_subject_teacher` SET `necessary`=abs(`necessary`-1) WHERE `class_id`=2 AND `subject_id`=1';
    }

    /**
     * 删除学科和专业的对应关系（其实要删除所有该专业下的班级和学科的对应关系）
     * @param $subject_id
     * @param $profession_id
     * @return mixed
     */
    public function delete_profession_subject($subject_id, $profession_id)
    {
        return M('class_subject_teacher')->where(['profession_id'=>$profession_id,'subject_id'=>$subject_id])->delete();
    }

    public function class_subject_list($class_id, $page = 1, $num = 12)
    {
        $start = ($page - 1) * $num;
        $fix = C('DB_PREFIX');
        $sql = 'SELECT * FROM (SELECT * FROM `'.$fix.'user` WHERE role=2) AS C RIGHT JOIN (SELECT B.*,A.`subject_name`,A.`subject_number` FROM `'.$fix.'subject` AS A RIGHT JOIN (SELECT * FROM `'.$fix.'class_subject_teacher`  WHERE `class_id`='.$class_id.' LIMIT '.$start.','.$num.')  AS B ON A.`subject_id`=B.`subject_id`) AS D ON D.`teacher_id`=C.`user_id`';
        $list = $this->query($sql);
        $count      = M('class_subject_teacher')->where(['class_id'=>$class_id])->count();
        $Page       = new \Think\myPage($count,$num);
        $show       = $Page->show();
        return ['list'=>$list, 'page'=>$show];
    }
}