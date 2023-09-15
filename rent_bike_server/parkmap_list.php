<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>車棚查詢</title>
</head>
<div style="background-color:#88a8a8; padding:10px; margin-bottom:0.1px;"></div>
<body>
	<div style="background-color:#ffffff; padding:0.1px; margin-bottom:0.1px;">
		<h2>
			<marquee direction="left" height="30" scrollamount="10" behavior="alternate">2017/4/9 G-Bike正式啟用!!!!!</marquee>
		</h2>
     <center><h3>下方車棚數字代表車棚可租借單車數，租車請回首頁使用租車鈕!<h3></center>
	</div>
	<div style="background:#f3f3f3; padding:10px; margin-bottom:0.1px;">
		<div>
		<?php 
				
	function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}	
				
				require_once('functions.php'); 
				$pdo= new functions("g-bike");//DBname

				$where=array();
				$rs=$pdo->select("park",$where);
				foreach($rs as $key){  // run所有座標點				
				?>
				<input type="button" id="btn<?php echo $key['park_id'];?>"style="z-index:3;position: absolute;top: <?php echo $key['park_y'];?>px;left: <?php echo (isMobile())?$key['park_x']-278:$key['park_x'];?>px; background-color: #F00; border-color: #F00;" value="<?php echo $key['park_suitable'];?>"/>
                <?php }?>
                
			
            <center>
				<IMG src="media/map.png" width="698" height="720" id="map" style="z-index:1;" border="0" onclick="clickposition(event)">
            </center>
                
                
		</div>
        
        <?php 
			foreach($rs as $key){  // run所有座標點
		?>
        <input type="button" value="<?php echo $key['park_name'];?>" onclick="nowposition(<?php echo $key['park_id'];?>,'<?php echo $key['park_name'];?>')" style="height:50px;"/>
		
		<?php }?>
		<BR><BR>
	 <div>
     <span id="alertmsg"></span>
     	<center>
        <a href=user_list.php>
			<input type="image" src="media/home_button.png" width="100" height="40"></a>
        <br>
		</center>
	</div>
<div style="background-color:#88a8a8; padding:10px; margin-bottom:0.1px;"></div>
<script type="text/javascript" src="jQueryAssets/jquery-1.8.3.min.js"></script>
<script>

function clickposition(){
	var mouseX = event.pageX-8;
    var mouseY = event.pageY-11;
	
	console.log("mouseX:"+mouseX+"   mouseY:"+mouseY);
	
	$.ajax
     ({
      type: "GET",
      url: "ajax.php?type=saveposition&x="+mouseX+"&y="+mouseY,
            success: function(msg)
            {
                $("#alertmsg").html(msg);
            }
     });
	 var id=getcookie("park");
	$('#btn'+id).css({"top":mouseY,"left":mouseX});

}

function nowposition(park,name){
	 document.cookie="park="+park;
	 $("#alertmsg").html("已選擇 "+name);
	 
}
function getcookie(c_name)
    {
    if (document.cookie.length>0)
      {
      c_start=document.cookie.indexOf(c_name + "=");
      if (c_start!=-1)
        { 
        c_start=c_start + c_name.length+1 ;
        c_end=document.cookie.indexOf(";",c_start);
        if (c_end==-1) c_end=document.cookie.length
        return unescape(document.cookie.substring(c_start,c_end));
        } 
      }
    return ""
}
</script>
</body>
</html>




