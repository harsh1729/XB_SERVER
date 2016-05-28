	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
	public function index($blog_id = false,$name="")
	{
		
			$blog_id = $blog_id;
			
				
			
				if(!$blog_id)
				{
					$this->load->model('blog_model');
					$headerdata['css'] = $this->load->view('view-parts/blog-view-css-files','',TRUE);
					$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
					$this->load->view('view-parts/Header',$headerdata);
					$blog['data'] = $this->blog_model->get_all_blog();
					$this->load->view('blog-view',$blog);

					$footerdata['js'] = $this->load->view('view-parts/blog-view-js-files','',TRUE);
					$this->load->view('view-parts/footer',$footerdata);	
			

				}
				else
				{
					$this->load->model('blog_model');
					$headerdata['css'] = $this->load->view('view-parts/blog-view-css-files','',TRUE);
					$headerdata['navigation'] = $this->load->view('view-parts/navigation-view','',TRUE);
					$this->load->view('view-parts/Header',$headerdata);
					$blog['data'] = $this->blog_model->get_blog_by_id($blog_id);
					$this->load->view('blog-view',$blog);

					$footerdata['js'] = $this->load->view('view-parts/blog-view-js-files','',TRUE);
					$this->load->view('view-parts/footer',$footerdata);	
				}
				
			
		
	}




	
	
}