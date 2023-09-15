<?php           //不可以簡稱

require_once( 'include_head.php');
require_once('functions.php'); 

$pdo= new functions("g-bike");
?>
<meta charset="utf-8">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">條款及公告</h1>
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
                           <a class="btn btn-default btn-xs" onclick="location.href='text_add.php'">+ Add new text</a>
                        </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                                    <thead>
                                        <tr>
                                        	<th>編號</th>
                                            <th>類型</th>
                                            <th>內容</th>
                                            <th>功能</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                 <?php
								 $where = array();
								 $rs=$pdo->select("text",$where);   //資料表，條件式
								 foreach($rs as $key){
									 ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $key['text_id'] ?></td>
                                            <td><?php echo $key['text_belong'] ?></td>
                                            <td><?php echo $key['text_content'] ?></td>
                                          <td style="width:100px;;">
                                            <a class="btn btn-default btn-xs" onclick="location.href='text_edit.php?id=<?php echo $key['text_id']?>'">edit</a>
                                            <a class="btn btn-default btn-xs" onclick="location.href='text_delete.php?id=<?php echo $key['text_id']?>'">delete</a>
                                            </td>
                                        </tr>
                                 <?php } ?>
                                	
    </script>
