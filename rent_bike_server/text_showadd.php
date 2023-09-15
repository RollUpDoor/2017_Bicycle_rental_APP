<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱


$text_belong=$_POST['text_belong'];
$text_content=$_POST['text_content'];


$post=array("text_belong"=>$text_belong,"text_content"=>$text_content);
$pdo->insert("text",$post);

echo "<script type=\"application/javascript\">alert('車棚新增完成!');location.href='text_list.php';</script>";

?>