<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>單車資料修改</title>
<link rel="stylesheet" type="text/css" href="jQueryAssets/flick.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/jquery.dataTables_themeroller.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/mycss.css">
  <script src="jQueryAssets/jquery-1.10.2.js"></script>
  <script src="jQueryAssets/jquery.dataTables.js"></script>

<?php

require_once('functions.php'); 
$pdo= new functions("g-bike");

$id=empty($_GET['id'])?0:$_GET['id'];
$where = array(":bike_id"=>$id);
$rs=$pdo->select("bike",$where);
	
if(count($rs)!=0){
?>

<body>
<h1 align="center">單車管理</h1>
<p align="center">&nbsp;</p>
<form action="bike_update.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
          <tr>
        <th colspan="5" style="font-size:24px"><input type="hidden" name="bike_id" value="<?php echo $id?>">
          修改單車資料</thead>
 
        <tbody>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">名稱</td>
          <td width="200" align="center" valign="middle">
          <input name="bike_name" type="varchar" required tabindex="1"  value="<?php echo $rs[0]['bike_name']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">密碼</td>
          <td colspan="2" align="center" valign="middle">
          <input name="bike_lock" type="varchar" tabindex="2"  value="<?php echo $rs[0]['bike_lock']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">車棚</td>
          <td colspan="2" align="center" valign="middle">
          <input name="park_id" type="varchar" tabindex="2"  value="<?php echo $rs[0]['park_id']?>"></td>
          </tr>
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
              <input type="submit" value="儲存" onclick="location.href='bike_list.php">
              &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" value="取消" onclick="location.href='bike_list.php">
           </tr>
        </tbody>
      </table>


</form>

  </script>
<?php }
else echo "<script type=\"text/javascript\">alert('錯誤!');location.href='bike_list.php'</script>";?>
</body>
</html>