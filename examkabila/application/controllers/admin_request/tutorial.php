<?php 

class Tutorial extends CI_Controller
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


  public function submit_tutorial()
  {
  	if(!$this->session->userdata('is_logged_in_admin'))
  	{

  	}
  	else
  	{
  				$this->load->model('tutorial_model');
				
				
				$tutorial_name = trim($this->input->post('tutorial_name'));
				$tutorial_text = trim($this->input->post('tutorial_text'));
				$tutorial_link = trim($this->input->post('tutorial_link'));
				
				
				echo $this->tutorial_model->submit_tutorial($tutorial_name,$tutorial_text,$tutorial_link);
				

  	}
  }



  public function get_all_tutorial()
  {
     $this->load->model('tutorial_model');
     $catid  = $this->input->post('catid');
     echo json_encode( $this->tutorial_model->get_all_tutorial($catid));
  }

  public function submit_comment()
  {
    $this->load->model('tutorial_model');

    $tutorial_comment = trim($this->input->post('tutorial_comment'));
    $tutorial_id = trim($this->input->post('tutorial_id'));
    $username = $this->session->userdata('name');
    echo json_encode($this->tutorial_model->submit_comment($tutorial_comment,$tutorial_id,$username));

  }

  public function get_tutorial_by_id()
  {
    $this->load->model('tutorial_model');
    $tutorial_id = trim($this->input->post('tutorial_id'));
    echo json_encode($this->tutorial_model->get_tutorial_by_id($tutorial_id));
  }

}