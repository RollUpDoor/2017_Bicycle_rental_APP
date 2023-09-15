<?php 
//include("checkalreadylogin.php");
require_once('functions.php');
$pdo= new functions("g-bike");

$where5 =  array(':text_id' =>"2");
$rs5=$pdo->select("text",$where5);
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QR Scanner</title>

<style type="text/css">
#mainbody{
    background: white;
    width:100%;
	display:none;
}
#v{
    width:300px;
    height:300px;
}
#outdiv{
    width:300px;
    height:300px;
	border: solid;
	border-width: 3px 3px 3px 3px;
}
#qr-canvas{
    display:none;
}

</style>
<script type="text/javascript" src="llqrcode.js"></script>
<script type="text/javascript" src="webqr.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
//轉跳至學生登入頁面
function locationpage(bike_id){
	var bike_id=$("#bike_id").val();
	 location.href = "rent_check.php";
}
</script>

</head>
<body style="background:#f3f3f3;">
<div style="background-color:#88a8a8; padding:10px;"> </div>
<div style="background-color:#ffffff; padding:0.1px; margin-bottom:0.1px;"><h2><marquee direction="left" height="30" scrollamount="10" behavior="alternate"><?php echo $rs5[0]['text_content'] ?></marquee></h2></div>  <!--跑馬燈-->
<div id="header">
<h2 align="center">請掃描車身的QR code</h2>
</div>
<div id="mainbody">
<div id="outdiv"></div> <!--影像-->
<!--<div id="result"></div> 掃描結果-->
</div>
</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>
<script type="text/javascript">load();//呼叫自訂方法</script>
<div>
    <center>
    
	<input type="image" src="media/home_button.png" width="100" height="40" onclick="self.location.href='home.php'">
     <br>
	</center>
</div>
<div style="background-color:#88a8a8; padding:10px; margin-bottom:0.1px;"></div>
<p>&nbsp;</p>
</body>
</html>