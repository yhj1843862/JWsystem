<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/23
 * Time: 上午11:49
 */

namespace Home\Controller;

class AreaController extends BaseController
{
    public function add()
    {
        if (IS_POST) {
            $name = I('post.name', '');
            $pid = I('post.pid', 0);
            //将数据插入到数据库
            $this->ajaxReturn(D('Area')->add_area($name, $pid));
        }

        if (IS_GET) {
            $id = I('get.id', 0);
            $parentInfo = M('Area')->where(['area_id' => $id])->find();
            $this->assign('parentInfo', $parentInfo);
            $this->display();
        }

    }

    public function area_list()
    {
        $pid = I('get.pid', 0);
        $list = M('Area')->where(['parent_id' => $pid])->select();
        //print_r($list);
        $this->assign('pid', $pid);
        $this->assign('area_list', $list);
        $this->display();
    }

    public function ajax_area_list()
    {
        $pid = I('post.pid', 0);
        $list = M('Area')->where(['parent_id' => $pid])->select();
        $this->ajaxReturn($list);
    }

    public function test()
    {
        $list = M('Area')->select();
        $list = $this->format($list);
        print_r($list);
    }

    public function format($arr, $start = 0)
    {
        $new = [];

        foreach ($arr as $v) {
            if ($v['parent_id'] == $start) {
                $v['children'][] = $this->format($arr, $v['area_id']);
                $new[] = $v;
            }
        }
        return $new;
        //print_r($new);
    }

    public function ajax_path_info()
    {
        if (IS_POST) {
            $id = I('post.id', 0);
            $path = M('Area')->where(['area_id' => $id])->getField('path');
            $list = explode('-', $path . $id);
            $list = M('Area')->where(['area_id' => ['in', $list]])->select();
            $this->ajaxReturn($list);
        }
    }
}