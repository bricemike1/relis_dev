<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	
		
	}
	
	/*
	 * page d'acceuil	 * 
	 */
	public function index()
	{
		//$this->session->set_userdata('working_perspective','class');
		if(!($this->session->userdata ( 'project_db' ))){
		
			redirect('manager/projects_list');
		}
		//print_test($this->session->userdata('working_perspective'));exit;
		if($this->session->userdata('working_perspective')=='screen'){
			redirect('home/screening');
		}
		
		$left_menu = $this->manager_lib->get_left_menu();
		
	
		
		$app_config=get_appconfig();
		if(!empty($app_config['run_setup']))
		{
			
			
			//redirect('install');
		}else{
		/*
		 * Recuperation du nombre de papiers par catégorie
		 */
		$data['all_papers']=$this->DBConnection_mdl->count_papers('all');		
		$data['processed_papers']=$this->DBConnection_mdl->count_papers('processed');
		$data['pending_papers']=$this->DBConnection_mdl->count_papers('pending');
		$data['assigned_me_papers']=$this->DBConnection_mdl->count_papers('assigned_me');
		$data['excluded_papers']=$this->DBConnection_mdl->count_papers('excluded');
		
		$data['configuration']=get_project_config($this->session->userdata ( 'project_db' ));
		/*
		 * Récuperation des participants dans l'application
		 */	
		$data['users']=$this->DBConnection_mdl->get_users_all();
		foreach ($data['users'] as $key => $value) {
			if(! (user_project($this->session->userdata('project_id'),$value['user_id'])) OR $value['user_usergroup'] == 1 ){
				unset($data['users'][$key]);
			}
		}
		
		/*
		 * Chargement de la vue qui va s'afficher
		 * 
		 */
		$data['page']='general/home';
		$this->load->view('body',$data);
		
		}
	}
	
	public function screening()
	{
		//update_paper_status_all();
		//$this->session->set_userdata('working_perspective','screen');
		
		
		
		if(!($this->session->userdata ( 'project_db' ))){
	
			redirect('manager/projects_list');
		}
		
		if($this->session->userdata('working_perspective')=='class'){
				redirect('home');
			}
			
		if(! active_screening_phase()){
				redirect('home/screening_select');
		}
			
		
		$data['screening_phase_info']=active_screening_phase_info();
		
		//print_test($screening_phase_info);
		
			/*
			 * Recuperation du nombre de papiers par catégorie
			 */
			
			$my_assignations=$this->Relis_mdl->get_user_assigned_papers(active_user_id(),'simple_screen',active_screening_phase());
			
			$total_papers=count($my_assignations);
			$papers_screened=0;
			foreach ($my_assignations as $key => $value) {
					
				if($value['screening_status']=='Done'){
					$papers_screened++;
				}else{
					/*if(empty($paper_to_screen)){
						$paper_to_screen=$value['paper_id'];
						//$assignment_id=$value['assignment_id'];
					}*/
				}
			}
			
			
			$data['all_papers']=$total_papers;
			$data['processed_papers']=$papers_screened;
			$data['pending_papers']=$total_papers - $papers_screened;
			$data['assigned_me_papers']=$total_papers;
			
			$data['configuration']=get_project_config($this->session->userdata ( 'project_db' ));
			/*
			 * Récuperation des participants dans l'application
			 */
			$data['users']=$this->DBConnection_mdl->get_users_all();
			foreach ($data['users'] as $key => $value) {
				if(! (user_project($this->session->userdata('project_id'),$value['user_id'])) OR $value['user_usergroup'] == 1 ){
					unset($data['users'][$key]);
				}
			}
	
			/*
			 * Chargement de la vue qui va s'afficher
			 *
			 */
			$data['page']='relis/h_screening';
			$this->load->view('body',$data);
	
		
	}
	
	public function screening_select()
	{
		
		
		$screening_phases = $this->db_current->order_by('screen_phase_order', 'ASC')
												->get_where('screen_phase', array('screen_phase_active'=>1))
												->result_array();
		
		$phases_list=array();
		$yes_no=array('0'=>'','1'=>'Yes');
		$i=1;
		foreach ($screening_phases as $k => $phase) {
		//	print_test($phase);
			$select_but="";
			$open_but="";
			$close_but="";
			
			
			
			
			if($phase['phase_state']=='Open'){
				$select_but=get_top_button ( 'all', 'Go to the phase', 'home/select_screen_phase/'.$phase['screen_phase_id'],'Go to','fa-send','',' btn-info ' ,False);
				$close_but=get_top_button ( 'all', 'Lock the phase', 'home/screening_phase_manage/'.$phase['screen_phase_id'].'/2','Lock','fa-lock','',' btn-danger ' ,False);
			}else{
				
				$open_but=get_top_button ( 'all', 'Unlock the phase', 'home/screening_phase_manage/'.$phase['screen_phase_id'],'Unlock','fa-unlock','',' btn-success ' ,False);					
			}	
			
			if(!can_manage_project()){
				$close_but="";
				$open_but="";
			}
			$temp=array(
					'num'=>$i,
					'Type'=>$phase['phase_type'],
					'Title'=>$phase['phase_title'],
					'State'=>$phase['phase_state'],
					'Final phase'=>$yes_no[$phase['screen_phase_final']],
					'action'=>$open_but.$close_but.$select_but,
			);
			array_push($phases_list, $temp);
			
			$i++;
		}
		
		if(!empty($phases_list)){
			array_unshift($phases_list, array('#','Category','Title','State','Final phase',''));
		}
		
	//	print_test($phases_list);
		$data['phases_list']=$phases_list;
		
			$data['configuration']=get_project_config($this->session->userdata ( 'project_db' ));
			/*
			 * Récuperation des participants dans l'application
			 */
			$data['users']=$this->DBConnection_mdl->get_users_all();
			foreach ($data['users'] as $key => $value) {
				if(! (user_project($this->session->userdata('project_id'),$value['user_id'])) OR $value['user_usergroup'] == 1 ){
					unset($data['users'][$key]);
				}
			}
	
			/*
			 * Chargement de la vue qui va s'afficher
			 *
			 */
			$this->session->set_userdata('current_screen_phase','');
			
			$data['page']='relis/h_screening_select';
			$this->load->view('body',$data);
	
		
	}
	
	public function select_screen_phase($screen_phase_id){
		
		if(!empty($screen_phase_id)){
			$this->session->set_userdata('current_screen_phase',$screen_phase_id);
			redirect('home/screening');
		}else{
		
			redirect('home/screening_select');
		}
	}
	
	public function screening_phase_manage($screen_phase_id,$op=1){
		if($op==1)//open the phase
		{
			$State='Open';
		}else{
			$State='Closed';
			}
			
			$res = $this->db_current->update ( 'screen_phase', array('phase_state'=>$State), array (
					'screen_phase_id' =>$screen_phase_id
			) );
			
			redirect('home/screening_select');
	}
	
	
	public function choose_project(){
		
		
		redirect('manager/projects_list');
		
	
		
	}
	
	
	public function set_project($projet_label,$project_id=0,$project_title=""){
		if(!empty($projet_label)){
			$this->session->set_userdata('project_db',$projet_label);
			$this->session->set_userdata('project_id',$project_id);
			$this->session->set_userdata('project_title',urldecode ( urldecode ($project_title)));
			
		}
		
		redirect('home/screening');
	}
	 
	/*
	 * Fonction appélé par le bouton de changement de langue
	 */
	public function change_lang(){
		
		if($this->session->userdata('active_language') AND $this->session->userdata('active_language')=='fr' ){
		
			$this->session->set_userdata('active_language','en');
		}else{
			$this->session->set_userdata('active_language','fr');
		}
		
	}
	
	//Fonction pour mettre à jours les  stored procedures après modification de la configuration 
	public function update_stored_procedure($config="all"){
		
		if($config=='all'){
		$configs=array('author','venue','users','usergroup','papers','classification','exclusion','assignation','paper_author','logs','str_mng','config','user_project');
		$reftables=$this->DBConnection_mdl->get_reference_tables_list();
		
		foreach ($reftables as $key => $value) {
			array_push($configs, $value['reftab_label']);
		}
		
		}else{
			$configs=array($config);
			
		}
		
		print_test($configs);
		
		foreach ($configs as $k => $config) {
			
				/*
				 * Stored procedure to get list of element
				 */
				$this->manage_stored_procedure_lib->create_stored_procedure_get($config);
				
				/*
				 * Stored procedure to count number of elements (used for navigation link)
				 */
				if($config=='papers')
				$this->manage_stored_procedure_lib->create_stored_procedure_count($config);
				
				/*
				 * Stored procedure to remove element
				 */
				$this->manage_stored_procedure_lib->create_stored_procedure_remove($config);
			
				/*
				 * Stored procedure to add element
				 */
				$this->manage_stored_procedure_lib->create_stored_procedure_add($config);
			
				
				/*
				 * Stored procedure to update element
				 */
				$this->manage_stored_procedure_lib->create_stored_procedure_update($config);
				
				/*
				 * Stored procedure to get detail element (select row)
				 */
				$this->manage_stored_procedure_lib->create_stored_procedure_detail($config);
			
		}
		
		///do not forget to add the stored procedure for papers : assigned, processed, and pending and update the 
		
	}
	
	
	
	public function create_table_config($config,$target_db='current'){
		
		$res=$this->manage_stored_procedure_lib->create_table_config(get_table_config($config),$target_db);
		
		echo $res;
	
	}
	
	/*
	 * Utilisé pour  test lorsque on veux mettre des valeurs de test dans la classification
	 */
	public function test_values(){
		
		
			
		$i=1;
		
		for($i=1;$i<=987;$i++){
		/*
		 * Préparation des valeurs qui sont générés de façon aléatoire
		 */	
		$fields=array(
			'class_paper_id'=>$i,	
			'class_name'=>"Classification $i",	
			'class_language'=>rand(1 , 6),	
			'class_sourceLang'=>rand(2,5 ),	
			'class_targetLang'=>rand(3 , 6),	
			'class_domain'=>rand(1 , 13),	
			'class_isHOT'=>rand(0 ,1 ),	
			'class_isBiderectional'=>rand(0 ,1),	
			'class_implementationAvailable'=>rand(0 ,1),	
			'class_isIndustrial'=>rand(0 ,1)	
				
		);
		
		print_test($fields);
		
		/*
		 * Insertion des données
		 */
		$headersaved = $this->db->insert ( 'classification', $fields );
	
		}
	
	}
	
	
	
	/*
	 * Affichage des résultat(statistique)  en cours de réaliation------
	 */
	public function result(){
		
		old_version();
		//save_metrics("bricetest metrics");
	
		/*
		 * Recupération du nombre de papiers par catégories
		 */
		$data['all_papers']=$this->DBConnection_mdl->count_papers('all');
		$data['processed_papers']=$this->DBConnection_mdl->count_papers('processed');
		$data['pending_papers']=$this->DBConnection_mdl->count_papers('pending');
		$data['assigned_me_papers']=$this->DBConnection_mdl->count_papers('assigned_me');
		$data['excluded_papers']=$this->DBConnection_mdl->count_papers('excluded');
		
		
		/*
		 * Stucture de la table des classification
		 */
		$table_config = $this->table_ref_lib->ref_table_config('classification');
		
		//print_test($table_config);
		
		$result_fin=array();
		
		foreach ($table_config['fields'] as $key_conf => $value_conf) {
		
			//if(!empty($value_conf['compute_result']) AND $value_conf['compute_result']=='yes' AND ($value_conf['input_type'] =='select') AND ($value_conf['input_select_source'] =='table') ){
			
				if(isset($value_conf['number_of_values']) AND ($value_conf['number_of_values']=='1' OR $value_conf['number_of_values']=='0') AND ($value_conf['input_type'] =='select') AND ($value_conf['input_select_source'] =='table' OR $value_conf['input_select_source'] =='array'  OR $value_conf['input_select_source'] =='yes_no' )  ){
					//print_test($value_conf);
					$ref_field=$key_conf;
					if($value_conf['input_select_source'] =='array'){
						$result= $this->manage_mdl->get_result_classification($key_conf);
						foreach ($result as $key => $value) {
							$result[$key]['field_desc'] =$value['field'] ;
						}
							
					}elseif($value_conf['input_select_source'] =='yes_no'){
						
						$result= $this->manage_mdl->get_result_classification($key_conf);
						
						$yes_no=array("False",'True');
						foreach ($result as $key => $value) {
							$result[$key]['field_desc'] =$yes_no[$value['field'] ];
						}
					
					}else{
					
					$conf=explode(";", $value_conf['input_select_values']);
					
					
					$ref_config=$conf[0];
					
					$ref_table=$this->DBConnection_mdl->get_reference_corresponding_table($ref_config);
					
					$ref_table_name=$ref_table['reftab_table'];
					
					$ref_table_desc=$ref_table['reftab_desc'];
					
						
					$result= $this->manage_mdl->get_result_classification($ref_field);
					
								
					foreach ($result as $key => $value) {
							
							$result[$key]['field_desc'] = $this->manage_mdl->get_reference_value($ref_table_name,$result[$key]['field']) ;
							
							
					}
						
					}
					
					$result_fin[$ref_config.$key_conf]['name']=$value_conf['field_title'];
					$result_fin[$ref_config.$key_conf]['field_name']=$ref_field;
					$result_fin[$ref_config.$key_conf]['rows']=$result;
					
					
					//print_test($result);
					}
		
			}
			
		//print_test($result_fin);
		
			
			/*
			 * La page contient des graphique cette valeur permettra le chargement de la librarie highcharts  
			 */
			$data['has_graph']='yes';
			
			
			$data['result_table']=$result_fin;
			$data['page']='result';
			$this->load->view('body',$data);
			//$this->load->view('welcome_message');
			
			
			
			
			
		}
		
		
		/*
		 * Page permettant de saisir une requette sql et avoir le résultat
		 */
		public function sql_query($query_type="single"){
			
			
			
			$data['query_type']=$query_type;
			
			/*
			 * La vue qui va s'afficher
			 */
			if($query_type!='multi'){
			$data ['top_buttons'] = get_top_button ( 'all', 'Switch to multi query!', 'home/sql_query/multi','Switch to multi query!',' fa-exchange','',' btn-info ' );
			$data['title']='Parse an SQL query';
			}else{
				$data ['top_buttons'] = get_top_button ( 'all', 'Switch to single query!', 'home/sql_query/','Switch to single query!',' fa-exchange','',' btn-info ' );
				$data['title']=lng_min('Parse multiple SQL queries');
			}	
			$data['page']='sql';
			$this->load->view('body',$data);
		}
	
		/*
		 * Page de traitement de requete sql saisie et affichade du résultat
		 */
		public function sql_query_response(){
			
			/*
			 * Récupération de la réquette saisier
			 */
			$post_arr = $this->input->post ();
			//print_test($post_arr); 
			
			$sql="";
			$sql=$post_arr['sql_field'];
			$query_type=$post_arr['query_type'];
			
			/*
			 * Verification si il faut afficher le résultat ou pas
			 */
			if(isset($post_arr['return_table'])){
				$return_table=1;
			}else{
				$return_table=0;
			}
			$data['query_type']=$query_type;
			if(!empty($sql)){
				$data['sql_field']=$sql;
				$data['return_table']=$return_table;
			
				/*
				 * Appel du model manage_mdl->run_query  pour executer la requette et recuperer le resultat
				 */
				if($query_type!='multi'){
				$res = $this->manage_mdl->run_query($sql,$return_table);
				}else{
					$delimiter=$post_arr['delimiter'];
					$T_queries=explode(!empty($delimiter)?$delimiter:';', $sql);
					//print_test($T_queries);
					$error=0;
					$all=0;
					$t_error_message=" ";
					foreach ($T_queries as $key => $v_sql) {
						$v_sql=trim($v_sql);
						if(!empty($v_sql)){
							$T_res = $this->manage_mdl->run_query($v_sql);
							if($T_res['code']!=0){
								$error++;
								$t_error_message .= " <br/> - ".$T_res['message'];
							}
							$all++;
						}
						
					}
					
					if($error==0){
						$res['code']=0;
						$res['message']=$all .' query executed!';
					}else{
						$res['code']=1;
						$res['message']=($all- $error) ." Succeded - $error Errors<br/>".$t_error_message;
					}
				}
			}else{
				$res['code']=1;
				$res['message']=lng_min('Query was empty');
				
			}
		//	print_test($res);
			
			
			if($res['code']==0){//L'execution de la requette a réussit
				
				/*	
				 * Péparation du résultat à afficher
				 */
				
				$data['message_success']="Success";
				$data['message_error']="";
				$array_header=array();
				if($return_table ){
					$data['display_list']="OK";
					if( ! empty($res['message']) AND is_array($res['message']) AND count($res['message'])>0){
				
					
					foreach ($res['message'][0] as $key => $value) {
						
						array_push($array_header, $key);
					}
					
					array_unshift($res['message'],$array_header);
					
					$data['list']=$res['message'];
					
					
				}
				}
				
			}else{ //L'execution de la requette a echoué
				
				/*
				 * Préparation du message d'erreur à afficher
				 */
				$data['message_error']="Error: ".$res['message'] ;
				$data['message_success']="";
				
			}
			if($query_type!='multi'){
				$data ['top_buttons'] = get_top_button ( 'all', 'Switch to multi query!', 'home/sql_query/multi','Switch to multi query!',' fa-exchange','',' btn-info ' );
				$data['title']=lng_min('Parse an SQL query');
			}else{
				$data ['top_buttons'] = get_top_button ( 'all', 'Switch to single query!', 'home/sql_query/','Switch to single query!',' fa-exchange','',' btn-info ' );
				$data['title']=lng_min('Parse multiple SQL queries');
			}
			
			
			
			$data['page']='sql';
			
			
			$this->load->view('body',$data);
		}
		
		
		public function export($type=1){
		
			$data['t_type']=$type;
			
			$data ['page_title'] = lng('Exports');
			$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'home' );
			$data['left_menu_perspective']='z_left_menu_screening';
			$data['project_perspective']='screening';
			$data ['page'] = 'export';
		
		
		
			/*
			 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
			 */
			$this->load->view ( 'body', $data );
		}
		
		
		//test fonction used to merge my csv file with the screening result
		private function screen_mine(){
			
			echo "brice";
			$all_file="cside/screen/all.csv";
			$accept_file="cside/screen/accepted.txt";
			$Taccepeted=array();
			$Tall=array();
			ini_set('auto_detect_line_endings',TRUE);
			
			$fp = fopen($all_file, 'rb');	
			$i=1;
			$last_count=0;
			while ( (($Tline = (fgetcsv($fp,0,";",'"')))) !== false) {
				$Tline = array_map( "utf8_encode", $Tline );
				//print_test($Tline);
				
				$Tall[$i]= $Tline;
				$i++;
				if($i==1000)
					exit;
			}
			//print_test($Tall);
			//exit;
			$fa = fopen($accept_file, 'rb');
			$i=1;
			$last_count=0;
			while ( (($Tline = (fgetcsv($fa,0,"$",'"')))) !== false) {
				$Tline = array_map( "utf8_encode", $Tline );
				//print_test($Tline);
			
				$Taccepeted[$i]= $Tline;
				$i++;
				if($i==1000)
					exit;
			}
			//echo count($Taccepeted);
			//print_test($Taccepeted);
			
			$final_added=array();
			//mapping
			$j=1;
			foreach ($Taccepeted as $key => $value) {
				$title=trim($value[0]);
				$result="not fund";
				foreach ($Tall as $key_all => $value_all) {
					if($title == trim($value_all[1]))
					{
						$result="found";
						$final_added[$j]=$value_all;
					}
				}
				
				echo " <h3>$j - $result</h3>";
				$j++;
			}
			
			print_test($final_added);
			
			$f_new = fopen("cside/screen/paper_to_classify.csv", 'w+');
			foreach ($final_added as $val) {
				fputcsv($f_new, $val,";");
			}
			
			
			fclose($f_new);
		}
		
		public function  metrics_view(){
			echo "<h1>list of files</h1>";
			
			$dir="C:/xampp/htdocs/relis/relis_multi_gen_01/cside/metrics_new";
			$dir="C:/xampp/htdocs/relis/relis_multi_gen_01/cside/metrics_new";
		
			if(is_dir($dir)){
				$files = array_diff(scandir($dir), array('.', '..',".metadata"));
				//$files = scandir($dir);
				//print_test($files);
				foreach ($files as $key => $value) {
					//directories per day
					$dir_f=$dir."/".$value;
					echo "<h2>$value</h2>";
					if(is_dir($dir_f)){
						$files_f = array_diff(scandir($dir_f), array('.', '..',".metadata"));
						foreach ($files_f as $key_f => $value_f) {
							
							
							if(strrpos($value_f, "dmin_") != '1' AND strrpos($value_f, "ser_unknown") != '1' ){
							$file=$dir."/".$value."/".$value_f;
							
							echo "<h2>".$file."</h2>";
							$this->metrics_file_content($file);
							}
						}
						//print_test($files_f);
					}else{
						echo"<p>nop inside</p>";
					}
					
					
				}
				
				
			}else{
				echo"nop";	
			}
		}
		
		public function metrics_file_content($file="C:/xampp/htdocs/relis/relis_multi_gen_01/cside/metrics_new/2016_Dec_10/pierre_13.txt"){
			//$file="C:/xampp/htdocs/relis/relis_multi_gen_01/cside/metrics_new/2016_Dec_11/younous_18.txt";
			
			ini_set('auto_detect_line_endings',TRUE);
				
			$fp = fopen($file, 'rb');
			$i=1;
			$last_count=0;
			$choosen_metrics=array();
			while  ( (($line = (fgets($fp)))) !== false) {
				
				$Tline=explode("__--~~", $line);
				
				$metrics=json_decode($Tline['2'],true);
				if(isset($metrics['server_info']['HTTP_USER_AGENT'])){
					
					//print_test($this->getBrowser($metrics['server_info']['HTTP_USER_AGENT']));
				}
				
				//print_test($metrics);
				$choosen_metrics['time']=isset($metrics['server_info']['REQUEST_TIME'])?$metrics['server_info']['REQUEST_TIME']:"";
				$client=isset($metrics['server_info']['HTTP_USER_AGENT'])? $this->getBrowser($metrics['server_info']['HTTP_USER_AGENT']) :"";
				$choosen_metrics['browser']=isset($client['name']) ? $client['name'] : "";
				$choosen_metrics['system']=isset($client['platform']) ? $client['platform'] : "";
				$choosen_metrics['page_url_source']=isset($metrics['server_info']['HTTP_REFERER'])?$metrics['server_info']['HTTP_REFERER']:"";
				$choosen_metrics['page_url']=isset($metrics['server_info']['REDIRECT_URL'])?$metrics['server_info']['REDIRECT_URL']:"";
				$choosen_metrics['status']=isset($metrics['server_info']['REDIRECT_STATUS'])?$metrics['server_info']['REDIRECT_STATUS']:"";
				$choosen_metrics['method']=isset($metrics['server_info']['REQUEST_METHOD'])?$metrics['server_info']['REQUEST_METHOD']:"";
				$choosen_metrics['user']=isset($metrics['session']['user_id'])?$metrics['session']['user_id']:"";
				$choosen_metrics['project']=isset($metrics['session']['project_db'])?$metrics['session']['project_db']:"admin";
				$choosen_metrics['screen_height']=isset($metrics['session']['screen_height'])?$metrics['session']['screen_height']:"";
				$choosen_metrics['screen_width']=isset($metrics['session']['screen_width'])?$metrics['session']['screen_width']:"";
			//	$choosen_metrics['profiler']=$metrics['profiler'];
				$choosen_metrics['metric_id']="";
				
				
				/*
				$pos_start=strrpos($metrics['profiler'],$start);
				$pos_end=strrpos($metrics['profiler'],$end);
				
				$got =substr($metrics['profiler'],$pos_start + strlen($start), $pos_end - $pos_start - strlen($start));
				echo "<h1>sss $got </h1>";
				*/
				if(!strstr($choosen_metrics['page_url'],'add_screen_size')){
					
					$start="COMPILE_CONTROLLER<div>";
					$end="</div></fieldset></div>";
					
					$pos_start=strrpos($metrics['profiler'],$start);
					$pos_end=strrpos($metrics['profiler'],$end);
					
					$choosen_metrics['page'] =substr($metrics['profiler'],$pos_start + strlen($start), $pos_end - $pos_start - strlen($start));
					
					$start="MEMORY_USAGE ";
					$end=" bytes</fieldset>";
					
					$pos_start=strrpos($metrics['profiler'],$start);
					$pos_end=strrpos($metrics['profiler'],$end);
					$choosen_metrics['memory_usage'] =str_replace(",", "", substr($metrics['profiler'],$pos_start + strlen($start), $pos_end - $pos_start - strlen($start)));
					
					
					$start="Total Execution Time</td><td>";
					$end="</td></tr></table>";
					
					$pos_start=strrpos($metrics['profiler'],$start);
					$pos_end=strrpos($metrics['profiler'],$end);
					$choosen_metrics['execution_time'] =substr($metrics['profiler'],$pos_start + strlen($start), $pos_end - $pos_start - strlen($start));
					
					
				print_test($choosen_metrics);
				
				
					$this->db4 = $this->load->database("spl", TRUE);
					$this->db4->insert ( 'metrics', $choosen_metrics );
				
				
				}
				
			}
		
		}
		
		
		public function  getStat(){
			$this->db4 = $this->load->database("spl", TRUE);
			$sql="SELECT DISTINCT page , count(*) as nombre from metrics GROUP BY page ORDER BY nombre DESC";
			//$sql="SELECT DISTINCT user , count(*) as nombre from metrics GROUP BY user ORDER BY nombre DESC";
			//$sql="SELECT DISTINCT user,page , count(*) as nombre from metrics GROUP BY user,page ORDER BY nombre DESC";
			
			$sql="SELECT DISTINCT hist , count(*) as nombre from metrics where hist_num=3  GROUP BY hist ORDER BY nombre DESC";
			$sql="SELECT DISTINCT hist , count(*) as nombre  ,AVG(date_diff_1) as date_diff_1_v,AVG(date_diff_2) as date_diff_2_v from metrics where hist_num=3 and page LIKE'manage/add_classification'  GROUP BY hist ORDER BY nombre DESC";
			
			$sql="SELECT DISTINCT hist , date_diff_1,date_diff_2 from metrics where hist_num=3 and page LIKE'manage/add_classification' AND hist like 'manage/list_paper -> manage/view_paper -> manage/add_classification' ";
			$sql="SELECT  hist , date_diff_1,date_diff_2 from metrics where hist_num=3 and page LIKE'manage/view_paper' AND hist like '%manage/add_classification -> manage/view_paper' ";
			$sql="SELECT  DISTINCT hist , count(*) as nombre  ,AVG(date_diff_1) as date_diff_1_v,AVG(date_diff_2) as date_diff_2_v from metrics where hist_num=3 and page LIKE'manage/view_paper'  GROUP BY hist ORDER BY nombre DESC";
			
			
			
			
			
			$sql="SELECT DISTINCT page , count(*) as nombre from metrics GROUP BY page ORDER BY nombre DESC";
			
			//-numbre total
			//$sql="SELECT  count(*) as nombre from metrics ";
			
			//-utilisateurs
			//$sql="SELECT DISTINCT  user from metrics";
			
			//- utilisateur par op�ration
			$sql="SELECT DISTINCT user , count(*) as nombre from metrics GROUP BY user ORDER BY nombre DESC";
			$sql="SELECT DISTINCT user,page , count(*) as nombre from metrics GROUP BY user,page ORDER BY nombre DESC";
			
			$sql="SELECT DISTINCT project , count(*) as nombre from metrics GROUP BY project ORDER BY nombre DESC";
			
			
			
			$sql="SELECT DISTINCT page , count(*) as nombre from metrics GROUP BY page ORDER BY nombre DESC";
			$sql="SELECT DISTINCT page , count(*) as nombre from metrics  GROUP BY page ORDER BY nombre DESC";
			$sql="SELECT DISTINCT project , count(*) as nombre from metrics GROUP BY project ORDER BY nombre DESC";
			
			$sql="SELECT DISTINCT page , count(*) as nombre from metrics  GROUP BY page ORDER BY nombre DESC";
			
			
			$sql="SELECT DISTINCT hist , count(*) as nombre   from metrics where hist_num=3 and page LIKE'manage/add_classification'  GROUP BY hist ORDER BY nombre DESC";
				
			$res=$this->db4->query($sql)->result_array();
			$tmpl = array (
					'table_open'  => '<table class="table table-striped table-hover">',
					'table_close'  => '</table>'
			);
			
			$this->table->set_template($tmpl);
			
			echo $this->table->generate($res);
			//print_test($res);
		}
		
		public function  getLienHist(){
			$this->db4 = $this->load->database("spl", TRUE);
			$sql="SELECT metric_id,user,time, page ,page_url_source,page_url from metrics  ORDER BY  user, time ASC";
			$res=$this->db4->query($sql)->result_array();
			$prev_time_1=0;
			$prev_time_2=0;
			$prev_page_1='';
			$prev_page_2='';
			$hist="";
			foreach ($res as $key => $value) {
				$hist=$value['page'];
				$hist_num=1;
				$value['date']=date('Y-m-d : H:i:s',$value['time']);
				if(!empty($prev_time_1)){
					$value['date_diff_1']=($value['time']-$prev_time_1);
					$value['hist_page_1']=$prev_page_1;
					if($value['date_diff_1']<3600){
					$hist=$prev_page_1." -> ".$hist;
					$hist_num++;
					}
				}else{
					$value['date_diff_1']="";
					$value['hist_page_1']="";
				}
				
				if(!empty($prev_time_2)){
					$value['date_diff_2']=($prev_time_1 - $prev_time_2);
					$value['hist_page_2']=$prev_page_2;
					
					if(!empty($prev_time_1) AND !empty($value['date_diff_1']) AND $value['date_diff_1']<3600){
						if($value['date_diff_2']<3600){
						$hist=$prev_page_2." -> ".$hist;
						$hist_num++;
						}
					}
				}else{
					$value['date_diff_2']="";
					$value['hist_page_2']="";
				}
				
				$value['hist']=$hist;
				$value['hist_num']=$hist_num;
				
				$prev_time_2=$prev_time_1;
				$prev_page_2=$prev_page_1;
				
				$prev_time_1=$value['time'];
				$prev_page_1= $value['page'];
				print_test($value);
				
				$res = $this->db4->update ( 'metrics', $value, array ('metric_id' =>$value['metric_id']	) );
			}
		//	print_test($res);
		}
		
		function getBrowser($u_agent)
		{
			//$u_agent = $_SERVER['HTTP_USER_AGENT'];
			$bname = 'Unknown';
			$ub = 'Unknown';
			$platform = 'Unknown';
			$version= "";
		
			//First get the platform?
			if (preg_match('/linux/i', $u_agent)) {
				$platform = 'linux';
			}
			elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
				$platform = 'mac';
			}
			elseif (preg_match('/windows|win32/i', $u_agent)) {
				$platform = 'windows';
			}
		
			// Next get the name of the useragent yes seperately and for good reason
			if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
			{
				$bname = 'Internet Explorer';
				$ub = "MSIE";
			}
			elseif(preg_match('/Firefox/i',$u_agent))
			{
				$bname = 'Mozilla Firefox';
				$ub = "Firefox";
			}
			elseif(preg_match('/Chrome/i',$u_agent))
			{
				$bname = 'Google Chrome';
				$ub = "Chrome";
			}
			elseif(preg_match('/Safari/i',$u_agent))
			{
				$bname = 'Apple Safari';
				$ub = "Safari";
			}
			elseif(preg_match('/Opera/i',$u_agent))
			{
				$bname = 'Opera';
				$ub = "Opera";
			}
			elseif(preg_match('/Netscape/i',$u_agent))
			{
				$bname = 'Netscape';
				$ub = "Netscape";
			}
		
			// finally get the correct version number
			$known = array('Version', $ub, 'other');
			$pattern = '#(?<browser>' . join('|', $known) .
			')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
			if (!preg_match_all($pattern, $u_agent, $matches)) {
				// we have no matching number just continue
			}
		
			// see how many we have
			$i = count($matches['browser']);
			if ($i != 1) {
				//we will have two since we are not using 'other' argument yet
				//see if version is before or after the name
				if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
					$version= $matches['version'][0];
				}
				else {
					if(isset($matches['version'][1]))
					$version= $matches['version'][1];
					else
					$version="Unknown";
				}
			}
			else {
				$version= $matches['version'][0];
			}
		
			// check if we have a number
			if ($version==null || $version=="") {$version="?";}
		
			return array(
					'userAgent' => $u_agent,
					'name'      => $bname,
					'version'   => $version,
					'platform'  => $platform,
					'pattern'    => $pattern
			);
		}
		
		
		public function test_assignment(){
			$number_of_papers=46;
			$number_of_user=4;
			$User_per_papers=3;
			
			$papers=array();
			$i=1;
			while ($i<=$number_of_papers) {
				$papers[$i]['paper']="paper_".$i;
				
				$papers[$i]['users']=array();
				$j=1;
				while($j<=$User_per_papers){
					$temp_user=$i % $number_of_user + $j;
					
					if($temp_user > $number_of_user )
						$temp_user = $temp_user - $number_of_user;
						
					array_push($papers[$i]['users'], $temp_user);
					
					
					$j++;
				}
				
				
			$i++;
			}
			
			//print_test($papers);
			$nuser=array();
			foreach ($papers as $key => $value) {
				foreach ($value['users'] as $key_u => $value_u) {
					if(isset($nuser[$value_u])){
						$nuser[$value_u] ++;
					}else{
						$nuser[$value_u] =1;
					}
				}
				
			}
			
			print_test($nuser);
			
		}
}
