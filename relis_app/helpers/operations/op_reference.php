<?php
function get_operations_reference() {
	//exclusion criteria

	$operations['list_exclusioncrieria']=array(
			'type'=>'List',
			'tab_ref'=>'exclusioncrieria',
			'operation_id'=>'list_exclusioncrieria'
	);
	
	$operations['add_exclusioncrieria']=array(
			'type'=>'Add',
			'tab_ref'=>'exclusioncrieria',
			'operation_id'=>'add_exclusioncrieria'
	);
	
	$operations['edit_exclusioncrieria']=array(
			'type'=>'Edit',
			'tab_ref'=>'exclusioncrieria',
			'operation_id'=>'edit_exclusioncrieria'
	);
	
	$operations['detail_exclusioncrieria']=array(
			'type'=>'Detail',
			'tab_ref'=>'exclusioncrieria',
			'operation_id'=>'detail_exclusioncrieria'
	);
	
	$operations['remove_exclusioncrieria']=array(
			'type'=>'Remove',
			'tab_ref'=>'exclusioncrieria',
			'operation_id'=>'remove_exclusioncrieria'
	);
	
	//papers_sources

	$operations['list_papers_sources']=array(
			'type'=>'List',
			'tab_ref'=>'papers_sources',
			'operation_id'=>'list_papers_sources'
	);
	
	$operations['add_papers_sources']=array(
			'type'=>'Add',
			'tab_ref'=>'papers_sources',
			'operation_id'=>'add_papers_sources'
	);
	
	$operations['edit_papers_sources']=array(
			'type'=>'Edit',
			'tab_ref'=>'papers_sources',
			'operation_id'=>'edit_papers_sources'
	);
	
	$operations['detail_papers_sources']=array(
			'type'=>'Detail',
			'tab_ref'=>'papers_sources',
			'operation_id'=>'detail_papers_sources'
	);
	
	$operations['remove_papers_sources']=array(
			'type'=>'Remove',
			'tab_ref'=>'papers_sources',
			'operation_id'=>'remove_papers_sources'
	);
	
	//search_strategy

	$operations['list_search_strategy']=array(
			'type'=>'List',
			'tab_ref'=>'search_strategy',
			'operation_id'=>'list_search_strategy'
	);
	
	$operations['add_search_strategy']=array(
			'type'=>'Add',
			'tab_ref'=>'search_strategy',
			'operation_id'=>'add_search_strategy'
	);
	
	$operations['edit_search_strategy']=array(
			'type'=>'Edit',
			'tab_ref'=>'search_strategy',
			'operation_id'=>'edit_search_strategy'
	);
	
	$operations['detail_search_strategy']=array(
			'type'=>'Detail',
			'tab_ref'=>'search_strategy',
			'operation_id'=>'detail_search_strategy'
	);
	
	$operations['remove_search_strategy']=array(
			'type'=>'Remove',
			'tab_ref'=>'search_strategy',
			'operation_id'=>'remove_search_strategy'
	);
	
	
	return $operations;
	
	
	
}
