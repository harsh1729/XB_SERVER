<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examtest extends CI_Controller
{
	 public function __construct()
	{
			parent::__construct();
	}
	public function loadexamtestview()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$headerdata['css'] = $this->load->view('view-parts/examtest-view-css-files','',TRUE);
			$this->load->view('view-parts/start-html',$headerdata);
			$this->load->view('examtest-view');
			$footerdata['js'] = $this->load->view('view-parts/examtest-view-js-files','',TRUE);
			$this->load->view('view-parts/close-html',$footerdata);
		}
		
	}

	
	
       function get_session_userid()
		{
			return $this->session->userdata('userid');
		}
	

	

	public function set_seen_questionid()
	{	

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('examtest_model');
			$questionid = $this->input->post('seen_question');
			$session_userid = $this->examtest_model->get_session_userid();
			$data = $this->examtest_model->set_seen_questionid($questionid,$session_userid);
			echo $data;
		}


		
	}

	
	public function instructionview($set_no,$section)
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$headerdata['css'] = $this->load->view('view-parts/instruction-view-css-files','',TRUE);
			$this->load->view('view-parts/start-html',$headerdata);
			$instructionviewData['setno'] = $set_no;
			$instructionviewData['section'] = $section;
			$this->load->view('instruction-view',$instructionviewData);
			$footerdata['js'] = $this->load->view('view-parts/instruction-view-js-files','',TRUE);
			$this->load->view('view-parts/close-html',$footerdata);
		}

		
	}
	public function instructionviewpre($set_no,$section)
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$headerdata['css'] = $this->load->view('view-parts/instruction-view-css-files','',TRUE);
			$this->load->view('view-parts/start-html',$headerdata);
			$instructionviewData['setno'] = $set_no;
			$instructionviewData['section'] = $section;
			$this->load->view('instructionpre-view',$instructionviewData);
			$footerdata['js'] = $this->load->view('view-parts/instruction-view-js-files','',TRUE);
			$this->load->view('view-parts/close-html',$footerdata);
		}


		
	}

	
	

	


}
