<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
		{
		parent::__construct();
		
		$this->load->library('form_validation');
		}
		
	/*
	 * Page d'authentification
	 * 
	 * */
	public function index()
	{
	
		
		if(($this->session->userdata('user_id')))
		
		{
			//Si l'utilisateur a déjà une session ouverte il est redirigé vers la page d'acceuil
			redirect('home');
		}else
		{
			
			/* Affichage du formulaire de connexion 
			 * 
			 * */
		
		$data['page']='login';
		
		/*
		 * Chargement de la vue d'authentification
		 */
		$this->load->view('login',$data);
		}	
	}
	
	
	
	
	/*
	 * Fonction de verification du mot de passe et nomt d'utilisateur entrée pour la connexion
	 */
	public function check_form(){
		/*
		 * Récupération des valeurs saisie per l'utilisateur
		 */
		$content=$this->input->post();
		
		
		
		/*
		 * Verification si toutes les valeurs ont été saisie avec "form validator" de codeIgniter
		 */
		$this->form_validation->set_rules('user_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
	
		if ($this->form_validation->run() == FALSE)
		{
			/*
			 * Si toutes les valeurs ne sont pas saisies  retour vers le formulaire de connexion
			 */
			$this->load->view('login');
		}
		else
		{
			
			/*
			 * Vérification si login et password sont correct
			 */
			
			$user = $this->DBConnection_mdl->check_user_credentials($this->input->post());
				
			//print_test($user);
			if(empty($user)){
					
					
				$data['err_msg'] = 'Username or Password not correct !';
				$this->load->view('login',$data);
					
			}
			else{
					
					
				
				
				$this->session->set_userdata($user);
				$this->session->set_userdata('page_msg_err','');
				$this->session->set_userdata('last_url',"");
				$this->session->set_userdata('msg'," Connexion réussie.");
				$this->session->set_userdata('submit_mode','normal');
				$this->session->set_userdata('language_edit_mode','no');
				$this->session->set_userdata('language_edit_mode','class');
				//used for redirection after saving data
				$this->session->set_userdata('after_save_redirect','');
				$this->session->set_userdata('current_screen_phase','');
				//$this->session->set_userdata('project_db','mt');
				//$this->session->set_userdata('project_db','stm');
				
			//	$configuration = get_appconfig();
				if(!empty($user['user_default_lang']))
					$default_lang=$user['user_default_lang'];
				else
					$default_lang='en';
				
				$this->session->set_userdata('active_language',$default_lang);
				set_log('Connexion','User connected');
				redirect('home');
					
			}
	
				
		}
	}
	
	/*
	 * 
	 * Déconnexion : réinitialisation de la session de l'utilisateur
	 * 
	 */
	public function discon()
	{	
		
		
		set_log('Disconnection','User disconnected');
		
		$this->session->sess_destroy();
		
		$this->session->set_userdata('user_id',0);
		
		redirect('auth');
		
	}
	
	public function add_screen_size($height=0,$width=0,$loadTime=0)
	{
	
	
		
	
		$this->session->set_userdata('screen_height',$height);
		$this->session->set_userdata('screen_width',$width);
		$this->session->set_userdata('server_request_time',$_SERVER['REQUEST_TIME']);
		$this->session->set_userdata('server_request_time_ready',time());
		echo "done";
	
	}
	
	public function add_screen_size_load()
	{
	
	
		

		$this->session->set_userdata('server_request_time',$_SERVER['REQUEST_TIME']);
		$this->session->set_userdata('server_request_time_load',time());
		echo "done";
	
	}
	
	
}
