<?php
function test($params) {
	//参照テスト
	$rows = $GLOBALS['db']->get('bbs', array(
			'order' => 'id DESC',
			//'where' => 'id > 3',
			//'limit' => '2, 2'
	));

	//更新テスト
	$rows[0]['article'] .= 'updated';
	$GLOBALS['db']->update('bbs', $rows);

	//登録テスト
	$insert_rows = array(
		array(
			'article' => 'insertテスト1'
		),
		array(
			'article' => 'insertテスト2'
		),
	);
	$GLOBALS['db']->insert('bbs', $insert_rows);

	//削除テスト
	$GLOBALS['db']->delete('bbs', array(
			'order' => 'id DESC',
			'where' => 'id > 3',
			'limit' => '2'
	));
	
	//参照テスト
	$rows = $GLOBALS['db']->get('bbs', array(
			'order' => 'id DESC',
			//'where' => 'id > 3',
			//'limit' => '2, 2'
	));
	//print_r($rows);
	
	return $rows;
}
