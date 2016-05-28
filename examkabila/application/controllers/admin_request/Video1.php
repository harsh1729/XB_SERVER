<?php 



class Video extends CI_Controller

{

  public function upload_video()

  {

  			 $target_path = realpath('admin_docs/upload_video');

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

  		 $target_path = realpath('admin_docs/upload_video');



  		 $filepath = $target_path.DIRECTORY_SEPARATOR.$filename;

  		 unlink($filepath);

  		 echo $filepath;

  }





  public function submit_video()

  {

  	if(!$this->session->userdata('is_logged_in_admin'))

  	{



  	}

  	else

  	{

  				$this->load->model('video_model');

				

				

				$video_pay_type = trim($this->input->post('video_pay_type'));

				$video_amount = trim($this->input->post('video_amount'));

				$video_name = trim($this->input->post('video_name'));

				$video_discription = trim($this->input->post('video_discription'));

				$video_link = trim($this->input->post('video_link'));

				

				echo $this->video_model->submit_video($video_pay_type,$video_amount,$video_name,$video_discription,$video_link);

				



  	}

  }



}