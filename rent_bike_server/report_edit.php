<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>維修回報修改</title>
<link rel="stylesheet" type="text/css" href="jQueryAssets/flick.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/jquery.dataTables_themeroller.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/mycss.css">
  <script src="jQueryAssets/jquery-1.10.2.js"></script>
  <script src="jQueryAssets/jquery.dataTables.js"></script>

<?php

require_once('functions.php'); 
$pdo= new functions("g-bike");

$id=empty($_GET['id'])?0:$_GET['id'];
$where = array(":report_id"=>$id);
$rs=$pdo->select("report",$where);
	
if(count($rs)!=0){
?>

<body>
<h1 align="center">維修回報管理</h1>
<p align="center">&nbsp;</p>
<form action="report_update.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
          <tr>
        <th colspan="5" style="font-size:24px"><input type="hidden" name="report_id" value="<?php echo $id?>">
          修改維修回報資料</thead>
 
        <tbody>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">問題</td>
          <td width="200" align="center" valign="middle">
          <input name="report_problem" type="char" required tabindex="1"  value="<?php echo $rs[0]['report_problem']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">地點</td>
          <td colspan="2" align="center" valign="middle">
          <input name="report_location" type="char" tabindex="2"  value="<?php echo $rs[0]['report_location']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">時間</td>
          <td width="200" align="center" valign="middle">
          <input name="report_time" type="datetime" required tabindex="1"  value="<?php echo $rs[0]['report_time']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">狀態</td>
          <td colspan="2" align="center" valign="middle">
          <input name="report_type" type="char" tabindex="2"  value="<?php echo $rs[0]['report_type']?>"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">解決</td>
          <td width="200" align="center" valign="middle">
          <input name="report_finish" type="int" required tabindex="1"  value="<?php echo $rs[0]['report_finish']?>"></td>
          </tr>
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
              <input type="submit" value="儲存" onclick="location.href='report_list.php">
              &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" value="取消" onclick="location.href='report_list.php">
           </tr>
        </tbody>
      </table>


</form>

  </script>
<?php }
else echo "<script type=\"text/javascript\">alert('錯誤!');location.href='report_list.php'</script>";?>
</body>
</html>