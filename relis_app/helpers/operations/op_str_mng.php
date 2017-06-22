<?php
function get_operations_str_mng() {
	

	$operations['list_str_mng']=array(
			'type'=>'List',
			'tab_ref'=>'str_mng',
			'operation_id'=>'list_str_mng'
	);
	
	$operations['add_str_mng']=array(
			'type'=>'Add',
			'tab_ref'=>'author',
			'operation_id'=>'add_str_mng'
	);
	
	
	$operations['detail_str_mng']=array(
			'type'=>'Detail',
			'tab_ref'=>'str_mng',
			'operation_id'=>'detail_str_mng'
	);
	
	return $operations;
}
