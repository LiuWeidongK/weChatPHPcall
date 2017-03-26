<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/24
 * Time: 16:00
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$class = new connSQL();
$conn = $class->getConn();

$array = array();
$lessonNo = $_POST['lessonNo'];
$sql = "select * from binding,studentinfo where binding.lno = '$lessonNo' and binding.openid = studentinfo.openid";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $arr = array();
    $arr['avatar'] = $row['avatarUrl'];
    $arr['name'] = $row['sname'];
    $array[] = $arr;
}
echo json_encode($array,JSON_UNESCAPED_UNICODE);