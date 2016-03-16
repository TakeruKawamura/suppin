<?php
class DB {
	public  $connection = NULL;
	private $host   = 'localhost';
	private $user   = 'rookies';
	private $pass   = 'techrookies';
	private $dbname = 'techrookies003';
	
	public function __construct() {
		$mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
		mysqli_set_charset( $mysqli, 'utf8' );
		$this->connection = $mysqli;
	}	
	
	/**
	 * データの取得
	 * @param string $table            テーブル名
	 * @param array  $condition_params 抽出条件
	 */
	public function get($table, $condition_params = NULL) {
		$conditions = array(
			'where' => NULL,
			'order' => NULL,
			'limit' => NULL,
		);
		
		if ($condition_params) {
			foreach ($condition_params as $condition => $condition_value) {
				if ($condition == 'where') {
					$conditions[$condition] = ' WHERE ' . $condition_value;
				}
				elseif ($condition == 'order') {
					$conditions[$condition] = ' ORDER BY ' . $condition_value;
				}
				elseif ($condition == 'limit') {
					$conditions[$condition] = ' LIMIT ' . $condition_value;
				}
			}
		}
		
		$query  = 'SELECT * FROM ' . $table . $conditions['where'] . $conditions['order'] . $conditions['limit'];
		$this->show_query($query);
		
		$result = $this->connection->query($query);
		$rows = NULL;
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
	
	/**
	 * データの更新
	 * @param string $table       テーブル名
	 * @param array  $update_rows 更新データ配列
	 */
	public function update($table, $update_rows) {
		if ($update_rows) {
			foreach ($update_rows as $row) {
				$where       = NULL;
				$update_data = NULL;
				foreach ($row as $column => $column_value) {
					if ($column == 'id') {
						$where = ' WHERE id = ' . $column_value;
					}
					else {
						if ($update_data) $update_data .= ',';
						$update_data .= $column . '= "' . $column_value . '"';
					}
				}
				
				$query  = 'UPDATE ' . $table . ' SET ' . $update_data . $where;
				$this->show_query($query);
				
				return $this->connection->query($query);
			}
		}
		
		return TRUE;
	}
	
	/**
	 * データの登録
	 * @param string $table       テーブル名
	 * @param array  $insert_rows 登録データ配列
	 */
	public function insert($table, $insert_rows) {
		if ($insert_rows) {
			$column_data = NULL;
			$insert_data = NULL;
			foreach ($insert_rows as $row) {
				$column_data_tmp = NULL;
				$insert_data_tmp = NULL;
				if ($insert_data)     $insert_data     .= ',';
				if ($insert_data_tmp) $insert_data_tmp .= ',';
				foreach ($row as $column => $column_value) {
					if ($column_data_tmp) $column_data_tmp .= ',';
					if ($insert_data_tmp) $insert_data_tmp .= ',';
					$column_data_tmp .= $column;
					$insert_data_tmp .= '"' . $column_value . '"';
				}
				$column_data     = $column_data_tmp;
				$insert_data_tmp = '(' . $insert_data_tmp . ')';
				$insert_data    .= $insert_data_tmp;
			}
			$column_data = '(' . $column_data . ')';
			$query  = 'INSERT INTO ' . $table . ' ' . $column_data . ' VALUES ' . $insert_data;
			$this->show_query($query);
				
			return $this->connection->query($query);
		}
		
		return TRUE;
	}
	
	/**
	 * データの削除
	 * @param string $table            テーブル名
	 * @param array  $condition_params 削除条件
	 */
	public function delete($table, $condition_params = NULL) {
		$conditions = array(
				'where' => NULL,
				'order' => NULL,
				'limit' => NULL,
		);
		
		if ($condition_params) {
			foreach ($condition_params as $condition => $condition_value) {
				if ($condition == 'where') {
					$conditions[$condition] = ' WHERE ' . $condition_value;
				}
				elseif ($condition == 'order') {
					$conditions[$condition] = ' ORDER BY ' . $condition_value;
				}
				elseif ($condition == 'limit') {
					$conditions[$condition] = ' LIMIT ' . $condition_value;
				}
			}
		}
		
		$query  = 'DELETE FROM ' . $table . $conditions['where'] . $conditions['order'] . $conditions['limit'];
		$this->show_query($query);

		return $this->connection->query($query);
	}
	
	/**
	 * SQLのそのまま実行
	 * @param string $query 実行SQL
	 */
	public function query($query) {
		return $this->connection->query($query);
	}
	
	private function show_query($query) {
		if ($GLOBALS['is_debug']) {
			print "#######\n";
			print "#query#\n";
			print "#######\n";
			print $query;
			print "\n\n";
		}		
	}
	
}
