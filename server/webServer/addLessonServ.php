<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/12
 * Time: 15:34
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

session_start();
$telphone = $_SESSION['telphone'];
$lessonname = $_POST['modalALLName'];
$lessonplace = $_POST['modalALLPlace'];
$total = $_POST['modalALTPerson'];
$lessonno = strtoupper(substr(md5(uniqid(rand(),1)),8,8));  //八位大写字母和数字组成
$class = new connSQL();
$conn = $class->getConn();
$sql = "insert into lesson values('$lessonno','$telphone','$lessonname','$total','$lessonplace')";
if(mysqli_query($conn,$sql)){
    echo "true";
}else echo "false";
