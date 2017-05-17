<?php
function icon($icon,$action='display') {
	if($action=='diplay')
		echo '<i class="fa fa-'.$icon.'"></i>';
		else 
		return '<i class="fa fa-'.$icon.'"></i>';
}