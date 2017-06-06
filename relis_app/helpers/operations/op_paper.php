<?php
function get_operations_paper() {
	//paper

	$operations['list_papers']=array(
			'type'=>'List',
			'tab_ref'=>'papers',
			'operation_id'=>'list_papers'
	);
	
	$operations['add_paper']=array(
			'type'=>'Add',
			'tab_ref'=>'papers',
			'operation_id'=>'add_paper'
	);
	
	$operations['edit_paper']=array(
			'type'=>'Edit',
			'tab_ref'=>'papers',
			'operation_id'=>'edit_paper'
	);
	
	$operations['detail_paper']=array(
			'type'=>'Detail',
			'tab_ref'=>'papers',
			'operation_id'=>'detail_paper'
	);
	
	$operations['remove_paper']=array(
			'type'=>'Remove',
			'tab_ref'=>'papers',
			'operation_id'=>'remove_paper'
	);
	
	
	return $operations;
	
	
	
}
