<?php
require_once('functions.php');
$pdo= new functions("g-bike");
$type=$_GET['type'];
switch($type){
	case "saveposition":
	$x=$_GET['x'];
	$y=$_GET['y'];
	$park_id=$_COOKIE['park'];
	//SQL
	$post=array("park_x"=>$x,"park_y"=>$y);
	$pdo->update("park",$post,$park_id);
	//true   
	echo "儲存";
	
	//false
	//echo "失敗";
	
	
	break;
	
	case "":
	
	
	break;
	case "":
	
	
	break;
	
	case "":
	
	
	break;
	}
?>