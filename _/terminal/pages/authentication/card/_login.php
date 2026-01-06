<?php
session_start();
error_reporting(0);
include("../../../conf/db_connection.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM `tbl_users` WHERE `email`=? AND `password`=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $password);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($row = $result->fetch_assoc()) {
		$afia_authentication = $row["login_session"];
		$_SESSION['id'] = $row['user_id'];
		$_SESSION['role'] = $row['user_type'];

		setcookie("afia_authentication", $afia_authentication, time() + 31536000, "/");
		setcookie("afia_HQ", "BoX65456454HDFJHFHF66646464", time() + 31536000, "/");
		setcookie("FBMC_DEVSESSION", "FranklinBMC-HDGHDYYY6464645fgfggh", time() + 31536000, "/");
		setcookie("FMbdjjrewewew_USER_LOGIN", "dsssdsdAFIA774hh377747476vbbccDDSfbmcndyhh555", time() + 31536000, "/");

		// Redirect to index.php on success
		header("Location: ../../../index.php");
		exit();
	} else {
		// Redirect back to login with error
		header("Location: login.php?error=1");
		exit();
	}
}
header("Location: login.php");
exit();
