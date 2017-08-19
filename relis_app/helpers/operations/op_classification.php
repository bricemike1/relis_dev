<?php
function get_operations_classification() {
	
	//Assignments
	
	$operations['list_assignments']=array(
			'type'=>'List',
			'tab_ref'=>'assignation',
			'operation_id'=>'list_assignments'
	);
	
	$operations['list_class_assignment']=array(
			'type'=>'List',
			'tab_ref'=>'assignation',
			'operation_id'=>'list_class_assignment'
	);
	
	$operations['list_class_assignment_val']=array(
			'type'=>'List',
			'tab_ref'=>'assignation',
			'operation_id'=>'list_class_assignment_val'
	);
	
	$operations['list_class_validation']=array(
			'type'=>'List',
			'tab_ref'=>'assignation',
			'operation_id'=>'list_class_validation'
	);
	
	$operations['add_class_assignment']=array(
			'type'=>'Add',
			'tab_ref'=>'assignation',
			'operation_id'=>'add_class_assignment'
	);
	$operations['edit_assignment_class']=array(
			'type'=>'Edit',
			'tab_ref'=>'assignation',
			'operation_id'=>'edit_assignment_class'
	);
	$operations['class_not_valid']=array(
			'type'=>'Edit',
			'tab_ref'=>'assignation',
			'operation_id'=>'class_not_valid'
	);
	
	$operations['detail_class_assignment']=array(
			'type'=>'Detail',
			'tab_ref'=>'assignation',
			'operation_id'=>'detail_class_assignment'
	);
	
	
	$operations['new_assignment_class']=array(
			'type'=>'AddChild',
			'tab_ref'=>'assignation',
			'operation_id'=>'new_assignment_class'
	);
	
	$operations['remove_class_assignment']=array(
			'type'=>'Remove',
			'tab_ref'=>'assignation',
			'operation_id'=>'remove_class_assignment'
	);
	
	return $operations;
	
	
	
}
