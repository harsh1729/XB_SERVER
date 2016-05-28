<?php
include("database_connection.php");

$upload_dir = 'uploads_image';

$targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;

unlink($targetPath.$_REQUEST['fid']);

?>




