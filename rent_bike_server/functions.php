<?php
date_default_timezone_set("Asia/Taipei");
@session_start();

class functions extends PDO{
	//屬性
	private $_dsn;
	
	private $_user="root";
	private $_pass="123456789";
	
	private $_encode="utf8";
	private $_stmt;
	private $_data = array();
	private $_last_insert_id;
	
	function __construct($db){
		$this->_dsn="mysql:host=127.0.0.1;dbname=".$db;//設定DataBase
		try{
			parent::__construct($this->_dsn,$this->_user,$this->_pass);
			$this->_setEncode();
		}	
		catch(Exception $e){
			print_r($e);
		}
	}//end construct 建構子
	
	function __set($name,$value){
		$this->_data[$name]=$value;
	}//end set
	
	function __get($name){
		if(isset($this->_data[$name]))
			return $this->_data[$name];
		else return false;
	}//end get
	
	private function _setEncode(){
		$this->query("SET NAMES '{$this->_encode}'");
	}//end setEncode 設定為UTF8連線編碼
		
	function bindQuery($sql,$bind=array ()){
		$this->_stmt=$this->prepare($sql);
		$this->_bind($bind);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
	}//end bindQuery   執行查詢
	
	private function _bind($bind){//綁定欄位型態
		foreach($bind as $key => $value){
			$this->_stmt->bindValue($key,$value, is_numeric($value)?PDO::PARAM_INT:PDO::PARAM_STR);
			}
	}//end bind 綁定植
	
	function error(){
		$error=$this->_stmt->errorInfo();
		echo "<br>".'errorCode:'.$error[0]."<br>";
		echo 'errorString:'.$error[2]."<br>";
	}//end error  顯示錯誤訊息
	
	function getData(){
		return $this->_data;
	}//end getData  取得DATA
	
