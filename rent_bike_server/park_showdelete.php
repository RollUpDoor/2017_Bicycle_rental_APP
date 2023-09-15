<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$park_id=$_POST['park_id'];

$pdo->delete("park",$park_id);

echo "<script type=\"application/javascript\">alert('車棚刪除成功!');location.href='park_list.php';</script>";

?>