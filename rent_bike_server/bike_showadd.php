<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱


$bike_name=$_POST['bike_name'];
$bike_lock=$_POST['bike_lock'];
$park_id=$_POST['park_id'];



$post=array("bike_name"=>$bike_name,"bike_lock"=>$bike_lock,"park_id"=>$park_id);
$pdo->insert("bike",$post);

echo "<script type=\"application/javascript\">alert('單車新增完成!');location.href='bike_list.php';</script>";

?>