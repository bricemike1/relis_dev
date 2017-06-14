<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Relis_mdl extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
		
	
		
		function get_user_assigned_papers($user_id=0,$screen_type="simple_screen",$screening_phase=0){
			
			$screen_table=get_table_configuration('screening','current','table_name');
			$active_field=get_table_configuration('screening','current','table_active_field');
			//print_test($screen_table);
			$condition="";
			if(!empty($user_id))
			{
				$condition=" AND user_id = $user_id  ";
			}
			
			if(!empty($screening_phase))
			{
				$condition=" AND screening_phase = $screening_phase  ";
			}
			
			
			$this->db3 = $this->load->database(project_db(), TRUE);
			if($screen_type=='screen_validation'){
				$sql= "select  * from assignment_screen_validate where 	assignment_active=1   $condition  ";
			}else{
				$sql= "select  * from $screen_table where 	$active_field=1   $condition  ";
			}
			
			
			$res=$this->db3->query($sql)->result_array();
			return $res;
		
		}
	
		
	
}