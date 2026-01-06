<?php
include("../../../conf/db_connection.php");

if (isset($_POST['registerBTN'])) {
    $firstname = trim($_POST['first_name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $name = $firstname . " " . $surname;
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $user_type = $_POST['user_type'] ?? '';

    // Basic validation
    if (!$firstname || !$surname || !$email || !$phone || !$password || !$confirm_password || !$user_type) {
        header("Location: register.php?error=Please fill all fields.");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=Invalid email address.");
        exit();
    }
    if (strlen($password) < 6) {
        header("Location: register.php?error=Password must be at least 6 characters.");
        exit();
    }
    if ($password !== $confirm_password) {
        header("Location: register.php?error=Passwords do not match.");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM tbl_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        header("Location: register.php?error=Email already registered.");
        exit();
    }
    $stmt->close();

    // Insert user
    $hashed_password = md5($password); // For production, use password_hash!
    $login_session = bin2hex(random_bytes(16));
    $stmt = $conn->prepare("INSERT INTO tbl_users (full_name, email, phone, password, user_type, login_session) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $hashed_password, $user_type, $login_session);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: login.php?success=1");
        exit();
    } else {
        $errorMsg = urlencode("Registration failed: " . $stmt->error);
        $stmt->close();
        header("Location: register.php?error=$errorMsg");
        exit();
    }
}
header("Location: register.php");