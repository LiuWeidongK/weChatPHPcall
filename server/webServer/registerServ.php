<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/11
 * Time: 20:08
 */
include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$telphone = $_POST['modalLPNum'];
$password = $_POST['modalLPWord'];
$name = $_POST['modalLName'];
$class = new connSQL();
$conn = $class->getConn();
$sql = "insert into login values ('$telphone','$name','$password')";
if(mysqli_query($conn,$sql))
    echo "true";
else echo "false";
