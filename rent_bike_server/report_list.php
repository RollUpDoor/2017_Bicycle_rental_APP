<?php 

require_once('include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");

?>
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">維修回報</h1>
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
                           <a class="btn btn-default btn-xs" href="report_add.php">+ Add new report</a></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                            <th>問題</th>
                                            <th>地點</th>
                                            <th>時間</th>
                                            <th>狀態</th>
                                            <th>解決</th>
                                            <th>使用者</th>
                                            <th>單車</th>
                                            <th>功能</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  <?php
								 $where = array();
								 $rs=$pdo->select("report",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $key['report_problem'] ?></td>
                                            <td><?php echo $key['report_location'] ?></td>
                                            <td><?php echo $key['report_time'] ?></td>
                                            <td><?php echo $key['report_type'] ?></td>
                                            <td><?php echo $key['report_finish'] ?></td>
                                            <td><?php 
											$where2 =  array(':user_id' =>$key['user_id']);
											$rs2=$pdo->select("user",$where2);
											echo $rs2[0]['user_name']?></td>
                                            <td><?php
                                            $where3 =  array(":bike_id" =>$key["bike_id"]);
								            $rs3=$pdo->select("bike",$where3);
											echo $rs3[0]['bike_name'] ?></td>
                                            <td style="width:100px;;">
                                        	<a class="btn btn-default btn-xs" onclick="location.href='report_edit.php?id=<?php echo $key['report_id']?>'">edit</a>
                                        </td>
                                        </tr>
                                 <?php } ?>
                                	
    </script>
