<?php
function migrate($params) {
	$mode = NULL;
	if (isset($params[1])) $mode = $params[1];
	if ( ! isset($params[2])) die('params[2] missing');
	
	switch ($mode) {
		//テーブルの作成
		case 'create_table' :
			$migration_file_name = $params[2] . '.php';
			require_once(dirname(__FILE__) . '/../resources/migration/' . $migration_file_name);
			print $query . "\n\n";
			$GLOBALS['db']->query($query);
			break;
		//テーブルの削除
		case 'drop_table' :
			$table_name = $params[2];
			$query = 'drop table ' . $table_name;
			print $query . "\n\n";
			$GLOBALS['db']->query($query);
			break;
		//データ初期化
		case 'truncate_table' :
			$table_name = $params[2];
			$query = 'truncate table ' . $table_name;
			print $query . "\n\n";
			$GLOBALS['db']->query($query);
			break;
		//CSV取り込み
		case 'load_data_infile' :
			$table_name = $params[2];
			$csv_path = (dirname(__FILE__) . '/../resources/csv/' . $table_name . '.csv');
			$query = 'LOAD DATA LOCAL INFILE "' . $csv_path . '" INTO TABLE ' . $table_name . ' FIELDS TERMINATED BY \',\'';
			print $query . "\n\n";
			$GLOBALS['db']->query($query);
			break;
	}
	
	return TRUE;
}
