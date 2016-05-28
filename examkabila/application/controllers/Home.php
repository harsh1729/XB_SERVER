	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$headerdata['css'] = $this->load->view('view-parts/home-view-css-files','',TRUE);
		$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
		$this->load->view('view-parts/Header',$headerdata);

		$this->load->view('home-view');

		$footerdata['js'] = $this->load->view('view-parts/home-view-js-files','',TRUE);
		$this->load->view('view-parts/footer',$footerdata);
		if($this->session->userdata('web_language') == null)
		{
			$this->session->set_userdata('web_language','hi');
		}
	}

	public function web_language()
	{
		$lang = $this->input->post('lang');
		$this->session->set_userdata('web_language',$lang);
		echo json_encode($this->session->userdata('web_language'));

	}
	
}
