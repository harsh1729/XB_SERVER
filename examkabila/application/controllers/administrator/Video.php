

		<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Video extends CI_Controller

{

	public function index()

	{

		$is_logged_in_admin = $this->session->userdata('is_logged_in_admin');

		if(!$is_logged_in_admin)

		{

			$this->load->view('administrator/login-view');

		}

		else

		{       

				$dataToNav['page'] = "video";

				$dataToNav['userName'] = "vikas";
                $this->load->model('Bankpo_model');
				$navigationData['navigation'] = $this->load->view('administrator/view-parts/navigation-view',$dataToNav,TRUE);

				$navigationData['css'] = $this->load->view('administrator/view-parts/video-view-css-files','',TRUE);

				$headerData['header'] = $this->load->view('administrator/view-parts/header-view',$navigationData,TRUE);
                $headerData['category'] = $this->Bankpo_model->get_cate(0);
				$data['data'] = $this->load->view('administrator/video-view',$headerData);

				$data['js'] = $this->load->view('administrator/view-parts/video-view-js-files','',TRUE);

				$this->load->view('administrator/view-parts/footer-view',$data);

		}



		

	

	}



	

	

}



