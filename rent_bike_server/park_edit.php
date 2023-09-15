<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>車棚資料修改</title>
<link rel="stylesheet" type="text/css" href="jQueryAssets/flick.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/jquery.dataTables_themeroller.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/mycss.css">
  <script src="jQueryAssets/jquery-1.10.2.js"></script>
  <script src="jQueryAssets/jquery.dataTables.js"></script>

<?php

require_once('functions.php'); 
$pdo= new functions("g-bike");

$id=empty($_GET['id'])?0:$_GET['id'];
$where = array(":park_id"=>$id);
$rs=$pdo->select("park",$where);
	
if(count($rs)!=0){
?>

<body>
<h1 align="center">車棚管理</h1>
<p align="center">&nbsp;</p>
<form action="park_update.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
          <tr>
        <th colspan="5" style="font-size:24px"><input type="hidden" name="park_id" value="<?php echo $id?>">
          修改車棚資料</thead>
 
        <tbody>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">名稱</td>
          <td width="200" align="center" valign="middle">
          <input name="park_name" type="varchar" required tabindex="1"  value="<?php echo $rs[0]['park_name']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">最大容量</td>
          <td width="200" align="center" valign="middle">
          <input name="park_max" type="int" tabindex="1"  value="<?php echo $rs[0]['park_max']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">可用單車數</td>
          <td colspan="2" align="center" valign="middle">
          <input name="park_suitable" type="int" tabindex="2"  value="<?php echo $rs[0]['park_suitable']?>"></td>
          </tr>
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
              <input type="submit" value="儲存" onclick="location.href='park_list.php">
              &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" value="取消" onclick="location.href='park_list.php">
           </tr>
        </tbody>
      </table>


</form>

  </script>
<?php }
else echo "<script type=\"text/javascript\">alert('錯誤!');location.href='park_list.php'</script>";?>
</body>
</html>