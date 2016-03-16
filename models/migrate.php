<?php
function migrate($params) {
	$mode = NULL;
	if (isset($params[1])) $mode = $params[1];
	
	switch ($mode) {
		//テーブルの作成
		case 'create_table' :
			$migration_file_name = $params[2];
			break;
		//テーブルの削除
		case 'drop_table' :
				
			break;
		//データ初期化
		case 'truncate' :

			break;
		//CSV取り込み
		case 'load_data_infile' :
			$csv_filename = $params[2];
			break;
	}
	
}
