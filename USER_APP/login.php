<?php
require_once('functions.php'); 
session_unset();
$pdo= new functions("g-bike");//DBname
if ((empty($_GET["login"])?"":$_GET["login"]) == "Login") {
//(條件式) ? T:F
	$user_email = trim($_GET["email"]);
	$user_password = trim($_GET['password']);	
	
	$where =  array(':user_email' => $user_email, ':user_password' => $user_password);
	$rs=$pdo->select("user",$where);   //資料表，條件式
	if (count($rs)==1) {
		$_SESSION['user_id'] = $rs[0]['user_id'];
		$_SESSION['user_name'] =$rs[0]['user_name'];
		$_SESSION['isLogin'] = "yes";
		
		header("Location: home.php?userid=".$rs[0]['user_id']);
	} 
	else {
		$errorStr ="登入失敗，請重新登入";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>G-Bike</title>

    
</head>

<body>
	<div style="background-color:#88a8a8 ; padding:10px;"> 
	</div>
	
	<!--背景顏色-->
	<div style="background:#F3F3F3;">
	    
		<div>
    		<center>
	    		<img src="media/gbike.png" width="250" height="100" alt=""/>
	    	</center>
	    </div>
	    <p>&nbsp;</p>
<script>

</script>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    
                    <div class="panel-body">
                        <form role="form" action="#" >
                           <P></P>
                            
                                <center><div class="form-group">
                                    <input class="form-control" 
                                    placeholder="E-mail" name="email" type="email" autofocus required />
                                </div>
                                <div class="form-group">
                                   <p></p>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required />
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <P>
                                	
                                </P>
                                <input type="submit" name="login" value="Login" class="btn btn-lg btn-success btn-block"/></center>
                           
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap_bicycle.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <div style="background-color:#88a8a8 ; padding:10px;"> 
	</div>

</body>

</html>