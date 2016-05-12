<?php
	function select($sql, $conn){
		$query = odbc_prepare($conn, $sql);
		odbc_execute($query);
		echo odbc_errormsg($conn);
		$result = array();
		while($area = odbc_fetch_array($query)){
			$result[] = $area;	
		}
		return $result;
	}
	
	