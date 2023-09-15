<?php           //不可以簡稱

require_once( 'include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");
?>
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">租借紀錄</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                        	&nbsp;
                         </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                            <th>租借編號</th>
                                            <th>啟用時間</th>
                                            <th>結束時間</th>
                                            <th>狀態</th>
                                            <th>使用者編號</th>
                                            <th>單車編號</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                 <?php
								 $where = array();
								 $rs=$pdo->select("rent",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $key['rent_id'] ?></td>
                                            <td><?php echo $key['rent_start_time'] ?></td>
                                            <td><?php echo $key['rent_end_time'] ?></td>
                                            <td><?php echo $key['rent_status'] ?></td>
                                            <td><?php
                                            $where2 =  array(":user_id" =>$key["user_id"]);
								            $rs2=$pdo->select("user",$where2);
											echo $rs2[0]['user_name'] ?></td>
                                            <td><?php
                                            $where3 =  array(":bike_id" =>$key["bike_id"]);
								            $rs3=$pdo->select("bike",$where3);
											echo $rs3[0]['bike_name'] ?></td>
                                            
                                        </tr>
                                 <?php } ?>
                                	</tbody>
                               
    </script>
