<?php

$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'uploads_image';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    
    $replaceChars = array(" ",".");
    
    $targetFile =  $targetPath.time().str_lreplace("_",".",str_replace($replaceChars,"_",$_FILES['file']['name']));  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
    echo time().str_lreplace("_",".",str_replace($replaceChars,"_",$_FILES['file']['name']));
}




function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

	if($pos !== false)
	{
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}

	return $subject;
}




?>