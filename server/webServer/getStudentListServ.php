<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/25
 * Time: 15:18
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$class = new connSQL();
$conn = $class->getConn();

$lessonNo = $_POST['lessonNo'];

$array = array();
$sql = "select * from binding,studentinfo where binding.lno = '$lessonNo' and binding.openid = studentinfo.openid";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $arr = array();
    $arr['id'] = $row['sid'];
    $arr['name_'] = $row['sname'];
    $arr['college'] = $row['scollege'];
    $arr['_class'] = $row['sclass'];
    $arr['tel'] = $row['stelephone'];
    $array[] = $arr;
}

echo json_encode($array);