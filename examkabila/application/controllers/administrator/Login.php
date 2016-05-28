<?php
class Login extends CI_Controller
{
	public function __construct() {        
		parent::__construct();
	}
	function is_LoggedIn()
	{
		$is_logged_in_admin = $this->session->userdata('is_logged_in_admin');
		if(isset($is_logged_in_admin) && $is_logged_in_admin == true)
		{
			redirect('administrator');
			die();
		}
	}
	function index()
	{
		$this->is_LoggedIn();
		$this->load->view('administrator/login-view');
	}
	function loginAuth()
	{
		$this->load->model('user_info_model');
		$queryRow = $this->user_info_model->admin_login($this->input->post('username'),md5($this->input->post('password')));


		if($queryRow['isValidated'])
		{
			
				$data = array(
					'user_id' => $queryRow['userid'],
					'name' => $queryRow['name'],
					'username' => $queryRow['username'],
					'is_logged_in_admin' => true
				);
				$this->session->set_userdata($data);
				redirect('administrator');
			
			
		}
		else
		{
			//username/password wrong!!!
			$this->session->set_flashdata('login_error','Username/Password do not Match!');
			redirect('administrator/login');
		}
	}
	function logout()
	{
		$this->session->set_userdata('is_logged_in_admin',FALSE);
		redirect('administrator/login');
	}
}
?>