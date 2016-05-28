<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller
{
	public function index()
	{

			$headerdata['css'] = $this->load->view('view-parts/Aboutus-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);
			$this->load->view('Aboutus-view');

			$footerdata['js'] = $this->load->view('view-parts/Aboutus-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
	}
}
