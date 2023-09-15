<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$bike_id=$_POST['bike_id'];
$bike_name=$_POST['bike_name'];
$bike_lock=$_POST['bike_lock'];
$park_id=$_POST['park_id'];



$post=array("bike_id"=>$bike_id,"bike_name"=>$bike_name,"bike_lock"=>$bike_lock,"park_id"=>$park_id);
$pdo->update("bike",$post,$bike_id);

echo "<script type=\"application/javascript\">alert('單車修改完成!');location.href='bike_list.php';</script>";

?>