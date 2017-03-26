<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/26
 * Time: 12:45
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$class = new connSQL();
$conn = $class->getConn();

$openid = $_POST['openid'];

$array = array();
$sql = "select * from binding,lesson,log where binding.openid = '$openid' and binding.lno = lesson.lno and binding.lno = log.lno and log.state = 0";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $arr = array();
    $arr['date'] = $row['dates'];
    $arr['lessonName'] = $row['lname'];
    $arr['tel'] = $row['telphone'];
    if(strpos($row['arriveid'],$openid)===false)
        $arr['state'] = 0;
    else $arr['state'] = 1;
    $array[] = $arr;
}
echo json_encode($array);