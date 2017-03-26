<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/21
 * Time: 20:03
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$openid = $_POST['openid'];
$arr = $_POST['arr'];
$json = json_decode($arr,true);

$id = $json['id'];
$name = $json['name'];
$college = $json['college'];
$_class = $json['_class'];
$tel = $json['tel'];

$class = new connSQL();
$conn = $class->getConn();
$sql = "update studentinfo set sid = '$id',sname = '$name',scollege = '$college',sclass = '$_class',stelephone = '$tel' where openid = '$openid'";
echo mysqli_query($conn,$sql);
