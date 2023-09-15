<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱


$manager_name=$_POST['manager_name'];
$manager_email=$_POST['manager_email'];
$manager_password=$_POST['manager_password'];


$post=array("manager_name"=>$manager_name,"manager_email"=>$manager_email,"manager_password"=>$manager_password);
$pdo->insert("manager",$post);

echo "<script type=\"application/javascript\">alert('管理者新增完成!');location.href='manager_list.php';</script>";

?>