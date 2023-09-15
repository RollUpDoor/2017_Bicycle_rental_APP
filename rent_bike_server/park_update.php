<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$park_id=$_POST['park_id'];
$park_name=$_POST['park_name'];
$park_max=$_POST['park_max'];
$park_suitable=$_POST['park_suitable'];




$post=array("park_id"=>$park_id,"park_name"=>$park_name,"park_max"=>$park_max,"park_suitable"=>$park_suitable);
$pdo->update("park",$post,$park_id);

echo "<script type=\"application/javascript\">alert('車棚修改完成!');location.href='park_list.php';</script>";

?>