<?php
require_once('functions.php');

$pdo= new functions("g-bike");
$user_id=$_SESSION['user_id'];

$where =  array(':user_id' => $user_id);
$rs=$pdo->select("user",$where);

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);
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
	<!--背景顏色-->
	<div style="background:#f3f3f3;">
		<div style="padding:40px;">
			<TR>
			  <TD>
			  		<font size="3">
			  			<center>
						  <strong>使用者 ： 
			  			  <?php echo $rs[0]['user_name']?><br></strong>
						  <strong>單車編號 : <?php		
							$where2 = array(':bike_id' =>$rs[0]['bike_id']);	
							$rs2=$pdo->select("bike",$where2);
							echo $rs2[0]['bike_name']?></strong><br>
						  <strong>啟用時間 : <?php $rs3=$pdo->select("rent",$where); echo $rs3[0]['rent_start_time'] ?></strong>
            			</center>
            		</font>
            </TD>
           </TR>
		</div>
		<p>&nbsp;</p>
		<div>
			<center>
				<h4>
					單車已成功通過閘門
				</h4>
				<h2>
					是否確定歸還
				</h2>
		</div>

		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		
		<div>
			<center>
				<input type="image" src="media/yes_button.png" width="100" height="40" onclick="self.location.href='return_success.php'"> <!--還要加判斷arduino有無感應 -->
				<input type="image" src="media/no_button.png" width="100" height="40" onclick="self.location.href='home.php'">
			</center>
			<br>
			<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
		</div>
</body>
</html>
