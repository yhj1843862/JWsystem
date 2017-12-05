<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/12/5
 * Time: 上午10:39
 */

//* * * * * php /Users/qingyun/php/mvc/20171127/Crontab/update_duty.php abcde
$a = $argv;
if(isset($a[1]) && $a[1] == 'abcde')
{
    $curl = curl_init('http://mvc.in/20171127/index.php/Home/Crontab/update_duty');
    curl_setopt($curl,CURLOPT_POST,1);
    $data = 'auth=sdgbndfxbgnhbdfhsnjsetamgfdvhbzaxbvnchbfg';
    curl_setopt($curl,CURLOPT_POSTFIELDS, $data);
    curl_exec($curl);
}

