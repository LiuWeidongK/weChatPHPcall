<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/22
 * Time: 14:39
 */

include_once '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

session_start();
$telphone = $_SESSION['telphone'];
$lessonNo = $_POST['lessonNo'];

$class = new connSQL();
$conn = $class->getConn();

$sign = true;
foreach ($lessonNo as $item){
    $sql = "delete from lesson where lno = '$item' and telphone = '$telphone'";
    if(!mysqli_query($conn,$sql))
        $sign = false;
}

if($sign)
    echo "true";
else echo "false";