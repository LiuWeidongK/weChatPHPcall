<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/21
 * Time: 17:10
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$openid = $_POST['openid'];

$class = new connSQL();
$conn = $class->getConn();

$arr = array();
$sql = "select * from studentinfo where openid = '$openid'";
$result = mysqli_query($conn,$sql);
if($row = mysqli_fetch_array($result)){
    $arr['state'] = 1;
    $arr['id'] = transNull($row['sid']);
    $arr['name'] = transNull($row['sname']);
    $arr['college'] = transNull($row['scollege']);
    $arr['_class'] = transNull($row['sclass']);
    $arr['tel'] = transNull($row['stelephone']);
}else $arr['state'] = 0;

echo json_encode($arr);

function transNull($str)
{
    return $str==null?"":$str;
}