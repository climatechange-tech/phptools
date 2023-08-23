<?php

function generic_mysql_command($connection, $mysql_syntax) {
	$mysql_comm = mysqli_query($connection, $mysql_syntax);
	// $connection->query($mysql_syntax);	
	return $mysql_comm;
}

function create_table($connection, $new_table, $nameAndDTypeClause) {
	$createTableSyn = "CREATE TABLE $new_table ($nameAndDTypeClause);";
	
	/*
	  For case-sensitive columns, after specifying the column name and data type,
	  use 'COLLATE utf8mb4_bin'.
	*/

	$createTableComm = generic_mysql_command($connection, $createTableSyn);
	return $createTableComm;
}

function drop_table($connection, $table, $exists_ok=True) {

	if ($exists_ok) {
		$dropTableSyn = "DROP TABLE IF EXISTS $table";		
	}
	else {
		$dropTableSyn = "DROP TABLE $table";
	}

	generic_mysql_command($connection, $dropTableSyn);
}

function show_tables($connection, $pattern=NULL, $rename_result_column=NULL) {
	if (!$pattern) {
		$showTableSyn = "SHOW TABLES";
	}
	
	else {
		$showTableSyn = "SHOW TABLES LIKE $pattern";
	}
}
	
function delete_all_table_entries($connection, $table) {
	$deleteAllEntriesComm = "TRUNCATE TABLE $table";
	return $deleteAllEntriesComm;
}

function count_table_rows($mysql_query_table) {
	$nrows = mysqli_num_rows($mysql_query_table);
	return $nrows;
}

function select_from_table($connection,
						   $fetcheable,
						   $table,
						   $where_clause=NULL,
						   $groupby_clause=NULL,
						   $return_syntax_str_only=False) {
	
	if ($where_clause && $groupby_clause) {
		$selFromTableSyn = "SELECT $fetcheable FROM $table WHERE $where_clause GROUP BY $groupby_clause";		
	}
	
	else if ($where_clause && !$groupby_clause) {
		$selFromTableSyn = "SELECT $fetcheable FROM $table WHERE $where_clause";		
	}
	
	else if (!$where_clause && $groupby_clause) {
		$selFromTableSyn = "SELECT $fetcheable FROM $table GROUP BY $groupby_clause";		
	}
	
	else {
		$selFromTableSyn = "SELECT $fetcheable FROM $table";		
	}
	
	if ($return_syntax_str_only) {
		return $selFromTableSyn;
	}
	else {
		$filteredData = generic_mysql_command($connection, $selFromTableSyn);
		return $filteredData;
	}
}

function fetch_field_from_table($selectedData, $single_field_name) {
	while ($row = mysqli_fetch_array($selectedData)) {
		$field = $row[$single_field_name];
		$table_field_array[] = $field;
	}
	
	$array_length = count($table_field_array);
	
	if ($array_length == 1) {
		return $table_field_array[0];
	}
	else {
		return $table_field_array;
	}
} 

function update_table_fields($connection,
							 $table,
							 $setClause,
							 $where_clause=NULL) {

	if ($where_clause) {
		$updateTableSyn = "UPDATE $table SET $setClause WHERE $where_clause";
	}
	
	else {
		$updateTableSyn = "UPDATE $table SET $setClause";
	}
	
	$updateTableComm = generic_mysql_command($connection, $updateTableSyn);
	return $updateTableComm;
}

function insert_values_into_table($connection, $table, $allValueStr) {

	$insertValueSyn = "INSERT INTO $table VALUES($allValueStr)";
	$insertValueComm = generic_mysql_command($connection, $insertValueSyn);
	return $insertValueComm;

}		

function delete_values_from_table($connection,
								  $table,
								  $where_clause=NULL) {
								 
	if ($where_clause) {								 		 
		$delRowSyn = "DELETE FROM $table WHERE $where_clause";
	}
	else {
		$delRowSyn = "DELETE FROM $table";
	}
	
	$delRowComm = generic_mysql_command($connection, $delRowSyn);
	return $delRowComm;
}
								  

function add_column_to_table($connection,
							 $table,
							 $newColName,
							 $dtypeNewCol,
							 $first_position=False,
							 $after_what_column=NULL) {
							 
							 
	if ($first_position && !$after_what_column){
		$addColSyn = "ALTER TABLE $table ADD $newColName $dtypeNewCol FIRST";
	}
	
	else if (!$first_position && $after_what_column) {
		$addColSyn = "ALTER TABLE $table ADD $newColName $dtypeNewCol AFTER $after_what_column";
	}
							 
	else {
		die("<p style='color:red'>You must choose between to include
								  on the first position or after a column.</p>");
	}
	
	$addColComm = generic_mysql_command($connection, $addColSyn);
	return $addColComm;
	
}

function remove_column_from_table($connection,
								  $table,
								  $colName2Del) {
								  
	$delColSyn = "ALTER TABLE $table DROP COLUMN $colName2Del";			  
	$delColComm = generic_mysql_command($connection, $delColSyn);
	return $delColComm;
	
}

function rename_column_on_table($connection,
								$table,
								$colName2Rename,
								$renamedColName) {
								  
	$renameColSyn = "ALTER TABLE $table RENAME COLUMN $colName2Rename TO $renamedColName";	  
	$renameColComm = generic_mysql_command($connection, $renameColSyn);
	return $renameColComm;
	
}

function change_column_data_type($connection,
								 $table,
								 $col2ChDtype,
								 $colNewDtype) {
								  
	$colNewDtypeChSyn = "ALTER TABLE $table MODIFY $col2ChDtype $colNewDtype";
	$colNewDtypeChComm = generic_mysql_command($connection, $colNewDtypeChSyn);
	return $colNewDtypeChComm;
	
}

function copy_table_by_fields($connection,
							  $source_table,
							  $fetcheable,
							  $new_table,
							  $where_clause=NULL,
							  $groupby_clause=NULL) {
	
	$selFromTableSyn = select_from_table($connection,
									     $fetcheable,
									     $source_table,
									     $where_clause=NULL,
									     $groupby_clause=NULL,
									     $return_syntax_str_only=True);
									     
	$copyTableSyn = "CREATE TABLE $new_table AS $selFromTableSyn";
	$copyTableComm = generic_mysql_command($connection, $copyTableSyn);
	return $copyTableComm;

}

?>
