<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$user_id=$_POST['user_id'];
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
$user_name=$_POST['user_name'];
$user_number=$_POST['user_number'];
$user_phone=$_POST['user_phone'];
$user_gender=$_POST['user_gender'];
$user_year=$_POST['user_year'];
$user_department_id=$_POST['user_department_id'];
$user_point=$_POST['user_point'];



$post=array("user_id"=>$user_id,"user_email"=>$user_email,"user_password"=>$user_password,"user_name"=>$user_name,"user_number"=>$user_number,"user_phone"=>$user_phone,"user_gender"=>$user_gender,"user_year"=>$user_year,"user_department_id"=>$user_department_id,"user_point"=>$user_point);
$pdo->update("user",$post,$user_id);

echo "<script type=\"application/javascript\">alert('使用者修改完成!');location.href='user_list.php';</script>";

?>