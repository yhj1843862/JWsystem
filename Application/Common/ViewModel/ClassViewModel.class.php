<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/28
 * Time: 上午9:50
 */
namespace Common\ViewModel;
use Think\Model\ViewModel;

class ClassViewModel extends ViewModel
{
    public $viewFields = [
        'user' => ['user_id','nickname','_on'=>'class.manager=user.user_id'],
        'class' => ['class_id','class_number','manager'],
    ];
}