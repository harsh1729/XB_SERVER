<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankpo extends CI_Controller
{
	public function get_gk()
	{
		$this->load->model('Bankpo_model');
		$limit = 15;
		$off_set = $this->input->post('off_set');
		echo $this->Bankpo_model->get_gk_ajax($off_set,$limit);	
	}

	public function get_gk_page()
	{
		$this->load->model('Bankpo_model');
		echo $this->Bankpo_model->get_gk_page();	
	}

    

    public function examalert()
    {
    	$this->load->model('Bankpo_model');
		echo $this->Bankpo_model->examalert();
    }

    public function updatedownload()
    {
    	$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
                $this->load->model('Bankpo_model');
			$id = $this->input->post('pdfid');
			echo  $this->Bankpo_model->updatedownload($id);
	/*	if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$id = $this->input->post('pdfid');
			
		   echo	$this->Bankpo_model->updatedownload($id);	
		}*/

    }
    public function web_language()
	{
		$lang = $this->input->post('lang');
		$this->session->set_userdata('web_language',$lang);
		echo json_encode($this->session->userdata('web_language'));

	}
    public function getexamquestion()
	{
		
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
		//$language = $this->examtest_model->get_session();
			$data = $this->Bankpo_model->getexamquestion();
			echo $data;
		}


		
	}
        public function get_seenexams_question()
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$exam_no = $this->input->post('exam_no');
			$language = $this->input->post('language');
			$userid = $this->Bankpo_model->get_session_userid();
			$data = $this->Bankpo_model->get_seenexams_question($exam_no,$language);
			echo $data;
		}
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
			$this->load->model('Bankpo_model');
			$questionid = $this->input->post('seen_question');
			$session_userid = $this->Bankpo_model->get_session_userid();
			$data = $this->Bankpo_model->set_seen_questionid($questionid,$session_userid);
			echo $data;
		}
      }


   public function set_language()
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model'); 
			$lang = $this->input->post('language');
			$data = $this->Bankpo_model->set_language($lang);
			echo json_encode($data);
		}


		
	}

	public function get_session_language()
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$data = $this->Bankpo_model->get_session_language();
			echo json_encode($data);
		}


		
	}


       public function get_numberof_sets()
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$set = $this->Bankpo_model->get_numberof_sets();
			echo $set;
		}

		
	}



       public function submitexamrecord()
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$date = date("d/m/Y");
			$this->load->model('Bankpo_model');
			$userid = $this->Bankpo_model->get_session_userid();
			$exam_record_array = $this->input->post('examrecord_array');
			$language = $this->input->post('language');
			$marks = $this->input->post('marks');
			$total_attempt = $this->input->post('total_attempt');
			$attempt_wrong = $this->input->post('attempt_wrong');
			$attempt_right = $this->input->post('attempt_right');
			$data = $this->Bankpo_model->submitexamrecord($exam_record_array,$language,$userid,$date,$marks,$total_attempt,$attempt_right,$attempt_wrong);
			echo $data;
		}


		
	}

	public function submitseenexam()
	{

		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				redirect('home');
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$userid = $this->Bankpo_model->get_session_userid();
			$seen_set_id = $this->session->userdata('set_no');
			$data = $this->Bankpo_model->submitseenexam($userid,$seen_set_id);
			echo $data;
		}

	}


	public function get_profile()
	{
		$this->load->model('Bankpo_model');
		$id = $this->session->userdata('userid');
		echo $this->Bankpo_model->get_profile($id);
	}

       public function get_daily_test_question()
	{
		$cat = $this->input->post('cat');
		$testno = $this->input->post('testno');
		$lang = $this->session->userdata('web_language');
		$this->load->model('Bankpo_model');
			
		$data = $this->Bankpo_model->get_daily_test_question($cat,$testno,$lang);
		echo $data;
			
	}

	public function get_daily_test_current_affaire_question()
	{
		
		if($this->input->post('date') == null)
		{
			$lang = $this->session->userdata('web_language');
			$this->load->model('Bankpo_model');
			$date = $this->Bankpo_model->get_daily_test_date();
			$data = $this->Bankpo_model->get_daily_test_current_affaire_question($date,$lang);
			echo $data;
		}
		else
		{
			$lang = $this->session->userdata('web_language');
			$this->load->model('Bankpo_model');
			$date = $this->input->post('date');
			$data = $this->Bankpo_model->get_daily_test_current_affaire_question($date,$lang);
			echo $data;
		}	
	}

       public function get_all_category()
	{
		$this->load->model('Bankpo_model');
		$cat = $this->input->post('cat');
		$data = $this->Bankpo_model->get_all_category($cat);
		echo json_encode($data);
	}

	public function submit_video_comment()
	{
		$this->load->model('video_model');
		$video_comment = trim($this->input->post('video_comment'));
		$video_id = trim($this->input->post('video_id'));
		$username = $this->session->userdata('name');
		$userid = $this->session->userdata('userid');
		echo json_encode($this->video_model->submit_comment($video_comment,$video_id,$username,$userid));
	}
}
