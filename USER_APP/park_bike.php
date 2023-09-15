<?php
require_once('functions.php'); 
$pdo= new functions("g-bike");
$where = array();
$rs=$pdo->select("park",$where);   //資料表，條件式

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
	<div style="background:#f3f3f3;">
	<!--背景顏色-->
		<div style="padding:40px;">
			
		</div>

		<div style="padding:40px;">
			<center>
				<TR>
					<TD>
						<strong>
							<font size="5">
								可用單車數：<?php echo $rs[0]['park_suitable']?>
							</font>
						</strong>
					</TD>
				</TR>
			</center>
		</div>

		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>

		<div>
			<center>
				
					<input type="image" src="media/goback_button.png" width="100" height="40" onclick="history.back()">
				
			</center>
			<br>
		</div>
		<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	</div>
</body>
</html>
