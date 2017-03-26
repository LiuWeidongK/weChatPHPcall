<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/13
 * Time: 15:38
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

session_start();
$telphone = $_SESSION['telphone'];
$class = new connSQL();
$conn = $class->getConn();
$array = array();
$sql = "select * from lesson where telphone = '$telphone'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
    $arr = [
        'lno' => $row['lno'],
        //'telphone' => $row['telphone'],
        'lname' => $row['lname'],
        'pnum' => $row['pnum'],
        'lplace' => $row['lplace']
    ];
    $array[] = $arr;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE);