<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/25
 * Time: 14:02
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$class = new connSQL();
$conn = $class->getConn();

session_start();
$telphone = $_SESSION['telphone'];

$array = array();
$sql = "select * from lesson where telphone = '$telphone'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $arr = array();
    $arr['lessonNo'] = $row['lno'];
    $arr['lessonName'] = $row['lname'];
    $array[] = $arr;
}

echo json_encode($array);