<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理者資料刪除</title>
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

$where = array(":manager_id"=>$id);
$rs=$pdo->select("manager",$where);
	
if(count($rs)!=0){
?>
<body>
<h1 align="center">管理者管理</h1>
<p align="center">&nbsp;</p>
<form action="manager_showdelete.php" method="post">
      <table border="1" align="center" cellpadding="8" cellspacing="0" id="table1">
        <thead>
        <tr>
        <th colspan="5" style="font-size:24px"><input type="hidden" name="manager_id" value="<?php echo $id?>">
          刪除使用者資料</thead>
  
        <tbody>
        <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">姓名</td>
          <td width="200" align="center" valign="middle"><?php echo $rs[0]['manager_name']?></td>
          </tr>
          <tr>
          <td width="200" align="center" valign="middle" style="font-size:15px">帳號</td>
          <td width="200" align="center" valign="middle"><?php echo $rs[0]['manager_email']?></td>
          </tr>
          <tr>
          <td width="200"  align="center" valign="middle" style="font-size:15px">密碼</td>
          <td width="200" align="center" valign="middle"><?php echo $rs[0]['manager_password']?></td>
          </tr>
          
         
          
          <tr colspan="100%">
                  <th  height="40" colspan="2"  align="center" valign="middle">
                  <p style="color: #F00">*【警告】 一但刪除，則無法復原!! *</p>
                    <p>
              <input type="submit" value="刪除" onclick="location.href='manager_list.php'">
              
           </tr>
        </tbody>
      </table>

</form>

  </script>
<?php }
else echo "<script type=\"text/javascript\">alert('錯誤!');location.href='manager_list.php'</script>";?>
</body>
</html>