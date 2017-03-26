<?php

/**
 * Created by PhpStorm.
 * User: Misaya
 * Date: 2017/3/11
 * Time: 20:06
 */
class connSQL
{
    function getConn() {
        //$conn = new mysqli("bdm264098108.my3w.com" , "bdm264098108" , "liu123456" , "bdm264098108_db");
        $conn = new mysqli("localhost" , "root" , "0000" , "mataapp");
        return $conn;
    }
}