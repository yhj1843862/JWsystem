<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/3
 * Time: 下午10:23
 */

namespace  Common\ViewModel;

use Think\Model\ViewModel;


class  ProfessionViewModel extends ViewModel
{
    public $viewFields = [
        'Department' => ['department_id','department_number','department_name','department_remark'],
        'Profession' => ['profession_id','department','profession_number','profession_name','profession_remark','_on'=>'Profession.department=Department.Department_id']
    ];
}