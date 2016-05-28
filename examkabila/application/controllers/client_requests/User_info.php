<?php

	class User_info extends CI_Controller
	{
		
		 public function __construct()
		{
			parent::__construct();
		}
		function user_login()
		{
			$this->load->model('user_info_model');

			$queryRow = $this->user_info_model->login($this->input->post('username'),md5($this->input->post('password')));
			if($queryRow['isValidated'])
			{
				
						$data = array(
						'userid' => $queryRow['userid'],
						'phone' => $queryRow['phone'],
						'email' => $queryRow['email'],
						'name' => $queryRow['name'],
						'username' => $queryRow['username'],
						'is_logged_in' => true
					);
					$this->session->set_userdata($data);
					echo json_encode($data);
				
			}
			else
			{
				$this->session->set_flashdata('login_error','Username/Password do not Match!');
				$data = array(
						'is_logged_in' => false
					);
				echo json_encode($data);
			}
		}


		function logout()
		{
			$this->session->set_userdata('is_logged_in',FALSE);
			redirect('Bankpo');
		}

		function user_register()
		{
			$this->load->model('user_info_model');
			$Resiter_Name = $this->input->post('Resiter_Name');
			$Resiter_Phone_No = $this->input->post('Resiter_Phone_No');
			$Resiter_email = $this->input->post('Resiter_email');
			$Resiter_password = md5($this->input->post('Resiter_password'));
			$Resiter_username = $this->input->post('Resiter_username');


			$Resister_query = $this->user_info_model->register($Resiter_Name,$Resiter_Phone_No,$Resiter_email,$Resiter_username,$Resiter_password);
			if($Resister_query['is_logged_in'])
			{
				$data = array(
						'name' => $Resister_query['name'],
						'phone' => $Resister_query['phone'],
						'email' => $Resister_query['email'],
						'username' => $Resister_query['username'],
						'userid' => $Resister_query['userid'],
						'is_logged_in' => true
					);
				$this->session->set_userdata($data);
				echo json_encode($data);
			}
			else
			{
				$data = array(
						'is_logged_in' => false
					);
				echo json_encode($data);
			}

		}
		function user_logout()
		{

		}
	}