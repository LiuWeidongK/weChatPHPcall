<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/15
 * Time: 20:51
 */

include '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$openid = $_POST['openid'];

$class = new connSQL();
$conn = $class->getConn();

$arr = array();

$sql = "select * from studentinfo where openid = '$openid'";
$result = mysqli_query($conn,$sql);
if($row = mysqli_fetch_array($result)){
    if($row['sid']==""||$row['sname']=="") {
        $arr["state"] = 0;
        $arr["msg"] = "once login";
        echo json_encode($arr);
    } else {
        $arr["state"] = 1;
        $arr["msg"] = "success";
        echo json_encode($arr);
    }
}else {
    $arr["state"] = 2;
    $arr["msg"] = "unknown error";
    echo json_encode($arr);
}
