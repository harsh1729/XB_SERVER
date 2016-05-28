<?php 

class Video extends CI_Controller
{
  public function upload_video()
  {/*
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
*/
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


   public function get()
	{
		
			
				$parentid = $this->input->get_post('parentid');
				$this->load->model('Bankpo_model');
				echo json_encode(array("status"=>"login","data"=>$this->Bankpo_model->get_cate($parentid),"parentid"=>$parentid) );
			
		
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
				$videoimg_link = trim($this->input->post('videoimg_link'));
				$videothumbnail_link = trim($this->input->post('videothumbnail_link'));
				$youtube_key = trim($this->input->post('youtube_key'));
				$lan_type = trim($this->input->post('lan_type'));
				$catid = trim($this->input->post('catid'));
				$date = trim($this->input->post('date'));
				$parrentcatid = trim($this->input->post('parrentcatid'));

				echo $this->video_model->submit_video($video_pay_type,$video_amount,$video_name,$video_discription,$video_link,$videoimg_link,$videothumbnail_link,$youtube_key,$lan_type,$catid,$date,$parrentcatid);
				

  	}
  }

   public function get_video()
  {
  	if(!$this->session->userdata('is_logged_in_admin'))
  	{

  	}
  	else
  	{
  				$this->load->model('video_model');
				$type = 6;
				$userid = $this->Bankpo_model->get_session_userid();
				$lang_type=json_decode($this->input->get_post('lang_type'));
				$catid = trim($this->input->post('catid'));
                $price_type=array();
				$price_type[0]="0";
				echo json_encode(array("status"=>"login","data"=>$this->video_model->get_all_video($type,$userid,$lang_type,$price_type,$catid)));
				
				

  	}
  }

}