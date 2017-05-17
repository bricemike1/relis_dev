<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Relis_mdl extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
		
	
		
		function get_user_assigned_papers($user_id=0,$screen_type="simple_screen"){
				
			if($user_id==0)
			{
				$condition="";
			}else{
				$condition=" AND user_id = $user_id";
			}
			$this->db3 = $this->load->database(project_db(), TRUE);
			if($screen_type=='screen_validation'){
				$sql= "select  * from assignment_screen_validate where 	assignment_active=1   $condition  ";
			}else{
				$sql= "select  * from assignment_screen where 	assignment_active=1   $condition  ";
			}
			
			
			$res=$this->db3->query($sql)->result_array();
			return $res;
		
		}
	
		
	
}