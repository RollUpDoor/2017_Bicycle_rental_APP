<?php
require_once('functions.php');
$pdo= new functions("g-bike");
$user_id=$_SESSION['user_id'];

$where =  array(':user_id' => $user_id);
$rs=$pdo->select("user",$where);
$rs3=$pdo->select("rent",$where);
$where2 = array(':bike_id' =>$rs3[0]['bike_id']);	
$rs2=$pdo->select("bike",$where2);

$tempDate2 = date("Y-m-d H:i:s");

$post=array('rent_end_time'=>$tempDate2,'rent_status'=>"已歸還",'user_id'=>$user_id);
$pdo->update("rent",$post,$user_id);

$bike_id=$rs3[0]['bike_id'];

$post3=array('history_end_time'=>$tempDate2,'history_status'=>"已歸還",'bike_id'=>$bike_id,'user_id'=>$user_id);
$pdo->insert("history",$post3,$user_id);

$post2=array("bike_id"=>"");
$pdo -> update("user",$post2,$user_id);

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);

$where6 =  array(':park_id' =>$rs2[0]['park_id']);
$rs6=$pdo->select("park",$where6);
$p=$rs6[0]['park_suitable'];
$p+=1;

$post6=array('park_suitable'=>$p);
$pdo->update("park",$post6,$rs2[0]['park_id']);

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

$post8=array('bike_status'=>"已歸還");
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
	<!--背景顏色-->
	<div style="background:#f3f3f3;">
		<div style="padding:40px;">
			<TR>
			  <TD>
			  	
		  		
			  			<center><strong><font size="3">
			  			  單車編號 : <?php		
							
							echo $rs2[0]['bike_name']?> <br>
			  			  啟用時間 : <?php  echo $rs3[0]['rent_start_time']?><br>
			  			  結束時間 : <?php  echo $tempDate2 ?><br>
			  			  扣除點數 :  <?php echo $dd ?><br>
			  			  剩餘點數 : <?php echo $rs7[0]['user_point']?>
	  			</font></strong></center>
            		
            	
            </TD>
           </TR>
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
			<center>
				<h1>
					歸還成功
				</h1>
			</center>
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
