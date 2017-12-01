<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/11/24
 * Time: 上午11:47
 */

/**
 * 验证邮箱是否合法
 * @param $email 邮箱地址
 * @return bool
 */
function check_email($email)
{
    if(preg_match('/\w+@\w+\.\w{2,10}/',$email))
    {
        return true;
    }else{
        return false;
    }
}

/**
 * 验证手机号是否合法
 * @param $mobile
 * @return bool
 */
function check_mobile($mobile)
{
    if(preg_match('/1[3,5,7,8,9]\d{9}/',$mobile))
    {
        return true;
    }else{
        return false;
    }
}

/** * 检验身份证是否合法
 * @param $id_card 身份证号码
 * @return bool
 */
function id_card_available($id_card)
{
    $city = array(11 => "北京", 12 => "天津", 13 => "河北", 14 => "山西", 15 => "内蒙古", 21 => "辽宁", 22 => "吉林", 23 => "黑龙江", 31 => "上海", 32 => "江苏", 33 => "浙江", 34 => "安徽", 35 => "福建", 36 => "江西", 37 => "山东", 41 => "河南", 42 => "湖北", 43 => "湖南", 44 => "广东", 45 => "广西", 46 => "海南", 50 => "重庆", 51 => "四川", 52 => "贵州", 53 => "云南", 54 => "西藏", 61 => "陕西", 62 => "甘肃", 63 => "青海", 64 => "宁夏", 65 => "新疆", 71 => "台湾", 81 => "香港", 82 => "澳门", 91 => "国外");
    $id_cardLength = strlen($id_card);
    //长度验证
    if (!preg_match('/^\d{17}(\d|x)$/i', $id_card) and !preg_match('/^\d{15}$/i', $id_card))
    {
        //验证码位数不对
        return false;
    }
    //地区验证
    if (!array_key_exists(intval(substr($id_card, 0, 2)), $city))
    {
        //验证地区是否存在
        return false;
    }
    // 15位身份证验证生日，转换为18位
    if ($id_cardLength == 15)
    {
        $id_card = substr($id_card, 0, 6) . "19" . substr($id_card, 6, 9); //15to18
        $bit18 = get_verify_bit($id_card); //算出第18位校验码
        $id_card = $id_card . $bit18;
    }
    //从今年算起，往前推进100年为有效的年份
    //今年的年份
    $now_year = date('Y');
    //截至年份
    $dead_year = $now_year - 100;
    $year = substr($id_card, 6, 4);
    if ($year < $dead_year || $year > $now_year)
    {
        return false;
    }
    //18位身份证处理
    //身份证编码规范验证
    $id_card_base = substr($id_card, 0, 17);
    if (strtoupper(substr($id_card, 17, 1)) != get_verify_bit($id_card_base))
    {
        return false;
    }
    return true;
}

/**
 * 计算身份证校验码，根据国家标准GB 11643-1999
 * @param $id_card_base 身份证前17位
 * @return bool|string false或者校验码
 */
function get_verify_bit($id_card_base)
{
    if (strlen($id_card_base) != 17)
    {
        return false;
    }
    //加权因子
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    //校验码对应值
    $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    $checksum = 0;
    for ($i = 0; $i < strlen($id_card_base); $i++)
    {
        $checksum += substr($id_card_base, $i, 1) * $factor[$i];
    }
    $mod = $checksum % 11;
    $verify_number = $verify_number_list[$mod];
    return $verify_number;
}

/**
 * 根据身份证号获取性别
 * @param $id_card
 * @return bool|int
 */
function get_sex_by_id_card($id_card)
{
    if(!id_card_available($id_card))
    {
        return false;
    }
    $num = $id_card{16};
    if ($num % 2 == 0)
    {
        return 0;
    }else{
        return 1;
    }
}

/**
 * 将身份证号的某些位置的内容替换成特殊字符
 * @param $id_card 身份证号
 * @param $start 其实替换的字符位
 * @param $num 替换的数量
 * @param $str 替换成的字符
 * @return string 替换后的字符串
 */
