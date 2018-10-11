<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bm_lib
{
	public function __construct()
	{
		
		$this->CI =& get_instance();
		
		if(!in_array($this->CI->router->fetch_class(), $this->CI->config->item('free_controllers'))){
			
			$this->checkauthentification();
			
		}
		
		$sections = array(
		'config'  => FALSE,
		'http_headers'  => FALSE,
		'session_data' => FALSE,
		'queries' => FALSE
		);
//	echo 	print_test($this->CI->load->database('default',true));
		$f = APPPATH.'config/database.php';
		include($f);
		$db_settings = $db;
		//print_test($db_settings);
	//	print_test(empty($db_settings[project_db()]));
		//exit;
		if(!empty($db_settings[project_db()])){
			
			$this->CI->db_current= $this->CI->load->database(project_db(), TRUE);
		}else{
		//	set_top_msg("There is a problem with the selected project!",'error');
		
			$this->CI->db_current= $this->CI->load->database('default', TRUE);
			$this->CI->session->set_userdata ( 'project_db','' );
			$this->CI->session->set_userdata ( 'project_id','' );
			$this->CI->session->set_userdata ( 'project_title','' );
			echo "<script>alert('There is a problem with the selected project!');window.location.href='".base_url()."home';</script>";
			//redirect('home');
			exit;
		}
		
		
		//exit;
	//	$this->CI->output->set_profiler_sections($sections);
	//$this->CI->output->enable_profiler(true);
	//$time=time();
	//$this->CI->session->set_userdata('request_time',  time());
	
		//print_test($this->CI->router->fetch_directory());
		//print_test($this->CI->router->fetch_class());
		//print_test($this->CI->uri->segment(2));
		//print_test(current_url());
	
	}
		
	/*
	 * Vérifiaction si l'utilisateur encours est authentifier, si non redirection vers la page d'authentification
	 */
	function checkauthentification()
	{
		if(!($this->CI->session->userdata('user_id'))){
			redirect('auth');
		}
	}

	
	/*
	 * Géneration de la pagination des pages
	 */
		function get_pagination($url, $total_rows,$uri_segment=3){

		$this->CI->load->library('pagination');
		$config['uri_segment'] = $uri_segment;
		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->CI->config->item('rec_per_page');
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<ul class="pagination pagination_mine">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="paginate_button">';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button">';
		$config['next_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class="paginate_button">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="paginate_button">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open']="<li class='paginate_button active'><a>";
		$config['cur_tag_close']="</a></li>";
		$config['num_links'] = 3;
		
		$this->CI->pagination->initialize($config);
		echo $this->CI->pagination->create_links();
		
		}
		
		
		/*
		 * Verification si un nom d'utilisateur est déjà utilisé ou pas
		 */
		function login_available($login){
				$result=$this->CI->DBConnection_mdl->login_available($login);
				
				return $result;
				
			}
			
			
	public function send_mail($subject,$message,$destination) {
		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "relisgeodes@gmail.com";
		$config['smtp_pass'] = "R3l1sApp";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
			
		$ci->email->initialize($config);
			
		$ci->email->from('relisgeodes@gmail.com', 'ReLiS');
		//$list = array('bbigendako@gmail.com');
		$ci->email->to($destination);
		$ci->email->reply_to('relisgeodes@gmail.com', 'ReLiS');
		$ci->email->subject($subject);
		$ci->email->message($message);
			
		if($ci->email->send()){
			//echo "Email sent successfully.";
			return 1;
		}
		else{
			
			//echo $ci->email->print_debugger();
			return 0;
		}
		
	}
	
	
	/**
	 * Generate a random string, 	
	 * @param int $length      How many characters do we want?
	 * @return string
	 */
	public function random_str($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
			

		}
	