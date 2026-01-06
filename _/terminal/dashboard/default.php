<?php 
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');
?>

        <div class="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
            <div class="col-xxl-9">
              <div class="card rounded-3 overflow-hidden h-100">
                <div class="card-body bg-line-chart-gradient d-flex flex-column justify-content-between">
                  <div class="row align-items-center g-0">
                    <div class="col" data-bs-theme="light">
                      <h4 class="text-white mb-0">Today $764.39</h4>
                      <p class="fs-10 fw-semi-bold text-white">Yesterday <span class="opacity-50">$684.87</span></p>
                    </div>
                    <div class="col-auto d-none d-sm-block"><select class="form-select form-select-sm mb-3" id="dashboard-chart-select">
                        <option value="all">All Payments</option>
                        <option value="successful" selected="selected">Successful Payments</option>
                        <option value="failed">Failed Payments</option>
                      </select></div>
                  </div><!-- Find the JS file for the following calendar at: src/js/charts/echarts/line-payment.js--><!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                  <div class="echart-line-payment" style="height:200px" data-echart-responsive="true"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row g-3">
                <div class="col-md-4 col-xxl-12">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row flex-between-center g-0">
                        <div class="col-6 d-lg-block flex-between-center">
                          <h6 class="mb-2 text-900">Active Users</h6>
                          <h4 class="fs-6 fw-normal text-700 mb-0">765k</h4>
                        </div>
                        <div class="col-auto h-100">
                          <div style="height:50px;min-width:80px;" data-echarts='{"xAxis":{"show":false,"boundaryGap":false},"series":[{"data":[3,7,6,8,5,12,11],"type":"line","symbol":"none"}],"grid":{"right":"0px","left":"0px","bottom":"0px","top":"0px"}}'></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xxl-12">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row flex-between-center">
                        <div class="col d-md-flex d-lg-block flex-between-center">
                          <h6 class="mb-md-0 mb-lg-2">Revenue</h6><span class="badge rounded-pill badge-subtle-success"><span class="fas fa-caret-up"></span> 61.8%</span>
                        </div>
                        <div class="col-auto">
                          <h4 class="fs-6 fw-normal text-700" data-countup='{"endValue":82.18,"decimalPlaces":2,"suffix":"M","prefix":"$"}'>0</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xxl-12">
                  <div class="card h-100">
                    <div class="card-body">
                      <?php
					  function generateUniqueNumber($min = 100000, $max = 999999) {
    return random_int($min, $max);
}

$uniqueNumber = generateUniqueNumber();

echo $uniqueNumber;
					  ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          

<?php include('../incl/footer.php'); ?>