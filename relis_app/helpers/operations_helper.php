<?php
function check_operation($operation,$type="List") {
	$operations=array();
	
	$operations['list_all_users']=array(
			'type'=>'List',
			'tab_ref'=>'users',
			'operation_id'=>'list_users'
	);
	$operations['list_usergroups']=array(
			'type'=>'List',
			'tab_ref'=>'usergroup',
			'operation_id'=>'list_usergroups'
	);
	
	$operations['detail_user']=array(
			'type'=>'Detail',
			'tab_ref'=>'users',
			'operation_id'=>'detail_user'
	);

	$operations['detail_user_min']=array(
			'type'=>'Detail',
			'tab_ref'=>'users',
			'operation_id'=>'detail_user_min'
	);
	
	$operations['remove_user']=array(
			'type'=>'Remove',
			'tab_ref'=>'users',
			'operation_id'=>'remove_user'
	);
	
	$operations['add_user']=array(
			'type'=>'Add',
			'tab_ref'=>'users',
			'operation_id'=>'add_user'
	);
	$operations['edit_user']=array(
			'type'=>'Edit',
			'tab_ref'=>'users',
			'operation_id'=>'edit_user'
	);
	
	
	

	
	include_once('operations/op_project.php');
	$operations=array_merge($operations,get_operations_project());
	
	include_once('operations/op_configuration.php');
	$operations=array_merge($operations,get_operations_configuration());
	
	include_once('operations/op_reference.php');
	$operations=array_merge($operations,get_operations_reference());
	
	
	include_once('operations/op_author.php');
	$operations=array_merge($operations,get_operations_author());
	
	include_once('operations/op_venue.php');
	$operations=array_merge($operations,get_operations_venue());
	

	include_once('operations/op_paper.php');
	$operations=array_merge($operations,get_operations_paper());
	
	include_once('operations/op_screening.php');
	$operations=array_merge($operations,get_operations_screening());
	
	if(isset($operations[$operation]) AND $operations[$operation]['type']==$type ){
			return $operations[$operation];
	}else{
			set_top_msg(lng_min(" Action not available!  ".$operation),'error');
			redirect('auth/');
			return false;
	}
	
	
}
