<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱


$report_problem=$_POST['report_problem'];
$report_location=$_POST['report_location'];
$report_time=$_POST['report_time'];
$report_type=$_POST['report_type'];
$report_finish=$_POST['report_finish'];
$bike_name=$_POST['bike_name'];
$tempdate=date("y-m-d H:i:s");

$where =  array(":bike_name" =>$bike_name);
$rs=$pdo->select("bike",$where);
$bike_id=$rs[0]['bike_id'];

$post=array("report_problem"=>$report_problem,"report_location"=>$report_location,"report_time"=>$tempdate,"report_type"=>"維修","report_finish"=>"未解決","user_id"=>"5","bike_id"=>$bike_id);
$pdo->insert("report",$post);

echo "<script type=\"application/javascript\">alert('維修回報新增完成!');location.href='report_list.php';</script>";

?>