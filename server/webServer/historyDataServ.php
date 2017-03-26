<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/25
 * Time: 18:22
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

session_start();
$telphone = $_SESSION['telphone'];

$class = new connSQL();
$conn = $class->getConn();

$array = array();
$sql = "select * from lesson,log where log.lno = lesson.lno and log.telphone = '$telphone' and state = 0";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $arr =array();
    $arr['_lessonNo'] = $row['lno'];
    $arr['date'] = $row['dates'];
    $arr['lessonName'] = $row['lname'];
    $arr['lessonPlace'] = $row['lplace'];
    $arr['pNum'] = $row['pnum'];
    $arr['aNum'] = $row['arrive'];
    $arr['nArrive'] = $row['notarriveid'];
    $array[] = $arr;
}
echo json_encode($array);
