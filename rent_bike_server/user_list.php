<?php 

require_once('include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");

?>
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">使用者資料</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                        	&nbsp;
                           <div class="pull-right">
                           <a class="btn btn-default btn-xs" onclick="location.href='user_add.php'">+ Add new user</a>
                        </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                            <th>帳號</th>
                                            <th>密碼</th>
                                            <th>姓名</th>
                                            <th>學號</th>
                                            <th>電話</th>
                                            <th>性別</th>
                                            <th>入學年度</th>
                                            <th>系級</th>
                                            <th>點數</th>
                                            <th>單車編號</th>
                                            <th>功能</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  <?php
								 $where = array();
								 $rs=$pdo->select("user",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                 
                                        <tr class="odd gradeX">
                                            <td><?php echo $key['user_email']?></td>
                                            <td><?php echo $key['user_password']?></td>
                                            <td><?php echo $key['user_name'] ?></td>
                                            <td><?php echo $key['user_number'] ?></td>
                                            <td><?php echo $key['user_phone'] ?></td>
                                            <td><?php echo $key['user_gender'] ?></td>
                                            <td><?php echo $key['user_year'] ?></td>
                                            <td><?php echo $key['user_department_id'] ?></td>
                                            <td><?php echo $key['user_point'] ?> </td>
                                            <td><?php
                                            $where2 =  array(":bike_id" =>$key["bike_id"]);
								            $rs2=$pdo->select("bike",$where2);
											echo (($key['bike_id'] == "")?"未借用":$rs2[0]['bike_name']) ?></td>
                                            <td style="width:100px;;">
                                            <a class="btn btn-default btn-xs" onclick="location.href='user_edit.php?id=<?php echo $key['user_id']?>'">edit</a>
                                            <a class="btn btn-default btn-xs" onclick="location.href='user_delete.php?id=<?php echo $key['user_id']?>'">delete</a>
                                            </td>
                                        </tr>
                                 <?php } ?>
                                	
    </script>
