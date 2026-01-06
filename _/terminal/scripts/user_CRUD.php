<?php 
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");


if (isset($_POST['email'])) 
  {
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$vendor_id = $_POST['vendor_id'];
	$user_type = $_POST['user_type'];
	$created_by_user_id = $_POST['created_by_user_id'];
	$password = $_POST['password'];
	
	$password = md5($password);
	
	$full_name = mysqli_real_escape_string($conn, $full_name);	
	
	
	$link_id = md5($full_name.time());
	$date_created = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `tbl_users` (`link_id`, `date_created`, `user_type`, `vendor_id`, `full_name`, `email`, `phone`, `password`, `login_session`, `created_by_user_id`) VALUES ('$link_id', '$date_created', $user_type, $vendor_id, '$full_name', '$email', '$phone', '$password', '$link_id', $created_by_user_id)";

	if ($conn->query($sql) === TRUE) {
	  echo 1;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
     
		
  }
//Delete Customer
if (isset($_POST['custDelete'])) 
  {  
		$custDelete = $_POST['custDelete'];
		
		$sql = "DELETE FROM `tbl_users` WHERE `user_id`=$custDelete AND `user_type` != 1";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }

if (isset($_POST['changeUserId'])) 
  {  
		$user_id = $_POST['changeUserId'];
		$password = $_POST['password'];
		$password = md5($password);
		
		$sql = "UPDATE `tbl_users` SET `password` = '$password' WHERE `user_id` = $user_id";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }



$conn->close(); 
?>

