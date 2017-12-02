<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/1
 * Time: 下午9:23
 */
namespace Common\Model;

use Think\Model;

class UserModel extends Model
{
    protected $err;

    public function add_user($data)
    {
        //验证数据格式
        $data = $this->check_user_data($data);

        if($data === false)
        {
            return $this->err;
        }

        if($this->where(['number'=>$data['number']])->find())
        {
            return ['status'=>0,'info'=>'编号已存在'];
        }


     }

    /**
     * 验证数据格式
     * @param $data
     * @return bool
     */

    public function check_user_data($data)
    {
        //编号
        if(!isset($data['number']) || mb_strlen($data['number'],'UTF-8') > 15 || mb_strlen($data['number'],'UTF-8')<1)
        {
            $this->err = ['status'=>0,'info'=>'请输入正确的编号,长度在1-15之间'];
            return false;
        }
        //检验昵称
         if(!isset($data['nickname']) || mb_strlen($data['nickname'],'UTF-8') > 10  || mb_strlen($data['nickname'],'UTF-8') < 2 )
        {
            $this->err = ['status'=>0, 'info'=>'昵称有误'];
            return false;
        }
        //手机号
        if(!isset($data['mobile']) || !check_mobile($data['mobile']) )
        {
            $this->err = ['status'=>0, 'info'=>'请输入正确的手机号'];
            return false;
        }
        //身份证
        if(!isset($data['id_card']) || !id_card_available($data['id_card']))
        {
            $this->err = ['status'=>0, 'info'=>'身份证号有误'];
            return false;
        }
        //检验邮箱
        if(!isset($data['email']) || mb_strlen($data['email'],'UTF-8') > 30  || !check_email($data['email']) )
        {
            $this->err = ['status'=>0, 'info'=>'请输入正确的邮箱，且长度小于30'];
            return false;
        }

        //角色信息
        if(!isset($data['role']) || empty($data['role']))
        {
            $this->err = ['status'=>0, 'info'=>'角色信息有误'];
            return false;
        }
        //籍贯地区
        if(!isset($data['area']) || empty($data['area']))
        {
            $this->err = ['status'=>0, 'info'=>'地区信息有误'];
            return false;
        }
        //自动完成性别
        $data['sex'] = get_sex_by_id_card($data['id_card']);
        return $data;
    }

    /**
     * 用户列表
     * @param array $where
     * @param int $page
     * @param int $num
     * @param string $order
     */
    public function user_list($where=[],$page =1,$num=10,$order = 'user_id DESC')
    {
        $list = $this->where($where)->order($order)->page($page.','.$num)->select();
        dump($list);
    }

    public function user_list2($page =1,$num =10,$order = 'user_id DESC')
    {
        $fix = C('DB_PREFIX');
        $start =  ($page -1) * $num;
        $list = $this->query('SELECT C.*,D.`area_name` FROM (SELECT A.*,B.`role_name` FROM (SELECT * FROM `'.$fix.'user` WHERE 1 ORDER BY '.$order.' LiMIT '.$start.','.$num.')AS A LEFT JOIN `'.$fix.'role` AS B ON B.`role_id`=A.`role`) AS C LEFT JOIN  `'.$fix.'area` AS D ON D.`area_id`=C.`area`');

        dump($list);
    }
    /**
     * 获取一个用户的基本信息
     *
     * @param $value       条件值
     * @param string $key  条件字段
     * @param array $where 附件条件
     * @return mixed
     *
     */
    public function user_info($value,$key='user_id',$where =[])
    {
        $where[$key] = $value;
        return $this->where($where)->find();
    }
}