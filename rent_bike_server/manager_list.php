<?php           //不可以簡稱

require_once('include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");
?>
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">管理者資料</h1>
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
                           <a class="btn btn-default btn-xs" href="manager_add.php">+ Add new manager</a></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                            <th>姓名</th>
                                            <th>帳號</th>
                                            <th>密碼</th>
                                            <th>功能</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 <?php
								 $where = array();
								 $rs=$pdo->select("manager",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                        <tr class="odd gradeX">
                                             <td><?php echo $key['manager_name']; ?></td>
                                             <td><?php echo $key['manager_email']; ?></td>
                                             <td><?php echo $key['manager_password']; ?></td>
                                             <td style="width:100px;;">
                                             <a class="btn btn-default btn-xs" onclick="location.href='manager_edit.php?id=<?php echo $key['manager_id']?>'">edit</a>
                                             <a class="btn btn-default btn-xs" onclick="location.href='manager_delete.php?id=<?php echo $key['manager_id']?>'">delete</a>
                                            </td>
                                        </tr>
                                      <?php }?>
                                	</tbody>
                               
    </script>
