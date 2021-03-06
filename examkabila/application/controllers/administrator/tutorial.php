
		<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial extends CI_Controller
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
				$dataToNav['page'] = "turorial";
				$dataToNav['userName'] = "vikas";
				$navigationData['navigation'] = $this->load->view('administrator/view-parts/navigation-view',$dataToNav,TRUE);
				$navigationData['css'] = $this->load->view('administrator/view-parts/tutorial-view-css-files','',TRUE);
				$headerData['header'] = $this->load->view('administrator/view-parts/header-view',$navigationData,TRUE);
				$data['data'] = $this->load->view('administrator/tutorial-view',$headerData);
				$data['js'] = $this->load->view('administrator/view-parts/tutorial-view-js-files','',TRUE);
				$this->load->view('administrator/view-parts/footer-view',$data);
		}

		
	
	}

	
	
}

