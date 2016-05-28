

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankpo extends CI_Controller
{
	public function index()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				$this->load->model('Bankpo_model');
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/Bankpo-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);
			$type = 1;
			$bankpo['data'] = $this->Bankpo_model->get_all_set_without_login($type);
			$bankpo['gk'] = $this->Bankpo_model->get_gk(1,10);			

			//$data = $this->Bankpo_model->get_all_set($item_id,$userid);
			
			$this->load->view('Bankpo-view',$bankpo);

			$footerdata['js'] = $this->load->view('view-parts/Bankpo-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
                        if($this->session->userdata('web_language') == null)
		        {
			 $this->session->set_userdata('web_language','hi');
		        }
		}
		else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/Bankpo-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);
			$userid = $this->Bankpo_model->get_session_userid();
			$type = 1;
			$bankpo['data'] = $this->Bankpo_model->get_all_set($type,$userid);
			$bankpo['gk'] = $this->Bankpo_model->get_gk(1,10);

			//$data = $this->Bankpo_model->get_all_set($item_id,$userid);
			
			$this->load->view('Bankpo-view',$bankpo);

			$footerdata['js'] = $this->load->view('view-parts/Bankpo-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
                        if($this->session->userdata('web_language') == null)
		        {
			   $this->session->set_userdata('web_language','hi');
		        }
		}
	}

	public function lastyearpdf()
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
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/lastyearpdf-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);


			$userid = $this->Bankpo_model->get_session_userid();
			$type = 3;
			$bankpo['data'] = $this->Bankpo_model->get_lastyear_pdf($type,$userid);
			

			$this->load->view('lastyearpdf-view',$bankpo);

			$footerdata['js'] = $this->load->view('view-parts/lastyearpdf-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
		}
	}

	public function bankinggkpdf()
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
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/bankinggkpdf-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);

			$userid = $this->Bankpo_model->get_session_userid();
			$type = 2;
			$bankpo['data'] = $this->Bankpo_model->get_all_pdf($type,$userid);
			$this->load->view('bankinggkpdf-view',$bankpo);


			$footerdata['js'] = $this->load->view('view-parts/bankinggkpdf-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
		}
	}

	public function bankposetpdf()
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
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/bankposetpdf-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);

			$userid = $this->Bankpo_model->get_session_userid();
			$type = 4;
			$bankpo['data'] = $this->Bankpo_model->get_all_pdf($type,$userid);
			

			$this->load->view('bankposetpdf-view',$bankpo);

			$footerdata['js'] = $this->load->view('view-parts/bankposetpdf-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
		}
	}


       public function importantpdf()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		//if(!$is_logged_in)
		//{
				//redirect('home');
		//}
		//else if($is_logged_in)
		{
			$this->load->model('Bankpo_model');
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/importantpdf-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);

			$userid = $this->Bankpo_model->get_session_userid();
			$type = 5;
			$bankpo['data'] = $this->Bankpo_model->importantpdf($type,$userid);
			

			$this->load->view('importantpdf-view',$bankpo);

			$footerdata['js'] = $this->load->view('view-parts/importantpdf-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
		}
	}


    public function purchageditem()
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
			$this->load->model('examtest_model');
			$headerdata['css'] = $this->load->view('view-parts/purchageditem-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);

			$userid = $this->Bankpo_model->get_session_userid();
			$type = 4;
			$bankpo['data'] = $this->Bankpo_model->purchageditem($userid);
			

			$this->load->view('purchageditem-view',$bankpo);

			$footerdata['js'] = $this->load->view('view-parts/purchageditem-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
		}
			
	}
	

        

        public function results()
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

			$headerdata['css'] = $this->load->view('view-parts/seenexams-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);

			$userid = $this->Bankpo_model->get_session_userid();
			$allexams = $this->Bankpo_model->results($userid);
			$data['allexams'] = $allexams; 

			$this->load->view('seenexams-view',$data);

			$footerdata['js'] = $this->load->view('view-parts/seenexams-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
		}



		
	}
	public function updatedownload()
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
			$id = $this->input->post('pdfid');
			
			$this->Bankpo_model->updatedownload($id);	
		}
        }
        
       

        public function download($pdf_type = false,$pdf_item_id = false)
	{
		//$demo = $this->input->Get('product_type');
		if($pdf_type == false && $pdf_item_id == false)
		{
			if($this->input->Get('product_type') !== null && $this->input->Get('price_type') !== null)
			{
				$product_type=json_decode($this->input->Get('product_type'));
				$price_type=json_decode($this->input->Get('price_type'));

				$this->load->model('Bankpo_model');
				$headerdata['css'] = $this->load->view('view-parts/download-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				//$type = 5;
				$userid = $this->Bankpo_model->get_session_userid();
				$download['data'] = $this->Bankpo_model->download($userid,$product_type,$price_type);
				$download['product_type'] =$product_type;
				$download['price_type'] = $price_type;
				
				$this->load->view('download-view',$download);

				$footerdata['js'] = $this->load->view('view-parts/download-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
			}
			else
			{
				$product_type=array();
				$product_type[0] = "";
				$product_type[1] = "";
				$product_type[2] = "";

				$price_type=array();
				$price_type[0]="0";
				$price_type[1]="1";
				

				$this->load->model('Bankpo_model');
				$headerdata['css'] = $this->load->view('view-parts/download-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				//$type = 5;
				$userid = $this->Bankpo_model->get_session_userid();
				$download['data'] = $this->Bankpo_model->download($userid,$product_type,$price_type);
				$download['product_type'] =$product_type;
				$download['price_type'] = $price_type;
				
				$this->load->view('download-view',$download);

				$footerdata['js'] = $this->load->view('view-parts/download-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
			}
		}
		else
		{
				$this->load->model('Bankpo_model');
				$headerdata['css'] = $this->load->view('view-parts/download_single-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				//$type = 5;
				$userid = $this->Bankpo_model->get_session_userid();
				$download['data'] = $this->Bankpo_model->download_single($userid,$pdf_type,$pdf_item_id);
				
				
				$this->load->view('download_single-view',$download);

				$footerdata['js'] = $this->load->view('view-parts/download_single-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
		}
		
		
		
	}
        

        public function video($video_item_id = false)
	{
		if($video_item_id == false)
		{
			if($this->input->Get('lang_type') !== null && $this->input->Get('price_type') !== null)
			{
				$lang_type=json_decode($this->input->Get('lang_type'));
				$price_type=json_decode($this->input->Get('price_type'));

				$this->load->model('Bankpo_model');
				$this->load->model('video_model');
				$headerdata['css'] = $this->load->view('view-parts/video-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				$type = 6;
				$userid = $this->Bankpo_model->get_session_userid();
				$video['data'] = $this->video_model->get_all_video($type,$userid,$lang_type,$price_type);
				$video['lang_type'] = $lang_type;
				$video['price_type'] = $price_type;
				$this->load->view('video-view',$video);

				$footerdata['js'] = $this->load->view('view-parts/video-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
			}
			else
			{
				$lang_type=array();
				$lang_type[0] = "";
				$lang_type[1] = "";
				

				$price_type=array();
				$price_type[0]="0";
				$price_type[1]="1";
				$this->load->model('Bankpo_model');
				$this->load->model('video_model');
				$headerdata['css'] = $this->load->view('view-parts/video-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				$type = 6;
				$userid = $this->Bankpo_model->get_session_userid();
				$video['data'] = $this->video_model->get_all_video($type,$userid,$lang_type,$price_type);
				$video['lang_type'] = $lang_type;
				$video['price_type'] = $price_type;
				$this->load->view('video-view',$video);

				$footerdata['js'] = $this->load->view('view-parts/video-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
			}

		}
		else
		{
				$this->load->model('Bankpo_model');
				$this->load->model('video_model');
				$headerdata['css'] = $this->load->view('view-parts/show_single_video-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);
				$type = 6;
				$userid = $this->Bankpo_model->get_session_userid();
				$video['data'] = $this->video_model->show_single_video($userid,$type,$video_item_id);
				
				
				$this->load->view('show_single_video-view',$video);

				$footerdata['js'] = $this->load->view('view-parts/show_single_video-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
		}
				
	}
        
	//////////////////  daily test


	public function daily_test_exam($cat)
	{
			
				$this->load->model('Bankpo_model'); 
				$headerdata['css'] = $this->load->view('view-parts/daily_test_exam-view-css-files','',TRUE);
				$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
				$this->load->view('view-parts/Header',$headerdata);

				$all_daily_test = $this->Bankpo_model->daily_test_exam($cat);
				$data['all_daily_test'] = $all_daily_test; 

				$this->load->view('daily_test_exam-view',$data);

				$footerdata['js'] = $this->load->view('view-parts/daily_test_exam-view-js-files','',TRUE);
				$this->load->view('view-parts/footer',$footerdata);
			

	}

	public function daily_test()
	{
		$this->load->model('Bankpo_model'); 
		$headerdata['css'] = $this->load->view('view-parts/daily_test-view-css-files','',TRUE);
		$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
		$this->load->view('view-parts/Header',$headerdata);

			

		$this->load->view('daily_test-view');

		$footerdata['js'] = $this->load->view('view-parts/daily_test-view-js-files','',TRUE);
		$this->load->view('view-parts/footer',$footerdata);

	}
        
        public function onlineexam($slug=false,$section=false,$instructions=false)
	{
		if($instructions)
		{
			$this->load->model('user_info_model');
			$is_logged_in = $this->user_info_model->is_logged_in();
			if(!$is_logged_in)
			{
					redirect('home');
			}
			else if($is_logged_in)
			{
				if($section == 'pre')
				{		
					$this->load->model('Bankpo_model');
					$this->Bankpo_model->set_session_setno($slug);
					$headerdata['css'] = $this->load->view('view-parts/instruction-view-css-files','',TRUE);
					$this->load->view('view-parts/start-html',$headerdata);
					$instructionviewData['slug'] = $slug;
					$instructionviewData['section'] = $section;
					$this->load->view('instructionpre-view',$instructionviewData);
					$footerdata['js'] = $this->load->view('view-parts/instruction-view-js-files','',TRUE);
					$this->load->view('view-parts/close-html',$footerdata);
				}
				else
				{
					$this->load->model('Bankpo_model');
					$this->Bankpo_model->set_session_setno($slug);
					$headerdata['css'] = $this->load->view('view-parts/instruction-view-css-files','',TRUE);
					$this->load->view('view-parts/start-html',$headerdata);
					$instructionviewData['slug'] = $slug;
					$instructionviewData['section'] = $section;
					$this->load->view('instruction-view',$instructionviewData);
					$footerdata['js'] = $this->load->view('view-parts/instruction-view-js-files','',TRUE);
					$this->load->view('view-parts/close-html',$footerdata);
				}
			}
		}
		else
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
				$this->Bankpo_model->set_session_setno($slug);
				$headerdata['css'] = $this->load->view('view-parts/examtest-view-css-files','',TRUE);
				$this->load->view('view-parts/start-html',$headerdata);
				$this->load->view('examtest-view');
				$footerdata['js'] = $this->load->view('view-parts/examtest-view-js-files','',TRUE);
				$this->load->view('view-parts/close-html',$footerdata);
			}
		}
		
	}

}

