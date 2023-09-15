<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>單車資料刪除</title>
<link rel="stylesheet" type="text/css" href="jQueryAssets/flick.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/jquery.dataTables_themeroller.css">
<link rel="stylesheet" type="text/css" href="css/mycss.css">
  <script src="jQueryAssets/jquery-1.10.2.js"></script>
  <script src="jQueryAssets/jquery.dataTables.js"></script>

</head>
<?php
require_once("functions.php");
$pdo=new functions("g-bike");
$id=empty($_GET['id'])?0:$_GET['id'];

$where = array(":bike_id"=>$id);
$rs=$pdo->select("bike",$where);
	
if(count($rs)!=0){
?>
<body>
<h1 align="center">單車管理</h1>
<p align="center">&nbsp;</p>
<form action="bike_showdelete.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
        <tr>
        <th colspan="5" style="font-size:24px"><input type="hidden" name="bike_id" value="<?php echo $id?>">
          刪除單車資料</thead>
  
        <tbody>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">編號</td>
          <td width="200" align="center" valign="middle"><?php echo $rs[0]['bike_name']?></td>
          </tr>
          <tr>
          <td width="200"  align="center" valign="middle" style="font-size:15px">密碼</td>
          <td width="200" align="center" valign="middle"><?php echo $rs[0]['bike_lock']?></td>
          </tr>
         
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
                  <p style="color: #F00">*【警告】 一但刪除，則無法復原!! *</p>
                    <p>
              <input type="submit" value="刪除" onclick="location.href='bike_list.php'">
              
           </tr>
        </tbody>
      </table>

</form>

  </script>
<?php }
else echo "<script type=\"text/javascript\">alert('錯誤!');location.href='bike_list.php'</script>";?>
</body>
</html>