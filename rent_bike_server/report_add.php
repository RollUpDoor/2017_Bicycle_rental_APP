<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>維修回報新增</title>
<link rel="stylesheet" type="text/css" href="jQueryAssets/flick.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/jquery.dataTables_themeroller.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/mycss.css">
  <script src="jQueryAssets/jquery-1.10.2.js"></script>
  <script src="jQueryAssets/jquery.dataTables.js"></script>

</head>
<?php
require_once('functions.php'); 
$pdo= new functions("g-bike");

$tempdate=date("y-m-d H:i:s");
?>
<body>
<h1 align="center">維修回報管理</h1>
<p align="center">&nbsp;</p>
<form action="report_showadd.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
          <tr>
        <th colspan="5" style="font-size:24px">新增維修資料</thead>
  
        <tbody>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">問題</td>
          <td width="200" align="center" valign="middle">
          <input name="report_problem" type="varchar" required tabindex="1"></td>
          </tr>
          <tr>
          <td width="200"  align="center" valign="middle" style="font-size:15px">地點</td>
          <td width="200" align="center" valign="middle">
          <input name="report_location" type="int" required min="0" tabindex="2"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">時間</td>
          <td width="200" align="center" valign="middle">
		  <?php echo $tempdate?>
          </tr>
          <tr>
          <td width="200"  align="center" valign="middle" style="font-size:15px">狀態</td>
          <td width="200" align="center" valign="middle">
          維修</td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">解決</td>
          <td width="200" align="center" valign="middle">
          未解決</td>
          </tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">單車編號</td>
          <td width="200" align="center" valign="middle">
          <input name="bike_name" type="varchar" required tabindex="1"></td>
          </tr>
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
              <input type="submit" value="儲存" onclick="location.href='report_list.php">
             
           </tr>
        </tbody>
      </table>

</form>

  </script>

</body>
</html>