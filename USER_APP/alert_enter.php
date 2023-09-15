<?php
require_once('functions.php');

$pdo= new functions("g-bike");//DBname

$user_id=$_SESSION['user_id'];
$where =  array(':user_id' => $user_id);
$rs=$pdo->select("user",$where);   //資料表，條件式

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);

$submit=empty($_POST['submit'])?"":$_POST['submit'];
if($submit=="確定送出"){//按下送出時	
	$report_problem=$_POST['report_problem'];
	$report_location=$_POST['report_location'];

if($report_problem=="其他")
{
	$report_problem=$_POST['report_problem_else'];
	}

$post=array('report_problem'=>$report_problem,'report_location'=>$report_location,'report_type'=>"緊急",'user_id'=>$user_id,'bike_id'=>$rs[0]['bike_id']);
$pdo->insert("report",$post);      //資料表，資料表內容

header("Location: alert_success.php");
}
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
		
			<center>
				<span><img src="media/alert.png" width="80" height="80" align="middle"/ ><strong><font size="5">緊急通報</font></strong>

				</span>
				<h5><span>腳踏車若在騎乘途中遇到無法繼續使用之緊急狀況<br>須立即停止時間計算者，請輸入以下資料，並完成緊急通報。
				</span></h5>
			</center>
		

		<div>
			<center>
			<div algin="center" style="width: 60%;">
		  			  <div style="text-align: left;width: 32%;">
			<form role="form" action="#" method="post">
				<strong>使用者 : </strong><?php echo $rs[0]['user_name'];?><br style="line-height:30px" ><strong>單車編號 : </strong> <?php												
			if(!empty($rs[0]['bike_id'])){
								
			$where2 =  array(':bike_id' =>$rs[0]['bike_id']);
			$rs2=$pdo->select("bike",$where2);
							   
			echo empty($rs[0]['bike_id'])?"未租借":"已租借".$rs2[0]['bike_name'];
							
							}else echo "未租借";
							 ?>
							 <br style="line-height:30px" >
							 <strong>地點 : </strong> 
							 <input name="report_location" type="text" required="required" />
		<br>

					<strong>問題說明:</strong>
			        <select name="report_problem" id="report_problem" onblur="checkProblem()" onchange="checkProblem()">
						 <option value="爆胎">爆胎</option>
						 <option value="掉鏈">掉鏈</option>
						 <option value="被撞">被撞</option>
						 <option value="無法感應">無法感應</option>
						 <option value="其他">其他</option>
					</select>
					<input name="report_problem_else" type="text" id="elseText" style="display:none"/>
				
				</div>
				</div>
		</center>
	<p>&nbsp;</p>

			<center>
				<input type="submit" name="submit" id="submit" value="確定送出" />&nbsp;&nbsp;
				<button type="button"  style="width:80px;height:25px;font-size:15px;"name="cancel" value="" onclick="history.back()">取消</button>
			</center>
            </form>	
			<br>
				<div style="background-color:#88a8a8; padding:10px; margin-bottom:0.1px;"></div>

		</div>
	</div>
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>

	<script>
	function checkProblem(){
	var report_problem=$('#report_problem').val();
		if(report_problem=='其他')
			$('#elseText').css("display","initial");
		else $('#elseText').css("display","none");
	}
</script>
</body>
</html>