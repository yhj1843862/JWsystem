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
        if(IS_POST)
        {
            $name = I('post.name','');
            $pid = I('post.pid',0);
            //检验数据是否符合规范
            if(mb_strlen($name,'UTF-8') < 2 || mb_strlen($name,'UTF-8') > 20)
            {
                $this->ajaxReturn(['status'=>0, 'info'=>'地区名称长度应该在2-20之间']);
            }
            //验证地区是否重复
            if(M('Area')->where(['area_name'=>$name, 'parent_id'=>$pid])->find())
            {
                //有重名
                $this->ajaxReturn(['status'=>0, 'info'=>'该地区已存在']);
            }
            //将数据插入到数据库
            if(M('Area')->add(['area_name'=>$name,'parent_id'=>$pid])){
                $this->ajaxReturn(['status'=>1, 'info'=>'成功']);
            }else{
                $this->ajaxReturn(['status'=>0, 'info'=>'失败']);
            }
            //$this->ajaxReturn($arr);
        }

        if(IS_GET)
        {
            $id = I('get.id', 0);
            $parentInfo  = M('Area')->where(['area_id'=>$id])->find();
            $this->assign('parentInfo',$parentInfo);
            $this->display();
        }

    }

    public function area_list()
    {
        $pid = I('get.pid',0);
        $list = M('Area')->where(['parent_id'=>$pid])->select();
        //print_r($list);
        $this->assign('pid',$pid);
        $this->assign('area_list', $list);
        $this->display();
    }

    public function ajax_area_list()
    {
        $pid = I('post.pid',0);
        $list = M('Area')->where(['parent_id'=>$pid])->select();
        $this->ajaxReturn($list);
    }

    public function test()
    {
        $list = M('Area')->select();
        $list = $this->format($list);
        print_r($list);
    }

    public function format($arr,$start = 0)
    {
        $new = [];

        foreach ($arr as $v)
        {
            if($v['parent_id'] == $start)
            {
                $v['children'][] = $this->format($arr , $v['area_id']);
                $new[] = $v;
            }
        }
        return $new;
        //print_r($new);
    }

    public function ajax_path_info()
    {
        if(IS_POST)
        {
            $id = I('post.id',0);
            $path = M('Area')->where(['area_id'=>$id])->getField('path');
            $list = explode('-',$path.$id);
            $list = M('Area')->where(['area_id'=>['in', $list]])->select();
            $this->ajaxReturn($list);
        }
    }
}