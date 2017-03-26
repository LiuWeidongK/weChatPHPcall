<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/24
 * Time: 14:45
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$class = new connSQL();
$conn = $class->getConn();

session_start();
$telphone = $_SESSION['telphone'];
$lessonNo = $_POST['lessonNo'];

$arriveArr = array();
$openidArr = array();
$notarriveArr = array();

$sql_1 = "select * from log where lno = '$lessonNo' and state = 1 and telphone = '$telphone'";
$result_1 = mysqli_query($conn,$sql_1);
if($row_1 = mysqli_fetch_array($result_1)){
    $arriveArr = explode('&',substr($row_1['arriveid'],1));
}

$sql_2 = "select * from binding where lno = '$lessonNo'";
$result_2 = mysqli_query($conn,$sql_2);
while($row_2 = mysqli_fetch_array($result_2)){
    $openidArr[] = $row_2['openid'];
}

$notarriveArr = array_diff($openidArr,$arriveArr);
$stringArr = implode('&',$notarriveArr);

$sql_3 = "update log set notarriveid = '$stringArr',state = 0 where lno = '$lessonNo'and state = 1 and telphone = '$telphone'";
echo mysqli_query($conn,$sql_3);