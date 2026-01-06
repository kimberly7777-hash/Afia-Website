<?php 
//error_reporting(0);
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");

	
if (isset($_POST['location_id'])) 
{
  $start_date = $_POST['start'];
  $start_date = $start_date." 00:00:00";
  $end_date = $_POST['end'];
  $end_date = $end_date." 00:00:00";
  $vendor_id = $_POST['vendor_id'];
  $location_id = $_POST['location_id'];
  $description = $_POST['eventDescription'];
  $description = mysqli_real_escape_string($conn, $description);
  //$created_by = $_POST['created_by'];
  $recurring = $_POST['recurring'];
  $created_by_id = $_POST['created_by'];
  $title = $_POST['title'];
  $cal_title = mysqli_real_escape_string($conn, $title);
  
  $date_created = date('Y-m-d H:i:s');
  
  
$sql = "INSERT INTO `tbl_schedule_calendar` (`date_created`, `created_by_id`, `location_id`, `cal_title`, `description`, `start_date`, `end_date`, `recurring`, `vendor_id`) VALUES ('$date_created', $created_by_id, $location_id, '$cal_title', '$description', '$start_date', '$end_date', $recurring, $vendor_id)";

	if ($conn->query($sql) === TRUE) {
	  echo 1;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}



}


$conn->close(); 
?>