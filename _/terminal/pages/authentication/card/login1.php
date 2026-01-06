<?php
error_reporting(0);
session_start();
include("../../../conf/db_connection.php");

$login_error = '';

if (isset($_POST['loginBtn'])) {
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $login_error = 'Please enter a valid email address.';
  } elseif ($password === '') {
    $login_error = 'Password field cannot be empty.';
  } else {
    $hashed_password = md5($password); // For production, use password_hash!
    $sql = "SELECT * FROM `tbl_users` WHERE `email`=? AND `password`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      // Set cookies
      setcookie("afia_authentication", $row["login_session"], time() + 31536000, "/");
      setcookie("afia_HQ", "BoX65456454HDFJHFHF66646464", time() + 31536000, "/");
      setcookie("FBMC_DEVSESSION", "FranklinBMC-HDGHDYYY6464645fgfggh", time() + 31536000, "/");
      setcookie("FMbdjjrewewew_USER_LOGIN", "dsssdsdAFIA774hh377747476vbbccDDSfbmcndyhh555", time() + 31536000, "/");
      header("Location: ../../../index.php");
      exit();
    } else {
      $login_error = 'Email and Password combination do not match';
    }
    $stmt->close();
  }
}
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AFIA Terminals | Dashboard</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="../../../assets/img/favicons/favicon.ico">
  <link rel="manifest" href="../../../assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="../../../assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <link href="../../../vendors/simplebar/simplebar.min.css" rel="stylesheet">
  <link href="../../../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
  <link href="../../../assets/css/theme.min.css" rel="stylesheet" id="style-default">
  <link href="../../../assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
  <link href="../../../assets/css/user.min.css" rel="stylesheet" id="user-style-default">
</head>

<body>
  <main class="main" id="top">
    <div class="container-fluid">
      <div class="row min-vh-100 flex-center g-0">
        <div class="col-lg-8 col-xxl-5 py-3 position-relative">
          <img class="bg-auth-circle-shape" src="../../../assets/img/icons/spot-illustrations/bg-shape.png" alt="" width="250">
          <img class="bg-auth-circle-shape-2" src="../../../assets/img/icons/spot-illustrations/shape-1.png" alt="" width="150">
          <div class="card overflow-hidden z-1">
            <div class="card-body p-0">
              <div class="row g-0 h-100">
                <div class="col-md-5 text-center " style="background-color: #197A7B;">
                  <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                    <div class="bg-holder bg-auth-card-shape" style="background-image:url(../../../assets/img/icons/spot-illustrations/half-circle.png);"></div>
                    <div class="z-1 position-relative">
                      <a class="link-light mb-4 font-sans-serif fs-5 d-inline-block fw-bolder" href="#"><img src="../../../assets/img/afia-logo.png" width="200" /></a>
                      <p class="opacity-75 text-white"></p>
                    </div>
                  </div>
                  <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                    <p class="text-white">Afia Terminal. Ver 1.34.2<br><a class="text-decoration-underline link-light" href="https://franklin.co.tz/afia-terminal">Waste Collection Manager</a></p>
                  </div>
                </div>
                <div class="col-md-7 d-flex flex-center">
                  <div class="p-4 p-md-5 flex-grow-1">
                    <div class="row flex-between-center">
                      <div class="col-auto">
                        <h3>Account Login</h3>
                        <?php if ($login_error): ?>
                          <div class="text-danger fw-bold" id="wrongCredentials"><?php echo $login_error; ?></div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <form method="post" autocomplete="off">
                      <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input class="form-control" id="email" name="email" type="text" inputmode="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
                      </div>
                      <div class="mb-3">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="password">Password</label>
                        </div>
                        <input class="form-control" id="password" name="password" type="password" required />
                      </div>
                      <div class="row flex-between-center">
                        <div class="col-auto">
                          <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="card-checkbox" checked="checked" /><label class="form-check-label mb-0" for="card-checkbox">Remember me</label></div>
                        </div>
                        <div class="col-auto"><a class="fs-10" href="forgot-password">Forgot Password?</a></div>
                      </div>
                      <div class="mb-3">
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="loginBtn">Log in</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../../../vendors/popper/popper.min.js"></script>
  <script src="../../../vendors/bootstrap/bootstrap.min.js"></script>
  <script src="../../../vendors/anchorjs/anchor.min.js"></script>
  <script src="../../../vendors/is/is.min.js"></script>
  <script src="../../../vendors/fontawesome/all.min.js"></script>
  <script src="../../../vendors/lodash/lodash.min.js"></script>
  <script src="../../../vendors/list.js/list.min.js"></script>
  <script src="../../../assets/js/theme.js"></script>
</body>

</html>