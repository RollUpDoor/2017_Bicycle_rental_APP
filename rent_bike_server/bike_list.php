<?php           //不可以簡稱

require_once('include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");
?>
<meta charset="utf-8">
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">單車資料</h1>
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
                           <a class="btn btn-default btn-xs" href="bike_add.php">+ Add new bike</a></div></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                            <th>單車編號</th>
                                            <th>單車密碼</th>
                                            <th>車棚</th>
                                            <th>In/Out</th>
                                            <th>功能</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 <?php
								 $where = array();
								 $rs=$pdo->select("bike",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                        <tr class="odd gradeX">
                                            <td><?php
                                            $where2 =  array(":bike_id" =>$key["bike_id"]);
								            $rs2=$pdo->select("bike",$where2);
											echo $rs2[0]['bike_name'] ?></td>
                                            <td><?php echo $key['bike_lock'] ?></td>
                                            <td><?php
                                            $where3 =  array(":park_id" =>$key["park_id"]);
								            $rs3=$pdo->select("park",$where3);
											echo $rs3[0]['park_name'] ?></td>
                                            <td><?php echo $key['bike_in_out'] ?></td>
                                            <td style="width:100px;;">
                                            <a class="btn btn-default btn-xs" onclick="location.href='bike_edit.php?id=<?php echo $key['bike_id']?>'">edit</a>
                                            <a class="btn btn-default btn-xs" onclick="location.href='bike_delete.php?id=<?php echo $key['bike_id']?>'">delete</a>
                                            </td>
                                        </tr>
                                 <?php } ?>
                                	
    </script>
