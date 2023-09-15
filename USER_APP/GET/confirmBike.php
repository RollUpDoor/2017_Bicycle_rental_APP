<?php

require_once('../functions.php');
$pdo= new functions("g-bike");//DBname
	
	$bike_name=$_GET['bike_id'];

	$where1 =  array(':bike_name' => $bike_name);
	$rs1=$pdo->select("bike",$where1);
	
	$where2 = array(':bike_id' => $rs1[0]['bike_id']);
	$rs2=$pdo->select("user",$where2);
	
	if(count($rs2)>0){//可以拿出去
		echo "OK";
		
	}else echo "NO";
	
	if ($rs1[0]['bike_in_out']=="in"){
		$inout="out";
	}else
		$inout="in";
		

	$post =  array('bike_in_out' =>$inout,'park_id' => "1");
	$pdo->update("bike",$post,$rs1[0]['bike_id']); //寫入資料庫
	



	
	
	
?>