<?php 
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");


if (isset($_POST['setUpAPI'])) 
  {  
		$source_addr = $_POST['source_addr'];
		$base_Url = $_POST['base_Url'];
		$api_key = $_POST['api_key'];
		$secret_key = $_POST['secret_key'];
		
		$source_addr = mysqli_real_escape_string($conn, $source_addr);
		$base_Url = mysqli_real_escape_string($conn, $base_Url);
		$api_key = mysqli_real_escape_string($conn, $api_key);
		$secret_key = mysqli_real_escape_string($conn, $secret_key);
		
		

		
		$sql = "UPDATE `tbl_sms_setup` SET 
		`source_addr` = '$source_addr',
		`base_Url` = '$base_Url',
		`api_key` = '$api_key',
		`secret_key` = '$secret_key'
		WHERE `sms_id` = 1";
			if ($conn->query($sql) === TRUE) {
			  echo 1;
			} else {
			  echo "Error deleting record: " . $conn->error;
			}
		
  }


if (isset($_POST['verifyID'])) 
  {
	  $cus_id = $_POST['verifyID'];
	  $fullname = $_POST['fullname'];
	  $street = $_POST['street'];
	  $customer_phone = $_POST['customer_phone'];
	  $custID = $_POST['custID'];
	  
	  $sent_date = date("Y-m-d H:i:s");
	  
	  $customer_phone = substr($customer_phone, 1);
	  $customer_phone = "255".$customer_phone;
//GENERATE RECIEPIENT ID	  
function generateUniqueNumber($min = 100000, $max = 999999) {
    return random_int($min, $max);
}
$recipient_id = generateUniqueNumber();
	  
$sqlLoc = "SELECT * FROM `tbl_sms_setup`";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
while($rowLoc = $resultLoc->fetch_assoc()) {
	
	$api_key = $rowLoc['api_key'];
	$base_Url	= $rowLoc['base_Url'];
	$secret_key = $rowLoc['secret_key'];
	$source_addr = $rowLoc['source_addr'];
	
}}

$message = 'Habari ndugu '.$fullname.' wa mtaa wa '.$street.'. No. ya usajili '.$custID.' No. ya uthibitisho '.$recipient_id;

$api_key=$api_key;
$secret_key = $secret_key;

$postData = array(
    'source_addr' => $source_addr,
    'encoding'=>0,
    'schedule_time' => '',
    'message' => $message,
    'recipients' => [array('recipient_id' => '1','dest_addr'=>$customer_phone)]
);

$Url =$base_Url;

$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

$response = curl_exec($ch);

if($response === FALSE){
	//echo $response;
	die(curl_error($ch));
}else{
	
$data = json_decode($response, true);
$code = $data['code'];
$message = $data['message'];
$status = @$data['status'];
$request_id = @$data['request_id'];

if($code == 100){
	
$sqlLoc = "SELECT * FROM `tbl_sms_number_verification` WHERE `customer_id`=$cus_id";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
	
	$sqlsnv = "UPDATE `tbl_sms_number_verification` SET `verification_CODE` = '$recipient_id', `request_id` = '$request_id' WHERE `customer_id` = $cus_id;
";
}else{
	$sqlsnv = "INSERT INTO `tbl_sms_number_verification` (`verification_CODE`, `customer_id`, `status`, `request_id`)VALUES ('$recipient_id', $cus_id, '$status', '$request_id')";
}

	
	if (mysqli_query($conn, $sqlsnv)) {}
	
	$sql = "INSERT INTO `tbl_sms_all_sent` (`cus_pay_id`, `sent_date`, `sms_text`, `delivery_status`, `recipient_id`, `request_id`)VALUES (0, '$sent_date', '$message', '$status', $recipient_id, '$request_id')";
	if (mysqli_query($conn, $sql)) {} ?>
	
	<span class="badge bg-success"><?php echo "Messege: ".$message; ?><span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
<?php }else{
	
	?>
	<span class="badge bg-danger"><?php echo "Code: ".$code. " | Error code: ".$message; ?><span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
<?php }	
}



}


if (isset($_POST['verification_CODE'])) 
  {
	$verification_CODE = $_POST['verification_CODE'];
	$customer_id = $_POST['customer_id'];
	
	$sqlLoc = "SELECT * FROM `tbl_sms_number_verification` WHERE `verification_CODE`='$verification_CODE' AND `customer_id`=$customer_id";
	$resultLoc = $conn->query($sqlLoc);
	if ($resultLoc->num_rows > 0) {
	while($rowLoc = $resultLoc->fetch_assoc()) 
	{
	$sms_verified = $rowLoc['sms_verified'];
	
	$sql = "UPDATE `tbl_sms_number_verification` SET 
		`status` = 1
		WHERE `sms_verified` = $sms_verified";
		if ($conn->query($sql) === TRUE) {
		echo 1; }
	}
	}else{ echo 2; }
	
  }

$conn->close(); 
?>

