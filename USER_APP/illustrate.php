<?php
require_once('functions.php');
$pdo= new functions("g-bike");

$where =  array(':text_id' =>"1");
$rs=$pdo->select("text",$where);

$where2 =  array(':text_id' =>"2");
$rs2=$pdo->select("text",$where2);

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
	
	<div style="background-color:#ffffff; padding:0.1px; margin-bottom:0.1px;"><h2><marquee direction="left" height="30" scrollamount="10" behavior="alternate"><?php echo $rs2[0]['text_content'] ?></marquee></h2></div>
	<div style="background:#f3f3f3;">
	<!--背景顏色-->
		<div style="padding:15px;">
		</div>

		<div>
			<TR>
				<TD>
					<strong>
						<font size="5">
							<center>
							</center>
						</font>
					</strong>
				</TD>
			</TR>
		</div>


	 
			<h5> 
            <center>
				<img src="media/illustrate.jpg" width="400" height="600" >
                </center>
 			</h5>

			<p>&nbsp;</p>
		<div>
			<center>
				<input type="image" src="media/home_button.png" width="100" height="40" title="home" onclick="history.back()"></button>
			</center>
			<br>
		</div>
			<div style="background-color:#88a8a8; padding:10px; margin-bottom:0.1px;"></div>

	</div>
</body>
</html>
