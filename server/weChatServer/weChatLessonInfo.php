<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/20
 * Time: 18:16
 */

/*
 * @In : openId.
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$openid = $_POST['openid'];
$array = array();
$class = new connSQL();
$conn = $class->getConn();
$sql = "select * from binding,lesson,login where binding.openid = '$openid' and binding.lno = lesson.lno and lesson.telphone = login.telphone";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
    $arr = array();
    $arr['lessonNo'] = $row['lno'];
    $arr['lessonName'] = $row['lname'];
    $arr['lessonplace'] = $row['lplace'];
    $arr['teacherName'] = $row['name'];
    $arr['teacherTel'] = $row['telphone'];
    $array[] = $arr;
}
echo json_encode($array);