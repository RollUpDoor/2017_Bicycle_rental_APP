<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理者資料新增</title>
<link rel="stylesheet" type="text/css" href="jQueryAssets/flick.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/jquery.dataTables_themeroller.css">
<link rel="stylesheet" type="text/css" href="jQueryAssets/css/mycss.css">
  <script src="jQueryAssets/jquery-1.10.2.js"></script>
  <script src="jQueryAssets/jquery.dataTables.js"></script>

</head>
<?php
require_once('functions.php'); 
$pdo= new functions("g-bike");

?>
<body>
<h1 align="center">管理者管理</h1>
<p align="center">&nbsp;</p>
<form action="manager_showadd.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
          <tr>
        <th colspan="5" style="font-size:24px">新增管理者資料</thead>
  
        <tbody>
         
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">姓名</td>
          <td width="200" align="center" valign="middle">
          <input name="manager_name" type="text" required tabindex="3"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">帳號</td>
          <td width="200" align="center" valign="middle">
          <input name="manager_email" type="varchar" required tabindex="1"></td>
          </tr>
           <tr>
          <td width="200"  align="center" valign="middle" style="font-size:15px">密碼</td>
          <td width="200" align="center" valign="middle">
          <input name="manager_password" type="varchar" required min="0" tabindex="2"></td>
          </tr>
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
              <input type="submit" value="儲存" onclick="location.href='manager_list.php">
             
           </tr>
        </tbody>
      </table>

</form>

  </script>

</body>
</html>