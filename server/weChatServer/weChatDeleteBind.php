<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/21
 * Time: 18:16
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$openid = $_POST['openid'];
$lessonNo = $_POST['lessonno'];

$class = new connSQL();
$conn = $class->getConn();

$sql = "delete from binding where openid = '$openid' and lno = '$lessonNo'";

return mysqli_query($conn,$sql);