<?php
// include("conf/db_connection.php");
// $cookie_name = "afia_authentication";
// if(isset($_COOKIE[$cookie_name])) 
// {
// 	$qrcode=$_COOKIE[$cookie_name]; 

// 	$query = "SELECT * FROM `tbl_users` WHERE `link_id`='$qrcode'";
// 	$result = mysqli_query($conn,$query);	
// 	if ($result->num_rows > 0) {
// 	while($row = $result->fetch_assoc()) { 
// 	 }}

// 	 header("location: dashboard/default");

// }else{ header("location: pages/authentication/card/login"); }
?>
<?php
session_start();
$id = $_SESSION['id'];
$role = $_SESSION['role'];

include("conf/db_connection.php");
$cookie_name = "afia_authentication";
if (isset($_COOKIE[$cookie_name])) {
	$qrcode = $_COOKIE[$cookie_name];
	// Select user and roles
	$query = "SELECT * FROM `tbl_users` WHERE user_id = '$id' && user_type = '$role'";
	$result = mysqli_query($conn, $query);

	if ($result && $result->num_rows > 0) {
		$row = $result->fetch_assoc();

		// Redirect based on user_type
		switch ($row['user_type']) {
			case 1:
				header("Location: dashboard/superuser");
				break;
			case 2:
				header("Location: dashboard/admin");
				break;
			case 3:
				header("Location: dashboard/vendor-admin");
				break;
			case 4:
				header("Location: dashboard/vendor-user");
				break;
			default:
				header("Location: dashboard/default");
		}
		exit;
	} else {
		header("Location: pages/authentication/card/login");
		exit;
	}
} else {
	header("Location: pages/authentication/card/login");
	exit;
}
?>