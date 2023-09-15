<?php
require_once('functions.php');
$pdo= new functions("g-bike");

$user_id=$_SESSION['user_id'];
$where =  array(':user_id' => $user_id);
$rs=$pdo->select("user",$where);  

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);

$tempDate2 = date("Y-m-d H:i:s");

$post=array('rent_end_time'=>$tempDate2,'rent_status'=>"緊急通報",'user_id'=>$user_id);
$pdo->update("rent",$post,$user_id);

$post2=array("bike_id"=>"");
$pdo -> update("user",$post2,$user_id);

$rs3=$pdo->select("rent",$where);

$start=strtotime($rs3[0]['rent_start_time']);
$end=strtotime($tempDate2);
$d=$end-$start;
$dd=floor($d/60);

if($rs3[0]['rent_status']=="租借中") {
	$r=$rs[0]['user_point']-$dd;
	$post3=array("user_point"=>$r);
	$pdo -> update("user",$post3,$user_id);
	
}
$rs7=$pdo->select("user",$where);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<!--<body background="media/home.png">-->
<body>
	<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	
	<div style="background-color:#ffffff; padding:0.1px; margin-bottom:0.1px;"><h2><marquee direction="left" height="30" scrollamount="10" behavior="alternate"><?php echo $rs5[0]['text_content'] ?></marquee></h2></div>
	<!--背景顏色-->
	<div style="background:#f3f3f3;">
		<div>
			<center>
				<img src="media/alert.png" width="80" height="80" align="middle"/ >
				<strong>
					<font size="5">緊急通報成功</font>
				</strong>
			</center>
		</div>
		<div>
			<center>
				<h4>
					單車編號:<?php												
			if(!empty($rs[0]['bike_id'])){
								
			$where2 =  array(':bike_id' =>$rs[0]['bike_id']);
			$rs2=$pdo->select("bike",$where2);
							   
			echo $rs2[0]['bike_name'];
							
							}else echo "未租借";?><br>
                             啟用時間: <?php  echo $rs3[0]['rent_start_time'] ?><br>		
                             結束時間:<?php  echo $tempDate2 ?><br>
                             扣除點數: <?php echo $dd ?> <br>
                             剩餘點數:<?php echo $rs7[0]['user_point']?>
				</h4>
			</center>
		</div>
	
		<p>&nbsp;</p>
	
		<div>
			<center>
				<h4>
					我們會盡快與您聯絡
				</h4>
			</cinter>
		</div>
	
		<p>&nbsp;</p>
		<div>
			<center>
				<a href="home.php">
					<input type="image" src="media/home_button.png" width="100" height="40">
				</a>
			</center>
			<br>
		</div>
		<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	</div>
</body>
</html>
