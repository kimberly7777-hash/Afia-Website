<?php 
//error_reporting(0);
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");

	
if (isset($_POST['costSetup'])) 
{
  $categoryIds = $_POST['category_ids'];
  $categoryTitleAmounts = $_POST['category_title_amounts'];
  $location_id = $_POST['costSetup'];
  
  $bill_date_created = date('Y-m-d H:i:s');
  
  
$sqlLoc = "SELECT * FROM `tbl_customer_category` WHERE 1";
$resultLoc = $conn->query($sqlLoc);
$qtyCate = $resultLoc->num_rows;

$sqlLoc = "SELECT * FROM `tbl_billing_setup` WHERE `location_id` = $location_id";
$resultLoc = $conn->query($sqlLoc);
$qtySetup = $resultLoc->num_rows;
  
if( $qtyCate > $qtySetup ) {
	
$sql = "DELETE FROM `tbl_billing_setup` WHERE `location_id`=$location_id";
if ($conn->query($sql) === TRUE) {}
	
}
  
  
$sqlLoc = "SELECT * FROM `tbl_billing_setup` WHERE `location_id` = $location_id";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
	
	


  for ($i = 0; $i < count($categoryIds); $i++) {
    $category_id = $categoryIds[$i];
    $category_title_amount = $categoryTitleAmounts[$i];

	
	$sql = "UPDATE `tbl_billing_setup` SET `location_id` = $location_id, `category_id` = $category_id, `category_title_amount` = '$category_title_amount' WHERE `location_id` = $location_id AND `category_id` = $category_id";
	mysqli_query($conn, $sql);
	
  }
  echo 2;

	}else{  

  for ($i = 0; $i < count($categoryIds); $i++) {
    $category_id = $categoryIds[$i];
    $category_title_amount = $categoryTitleAmounts[$i];
	
	$bill_link_id = md5($category_id.time());

	
	$sql = "INSERT INTO `tbl_billing_setup` (`bill_link_id`, `location_id`, `bill_date_created`, `category_id`, `category_title_amount`) VALUES ('$bill_link_id', $location_id, '$bill_date_created', $category_id, '$category_title_amount')";

	mysqli_query($conn, $sql);
	
  }
  echo 1;

}
}


if (isset($_POST['createInvoice'])) 
{
	$createInvoice = $_POST['createInvoice'];
	$invMonth = $_POST['invMonth'];


$sqlLoc = "SELECT * FROM `tbl_customer_payment` WHERE `invMonth` = '$invMonth'";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) { exit; }

	
$sn = 0;	
$sqlLoc = "SELECT * FROM `tbl_vendor_street_linkup` WHERE `tbl_vendor_street_linkup`.`vendor_id` = $createInvoice";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
while($rowLoc = $resultLoc->fetch_assoc()) {
	
	$district_id = $rowLoc['street_id'];
	//$category_id = $rowLoc['category_id'];
	//$cus_pay_amount = $rowLoc['category_title_amount'];
	
$sqlLocx = "SELECT * FROM `tbl_customers`, `tbl_customer_category`, `tbl_billing_setup` WHERE `tbl_customers`.`customer_category_id` = `tbl_customer_category`.`customer_category_id` AND `tbl_billing_setup`.`category_id` = `tbl_customer_category`.`customer_category_id` AND `tbl_customers`.`customer_location_id`= $district_id GROUP BY `tbl_customers`.`customer_id`;";
$resultLocx = $conn->query($sqlLocx);
if ($resultLocx->num_rows > 0) {
while($rowLocx = $resultLocx->fetch_assoc()) {	
	
	$customer_id = $rowLocx['customer_id'];
	$customer_category_id = $rowLocx['customer_category_id'];
	$cus_pay_date_created = date('Y-m-d H:i:s');
	$pay_link_id = md5($customer_id.time());
	$xCode = substr($pay_link_id, 0, 2);
	$xCode = strtoupper($xCode);
	//$cus_pay_invoice_no = $xCode .'-'.date('Hisd-mY-').$sn;
	$sn++;
	$cus_pay_invoice_no = $xCode .'-'.date('Hisd-mY-').$customer_id;
	
	$cus_pay_amount = $rowLocx['category_title_amount'];
	
	
	
	$sql = "INSERT INTO `tbl_customer_payment` (`payment_method_id`, `pay_link_id`, `customer_id`, `cus_pay_date_created`, `cus_pay_invoice_no`, `cus_pay_amount`, `invMonth`) VALUES (1, '$pay_link_id', $customer_id, '$cus_pay_date_created', '$cus_pay_invoice_no', '$cus_pay_amount', '$invMonth')";

	if (mysqli_query($conn, $sql)) { }
	

} echo 1; }
}}
}

if (isset($_POST['theAmount'])) 
{
	$cus_pay_id = $_POST['cus_pay_id'];
	$cus_pay_date = date('Y-m-d H:i:s');
	

$sql = "UPDATE `tbl_customer_payment` SET `cus_pay_status` = 1, `cus_pay_date` = '$cus_pay_date' WHERE `cus_pay_id` = $cus_pay_id";

if (mysqli_query($conn, $sql)) {
  echo 1;
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

}


$conn->close(); 
?>