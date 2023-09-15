<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");
$pdo= new functions("g-bike");//引數是資料庫名稱
$bike_id=$_POST['bike_id'];
$pdo->delete("bike",$bike_id);
echo "<script type=\"application/javascript\">alert('單車刪除完成!');location.href='bike_list.php';</script>";
?>