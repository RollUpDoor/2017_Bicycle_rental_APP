<?php
require_once('functions.php'); 
session_unset();
$pdo= new functions("g-bike");//DBname

$errorStr ="";

if ((empty($_POST["login"])?"":$_POST["login"]) == "Login") {
//(條件式) ? T:F
	$manager_email = trim($_POST["email"]);
	$manager_password = trim($_POST['password']);	
	
	$where =  array(':manager_email' => $manager_email, ':manager_password' => $manager_password);
	$rs=$pdo->select("manager",$where);   //資料表，條件式
	if(count($rs)==1) {
		$_SESSION['manager_id'] = $rs[0]['manager_id'];
		$_SESSION['manager_name'] =$rs[0]['manager_name'];
		$_SESSION['isLogin'] = "yes";
		
		header("Location: user_list.php?managerid=".$rs[0]['manager_id']);
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

    <title>Brain Injury Database</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap_bicycle.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<script>

</script>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In <span class="error">&nbsp;<? echo $errorStr?></span></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="#" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" 
                                    ="E-mail" name="email" type="email" autofocus required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required />
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="login" value="Login" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                        <br>
                        <p align="center"><?php echo $errorStr;?></p>
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

</body>

</html>
