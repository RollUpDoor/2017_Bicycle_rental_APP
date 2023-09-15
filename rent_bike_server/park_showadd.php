<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱


$park_name=$_POST['park_name'];
$park_max=$_POST['park_max'];
$park_suitable=$_POST['park_suitable'];


$post=array("park_name"=>$park_name,"park_max"=>$park_max,"park_suitable"=>$park_suitable);
$pdo->insert("park",$post);

echo "<script type=\"application/javascript\">alert('車棚新增完成!');location.href='park_list.php';</script>";

?>