<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/25
 * Time: 19:34
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

session_start();
$telphone = $_SESSION['telphone'];
$lessonNo = $_POST['lessonNo'];

$class = new connSQL();
$conn = $class->getConn();

$notArrStr = "";
$sql = "select * from log where lno = '$lessonNo' and telphone = '$telphone' and state = 0";
$result = mysqli_query($conn,$sql);
if($row = mysqli_fetch_array($result)){
    $notArrStr = $row['notarriveid'];
}

$resultArr = array();
$notArr = explode('&',$notArrStr);
foreach ($notArr as $value){
    $sql_ = "select * from studentinfo where openid = '$value'";
    $result_ = mysqli_query($conn,$sql_);
    if($row_ = mysqli_fetch_array($result_)){
        $arr = array();
        $arr['id'] = $row_['sid'];
        $arr['name'] = $row_['sname'];
        $resultArr[] = $arr;
    }
}

echo json_encode($resultArr);