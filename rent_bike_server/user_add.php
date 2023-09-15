<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>使用者資料新增</title>
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
<h1 align="center">使用者管理</h1>
<p align="center">&nbsp;</p>
<form action="user_showadd.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
          <tr>
        <th colspan="5" style="font-size:24px">新增使用者資料</thead>
  
        <tbody>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">帳號</td>
          <td width="200" align="center" valign="middle">
          <input name="user_email" type="varchar" required tabindex="1"></td>
          </tr>
          <tr>
          <td width="200"  align="center" valign="middle" style="font-size:15px">密碼</td>
          <td width="200" align="center" valign="middle">
          <input name="user_password" type="varchar" required min="0" tabindex="2"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">姓名</td>
          <td width="200" align="center" valign="middle">
          <input name="user_name" type="text" required tabindex="3"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">學號</td>
          <td colspan="2" align="center" valign="middle">
          <input name="user_number" type="varchar" tabindex="4"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">電話</td>
          <td colspan="2" align="center" valign="middle">
          <input name="user_phone" type="varchar" tabindex="4"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">性別</td>
          <td colspan="2" align="center" valign="middle">
          <input name="user_gender" type="text" tabindex="4"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">入學年度</td>
          <td colspan="2" align="center" valign="middle">
          <input name="user_year" type="varchar" tabindex="4"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">系級</td>
          <td colspan="2" align="center" valign="middle">
          <input name="user_department_id" type="text" tabindex="4"></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">點數</td>
          <td colspan="2" align="center" valign="middle">
          <input name="user_point" type="varchar" tabindex="4"></td>
          </tr>
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
              <input type="submit" value="儲存" onclick="location.href='user_list.php">
             
           </tr>
        </tbody>
      </table>

</form>

  </script>

</body>
</html>