<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/3
 * Time: 下午10:11
 */
namespace Home\Controller;

use Common\ViewModel\ProfessionViewModel;

class ProfessionController extends  BaseController
{


    public function ajax_class_list()
    {
        //获取某个专业下的班级列表
        $profession = I('post.pid',0);
        $data = D('Class')->class_list(['profession'=>$profession],1,9999999);

        dump($data);
        if($data['status'])
        {
            $str ='';
            foreach ($data['data']['list'] as $k=>$v)
            {
                $str .= '<option value="'.$v['class_id'].'">'.$v['class_name'].'</option>';
            }
            $this->ajaxReturn($str);
        }else{
            $this->ajaxReturn('');
        }
    }


}