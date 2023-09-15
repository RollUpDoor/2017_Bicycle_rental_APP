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
			  	<strong>
			  		<font size="3">
			  			<center>
						  使用者 ： <?php echo $rs[0]['user_name']?><br>
						  使用狀況 : <?php				
						  	$state=false;								
							if(!empty($rs[0]['bike_id'])){
							    $where2 =  array(':bike_id' =>$rs[0]['bike_id']);
								$rs2=$pdo->select("bike",$where2);
							   
								echo empty($rs[0]['bike_id'])?"未租借":"已租借".$rs2[0]['bike_name'];
							 $state=empty($rs[0]['bike_id'])?false:true;
							}else echo "未租借";
							 ?><br>
						  剩餘點數 : <?php echo $rs[0]['user_point']?><br>
           				  單車編號 : <?php		
							echo $rs2[0]['bike_name']?><br>
           				  鎖的密碼 : <?php												
							if(!empty($rs[0]['bike_id'])){
							   echo $rs2[0]['bike_lock'];
								}else echo "未租借";
							?>
           			</center>
            		</font>
            	</strong>
            </TD>
           </TR>
		</div>

		<div>
			<center>
				<h3>
					單車未通過閘門<br style="line-height:25px"> 請至閘門處重新感應
				</h3>
			</center>
		</div>
		<p>&nbsp;</p>

		<div>
			<center>
					<input type="image" src="media/alert_button.png" width="100" height="40" onclick="self.location.href='alert_enter.php'">
                    <input type="image" src="media/home_button.png" width="100" height="40" onclick="self.location.href='home.php'">
			</center>
		</div>
		<center>		
			<h5>
				如一直無法感應請按緊急通報
			</h5>
		</center>
		<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	</div>
</body>
</html>
