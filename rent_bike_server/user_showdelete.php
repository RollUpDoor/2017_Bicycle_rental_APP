<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$user_id=$_POST['user_id'];

$pdo->delete("user",$user_id);

echo "<script type=\"application/javascript\">alert('使用者刪除完成!');location.href='user_list.php';</script>";

?>