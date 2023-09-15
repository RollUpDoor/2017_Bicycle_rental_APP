<?php
header("Content-Type:text/html;charset=utf-8");
require_once("functions.php");

$pdo= new functions("g-bike");//引數是資料庫名稱

$report_id=$_POST['report_id'];
$report_problem=$_POST['report_problem'];
$report_location=$_POST['report_location'];
$report_time=$_POST['report_time'];
$report_type=$_POST['report_type'];
$report_finish=$_POST['report_finish'];



$post=array("report_id"=>$report_id,"report_problem"=>$report_problem,"report_location"=>$report_location,"report_time"=>$report_time,"report_type"=>$report_type,"report_finish"=>$report_finish);
$pdo->update("report",$post,$report_id);

echo "<script type=\"application/javascript\">alert('維修回報修改完成!');location.href='report_list.php';</script>";

?>