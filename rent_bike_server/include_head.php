<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bicycle Center Database</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap_bicycle.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="user_list.php">G-Bike 校園單車管理系統</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="back_login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
              </ul>
                <!-- /.dropdown-user -->                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

          <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="user_list.php"><i class="fa fa-table fa-fw"></i> 使用者資料</a> </li>
                        <li>
                            <a href="bike_list.php"><i class="fa fa-table fa-fw"></i> 單車資料</a></li>
                        <li>
                            <a href="rent_list.php"><i class="fa fa-table fa-fw"></i> 租借紀錄</a> </li>
                        <li>
                            <a href="park_list.php"><i class="fa fa-table fa-fw"></i> 車棚資料</a></li>
                        <li>
                            <a href="parkmap_list.php"><i class="fa fa-table fa-fw"></i> 車棚位置設定</a></li>
                        <li>
                            <a href="report_list.php"><i class="fa fa-table fa-fw"></i> 維修回報</a></li>
                        <li>
                            <a href="manager_list.php"><i class="fa fa-table fa-fw"></i> 管理者資料</a></li>
                        <li>
                            <a href="text_list.php"><i class="fa fa-table fa-fw"></i> 條款及公告</a></li>
                        <li>
                            <a href="back_login.php"><i class="fa fa-table fa-fw"></i> 登出</a></li>
                        <li>
                            <!--<a href="company_list.php"><i class="fa fa-table fa-fw"></i> Company List</a>-->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

