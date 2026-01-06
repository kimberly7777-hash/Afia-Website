<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Afia Terminal</title>
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
  <style>
    .step {
      display: none;
    }

    .step.active {
      display: block;
    }

    .step-buttons {
      margin-top: 1rem;
    }
  </style>
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
                <div class="col-md-5 text-center bg-card-gradient">
                  <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                    <div class="bg-holder bg-auth-card-shape" style="background-image:url(../../../assets/img/icons/spot-illustrations/half-circle.png);"></div>
                    <div class="z-1 position-relative">
                      <a class="link-light mb-4 font-sans-serif fs-5 d-inline-block fw-bolder" href="../../../index.html">falcon</a>
                      <p class="opacity-75 text-white">With the power of Falcon, you can now focus only on functionaries for your digital products, while leaving the UI design on us!</p>
                    </div>
                  </div>
                  <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                    <p class="pt-3 text-white">Have an account?<br><a class="btn btn-outline-light mt-2 px-4" href="login.php">Log In</a></p>
                  </div>
                </div>
                <div class="col-md-7 d-flex flex-center">
                  <div class="p-4 p-md-5 flex-grow-1">
                    <h3>Register</h3>
                    <?php if (isset($_GET['error'])): ?>
                      <div class="alert alert-danger">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                      </div>
                    <?php elseif (isset($_GET['success'])): ?>
                      <div class="alert alert-success">Registration successful! <a href="login.php">Login here</a>.</div>
                    <?php endif; ?>

                    <form id="registerForm" method="post" action="_register.php" autocomplete="off" novalidate>
                      <!-- Step 1 -->
                      <div class="step active" id="step-1">
                        <div class="mb-3">
                          <label class="form-label" for="card-name">First Name</label>
                          <input class="form-control" type="text" id="card-name" name="first_name" required />
                          <div class="invalid-feedback">Please enter your first name.</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="card-surname">Surname</label>
                          <input class="form-control" type="text" id="card-surname" name="surname" required />
                          <div class="invalid-feedback">Please enter your surname.</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="card-email">Email address</label>
                          <input class="form-control" type="email" id="card-email" name="email" required />
                          <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="step-buttons">
                          <button type="button" class="btn btn-primary w-100" id="next-1">Next</button>
                        </div>
                      </div>
                      <!-- Step 2 -->
                      <div class="step" id="step-2">
                        <div class="mb-3">
                          <label class="form-label" for="card-phone">Phone Number</label>
                          <input class="form-control" type="number" id="card-phone" name="phone" required />
                          <div class="invalid-feedback">Please enter a valid phone number.</div>
                        </div>
                        <div class="row gx-2">
                          <div class="mb-3 col-sm-6">
                            <label class="form-label" for="card-password">Password</label>
                            <input class="form-control" type="password" id="card-password" name="password" required minlength="6" />
                            <div class="invalid-feedback">Password must be at least 6 characters.</div>
                          </div>
                          <div class="mb-3 col-sm-6">
                            <label class="form-label" for="card-confirm-password">Confirm Password</label>
                            <input class="form-control" type="password" id="card-confirm-password" name="confirm_password" required />
                            <div class="invalid-feedback">Passwords do not match.</div>
                          </div>
                        </div>
                        <div class="step-buttons d-flex justify-content-between">
                          <button type="button" class="btn btn-secondary" id="prev-2">Previous</button>
                          <button type="button" class="btn btn-primary" id="next-2">Next</button>
                        </div>
                      </div>
                      <!-- Step 3 -->
                      <div class="step" id="step-3">
                        <div class="mb-3">
                          <label class="form-label" for="card-type">User Type</label>
                          <select class="form-control" id="card-type" name="user_type" required>
                            <option value="">Select User Type</option>
                            <?php
                            include_once("../../../conf/db_connection.php");
                            if ($conn) {
                              $user_type_query = $conn->query("SELECT user_type_id, title FROM tbl_user_types");
                              if ($user_type_query && $user_type_query->num_rows > 0) {
                                while ($row = $user_type_query->fetch_assoc()) {
                                  echo "<option value='" . $row['user_type_id'] . "'>" . $row['title'] . "</option>";
                                }
                              }
                            }
                            ?>
                          </select>
                          <div class="invalid-feedback">Please select a user type.</div>
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" id="card-register-checkbox" required />
                          <label class="form-label" for="card-register-checkbox">
                            I accept the <a href="#!">terms</a> and <a class="white-space-nowrap" href="#!">privacy policy</a>
                          </label>
                          <div class="invalid-feedback">You must accept the terms and privacy policy.</div>
                        </div>
                        <div class="mb-3">
                          <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="registerBTN">Register</button>
                        </div>
                        <div class="step-buttons">
                          <button type="button" class="btn btn-secondary w-100" id="prev-3">Previous</button>
                        </div>
                      </div>
                    </form>
                    <div class="position-relative mt-4">
                      <hr />
                      <div class="divider-content-center">or register with</div>
                    </div>
                    <div class="row g-2 mt-2">
                      <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
                      <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a></div>
                    </div>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const steps = Array.from(document.querySelectorAll('.step'));
      let currentStep = 0;

      function showStep(index) {
        steps.forEach((step, i) => {
          step.classList.toggle('active', i === index);
        });
        currentStep = index;
      }

      // Step 1 -> Step 2
      document.getElementById('next-1').onclick = function(e) {
        e.preventDefault();
        const name = document.getElementById('card-name');
        const surname = document.getElementById('card-surname');
        const email = document.getElementById('card-email');
        let valid = true;
        //  First name
        if (!name.value.trim()) {
          name.classList.add('is-invalid');
          valid = false;
        } else {
          name.classList.remove('is-invalid');
        }
        // Surname
        if (!surname.value.trim()) {
          surname.classList.add('is-invalid');
          valid = false;
        } else {
          surname.classList.remove('is-invalid');
        }
        // E-mail
        if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
          email.classList.add('is-invalid');
          valid = false;
        } else {
          email.classList.remove('is-invalid');
        }
        if (valid) showStep(1);
      };

      // Step 2 -> Step 3
      document.getElementById('next-2').onclick = function(e) {
        e.preventDefault();
        const phone = document.getElementById('card-phone');
        const password = document.getElementById('card-password');
        const confirm = document.getElementById('card-confirm-password');
        let valid = true;

        if (!phone.value || phone.value.length < 6 || phone.value.length > 13) {
          phone.classList.add('is-invalid');
          valid = false;
        } else {
          phone.classList.remove('is-invalid');
        }
        if (!password.value || password.value.length < 6) {
          password.classList.add('is-invalid');
          valid = false;
        } else {
          password.classList.remove('is-invalid');
        }
        if (password.value !== confirm.value || !confirm.value) {
          confirm.classList.add('is-invalid');
          valid = false;
        } else {
          confirm.classList.remove('is-invalid');
        }
        if (valid) showStep(2);
      };

      // Step 2 <- Step 1
      document.getElementById('prev-2').onclick = function(e) {
        e.preventDefault();
        showStep(0);
      };

      // Step 3 <- Step 2
      document.getElementById('prev-3').onclick = function(e) {
        e.preventDefault();
        showStep(1);
      };

      // Final submit validation
      document.getElementById('registerForm').addEventListener('submit', function(e) {
        const userType = document.getElementById('card-type');
        const checkbox = document.getElementById('card-register-checkbox');
        let valid = true;
        if (!userType.value) {
          userType.classList.add('is-invalid');
          valid = false;
        } else {
          userType.classList.remove('is-invalid');
        }
        if (!checkbox.checked) {
          checkbox.classList.add('is-invalid');
          valid = false;
        } else {
          checkbox.classList.remove('is-invalid');
        }
        if (!valid) e.preventDefault();
      });
    });
  </script>
</body>

</html>