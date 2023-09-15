<?php 

require_once('include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");

?>
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">車棚資料</h1>
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
                           <a class="btn btn-default btn-xs" href="park_add.php">+ Add new park</a></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                            <th>車棚名稱</th>
                                            <th>最大容量</th>
                                            <th>可用單車數</th>
                                            <th>車棚狀態</th>
                                            <th>功能</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 <?php
								 $where = array();
								 $rs=$pdo->select("park",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $key['park_name'] ?></td>
                                            <td><?php echo $key['park_max'] ?></td>
                                            <td><?php echo $key['park_suitable'] ?></td>
                                            <td><?php 
											echo ($key['park_suitable'] > $key['park_max'])?"<font color='#FF0000' size='+2'><strong>車位須調整</strong></font>":"良好"?></td>
                                            <td style="width:100px;;">
                                        	<a class="btn btn-default btn-xs" onclick="location.href='park_edit.php?id=<?php echo $key['park_id']?>'">edit</a>
                                            <a class="btn btn-default btn-xs" onclick="location.href='park_delete.php?id=<?php echo $key['park_id']?>'">delete</a>
                                            </td>
                                        </tr>
                                 <?php } ?>
                                	
    </script>
