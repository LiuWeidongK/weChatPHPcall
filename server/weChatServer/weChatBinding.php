<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/22
 * Time: 12:52
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$openid = $_POST['openid'];
$lessonNo = $_POST['lessonNo'];

$class = new connSQL();
$conn = $class->getConn();

$iSql = "insert into binding values ('$openid','$lessonNo')";
echo mysqli_query($conn,$iSql);