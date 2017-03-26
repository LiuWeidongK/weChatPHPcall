<?php
/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/14
 * Time: 20:30
 */

include '../utils/connSQL.php';
header("Content-type: text/html; charset=utf-8");

$code = $_POST['code'];
$avatarUrl = $_POST['avatarUrl'];
$result = array();

$appId = "wx655fd94fb66a36ab";
$secret = "3a86e395b60bd038936cc3b6b88eb446";
$grant_type = "authorization_code";
$url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appId&secret=$secret&js_code=$code&grant_type=$grant_type";

$json = json_decode(file_get_contents($url));

if($json->{'openid'}!=null){
    $openid = $json->{'openid'};
    $class = new connSQL();
    $conn = $class->getConn();
    $sql = "insert into studentinfo (openid,avatarUrl) values('$openid','$avatarUrl')";
    mysqli_query($conn,$sql);
    $result["state"] = 1;
    $result["value"] = $openid;
    $result["msg"] = "success";
    echo json_encode($result);
}else {
    $errcode = $json->{'errcode'};
    $errmsg = $json->{'errmsg'};
    $errResult = array("errcode"=>$errcode, "errmsg"=>$errmsg);
    $result["state"] = 0;
    $result["value"] = json_encode($errResult);
    $result["msg"] = "error";
    echo json_encode($result);
}

