<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/23
 * Time: 16:48
 */

include_once '../utils/connSQL.php';

$openid = $_POST['openid'];
$lessonNo = $_POST['lessonNo'];

$class = new connSQL();
$conn = $class->getConn();

$arr = array();

$sql_ = "select * from log where lno = '$lessonNo' and state = 1";
$result = mysqli_query($conn,$sql_);
if($row = mysqli_fetch_array($result)){
    if(strpos($row['arriveid'],$openid)===false){       //成功
        $sql = "update log set arrive = arrive + 1,arriveid = concat(arriveid,'$openid') where lno = '$lessonNo' and state = 1";
        if(mysqli_query($conn,$sql)){
            $arr['state'] = 1;
            $arr['msg'] = "success";
            echo json_encode($arr);
        }else {
            $arr['state'] = -1;
            $arr['msg'] = "error";
            echo json_encode($arr);
        }
    }else{
        $arr['state'] = 0;
        $arr['msg'] = "repeat";
        echo json_encode($arr);
    }
}else {
    $arr['state'] = -1;
    $arr['msg'] = "error";
    echo json_encode($arr);
}