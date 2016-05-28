<?php

	class Contactus extends CI_Controller
	{
		
		 public function __construct()
		{
			parent::__construct();
		}

		function index()
		{
			$this->load->model('user_info_model');
			$is_logged_in = $this->user_info_model->is_logged_in();
			if(!$is_logged_in)
			{
				redirect('home');
			}
			else
			{
				
				$headerdata['css'] = $this->load->view('view-parts/contactus-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				$this->load->view('contactus-view');
				$footerdata['js'] = $this->load->view('view-parts/contactus-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
			}
		}

		function contactus()
		{
			$this->load->model('user_info_model');
			$is_logged_in = $this->user_info_model->is_logged_in();
			if(!$is_logged_in)
			{
				redirect('home');
			}
			else
			{
				$name = $this->input->post('username_contact');
				$message = $this->input->post('usermessage');
				$this->load->model('Contactus_model');
				echo $this->Contactus_model->contactus($name,$message);
			}
		}
	

	}