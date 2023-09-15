<?php	 
$bike_id=$_GET['bike_id'];

require_once("functions.php");
$pdo= new functions("g-bike");
$where=array(":bike_id"=>$bike_id);
$rs=$pdo->select("user",$where);

	if($rs[0]['bike_id']=$bike_id){
		echo alert('此單車已有人使用!');
	}else {
		header("Location:rent_check.php");
	}
?>