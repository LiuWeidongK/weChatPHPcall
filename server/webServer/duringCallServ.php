<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/24
 * Time: 21:02
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
$resultArr = array();

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
foreach ($notarriveArr as $item){
    $arr = array();
    $sql_3 = "select * from studentinfo where openid = '$item'";
    $result_3 = mysqli_query($conn,$sql_3);
    if($row = mysqli_fetch_array($result_3)){
        $arr['avatar'] = $row['avatarUrl'];
        $arr['name'] = $row['sname'];
        $resultArr[] = $arr;
    }
}
echo json_encode($resultArr);