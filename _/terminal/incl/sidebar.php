<?php
$baseUrl = '/_/terminal';
?>

</div>
</div>
</nav>
<nav class="no-print navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
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

        <a class="nav-link" href="<?php echo $baseUrl; ?>/dashboard">
          <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span></div>
        </a>

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

    </div>
  </div>
</nav>

<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
</nav>