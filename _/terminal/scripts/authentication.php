<?php
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$baseUrl = $baseUrl."";
$filePath = $_SERVER['DOCUMENT_ROOT']."";
include(__DIR__ ."../../conf/db_connection.php");
$cookie_name = "afia_authentication";

if(isset($_COOKIE[$cookie_name])) 
{
	$login_session=$_COOKIE[$cookie_name];
	
	$query = "SELECT * FROM `tbl_users` WHERE `login_session`='$login_session'";
	$result = mysqli_query($conn,$query);	
	if ($result->num_rows > 0) {
		// output data of each row
	while($row = $result->fetch_assoc()) { 
	$glog_full_name=$row['full_name']; 
	$admin_level=$row['user_type'];
	$glob_user_id=$row['user_id'];
	$glob_vendor_id = $row['vendor_id'];

		
	}
	
	$queryV = "SELECT * FROM `tbl_vendors` WHERE `vendor_id`=$glob_vendor_id";
	$resultV = mysqli_query($conn,$queryV);	
	if ($resultV->num_rows > 0) {
	while($rowV = $resultV->fetch_assoc()) { 
	$glob_vendor_title=$rowV['vendor_title'];
	$glob_vendor_email=$rowV['vendor_email'];
	$glob_vendor_phone=$rowV['vendor_phone'];
	$glob_vendor_address=$rowV['vendor_address'];

	}}
	
	
	
	
	
	
	}else {
	
	if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
		
		header("refresh: 0");
		
    }}
	
	
	}
	
}else{ echo "<script>window.location='".$baseUrl."/pages/authentication/card/login'</script>"; }
?>