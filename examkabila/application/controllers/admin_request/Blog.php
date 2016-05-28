<?php 



class Blog extends CI_Controller

{

  public function upload_image()

  {

  			 $target_path = realpath('admin_docs/upload_image');

  			$tempFile = $_FILES['file']['tmp_name'];

			$replaceChars = array(" ",".");

			//$timedImgName = time().str_replace($replaceChars,"_",$_FILES['file']['name']);

			$timedImgName = time().(time()+rand(100,500)).".".pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

			

			//$targetFile =  $upload_path."/".$this->str_lreplace("_",".",$timedImgName);



			//$targetFile =  $upload_path.DIRECTORY_SEPARATOR.$this->xerces_globals->str_last_replace("_",".",$timedImgName);

			$targetFile =  $target_path.DIRECTORY_SEPARATOR.$timedImgName;

			

			move_uploaded_file($tempFile,$targetFile);

			//return $this->str_lreplace("_",".",$timedImgName);

			echo $timedImgName;





		







  }



  public function remove_image($filename)

  {

  		 $target_path = realpath('admin_docs/upload_image');



  		 $filepath = $target_path.DIRECTORY_SEPARATOR.$filename;

  		 unlink($filepath);

  		 echo $filepath;

  }





  public function submit_blog()

  {

  	if(!$this->session->userdata('is_logged_in_admin'))

  	{



  	}

  	else

  	{

  				$this->load->model('blog_model');

				

				

				$blog_text = trim($this->input->post('blog_text'));

				$blog_link = trim($this->input->post('blog_link'));

				$image_align = trim($this->input->post('image_align'));

        $blog_name = trim($this->input->post('blog_name'));

        $date = date('d-F-Y');

				

				

				echo $this->blog_model->submit_blog($blog_text,$blog_link,$image_align,$blog_name,$date);

				



  	}

  }

  public function submit_status()
  {
    if(!$this->session->userdata('is_logged_in_admin'))
    {

    }
    else
    {
          $this->load->model('blog_model');
        
        
        $status_text = trim($this->input->post('status_text'));
        $status_link_image = trim($this->input->post('status_link_image'));
        $status_name = trim($this->input->post('status_name'));
        $status_category = trim($this->input->post('status_category'));
        $status_language = trim($this->input->post('status_language'));
        $image_align = trim($this->input->post('image_align'));
        $date = date('Y-m-d');
        
        
        echo $this->blog_model->submit_status($status_text,$status_link_image,$status_category,$status_name,$date,$status_language,$image_align);
        

    }
  }



  public function submit_sub_text()

  {

    if(!$this->session->userdata('is_logged_in_admin'))

    {



    }

    else

    {

          $this->load->model('blog_model');

        

        

        $blog_text = trim($this->input->post('blog_text'));

        $blog_link = trim($this->input->post('blog_link'));

        $image_align = trim($this->input->post('image_align'));

        $blog_id = trim($this->input->post('blog_id'));

       

        

        

        echo $this->blog_model->submit_sub_text($blog_text,$blog_link,$image_align,$blog_id);

        



    }

  }





  public function get_ajax_blog()

  {

     $this->load->model('blog_model');

     echo json_encode($this->blog_model->get_ajax_blog());

  }

  public function submit_comment()

  {

    $this->load->model('blog_model');



    $blog_comment = trim($this->input->post('blog_comment'));

    $blog_id = trim($this->input->post('blog_id'));

    $username = $this->session->userdata('name');

    echo json_encode($this->blog_model->submit_comment($blog_comment,$blog_id,$username));

  }



  public function see_more()

  {

    $this->load->model('blog_model');



    $offset = $this->input->post('offset');

    $blog_id = $this->input->post('blog_id');

    echo json_encode($this->blog_model->see_more($offset,$blog_id));

  }



}