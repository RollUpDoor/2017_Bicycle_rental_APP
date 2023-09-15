<?php
require_once('functions.php');

$pdo= new functions("g-bike");//DBname

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);

$user_id=(!empty($_SESSION['user_id']))?$_SESSION['user_id']:"";
if($user_id!=""){
	$where =  array(':user_id' => $user_id);
	$rs=$pdo->select("user",$where); //資料表，條件式
	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<!--<body background="media/home.png">-->
<body style="background:#f3f3f3;">
	<div style="background-color:#88a8a8; padding:10px;"> 
	</div>
	
	<div style="background-color:#ffffff; padding:0.1px; margin-bottom:0.1px;"><h2><marquee direction="left" height="30" scrollamount="10" behavior="alternate"><?php echo $rs5[0]['text_content'] ?></marquee></h2></div>
	<!--背景顏色-->
	<div>
		<center>
		<div style="padding:40px;">
			<TR>
			  <TD>
			  	
			  		<font size="4">
			  			<div algin="center" style="width: 65%;" >
		  			  <div style="text-align: left;width: 35%;">
			  			  <strong><font size="3">使用者 : </font>
			  			  <?php echo $rs[0]['user_name']?></strong><br>
			  			  <strong><font size="3">使用狀況 : </font>
			  			  <?php				
						  $state=false;								
							if(!empty($rs[0]['bike_id'])){
								
							    $where2 =  array(':bike_id' =>$rs[0]['bike_id']);
								$rs2=$pdo->select("bike",$where2);
							   
								echo empty($rs[0]['bike_id'])?"未租借":"已租借".$rs2[0]['bike_name'];
							 $state=empty($rs[0]['bike_id'])?false:true;
							}else echo "未租借";
							
							 ?></strong><br>
						  <strong>剩餘點數 : <?php echo $rs[0]['user_point']?></strong><br>
           				  <strong>鎖的密碼 : <?php												
							if(!empty($rs[0]['bike_id'])){
							   
							   echo $rs2[0]['bike_lock'];
							
							}else echo "未租借";
							
							
							?></strong>
           			</div>
				  </div>
            </TD>
           </TR>
           
		</div>
		<div>
			<center>
            <?php 
			$state2=false;
			if($rs[0]['user_point']<=0){$state2=false; }else{ $state2=true; }
			if($rs[0]['bike_id']==""){?><input type="image" src="media/rent_button.png" width="100" height="40" <?php echo ($state2)?"onclick=\"self.location.href='QRscan.php'\"":"onclick=\"alert('點數不足，請儲值!');\"";?>> <?php }else{ ?><input type="image" src="media/return_button.png" width="100" height="40"  <?php 
			$state3=false;
			if($rs2[0]['bike_in_out']=="in"){$state3=true;}else{$state3=false;}
			echo ($state3)?"onclick=\"self.location.href='return_check.php'\"":"onclick=\"self.location.href='return_failed.php'\"";?>> <?php } ?>
			</center>
            
           
			
			<br>
		
			<center>
				<input type="image" src="media/park_search_button.png" width="100" height="40" onclick="self.location.href='park_map.php'">
				&nbsp;
                
				
				<a href="<?php echo ($state)?"alert_enter.php":"#"?>">
				<input type="image" src="media/alert_button.png" width="100" height="40" <?php echo ($state)?"":"onclick=\"alert('未租借單車，無法使用緊急通報!');\"";?>>
				</a>
				
				<br>
				<br>
				<input type="image" src="media/fix_reportbutton.png" width="100" height="40" onclick="self.location.href='fix_enter.php'">				
				&nbsp;
                
				<input type="image" src="media/logout_button.png" width="100" height="40" onclick="self.location.href='login.php'">
		  </center>
		</div>
		
		
		<p>&nbsp;</p>
		
		<div>
			<center>
            		<a href="illustrate.php"><U>功能說明</U></a>
                    <p>
					<a href="rule.php"><U>租借條款</U></a>
					
			</center>
		</div>
		<br>
		<div style="background-color:#88a8a8; padding:10px;"> 
	</div>


	</div>
    
<script>
	window.onload=function(){
  		document.getElementById("button").style.display='none';

	}
	function showButton(){
		if <?php ($rs[0]['bike_id'])==""?>{
  		document.getElementById("button").style.display='block';}
	}
</script>
</body>
<?php }else{ echo "<script>alert('錯誤!');location.href='login.php'</script>";}?>
</html>