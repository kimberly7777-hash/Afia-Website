<?php 
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");

//add new Customer
if (isset($_POST['house_number'])) 
  {
	$customer_first_name = $_POST['customer_first_name'];
	$customer_mid_name = $_POST['customer_mid_name'];
	$customer_surname = $_POST['customer_surname'];
	$customer_phone = $_POST['customer_phone'];
	$customer_email = $_POST['customer_email'];
	$house_number = $_POST['house_number'];
	$customer_location_id = $_POST['customer_location_id'];
	$customer_address = $_POST['customer_address'];
	$created_by_user_id = $_POST['created_by_user_id'];
	$customer_category_id = $_POST['customer_category_id'];
	
	$customer_first_name = mysqli_real_escape_string($conn, $customer_first_name);
	$customer_mid_name = mysqli_real_escape_string($conn, $customer_mid_name);
	$customer_surname = mysqli_real_escape_string($conn, $customer_surname);
	$customer_address = mysqli_real_escape_string($conn, $customer_address);
	$house_number = mysqli_real_escape_string($conn, $house_number);
	
	
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

	$custID = generateUniqueId();
	
	//$custID = 
	$customer_link_id = md5($custID.time());
	$date_created = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `tbl_customers` (`customer_link_id`, `custID`, `date_created`, `customer_first_name`, `customer_mid_name`, `customer_surname`, `customer_phone`, `customer_email`, `house_number`, `customer_address`, `customer_location_id`, `created_by_user_id`, `customer_category_id`) VALUES ('$customer_link_id', '$custID', '$date_created', '$customer_first_name', '$customer_mid_name', '$customer_surname', '$customer_phone', '$customer_email', '$house_number', '$customer_address', $customer_location_id, $created_by_user_id, $customer_category_id)";

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
		
		$sql = "DELETE FROM `tbl_customers` WHERE `customer_id`=$custDelete";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }

//Delete Category
if (isset($_POST['cc_id_delete'])) 
  {  
		$customer_category_id = $_POST['cc_id_delete'];
		
		$sql = "DELETE FROM `tbl_customer_category` WHERE `customer_category_id`=$customer_category_id";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }

//Add Customer Categories
if (isset($_POST['customer_category_title'])) 
  {  
		$customer_category_title = $_POST['customer_category_title'];
		$customer_category_title = mysqli_real_escape_string($conn, $customer_category_title);
		
		$link_id = md5($customer_category_title.time());
		
		
		$sql = "INSERT INTO `tbl_customer_category` (`customer_category_title`, `link_id`)VALUES('$customer_category_title', '$link_id')";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }

//Edit Customer Categories
if (isset($_POST['customer_category_titleedit'])) 
  {  
		$customer_category_title = $_POST['customer_category_titleedit'];
		$customer_category_title = mysqli_real_escape_string($conn, $customer_category_title);
		
		$cc_id_edit = $_POST['cc_id_edit'];
		
		
		$sql = "UPDATE `tbl_customer_category` SET `customer_category_title` = '$customer_category_title' WHERE `customer_category_id` = $cc_id_edit";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }

//Update Customer
if (isset($_POST['updateCustomer'])) 
  {
	$customer_first_name = $_POST['customer_first_name'];
	$customer_mid_name = $_POST['customer_mid_name'];
	$customer_surname = $_POST['customer_surname'];
	$customer_phone = $_POST['customer_phone'];
	$customer_email = $_POST['customer_email'];
	$house_number = $_POST['edit_house_number'];
	$customer_location_id = $_POST['customer_location_id'];
	$customer_address = $_POST['customer_address'];
	$customer_category_id = $_POST['customer_category_id'];
	$customer_id = $_POST['updateCustomer'];
	
	$customer_first_name = mysqli_real_escape_string($conn, $customer_first_name);
	$customer_mid_name = mysqli_real_escape_string($conn, $customer_mid_name);
	$customer_surname = mysqli_real_escape_string($conn, $customer_surname);
	$customer_address = mysqli_real_escape_string($conn, $customer_address);
	$house_number = mysqli_real_escape_string($conn, $house_number);
	
	
	
	
	$sql = "UPDATE `tbl_customers` SET 
	`customer_first_name` = '$customer_first_name', 
	`customer_mid_name` = '$customer_mid_name', 
	`customer_surname` = '$customer_surname', 
	`customer_phone` = '$customer_phone', 
	`customer_email` = '$customer_email', 
	`house_number` = '$house_number', 
	`customer_address` = '$customer_address' 
	WHERE `customer_id` = $customer_id;
";

	if ($conn->query($sql) === TRUE) {
	  echo 1;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
     
		
  }


$conn->close(); 
?>

