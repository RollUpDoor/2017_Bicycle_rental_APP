<?php
require_once('functions.php');
$pdo= new functions("g-bike");

$user_id=$_SESSION['user_id'];
$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);

$post=array('rent_status'=>"維修中");
$pdo->update("rent",$post,$user_id);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>
<!--<body background="media/home.png">-->
<body>
	<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	
	<div style="background-color:#ffffff; padding:0.1px; margin-bottom:0.1px;"><h2><marquee direction="left" height="30" scrollamount="10" behavior="alternate"><?php echo $rs5[0]['text_content'] ?></marquee></h2></div>
	<div style="background:#f3f3f3;">
	<!--背景顏色-->
		<div style=padding:60px;></div>
		<span>
			<center>
				<img src="media/fix.png" width="80" height="80" align="middle"/ ><strong><font size="4">維修通報成功</font></strong>
		</span>

		<div>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
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
