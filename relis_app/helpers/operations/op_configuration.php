<?php
function get_operations_configuration() {
	//Projects

	
	$operations['edit_configuration']=array(
			'type'=>'Edit',
			'tab_ref'=>'config',
			'operation_id'=>'edit_configuration'
	);
	
	$operations['configurations']=array(
			'type'=>'Detail',
			'tab_ref'=>'config',
			'operation_id'=>'configurations'
	);
	$operations['edit_conf_papers']=array(
			'type'=>'Edit',
			'tab_ref'=>'config',
			'operation_id'=>'edit_conf_papers'
	);
	
	$operations['config_papers']=array(
			'type'=>'Detail',
			'tab_ref'=>'config',
			'operation_id'=>'config_papers'
	);
	
	return $operations;
	
	
	
}
