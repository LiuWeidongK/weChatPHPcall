<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/11
 * Time: 20:18
 */
include_once  '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$telphone = $_POST['loginPNumber'];
$password = $_POST['loginPWord'];
$class = new connSQL();
$conn = $class->getConn();
$sql = "select * from login where telphone = '$telphone' and password = '$password'";
$result = mysqli_query($conn,$sql);
if($row = mysqli_fetch_array($result)){
    $name = $row['name'];
    session_start();
    $_SESSION['telphone'] = $telphone;
    $_SESSION['name'] = $name;
    echo "true";
} else echo "false";