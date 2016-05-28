<?php
include("database_connection.php");
session_start();
$QuesCatId = $_REQUEST['QuesCatId'];

    $parentId = $QuesCatId ;    


//$AppId = $_SESSION['Application_Id'];
$AppId =1;

$query_empty=1;
$cat_all = array();
function repeat()
{
    global $parentId,$AppId,$query_empty,$cat_all,$db;
    $cat = array();
    $query = mysqli_query($db,"select * from category_table where parentId=".$parentId." and AppId=".$AppId);
   $query_empty = mysqli_num_rows($query);
    while($row=mysqli_fetch_array($query))
    {
        $cat1['id'] = $row['id'];
        $cat1['name']=$row['category'];
        array_push($cat,$cat1);
    }
    array_push($cat_all,$cat);
    $parentId = $cat[0]['id'];
}
while( $query_empty !== 0 )
{
   
    repeat();
}


echo json_encode($cat_all);

?>