<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$text_id=$_POST['text_id'];

$pdo->delete("text",$text_id);

echo "<script type=\"application/javascript\">alert('車棚刪除成功!');location.href='text_list.php';</script>";

?>