function hide_id_card($id_card,$start=12,$num=6, $str='*')
{
    $tmp = '';
    for ($i =0; $i<$num; $i++)
    {
        $tmp .= $str;
    }
    return substr($id_card,0,$start).$tmp.substr($id_card,$start+$num);
}

function format_where($where)
{
    if(!is_array($where))
    {
        return false;
    }
    $whereString = ' WHERE 1 ';
    foreach ($where as $k=>$v)
    {
        if(!is_array($v))
        {
            $whereString .= ' AND `'.$k.'`="'.$v.'"';
        }else{
            if(is_array($v[0]))
            {
                foreach ($v as $vv)
                {
                    $whereString .= ' AND '.$k.$vv[0].'"'.$vv[1].'"';
                }
            }else{
                if(is_array($v[1]))
                {
                    $whereString .= ' AND (';
                    foreach ($v[1] as $kk=>$vv)
                    {
                        $whereString .= ' `'.$k.'`="'.$vv.'" '.$v[0];
                    }
                    $whereString = rtrim($whereString, $v[0]) .')';
                }else{
                    if(strpos( $v[1],','))
                    {
                        $whereString .= ' AND `'.$k.'` '.$v[0].' ('.$v[1].')';
                    }else {
                        $whereString .= ' AND `'.$k.'` '.$v[0].' ("'.$v[1].'")';
                    }
                }
            }
        }
    }
    return $whereString;
}


/**
 * @param $excel_path excel文件路径
 * @param int $start_row 从第几行开始读取数据
 * @param array $fields 每个列对应的字段
 * @return array|bool|mixed
 */
function read_excel($excel_path,$start_row = 1, array $fields)
{
    vendor('PHPExcel.PHPExcel');
    $PHPReader = new PHPExcel_Reader_Excel2007();
    if(!$PHPReader->canRead($excel_path))
    {
        //刚开始尝试使用高版本的读取，如果不能读，则尝试使用低版本格式的读取
        $PHPReader = new PHPExcel_Reader_Excel5();
        if(!$PHPReader->canRead($excel_path))
        {
            return false;
        }
    }
    //加载excel文件
    $e = $PHPReader->load($excel_path);
    //获取所有工作表
    $sheets = $e->getAllSheets();
    $data = [];
    //遍历所有工作表
    foreach ($sheets as $k=>$v)
    {
        $rowNum = $v->getHighestRow();
        $column = my_ord($v->getHighestColumn());
        for ($i = $start_row; $i <= $rowNum; $i++)
        {
            $s = $i-$start_row;
            for ($j=1; $j<=$column; $j++)
            {
                echo my_chr($j),'<br>';
                //获取每一个方格对象
                $cell = $v->getCell(my_chr($j).$i);
                //读取方格里面的内容
                $value = $cell->getValue();
                if(!empty($value))
                {
                    $field = $fields[$j-65];
                    if(empty($field))
                    {
                        $data[$k][$s][] = $value;
                    }else{
                        $data[$k][$s][$field] = $value;
                    }
                }
            }
        }
    }
    if(count($data) == 1)
    {
        return $data[0];
    }
    return $data;
}

/**
 * 将最多两位字母转成数字（根据ascii码）
 * 比如：A 转成 1 , AB 转成 28 DF 转成110
 * @param $str
 * @return int
 */
function my_ord($str)
{
    if(strlen($str) == 1)
    {
        $str = '@'.$str;
    }
    $str = strtoupper($str);
    $column = (ord($str{0}) - 64 ) * 26 + ord($str{1}) - 64;
    return $column;
}

/**
 * 将数字转成字母，最大支持到702（根据ascii码），是my_ord()的相反操作
 * @param $num
 * @return bool|string
 */
function my_chr($num)
{
    if(empty($num))
    {
        return false;
    }
    $first_num = floor($num / 26);
    $second_num = $num % 26;
    if($second_num == 0)
    {
        $first_num = $first_num - 1;
        $second_num = 26;
    }
    $first = chr($first_num + 64);
    $second = chr($second_num + 64);
    if($first == '@')
    {
        return $second;
    }else{
        return $first.$second;
    }
}