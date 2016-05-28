

<?php

$name = $_REQUEST['name'];

header("Content-disposition: attachment; filename=".$name."");
header("Content-type: application/pdf");
readfile("http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$name);

?>
