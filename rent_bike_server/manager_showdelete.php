<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$manager_id=$_POST['manager_id'];

$pdo->delete("manager",$manager_id);

echo "<script type=\"application/javascript\">alert('管理者刪除成功!');location.href='manager_list.php';</script>";

?>