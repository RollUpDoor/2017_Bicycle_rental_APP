<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$manager_id=$_POST['manager_id'];
$manager_name=$_POST['manager_name'];
$manager_email=$_POST['manager_email'];
$manager_password=$_POST['manager_password'];



$post=array("manager_id"=>$manager_id,"manager_name"=>$manager_name,"manager_email"=>$manager_email,"manager_password"=>$manager_password);

echo "<script type=\"application/javascript\">alert('使用者修改完成!');location.href='manager_list.php';</script>";

?>