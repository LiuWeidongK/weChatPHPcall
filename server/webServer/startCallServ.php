<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/23
 * Time: 15:58
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

session_start();
$telphone = $_SESSION['telphone'];
$lessonNo = $_POST['lessonNo'];

$datetime = date("y-m-d H:i:s");

$class = new connSQL();
$conn = $class->getConn();

$sql_ = "select * from log where lno = '$lessonNo' and state = 1 and telphone = '$telphone'";
$result = mysqli_query($conn,$sql_);
if($row = mysqli_fetch_array($result)){      //重复
    echo "false";
}else {
    $sql = "insert into log (dates,lno,telphone,state,arrive,arriveid) values ('$datetime','$lessonNo','$telphone',1,0,'&')";
    if(mysqli_query($conn,$sql)){
        echo "true";
    }else echo "false";
}
