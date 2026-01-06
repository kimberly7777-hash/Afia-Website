<?php 
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");


if (isset($_POST['vendor_title'])) 
  {
	$vendor_title = $_POST['vendor_title'];
	$vendor_phone = $_POST['vendor_phone'];
	$vendor_email = $_POST['vendor_email'];
	$vendor_address = $_POST['vendor_address'];
	$vendor_description = $_POST['vendor_description'];
	$created_user_id = $_POST['created_user_id'];
	
	$vendor_title = mysqli_real_escape_string($conn, $vendor_title);
	$vendor_address = mysqli_real_escape_string($conn, $vendor_address);
	$vendor_description = mysqli_real_escape_string($conn, $vendor_description);
	
	
	function generateUniqueId() {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';

    // Generate two random letters
    $lettersPart = substr(str_shuffle($letters), 0, 2);

    // Generate four random numbers
    $numbersPart = substr(str_shuffle($numbers), 0, 4);

    // Combine the letters and numbers
    $uniqueId = $lettersPart . $numbersPart;

    return $uniqueId;
	}

	$vendorID = generateUniqueId();
	
	//$custID = 
	$vendor_link_id = md5($vendorID.time());
	$vendor_date_created = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `tbl_vendors` (`vendor_link_id`, `vendor_date_created`, `vendor_title`, `vendor_email`, `vendor_phone`, `vendor_address`, `vendor_description`, `created_user_id`, `vendorID`) VALUES ('$vendor_link_id', '$vendor_date_created', '$vendor_title', '$vendor_email', '$vendor_phone', '$vendor_address', '$vendor_description', $created_user_id, '$vendorID')";

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
		
		$sql = "DELETE FROM `tbl_vendors` WHERE `vendor_id`=$custDelete";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }

//Remove Site
if (isset($_POST['siteDelete'])) 
  {  
		$street_id = $_POST['siteDelete'];
		
		$sql = "DELETE FROM `tbl_vendor_street_linkup` WHERE `street_id`=$street_id";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }


  
//Add LOCTION TO vendor
if (isset($_POST['addLocation'])) 
  {  
		$vendor_id = $_POST['addLocation'];
		$street_id = $_POST['street_id'];
		
		
$myfile = fopen("xXx.txt", "w") or die("Unable to open file!");
$txt = $street_id;
fwrite($myfile, $txt);
fclose($myfile);	
		

$sql = "SELECT * FROM `tbl_vendor_street_linkup`, `tbl_vendors`, `tbl_locations` WHERE `tbl_vendor_street_linkup`.`vendor_id` = `tbl_vendors`.`vendor_id` AND `tbl_vendor_street_linkup`.`street_id` = `tbl_locations`.`district_id` AND `tbl_locations`.`district_id` = $street_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) 
{
    echo "This site: ".$row["region"]."->".$row["district"]."->".$row["ward"]."->".$row["street"]." is under ".$row["vendor_title"];
	exit;
}
}
		
$sql = "INSERT INTO `tbl_vendor_street_linkup` (`vendor_id`, `street_id`)
VALUES ($vendor_id, $street_id)";

if ($conn->query($sql) === TRUE) {
  echo 1;
} else {
  echo 2;
}
		
  }


$conn->close(); 
?>

