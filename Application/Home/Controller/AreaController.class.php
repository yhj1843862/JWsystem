<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/2
 * Time: 上午9:19
 */
namespace Home\Controller;

class AreaController extends  BaseController
{
    public function add()
    {

    }

    public function area_list()
    {

    }

    public function ajax_area_list()
    {
        $pid = I('post.pid',0);
        $list = M('Area')->where(['parent_id'=>$pid])->select();
        $this->ajaxReturn($list);
    }

    public function ajax_path_info()
    {
        if(IS_POST)
        {
            $id= I('post.id',0);
            $path = M('Area')->where(['area_id'=>$id])->getField('path');
            $list = explode('-',$path.$id);
            $list = M('Area')->where(['area_id'=>['in',$list]])->select();
            $this->ajaxReturn($list);
        }
    }
}