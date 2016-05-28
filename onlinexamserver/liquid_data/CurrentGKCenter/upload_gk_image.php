<?php

// question table : currentGKQrecord
// Options table : currentGKOptions

        //include("../database_connection.php");


            $target_path = realpath('../uploadedImages');
  			$tempFile = $_FILES['file']['tmp_name'];
			$replaceChars = array(" ",".");
			//$timedImgName = time().str_replace($replaceChars,"_",$_FILES['file']['name']);
			$timedImgName = time().(time()+rand(100,100)).".".pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			
			//$targetFile =  $upload_path."/".$this->str_lreplace("_",".",$timedImgName);

			//$targetFile =  $upload_path.DIRECTORY_SEPARATOR.$this->xerces_globals->str_last_replace("_",".",$timedImgName);
			$targetFile =  $target_path.DIRECTORY_SEPARATOR.$timedImgName;
			
			move_uploaded_file($tempFile,$targetFile);
			//return $this->str_lreplace("_",".",$timedImgName);
			echo $timedImgName;
?>