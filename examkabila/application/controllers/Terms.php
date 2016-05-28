<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller
{
	public function index()
	{

			$headerdata['css'] = $this->load->view('view-parts/Terms-view-css-files','',TRUE);
			$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
			$this->load->view('view-parts/Header',$headerdata);
			$this->load->view('Terms-view');

			$footerdata['js'] = $this->load->view('view-parts/Terms-view-js-files','',TRUE);
			$this->load->view('view-parts/footer',$footerdata);
	}
}
