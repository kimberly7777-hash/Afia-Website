<?php
session_start();
include("../../conf/db_connection.php");
$baseUrl = '/_/terminal';

$id = $_SESSION['id'] ?? null;
$user = null;

if ($id) {
  // Use prepared statement with parameter binding for security
  $user_details_stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_id = ?");
  $user_details_stmt->bind_param("i", $id);
  $user_details_stmt->execute();
  $user_details_result = $user_details_stmt->get_result();
  $user = $user_details_result->fetch_assoc();
  $user_details_stmt->close();
}
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">


<!-- Mirrored from prium.github.io/falcon/v3.22.0/pages/user/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 16:07:18 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
  <title>Dashboard | Afia Terminals</title>

  <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicons/favicon.ico">
  <link rel="manifest" href="../../assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="../../assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">
  <script src="../../assets/js/config.js"></script>
  <script src="../../vendors/simplebar/simplebar.min.js"></script>

  <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
  <link href="../../vendors/glightbox/glightbox.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <link href="../../vendors/simplebar/simplebar.min.css" rel="stylesheet">
  <link href="../../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
  <link href="../../assets/css/theme.min.css" rel="stylesheet" id="style-default">
  <link href="../../assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
  <link href="../../assets/css/user.min.css" rel="stylesheet" id="user-style-default">

  <script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
      var linkDefault = document.getElementById('style-default');
      var userLinkDefault = document.getElementById('user-style-default');
      linkDefault.setAttribute('disabled', true);
      userLinkDefault.setAttribute('disabled', true);
      document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
      var linkRTL = document.getElementById('style-rtl');
      var userLinkRTL = document.getElementById('user-style-rtl');
      linkRTL.setAttribute('disabled', true);
      userLinkRTL.setAttribute('disabled', true);
    }
  </script>
</head>

