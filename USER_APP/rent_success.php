<?php
require_once('functions.php');
$pdo= new functions("g-bike");

$user_id=$_SESSION['user_id'];

$bike_id=$_GET['bike_id'];
$post=array("bike_id"=>$bike_id);
$pdo -> update("user",$post,$user_id);

$where =  array(':user_id' => $user_id);
$rs=$pdo->select("user",$where);

$where2 = array(':bike_id' =>$rs[0]['bike_id']);	
$rs2=$pdo->select("bike",$where2);

$tempDate = date("Y-m-d H:i:s");

$post2=array('rent_start_time'=>$tempDate,'rent_status'=>"租借中",'bike_id'=>$bike_id,'user_id'=>$user_id);
$pdo->update("rent",$post2,$user_id);

$post3=array('history_start_time'=>$tempDate,'history_status'=>"租借中",'bike_id'=>$bike_id,'user_id'=>$user_id);
$pdo->insert("history",$post3,$user_id);

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);

$where6 =  array(':park_id' =>$rs2[0]['park_id']);
$rs6=$pdo->select("park",$where6);
$p=$rs6[0]['park_suitable'];
$p-=1;

$post7=array('park_suitable'=>$p);
$pdo->update("park",$post7,$rs2[0]['park_id']);

$post8=array('bike_status'=>"租借中");
$pdo->update("bike",$post8,$rs[0]['bike_id']);
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
	  <div style="padding:40px;">
			<TR>
			  <TD>
			  	<strong>
			  		<font size="5">
			  			<center>
						 	租借成功
            			</center>
            		</font>
            	</strong>
            </TD>
           </TR>
		</div>
		<div style="padding:40px;">
			<TR>
			  <TD>
			  			<center>
			  			<strong><font size="3">
						 	單車編號 : <?php		
							echo $rs2[0]['bike_name']?><br>
           					密碼鎖密碼 : <?php	echo $rs2[0]['bike_lock']?><br> 
           					啟用時間 : <?php echo $tempDate
							 ?>
       			</font></strong>
			  			</center>
            </TD>
           </TR>
		</div>

		<p>&nbsp;</p>
		<p>&nbsp;</p>
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
