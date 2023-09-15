<?php
$bike_id=$_GET['bike_id'];


require_once("functions.php");
$pdo= new functions("g-bike");
$user_id=$_SESSION['user_id'];

$where=array(":bike_id"=>$bike_id);
$rs=$pdo->select("bike",$where);

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
			<TR><TD><strong><font size="5"><center>單車編號:<?php echo $rs[0]['bike_name']?></center></font></strong></TD></TR>
		</div>


	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>

		<div>
			<TR>
				<TD>
					<strong>
						<font size="5">
							<center>
								是否確定租借
							</center>
						</font>
					</strong>
				</TD>
			</TR>
		</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
		<div>
			
            <center>
				<?php 
			$state2=false;
			if($rs[0]['bike_status']=="已歸還"){$state2=true; }else{ $state2=false; }
			?><input type="image" src="media/yes_button.png" width="100" height="40" <?php echo ($state2)?"onclick=\"location.href='rent_success.php?bike_id=".$bike_id."';\"":"onclick=\"alert('此單車無法租借，請換一台!');location.href='home.php';\""; ?>>
            
            
				
				<input type="image" src="media/no_button.png" width="100" height="40" onClick="self.location.href='home.php'">
                </center>
              
			<br>
		</div>
			<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	</div>
</body>
</html>
