<?php 
$invoice = $_GET['invoice'];
$sqlLoc = "SELECT * FROM `tbl_customer_payment`, `tbl_customers`, `tbl_customer_category`, `tbl_locations` WHERE `tbl_customer_payment`.`customer_id` = `tbl_customers`.`customer_id` AND `tbl_customer_category`.`customer_category_id` = `tbl_customers`.`customer_category_id` AND `tbl_customers`.`customer_location_id` = `tbl_locations`.`district_id` AND `tbl_customer_payment`.`pay_link_id`='$invoice'";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
while($row = $resultLoc->fetch_assoc()) {

	$district_id = $row['district_id'];
	$cpdc = $row['cus_pay_date_created'];	
$loc = $row['district'].", ".$row['region'];
$loc2 = $row['street'].", ".$row['ward']; 

$fullname = $row['customer_first_name'].' '.$row['customer_mid_name'].' '.$row['customer_surname'];
$invMonth = $row['invMonth'];
$cus_pay_date_created = $row['cus_pay_date_created'];
$house_number = $row['house_number'];
$pay_status = $row['cus_pay_status'];
$customer_email = $row['customer_email'];
$customer_phone = $row['customer_phone'];
$cus_pay_invoice_nox =  $row['cus_pay_invoice_no'];
$customer_category_title = $row['customer_category_title'];
$cus_pay_amount = $row['cus_pay_amount'];
}}
?>
<style>
 @media print {
            body * { /* Important: Target all elements within the body */
                visibility: hidden; /* Hide everything by default */
            }

            .printable-area, .printable-area * { /* Show only the printable area and its children */
                visibility: visible;
            }

            .printable-area {
                position: absolute; /* Necessary for correct positioning */
                left: 0;
                top: 0;
                margin: 0;
                padding: 10mm; /* Add some padding if needed */
            }

           

           
        }
</style>
<div class="col-xxl-9">
<div class="card mb-3 no-print">
            <div class="card-body">
              <div class="row justify-content-between align-items-center">
                <div class="col-md">
                  <h5 class="mb-2 mb-md-0">Inv. #<?php echo $cus_pay_invoice_nox; ?></h5>
                </div>
                <div class="col-auto"><button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button"><span class="fas fa-arrow-down me-1"> </span>Download (.pdf)</button><button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button"><span class="fas fa-print me-1"> </span>Print</button><button class="btn btn-falcon-success btn-sm mb-2 mb-sm-0" type="button"><span class="fas fa-dollar-sign me-1"></span>Receive Payment</button></div>
              </div>
            </div>
          </div>
          <div class="card printable-area">
            <div class="card-body">
              <div class="row align-items-center text-center mb-3">
                <div class="col-sm-6 text-sm-start"></div>
                <div class="col text-sm-end mt-3 mt-sm-0">
                  <h2 class="mb-3">Invoice</h2>
                  <h5><?php echo $glob_vendor_title; ?></h5>
				  <p class="fs-10 mb-0"><?php echo $glob_vendor_email; ?></p>
				  <p class="fs-10 mb-0"><?php echo $glob_vendor_phone; ?></p>
                  <p class="fs-10 mb-0"><?php echo $glob_vendor_address; ?><br />Tanzania</p>
                </div>
                <div class="col-12">
                  <hr />
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-500">Invoice to</h6>
                  <h5><?php echo $fullname; ?></h5>
                  <p class="fs-10">House no. <?php echo $house_number.", ".$loc2; ?>,<br /><?php echo $loc; ?><br />Tanzania.</p>
                  <p class="fs-10"><a href="mailto:<?php echo $customer_email; ?>"><?php echo $customer_email; ?></a><br /><a href="tel:<?php echo $customer_phone; ?>"><?php echo $customer_phone; ?></a></p>
                </div>
                <div class="col-sm-auto ms-auto">
                  <div class="table-responsive">
                    <table class="table table-sm table-borderless fs-10">
                      <tbody>
                        <tr>
                          <th class="text-sm-end">Invoice No:</th>
                          <td><?php echo $cus_pay_invoice_nox; ?></td>
                        </tr>
                        
                        <tr>
                          <th class="text-sm-end">Invoice Date:</th>
                          <td><?php echo date('d-m-Y', strtotime($cus_pay_date_created)) ?></td>
                        </tr>
						<tr>
                          <th class="text-sm-end">Cetegory:</th>
                          <td><?php echo $customer_category_title; ?></td>
                        </tr>
						<tr>
                          <th class="text-sm-end">Collection Month:</th>
                          <td><?php echo date('F, Y', strtotime($invMonth)) ?></td>
                        </tr>
                        <tr>
                          <th class="text-sm-end">Payment Due:</th>
                          <td>Upon receipt</td>
                        </tr>
                        <tr class="alert alert-success fw-bold">
                          <th class="text-success-emphasis text-sm-end">Amount Due:</th>
                          <td class="text-success-emphasis"><?php echo number_format($cus_pay_amount, 2); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="table-responsive scrollbar mt-4 fs-10">
                <table class="table table-striped border-bottom">
                  <thead data-bs-theme="light">
                    <tr class="bg-primary dark__bg-1000">
                      <th class="text-white border-0">Service title</th>
                      <th class="text-white border-0 text-center">Quantity</th>
                      <th class="text-white border-0 text-end">Rate</th>
                      <th class="text-white border-0 text-end">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle">
                        <h6 class="mb-0 text-nowrap">Monthly waste collection payment</h6>
                        <p class="mb-0"><?php echo $customer_category_title; ?></p>
                      </td>
                      <td class="align-middle text-center">1</td>
                      <td class="align-middle text-end"><?php echo number_format($cus_pay_amount, 2); ?></td>
                      <td class="align-middle text-end"><?php echo number_format($cus_pay_amount, 2); ?></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="row justify-content-end">
                <div class="col-auto">
                  <table class="table table-sm table-borderless fs-10 text-end">
                    <tr>
                      <th class="text-900">Subtotal:</th>
                      <td class="fw-semi-bold"><?php echo number_format($cus_pay_amount, 2); ?> </td>
                    </tr>
                    
                    <tr class="border-top">
                      <th class="text-900">Total:</th>
                      <td class="fw-semi-bold"><?php echo number_format($cus_pay_amount, 2); ?></td>
                    </tr>
                    <tr class="border-top border-top-2 fw-bolder">
                      <th class="text-900">Amount Due:</th>
                      <td class="text-900"><?php echo number_format($cus_pay_amount, 2); ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer bg-body-tertiary">
              <p class="fs-10 mb-0"><strong>Notes: </strong>We really appreciate your business and if there’s anything else we can do, please let us know!</p>
            </div>
          </div>
          
  

</div>
