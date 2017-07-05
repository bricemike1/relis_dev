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
			
			$screening_decision_table='';
			$screening_decision_active_field='';
			
			//print_test($screen_table);
			$condition="";
			if(!empty($user_id))
			{
				$condition=" AND S.user_id = $user_id  ";
			}
			
			if(!empty($screening_phase))
			{
				$condition.=" AND S.screening_phase = $screening_phase  ";
			}
			
			
			$this->db3 = $this->load->database(project_db(), TRUE);
			if(!empty($screen_type)){
				if($screen_type=='screen_validation'){
					$condition.=" AND S.assignment_role = 'Validation'  ";
				}else{
					$condition.=" AND S.assignment_role = 'Screening' ";
				}
			}
			$sql= "select  S.*,IFNULL(D.screening_decision,'Pending') as paper_status from $screen_table S
			LEFT JOIN  screen_decison D ON (S.paper_id=D.paper_id AND S.screening_phase=D.screening_phase AND D.decision_active=1 ) 
			where 	$active_field=1   $condition  ";
			//echo "$sql";
			
			$res=$this->db3->query($sql)->result_array();
			return $res;
		
		}
	
		
	
}