<body>
  <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
  <main class="main" id="top">
    <div class="container" data-layout="container">
      <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
          var container = document.querySelector('[data-layout]');
          container.classList.remove('container');
          container.classList.add('container-fluid');
        }
      </script>

      <nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
        <script>
          var navbarStyle = localStorage.getItem("navbarStyle");
          if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
          }
        </script>
        <div class="d-flex align-items-center">
          <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
          </div>
          <a class="navbar-brand" href="<?php echo $baseUrl; ?>">
            <div class="d-flex align-items-center py-3"><img class="me-2" src="<?php echo $baseUrl; ?>/assets/img/afia-logo.png" alt="" width="100" /></div>
          </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
          <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl; ?>/dashboard">
                  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span></div>
                </a>
              </li>

              <li class="nav-item"><!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                  <div class="col-auto navbar-vertical-label">Settings</div>
                  <div class="col ps-0">
                    <hr class="mb-0 navbar-vertical-divider" />
                  </div>
                </div><!-- parent pages-->
                <a class="nav-link dropdown-indicator " href="#administration" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="email">
                  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cog"></span></span><span class="nav-link-text ps-1">Administration</span></div>
                </a>
                <ul class="nav collapse <?php if (strpos($linkURL, 'administration') !== false) {
                                          echo 'show';
                                        } ?>" id="administration">

                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'vendor-management') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/administration/vendor-management">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Contractors</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'customer-management') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/administration/customer-management">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Customers</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'user-management') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/administration/user-management">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Users </span></div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'sms-setup') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/administration/sms-setup">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">SMS API Setup</span></div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'billing-setup') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/administration/billing-setup">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Billing Setup</span></div>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item"><!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                  <div class="col-auto navbar-vertical-label">Application</div>
                  <div class="col ps-0">
                    <hr class="mb-0 navbar-vertical-divider" />
                  </div>
                </div><!-- parent pages-->
                <a class="nav-link dropdown-indicator" href="#application" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="email">
                  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cog"></span></span><span class="nav-link-text ps-1">Client Management</span></div>
                </a>
                <ul class="nav collapse <?php if (strpos($linkURL, 'application') !== false) {
                                          echo 'show';
                                        } ?>" id="application">

                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'my-sites') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/application/my-sites">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">My Clients</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'billing-payment') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/application/billing-payment">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Billing & Payments</span></div>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item"><!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                  <div class="col-auto navbar-vertical-label">General Planner</div>
                  <div class="col ps-0">
                    <hr class="mb-0 navbar-vertical-divider" />
                  </div>
                </div><!-- parent pages-->
                <a class="nav-link dropdown-indicator" href="#schedulling" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="email">
                  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cog"></span></span><span class="nav-link-text ps-1">Scheduling</span></div>
                </a>
                <ul class="nav collapse <?php if (strpos($linkURL, 'schedulling') !== false) {
                                          echo 'show';
                                        } ?>" id="schedulling">

                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'collection-schedull') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/schedulling/collection-schedull">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Collection Schedule</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if (strpos($linkURL, 'billing-payment') !== false) {
                                          echo 'active';
                                        } ?>" href="<?php echo $baseUrl; ?>/application/billing-payment">
                      <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Disposing Plan</span></div>
                    </a>
                  </li>

                </ul>
              </li>


            </ul>
          </div>
        </div>
      </nav>
      <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="<?php echo $baseUrl; ?>">
          <div class="d-flex align-items-center"><img class="me-2" src="<?php echo $baseUrl; ?>/assets/img/afia-logo.png" alt="" width="100" /></div>
        </a>
        <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
          <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dashboards">Dashboard</a>
              <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="dashboards">
                <div class="bg-white dark__bg-1000 rounded-3 py-2"><a class="dropdown-item link-600 fw-medium" href="../../index.html">Default</a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/analytics.html">Analytics</a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/crm.html">CRM</a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/e-commerce.html">E commerce</a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/lms.html">LMS<span class="badge rounded-pill ms-2 badge-subtle-success">New</span></a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/project-management.html">Management</a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/saas.html">SaaS</a><a class="dropdown-item link-600 fw-medium" href="../../dashboard/support-desk.html">Support desk<span class="badge rounded-pill ms-2 badge-subtle-success">New</span></a></div>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="content">
        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
          <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
          <a class="navbar-brand me-1 me-sm-3" href="<?php echo $baseUrl; ?>">
            <div class="d-flex align-items-center"><img class="me-2" src="<?php echo $baseUrl; ?>/assets/img/afia-logo.png" alt="" width="40" /></div>
          </a>
          <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
            <li class="nav-item ps-2 pe-0">
              <div class="dropdown theme-control-dropdown"><a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0" href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-sun fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></span><span class="fas fa-moon fs-7" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark"></span><span class="fas fa-adjust fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></span></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3" aria-labelledby="themeSwitchDropdown">
                  <div class="bg-white dark__bg-1000 rounded-2 py-2"><button class="dropdown-item d-flex align-items-center gap-2" type="button" value="light" data-theme-control="theme"><span class="fas fa-sun"></span>Light<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button><button class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark" data-theme-control="theme"><span class="fas fa-moon" data-fa-transform=""></span>Dark<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button><button class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto" data-theme-control="theme"><span class="fas fa-adjust" data-fa-transform=""></span>Auto<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button></div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                  <img class="rounded-circle" src="<?php echo $baseUrl; ?>/assets/img/team/avatar.png" alt="" />
                </div>
              </a>
              <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                  <a class="dropdown-item" href="#!">Set status</a>
                  <a class="dropdown-item" href="../../pages/user/profile.php">Profile &amp; account</a>
                  <a class="dropdown-item" href="#!">Feedback</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#!">Settings</a>
                  <a class="dropdown-item" href="../authentication/card/logout.html">Logout</a>
                </div>
              </div>
            </li>
          </ul>
        </nav>
        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;" data-move-target="#navbarVerticalNav" data-navbar-top="combo">
          <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
          <a class="navbar-brand me-1 me-sm-3" href="<?php echo $baseUrl; ?>">
            <div class="d-flex align-items-center"><img class="me-2" src="<?php echo $baseUrl; ?>/assets/img/afia-logo.png" alt="" width="100" /></div>
          </a>
        </nav>
        <script>
          var navbarPosition = localStorage.getItem('navbarPosition');
          var navbarVertical = document.querySelector('.navbar-vertical');
          var navbarTopVertical = document.querySelector('.content .navbar-top');
          var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
          var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
          var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

          if (localStorage.getItem('navbarPosition') === 'double-top') {
            document.documentElement.classList.toggle('double-top-nav-layout');
          }

          if (navbarPosition === 'top') {
            navbarTop.removeAttribute('style');
            navbarTopVertical.remove(navbarTopVertical);
            navbarVertical.remove(navbarVertical);
            navbarTopCombo.remove(navbarTopCombo);
            navbarDoubleTop.remove(navbarDoubleTop);
          } else if (navbarPosition === 'combo') {
            navbarVertical.removeAttribute('style');
            navbarTopCombo.removeAttribute('style');
            navbarTop.remove(navbarTop);
            navbarTopVertical.remove(navbarTopVertical);
            navbarDoubleTop.remove(navbarDoubleTop);
          } else if (navbarPosition === 'double-top') {
            navbarDoubleTop.removeAttribute('style');
            navbarTopVertical.remove(navbarTopVertical);
            navbarVertical.remove(navbarVertical);
            navbarTop.remove(navbarTop);
            navbarTopCombo.remove(navbarTopCombo);
          } else {
            navbarVertical.removeAttribute('style');
            navbarTopVertical.removeAttribute('style');
            navbarTop.remove(navbarTop);
            navbarDoubleTop.remove(navbarDoubleTop);
            navbarTopCombo.remove(navbarTopCombo);
          }
        </script>

        <div class="card mb-3">
          <div class="card-header position-relative min-vh-25 mb-7">
            <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(../../assets/img/generic/4.jpg);"></div><!--/.bg-holder-->
            <div class="avatar avatar-5xl avatar-profile">
              <img class="rounded-circle" src="<?php echo $baseUrl; ?>/assets/img/team/avatar.png" alt="" />
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8">
                <h5 class="fs-9 fw-normal">Full Name :
                  <?= $user ? htmlspecialchars($user['full_name']) : 'Unknown User' ?> <span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h4>
                </h5><br>
                <p class="text-500">E-mail : <?= $user ? $user['email'] : 'Unknown' ?></p>
                <p class="text-500">Phone Number : <?= $user ? $user['phone'] : 'Unknown' ?></p>
                <p class="text-500">
                  User Type :
                  <?php
                  if ($user) {
                    switch ($user['user_type']) {
                      case 1:
                        echo 'Super User';
                        break;
                      case 2:
                        echo 'Administrator';
                        break;
                      case 3:
                        echo 'Vendor Administrator';
                        break;
                      case 4:
                        echo 'Vendor User';
                        break;
                      default:
                        echo 'Unknown';
                    }
                  } else {
                    echo 'Unknown';
                  }
                  ?>
                </p>
                <!-- <button class="btn btn-falcon-primary btn-sm px-3" type="button">Following</button><button class="btn btn-falcon-default btn-sm px-3 ms-2" type="button">Message</button> -->
                <div class="border-bottom border-dashed my-4 d-lg-none"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-600">Developed & Maintained by Afia Orbit <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> <?php echo date('Y') ?> &copy; <a href="https://afiasolutions.co.tz/">Afia Orbit</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-600">v1.1.0</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </main><!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

  <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
  <script src="../../vendors/popper/popper.min.js"></script>
  <script src="../../vendors/bootstrap/bootstrap.min.js"></script>
  <script src="../../vendors/anchorjs/anchor.min.js"></script>
  <script src="../../vendors/is/is.min.js"></script>
  <script src="../../vendors/glightbox/glightbox.min.js"></script>
  <script src="../../vendors/fontawesome/all.min.js"></script>
  <script src="../../vendors/lodash/lodash.min.js"></script>
  <script src="../../vendors/list.js/list.min.js"></script>
  <script src="../../assets/js/theme.js"></script>
</body>


<!-- Mirrored from prium.github.io/falcon/v3.22.0/pages/user/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 16:07:25 GMT -->

</html>