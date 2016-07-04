<?php
include_once 'db_functions.php';
$post = array();
$category_name=new DB_Functions();
$categoryname=$category_name->view_gklist($post);
$count = count($categoryname);
//print_r($addEmployeelist);
if($count > 0){
	echo json_encode($categoryname);
}
else{
	$data = array('msg'=>'0');
	echo json_encode($data);
}
?>