	function getlastInsertId(){
		return $this->_last_insert_id;
	}

//======================================通用SQL方法=====================================
	function select($table,$where=array()){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue';
		
		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues).";":"select * from `{$table}`;";
		   return	$this->bindQuery($sql,$where);

	}//end select 查詢
	
	function selectLimit($table,$where=array(),$start,$end){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();

		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues)." limit $start,$end;":"select * from `{$table}` limit $start,$end;";
		   return	$this->bindQuery($sql,$where);

	}//end select limit 查詢
	
	function selectOffset($table,$where=array(),$offsetQ){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();

		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues)."limit 100000000 OFFSET $offsetQ;":"select * from `{$table}` limit 100000000 OFFSET $offsetQ;";
		   return	$this->bindQuery($sql,$where);

	}//end select OFFSET 查詢
	
	function selectGroupByASC($table,$where=array(),$groupfield){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue' group by`field`;
		
		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues)." group by `{$groupfield}`;":"select * from `{$table}` group by `{$groupfield}`;";
		   return	$this->bindQuery($sql,$where);


	}//end selectGroupByASC 查詢
	
	function selectGroupByDESC($table,$where=array(),$groupfield){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue' group by`field`;
		
		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues)." group by `{$groupfield}` DESC;":"select * from `{$table}` group by `{$groupfield}` DESC;";
		   return	$this->bindQuery($sql,$where);

	}//end selectGroupByDESC 查詢
	
	
	function selectInnerJoin($table1,$table2,$on=array()){
		$data = array_merge($this->_data,$on);// array_merge 陣列合併
		$onvalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue' group by`field`;
		
		foreach($data as $key =>$value){
			$onvalues[]= "`".$key."` like $value";
		}
           $sql="select * from `{$table1}` inner join `{$table2}` on ".implode(' and ',$onvalues).";";
		   return	$this->bindQuery($sql,$on);

	}//end selectInnerJoin 查詢
	
	function selectInnerJoinOrderby($table1,$table2,$on=array(),$orderby,$option){
		$data = array_merge($this->_data,$on);// array_merge 陣列合併
		$onvalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue' group by`field`;
		
		foreach($data as $key =>$value){
			$onvalues[]= "`".$key."` like $value";
		}
         $sql="select * from `{$table1}` inner join `{$table2}` on ".implode(' and ',$onvalues)." order by `{$orderby}` $option;";
		   return	$this->bindQuery($sql,$on);

	}//end selectInnerJoin 查詢
	
	function selectInnerJoinGroupByASC($table1,$table2,$on=array(),$groupfield){
		$data = array_merge($this->_data,$on);// array_merge 陣列合併
		$onvalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue' group by`field`;
		
		foreach($data as $key =>$value){
			$onvalues[]= "`".$key."` like $value";
		}
         	$sql="select * from `{$table1}` inner join `{$table2}` on ".implode(' and ',$onvalues)." group by `{$groupfield}`;";
		   return	$this->bindQuery($sql,$on);

	}//end selectInnerJoin 查詢
	
	function selectMax($table,$maxfield=array(),$where=array()){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();

		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
		
		foreach($maxfield as $key =>$value){
			$maxfieldvalues[]= "MAX(`{$value}`) ";
		}
		
       $sql=($wherevalues)?"select ".implode(' , ',$maxfieldvalues)." from `{$table}` where ".implode(' and ',$wherevalues).";":"select ".implode(' , ',$maxfieldvalues)." from `{$table}`;";
		   return	$this->bindQuery($sql,$where);
	}//end select Max
		   
		function selectOrderBy($table,$where=array(),$order=array()){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue';
		
		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
		foreach($order as $key =>$value){
			$orderfield[]= "`$key` $value";
		}
		
		
       $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues)." order by ".implode(' , ',$orderfield).";":"select * from `{$table}` order by ".implode(' , ',$orderfield).";";
		   return	$this->bindQuery($sql,$where);

	}//end select order by查詢
	
		function selectBetween($table,$where=array(),$betweenfield,$betweenSTARTrange,$betweenENDrange){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();
		
		//查詢的SQL語法：select `field1`,`field2` from `table` where `conditionfield` = 'conditionvalue';
		
		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql=($wherevalues)?"select * from `{$table}` where ".implode(' and ',$wherevalues)." and $betweenfield between `{$betweenSTARTrange}` and `{$betweenENDrange}`;":"select * from `{$table}` between `{$betweenSTARTrange}` and `{$betweenENDrange}`";
		   return	$this->bindQuery($sql,$where);

	}//end select order by查詢
	
	function selectSum($table,$sumfield=array(),$where=array()){
		$data = array_merge($this->_data,$where);// array_merge 陣列合併
		$wherevalues=array();
		$bind_data=array();

		foreach($data as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
		
		foreach($sumfield as $key =>$value){
			$sumfieldvalues[]= "SUM(`{$value}`) ";
		}
		
       $sql=($wherevalues)?"select ".implode(' , ',$sumfieldvalues)." from `{$table}` where ".implode(' and ',$wherevalues).";":"select ".implode(' , ',$sumfieldvalues)." from `{$table}`;";
		   return	$this->bindQuery($sql,$where);
	}//end select Max
	
	
	//***************************************************************
	
	function insert($table,$param=array()){
		$data = array_merge($this->_data,$param);// array_merge 陣列合併
		$columns = array_keys($data);//array_keys 陣列索引值
		$values=array();
		$bind_data=array();
		
		//新增的SQL語法：insert into table (`field1`,`field2`) values ('value1','value2') ;
		
		foreach($data as $key =>$value){
			$values[]=":{$key}";
			$bind_data[":{$key}"]=$value;
		}
		$sql="INSERT INTO `{$table}` (`".implode('`,`',$columns)."`) VALUES (".implode(',',$values).");";
		$this->_stmt=$this->prepare($sql);
		$this->_bind($bind_data);
		$this->_stmt->execute();
		$this->_last_insert_id=$this->lastInsertId();//將最後insert ID存入_last_insert_id屬性
		
	}//end insert   新增
		
	function update($table,$param=array(),$id=false){
		if($id==false && !($id=$this->id)){//判斷id是否存在
			return false;
		}else {
		$data = array_merge($this->_data,$param);// array_merge 陣列合併
		$columns = array_keys($data);//array_keys 陣列索引值
		$bind_temp=array();
		$bind_data=array();
		
		//更新的SQL語法：update table set `field1`='value1',`field2`='value2' where `id`='id';
		
		foreach($data as $key =>$value){
				$bind_temp[]="`{$key}`=:{$key}";
				$bind_data[":{$key}"]=$value;
		}
	    $sql="UPDATE `{$table}` SET ".implode(',',$bind_temp)." where `{$table}_id` = :id;";
		$this->_stmt=$this->prepare($sql);
		$this->_bind(array(":id"=>$id));//檢查id欄位型態
		$this->_bind($bind_data);//檢查欄位型態
		$this->_stmt->execute();
		}//end else
	}//end update   更新
		
	function upadteFK($table,$param=array(),$where=array()){
		$data = array_merge($this->_data,$param);// array_merge 陣列合併
		$columns = array_keys($data);//array_keys 陣列索引值
		$bind_temp=array();
		$bind_data=array();
		$wherevalues=array();
		
		//更新的SQL語法：update table set `field1`='value1',`field2`='value2' where `id`='id';
		//更新的欄位
		foreach($data as $key =>$value){
				$bind_temp[]="`{$key}`=:{$key}";
				$bind_data[":{$key}"]=$value;
		}
		//更新的where條件式
		foreach($where as $key =>$value){
			$sqlwhere[]= "`{$key}` like :$key";
			$wherevalues[":{$key}"]=$value;
		}
		
	    $sql="UPDATE `{$table}` SET ".implode(',',$bind_temp)." where ".implode(' and ',$sqlwhere).";";
		$this->_stmt=$this->prepare($sql);
		$this->_bind($bind_data);//檢查欄位
		$this->_bind($wherevalues);//檢查where
		$this->_stmt->execute();
	}//end upadteFK   更新	
		

	function delete($table,$id=false){
		if($id==false && !($id=$this->id)){//判斷id是否存在
			return false;
		}else {
	    $sql="delete from `{$table}` where `{$table}_id` = :id;";
		$this->_stmt=$this->prepare($sql);
		$this->_bind(array(":id"=>$id));//檢查id欄位型態
		$this->_stmt->execute();
		}//end else
	}//end delete   刪除
	

	function deleteFK($table,$where=array()){
		//刪除的where條件式
		foreach($where as $key =>$value){
			$sqlwhere[]= "`{$key}` like :$key";
			$wherevalues[":{$key}"]=$value;
		}
		
	    $sql="delete from `{$table}` where ".implode(' and ',$sqlwhere).";";
		$this->_stmt=$this->prepare($sql);
		$this->_bind($wherevalues);//檢查where
		$this->_stmt->execute();

	}//end deleteFk  刪除



//====================================自訂SQL方法==================================


























//俊良專題的function  當做demo參考用

	function displaysavedefaulttable(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
        $sql="select * from `table` where `restaurant_id`={$restaurant_id} ".
		"order by `table_number` ASC;";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
	}//end displaysavedefaulttable查詢
	//***************************************************************************
	function parameter_table_save_delete(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
	   	 	$sql="delete from `table` where `restaurant_id` = {$restaurant_id};";
			$this->_stmt=$this->prepare($sql);
			$this->_stmt->execute();
	}//end parameter_table_save_delete
	
	//***************************************************************************
	function display_Workstation_product_totaltable($in1,$in2,$where){
		
        $sql="select * from `ordersheetdetail` where `ordersheet_id` in ({$in1}) and `product_id` in ({$in2}) order by `ordersheetdetail_id` ASC;";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();

	}//end display_Workstation_product_totaltable查詢
	//***********************************顧客人數****************************************
	function customerVisits($starttime,$endtime){
		if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT sum(`ordersheet_peoplequantity`) FROM `ordersheet` ".
		"where `ordersheet_state`='訂單結束' and `ordersheet_ordertime` between '$starttime' and '$endtime' ".
		"and `restaurant_id`='$restaurant_id';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}
//**************************************單日顧客人數*************************************
	function customerVisitsOneday($oneday){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT sum(`ordersheet_peoplequantity`) FROM `ordersheet` ".
		"where `ordersheet_state`='訂單結束' and `ordersheet_ordertime` like '$oneday%' ".
		"and `restaurant_id`='$restaurant_id';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}
//**************************************歷史顧客人數*************************************
	function customervisitshistory(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT DISTINCT DATE(`ordersheet_ordertime`) FROM `ordersheet` ".
		"where `ordersheet_state`='訂單結束' and `restaurant_id`='$restaurant_id';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}
//**************************************熱門餐點*************************************
	function analysis_hotmeals($starttime,$endtime,$product_kind_id){
		$endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];

		$sql="SELECT `ordersheetdetail`.`product_id`,count(*) FROM `ordersheetdetail` inner join `product` on `ordersheetdetail`.`product_id`=`product`.`product_id` and `product`.`product_kind_id` like '$product_kind_id' and `ordersheetdetail`.`ordersheet_id` in (SELECT `ordersheet_id` FROM `ordersheet` where `restaurant_id`='$restaurant_id' and `ordersheet_ordertime` between '$starttime' and '$endtime' and `ordersheet`.`ordersheet_state`='訂單結束') group by `product_id`";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}

//**************************************熱門時段*************************************
	function analysis_hottime($starttime,$endtime,$ordersheet_ordertype){
		if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT `ordersheet_ordertime` FROM `ordersheet` ".
		"where `ordersheet_state`='訂單結束' and `ordersheet_ordertime` between '$starttime' and '$endtime' ".
		"and `restaurant_id`='$restaurant_id' and `ordersheet_ordertype` like '$ordersheet_ordertype';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}
//**************************************熱門時段2 餐點別 年*************************************
	function analysis_hottime_productNameYEAR($starttime,$endtime,$ordersheet_ordertype,$product_id){
		if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT `ordersheet_ordertime` FROM `ordersheet` inner join `ordersheetdetail`".
			"on `ordersheet`.`ordersheet_id`=`ordersheetdetail`.`ordersheet_id` and ".
			"`ordersheetdetail`.`product_id` like '$product_id' and `ordersheet`.`ordersheet_state`='訂單結束' ".
			"and `ordersheet`.`ordersheet_ordertime` between '$starttime' and '$endtime' ".
			"and `ordersheet`.`restaurant_id`='$restaurant_id' and `ordersheet`.`ordersheet_ordertype` ".
			"like '$ordersheet_ordertype';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}

//**************************************熱門時段3 餐點別 小時*************************************
	function analysis_hotmealsproductName($starttime,$endtime,$productid){
		if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT `ordersheet_ordertime` FROM `ordersheet` where `ordersheet_id` in 
		(SELECT `ordersheet_id` FROM `ordersheetdetail` where `product_id` like '$productid') and `ordersheet_ordertime` between '$starttime' and '$endtime' and `ordersheet_state`='訂單結束' and `restaurant_id`='$restaurant_id';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}

//**************************************熱門訂位時段1 餐點別*************************************
	function analysis_hotmealsperiodproductName($ordertimeperiod_id,$product_id){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		$ordersheet_ordertime=date("Y-m-d");
		
		$sql="SELECT count(*) FROM `ordersheetdetail` where `ordersheet_id` in (SELECT `ordersheet_id` FROM `ordersheet` where `ordertimeperiod_id` = '$ordertimeperiod_id' and `restaurant_id`='$restaurant_id' and `ordersheet_ordertime` like '$ordersheet_ordertime%') and `product_id` like '$product_id';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}

//**************************************熱門訂位時段2 訂單方式(網路/現場)*************************************
	function analysis_hotmealsperiodOrdertype($ordertimeperiod_id,$type,$ordersheet_ordertime){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT count(*) FROM `ordersheet` where `ordertimeperiod_id` = '$ordertimeperiod_id' and `restaurant_id`='$restaurant_id' and `ordersheet_ordertime` like '$ordersheet_ordertime%' and `ordersheet_ordertype` like '$type%';";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}

//******************************翻桌率算法1*****************************************
function getTurnoverRate1($starttime,$endtime){//算法1：來店總人數/總桌數
	if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
	@session_start();
	$restaurant_id=$_SESSION['restaurant_id'];
	$sql = "SELECT sum(`ordersheet_peoplequantity`) FROM  `ordersheet` where `ordersheet_state`='訂單結束' and `ordersheet_ordertime` and `restaurant_id`='$restaurant_id' and `ordersheet_ordertime`  between '$starttime' and '$endtime'";
	$this->_stmt=$this->prepare($sql);
	$this->_stmt->execute();
	$rs1=$this->_stmt->fetchAll();
	
	$sql = "SELECT sum(`table_seatquantity`) FROM `table` where `restaurant_id`='$restaurant_id'";//總座位數
	$this->_stmt=$this->prepare($sql);
	$this->_stmt->execute();
	$rs2=$this->_stmt->fetchAll();
	return array(
	($rs1[0][0]>0)?$rs1[0][0]:0,
	($rs2[0][0]>0)?$rs2[0][0]:0,
	($rs1[0][0]/$rs2[0][0]>0)?$rs1[0][0]/$rs2[0][0]:0
	);
}

//*****************************************翻桌率算法2*************************************
function getTurnoverRate2($starttime,$endtime){//算法1：來店總人數/總桌數
	if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
	@session_start();
	$restaurant_id=$_SESSION['restaurant_id'];
	$sql = "SELECT count(*) FROM `ordersheet` where `ordersheet_state` = '訂單結束' and `ordersheet_ordertime` between '$starttime' and '$endtime' and `restaurant_id`='$restaurant_id'";
	$this->_stmt=$this->prepare($sql);
	$this->_stmt->execute();
	$rs1=$this->_stmt->fetchAll();
	
	$sql = "SELECT count(*) FROM  `table` where `restaurant_id`='$restaurant_id'";//總桌數
	$this->_stmt=$this->prepare($sql);
	$this->_stmt->execute();
	$rs2=$this->_stmt->fetchAll();
	return array(
	($rs1[0][0]>0)?$rs1[0][0]:0,
	($rs2[0][0]>0)?$rs2[0][0]:0,
	($rs1[0][0]/$rs2[0][0]>0)?$rs1[0][0]/$rs2[0][0]:0
	);
}
//***************************泉翰 訂單查詢*****************************
	function displayordersheet($starttime,$endtime,$type,$user){
		$endtime=date("Y-m-d",(strtotime($endtime)+24*60*60));
		$ordersheet_state=($type)?$type:"%";
		
		if($user=="member"){
		@session_start();
		$member_id=$_SESSION['member_id'];
		
      	$sql="select * from `member` INNER JOIN`ordersheet` on `member`.`member_id` =  `ordersheet`.`member_id` AND `ordersheet`.`member_id` ='$member_id' AND `ordersheet`.`ordersheet_ordertime` BETWEEN '$starttime' AND '$endtime' and `ordersheet_state` like '$ordersheet_state';";
		}else {
			@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
			$sql="select * from `member` INNER JOIN`ordersheet` on `member`.`member_id` =  `ordersheet`.`member_id` AND `ordersheet`.`ordersheet_ordertime` BETWEEN '$starttime' AND '$endtime' and `ordersheet_state` like '$ordersheet_state' and `restaurant_id`='$restaurant_id';";
			}
		
		  		$this->_stmt=$this->prepare($sql);
				$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
		}//between displayordersheet
		
//***************************泉翰 訂單警訊 前三名餐點*****************************
	function displayordersheetTop3($starttime,$endtime){
		if($starttime==$endtime) $endtime=date("Y-m-d",strtotime($endtime)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="SELECT `product_id`,count(*) FROM `ordersheetdetail` inner join `ordersheet` on  `ordersheet`.`ordersheet_id`=`ordersheetdetail`.`ordersheet_id` and `ordersheet`.`ordersheet_state` like '已訂%' and `ordersheet`.`restaurant_id`='$restaurant_id' and `ordersheet`.`ordersheet_ordertime` between '$starttime' and '$endtime'  group by `ordersheetdetail`.`product_id` limit 0,3";
		
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return $this->_stmt->fetchAll();
}	
	
//********************************************************************
function ajax_Rtable_ordersheet_selectbetween($restaurant_id,$starttime,$endtime){

		$sql="select * from `ordersheet` where `restaurant_id`='$restaurant_id' and `ordersheet_state` like '已訂%' and `ordersheet_ordertime` between '$starttime' and '$endtime' order by `ordersheet_state` ASC;";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
}

	function displayordersheetdetail($ordersheet_id){
		
	$sql="select count(*)as Q,`product_name`,`product_sellingprice`*count(*) as price,`ordersheetdetail_completestate` from `product` INNER JOIN`ordersheetdetail` on `product`.`product_id` =  `ordersheetdetail`.`product_id` AND `ordersheetdetail`.`ordersheet_id` ='".$ordersheet_id."' group by `ordersheetdetail`.`product_id`";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();	
	}
	
	function loadcurrenttableordersheet(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
	
		$sql="select `member_id`,`ordersheet`.`table_id`,`ordersheet_id`,`ordersheet_peoplequantity` from `ordersheet` INNER JOIN`table` on `ordersheet`.`table_id` =  `table`.`table_id` AND `ordersheet`.`restaurant_id` ='".$restaurant_id."' AND `ordersheet`.`ordersheet_ordertime` like '".date("Y-m-d")."%' AND (`ordersheet`.`ordersheet_state` ='已入座' OR `ordersheet`.`ordersheet_state` ='出餐完畢');";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();			
	}
	
	function loadtotaltableid(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
	
		$sql="select * from `ordersheet` where `restaurant_id`='".$restaurant_id."' AND `ordersheet_ordertime` like '".date("Y-m-d")."%' AND (`ordersheet`.`ordersheet_state` ='已入座' OR `ordersheet`.`ordersheet_state` ='出餐完畢');";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();			
	}
	function member_service_displaycallservice(){
		@session_start();
		$member_id=$_SESSION['member_id'];
		
		$sql="select * from `ordersheet` where `member_id` = '$member_id' AND `ordersheet_ordertime` like '".date("Y-m-d")."%' AND (`ordersheet`.`ordersheet_state` ='已入座' OR `ordersheet`.`ordersheet_state` ='出餐完畢');";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();	
		}
	
	function deletequestionnaire_option($id=false){
		if($id==false && !($id=$this->id)){//判斷id是否存在
			return false;
		}else {
	    $sql="delete from `questionnaire_option` where `questionnaire_id` = :id;";
		$this->_stmt=$this->prepare($sql);
		$this->_bind(array(":id"=>$id));//檢查id欄位型態
		$this->_stmt->execute();
		}//end else
	}//end deletequestionnaire_option   刪除
	
	function allowentermember_historyordersheet($ordersheet_id){
		@session_start();
		$member_id=$_SESSION['member_id'];
		$ordersheet_ordertime=date("Y-m-d");
		$sql="select `table_id`,`restaurant_id` from `ordersheet` where member_id='$member_id' and ordersheet_ordertime like '$ordersheet_ordertime%' and ".
			 "(ordersheet_state = '已入座' OR ordersheet_state ='出餐完畢' ) and ordersheet_id ='$ordersheet_id';";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();

	}
	
	function member_questionnaire_saveupdate($questionnaire_answer_answerARRAY,$ordersheet_id){
		
		$sql="UPDATE `questionnaire_answer` SET `questionnaire_answer_answerARRAY`='$questionnaire_answer_answerARRAY' where `ordersheet_id` = '$ordersheet_id';";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
	}
	
	function customerseatdown_ordersheetdetail_update($ordersheet_id){
		
		$sql="UPDATE `ordersheetdetail` SET `ordersheetdetail_completestate`='已入座' where `ordersheet_id` = '$ordersheet_id';";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
	}
	
	function display_restaurant_member_searchservice(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		$ordersheet_ordertime=date("Y-m-d");
		$sql="select `table_id`,`restaurant_id` from `ordersheet` where member_id='$member_id' and ordersheet_ordertime like '$ordersheet_ordertime%' and ".
			 "(ordersheet_state = '已入座' OR ordersheet_state ='出餐完畢' ) and ordersheet_id ='$ordersheet_id';";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
}
	
	function questionnaire_member_answer_analysis_select_ordersheet($date1,$date2){
		$date2=date("Y-m-d",strtotime($date2)+60*60*24);
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];

		$sql="select `ordersheet_id` from `ordersheet` where `ordersheet_questionnairestate` ='已填寫' and `ordersheet_ordertime` between '$date1' and '$date2' and `restaurant_id` ='$restaurant_id';";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
	}
	
	function select_displayRtableservice_ordersheet_state($member_id){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];

		$sql="select ordersheet_id from `ordersheet` where `member_id` ='$member_id' and (ordersheet_state = '已入座' OR ordersheet_state ='出餐完畢') and `restaurant_id` ='$restaurant_id';";
		$this->_stmt=$this->prepare($sql);
		$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
	}
	
	function restaurant_selectTable_displayordersheet(){
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		$result=array();
		
		$where=array(":restaurant_id"=>$restaurant_id,
		":ordersheet_ordertime"=>date("Y-m-d")."%",":ordersheet_state"=>"已入座");
		$rs1=$this->select("ordersheet",$where);				
		$i=0;
		foreach($rs1 as $key1){	
					
		$where2=array(":ordersheet_id"=>$key1['ordersheet_id']);
		$rs2=$this->select("ordersheetdetail",$where2);	
		if(count($rs2)==0){
			$result[$i++]=array("ordersheet_id"=>$key1['ordersheet_id'],"member_id"=>$key1['member_id'],"ordersheet_peoplequantity"=>$key1['ordersheet_peoplequantity']);
		}

		return $result;
		}
	}

	function displayordersheetProduct($starttime,$endtime,$type){
		$endtime=date("Y-m-d",(strtotime($endtime)+24*60*60));
		$ordersheet_state=(!empty($type))?$type:"%";
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="select `product`.`product_id`,`product_name`,count(*) from `product` INNER JOIN `ordersheetdetail` on `product`.`product_id` = `ordersheetdetail`.`product_id` AND `ordersheetdetail`.`ordersheet_id` in (select `ordersheet_id` from `ordersheet` where `ordersheet_ordertime` BETWEEN '$starttime' AND '$endtime' and `ordersheet_state` like '{$ordersheet_state}%' and `ordersheet_ordertype` like '網路%' and `restaurant_id`='$restaurant_id') group by `product`.`product_id` order by count(*) desc;";

		  		$this->_stmt=$this->prepare($sql);
				$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
	}
	
	function displayordersheetProduct_detail($pid,$starttime,$endtime,$type){
		$endtime=date("Y-m-d",(strtotime($endtime)+24*60*60));
		$ordersheet_state=(!empty($type))?$type:"%";
		@session_start();
		$restaurant_id=$_SESSION['restaurant_id'];
		
		$sql="select `ordersheet_ordertime`,`ordertimeperiod_kind`,`ordertimeperiod_time`,`ordersheetdetail_remark` from `ordertimeperiod` INNER JOIN `ordersheetdetail` inner join `ordersheet` on `ordersheet_ordertime` BETWEEN '$starttime' AND '$endtime' and `product_id` like '$pid' and `ordersheetdetail`.`ordersheet_id`=`ordersheet`.`ordersheet_id` and `ordertimeperiod`.`ordertimeperiod_id`=`ordersheet`.`ordertimeperiod_id` and `ordersheet`.`ordersheet_state` like '{$ordersheet_state}%' and `ordersheet_ordertype` like '網路%'  and `ordersheet`.`restaurant_id`='$restaurant_id' group by `ordersheetdetail`.`ordersheetdetail_id`;";

		  		$this->_stmt=$this->prepare($sql);
				$this->_stmt->execute();
		return	$this->_stmt->fetchAll();
	}
	//*********************************************************************
	function sidebar($where=array()){
		$wherevalues=array();
		$bind_data=array();
		foreach($where as $key =>$value){
			$wherevalues[]= "`".substr($key,1,strlen($key)-1)."` like $key";
		}
        $sql="select * from `sidebar` where ".implode(' and ',$wherevalues).";";
		   return	$this->bindQuery($sql,$where);

	}//end select 查詢
	
	function displaysidebar($type){
		$rs=$this->sidebar(array(":type"=>$type));
		$string="";
		foreach($rs as $key){
		$string.="<li><a href=".$key['link'].">".$key['linkname']."</a></li>\n\t";
		}
		return $string;
	}
		
		
}//end class
	

?>