<div class="col-xxl-9">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title text-uppercase">Billing & Payments</h5>
<div id="sucSave" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1" id="sucMsg"></p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSave" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1" id="errMsg"></p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase">Vendor: <?php echo $glob_vendor_title; ?><br />
		<span data-bs-toggle="modal" data-bs-target="#pickMonth" class="badge bg-success cursor-pointer">NOW SHOWING invoices: <?php if(isset($_GET['m'])){ echo date('F - Y', strtotime($_GET['m'])); }else { echo date('F - Y'); } ?> <span class="ms-1 far fa-calendar-alt" data-fa-transform="shrink-2"></span></span>
		
		</h5>
      </div>
	 <div class="col-6 col-sm-auto ms-auto text-end ps-0">

        <div id="table-number-pagination-replace-element">
		<button class="btn btn-falcon-default btn-sm mx-2" type="button" onClick="genInvoice()">
		<span class="fas fa-dollar-sign" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Genarate Invoice</span>
		</button>
		
		<button class="btn btn-falcon-default btn-sm mx-2" type="button" data-bs-toggle="modal" data-bs-target="#smsToAll">
		<span class="fas fa-sms" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Send debt sms to all</span>
		</button>
		
		</div>
      </div>
    
    </div>
  </div>
  <div class="card-body p-0">
    <div class="falcon-data-table">
<?php 
$sn=0; 
$sqlLoc = "SELECT * FROM `tbl_customer_payment`, `tbl_customers`, `tbl_customer_category`, `tbl_locations` WHERE `tbl_customer_payment`.`customer_id` = `tbl_customers`.`customer_id` AND `tbl_customer_category`.`customer_category_id` = `tbl_customers`.`customer_category_id` AND `tbl_customers`.`customer_location_id` = `tbl_locations`.`district_id` AND `tbl_customer_payment`.`invMonth`='$xdatex'";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
?>
      <table class="table table-sm mb-0 data-table fs-10" data-datatables='{"searching":true,"responsive":true,"pageLength":8,"info":true,"lengthChange":false,"dom":"<&#39;row mx-1&#39;<&#39;col-sm-12 col-md-6&#39;l><&#39;col-sm-12 col-md-6&#39;f>><&#39;table-responsive scrollbar&#39;tr><&#39;row no-gutters px-1 pb-3 align-items-center justify-content-center&#39;<&#39;col-auto&#39; p>>","language":{"paginate":{"next":"<span class=\"fas fa-chevron-right\"></span>","previous":"<span class=\"fas fa-chevron-left\"></span>"}}}'>
        <thead class="bg-200">
          <tr>
            
           
            <th class="text-900 sort pe-1 align-middle">Customer name</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Cust ID</th>
            <th class="text-900 sort pe-1 align-middle">Invoice No.</th>
		<th class="text-900 sort pe-1 align-middle">Inv Date </th>
		
		<th class="text-900 sort pe-1 align-middle ">Street</th>
		<th class="text-900 sort pe-1 align-middle">Inv. Month</th>
		<th class="text-900 sort pe-1 align-middle">Status</th>
        <th class="text-900 sort pe-1 align-middle text-end">Amount</th>    
          
		  <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th></tr>
        </thead>
        <tbody class="list" id="table-number-pagination-body">
<?php
while($row = $resultLoc->fetch_assoc()) {
$sn++;
	$district_id = $row['district_id'];
	$cpdc = $row['cus_pay_date_created'];	
$loc = $row['region']."->".$row['district']."->".$row['ward']."->".$row['street']; 
$fullname = $row['customer_first_name'].' '.$row['customer_mid_name'].' '.$row['customer_surname'];
$invMonth = $row['invMonth'];
$pay_status = $row['cus_pay_status'];
$pay_link_id =  $row['pay_link_id'];
$customer_link_id =  $row['customer_link_id'];
$cus_pay_id =  $row['cus_pay_id'];
$customer_id = $row['customer_id'];
$house_number = $row['house_number'];
$street = $row['street'];

?>          
		  <tr class="btn-reveal-trigger">
            
            <td class="align-middle fs-9"><?php echo $sn.". ".$fullname; ?></td>
			<td class="align-middle white-space-nowrap text-start fw-bold"><?php echo $row['custID']; ?></td>
            <td class="align-middle"><?php echo $row['cus_pay_invoice_no']; ?></td>
			<td class="align-middle"><?php echo date('d/m/Y', strtotime($cpdc)); ?></td>
			
			<td class="align-middle"><?php echo ucfirst(strtolower($row['street'])); ?></td>
			<td class="align-middle"><?php echo date('M Y', strtotime($invMonth)); ?></td>
			<td class="align-middle">
			<?php if($pay_status==0){ ?>
			<span id="justHide<?php echo $cus_pay_id; ?>" data-bs-toggle="modal" data-bs-target="#payInvoice<?php echo $cus_pay_id; ?>" class=" cursor-pointer badge badge rounded-pill badge-subtle-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span>
			</span>
			
			<span id="justShow<?php echo $cus_pay_id; ?>" style='display: none;' class="cursor-pointer badge badge rounded-pill badge-subtle-success">Paid<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
			</span>
			<?php } elseif($pay_status==1){ ?>
			<span data-bs-toggle="modal" data-bs-target="#payInvoice<?php echo $cus_pay_id; ?>" class="cursor-pointer badge badge rounded-pill badge-subtle-success">Paid<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
			<?php } ?>
			</td>
			<td class="align-middle text-end amount"><?php echo number_format($row['cus_pay_amount']); ?></td>
			
			
			<td class="align-middle white-space-nowrap text-end">
              <div class="dropstart font-sans-serif position-static d-inline-block"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown-number-pagination-table-item-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-number-pagination-table-item-0">
				<a class="dropdown-item" href="?invoice=<?php echo $pay_link_id; ?>">View Invoice</a>
                  <div class="dropdown-divider"></div>
				  <a class="dropdown-item text-warning" href="#" data-bs-toggle="modal" data-bs-target="#payInvoice<?php echo $cus_pay_id; ?>">Recieve Payment</a>
				  
                </div>
              </div>
            </td>
            
          </tr>

<div class="modal fade" id="payInvoice<?php echo $cus_pay_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center text-white">
		<span class="fas fa-dollar-sign text-dark fs-2"></span><br /><br />
		<h4 class="" >Recieve Payment</h4>
		<h4 class="h6" ><?php echo $fullname; ?> | House no. <?php echo $house_number; ?> | Street: <?php echo ucfirst(strtolower($street)); ?></h4>
		<hr class="my-1" />
<?php 
$gtinv = 0;
$sqlLoci = "SELECT * FROM `tbl_customer_payment` WHERE `customer_id`=$customer_id AND `cus_pay_status` = 0 ORDER BY `invMonth` DESC";
$resultLoci = $conn->query($sqlLoci);
if ($resultLoci->num_rows > 0) { ?>		
<ul class="list-group list-group-flush">
<?php
while($rowi = $resultLoci->fetch_assoc()) {
	$cus_pay_amountx = $rowi['cus_pay_amount'];	
	$invMonthx = $rowi['invMonth'];
	$cpid = $rowi['cus_pay_id'];
$gtinv = $cus_pay_amountx + $gtinv;	
?>
<div id="hideWhole<?php echo $cpid; ?>" >
  <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo "<strong>".date('F Y', strtotime($invMonthx))."</strong>"; ?>
  <span class=""><?php echo number_format($cus_pay_amountx); ?> <button  class="btn btn-falcon-primary btn-sm" onClick="shHi<?php echo $cpid; ?>()">&#9166;</button></span>
  </li>
  <div style="display: none" id="payNow<?php echo $cpid; ?>" class="input-group mb-3"><span class="input-group-text">Amount</span><input disabled value="<?php echo number_format($cus_pay_amountx); ?>" class="form-control" type="text" /><span class="cursor-pointer input-group-text" onClick="sendPay<?php echo $cpid; ?>()">Confirm</span></div>
</div>
<script>
function sendPay<?php echo $cpid; ?>(){
	const theAmount = '<?php echo $cus_pay_amountx; ?>';
	const cus_pay_id = '<?php echo $cpid; ?>';
	
	$.ajax({
			type: "POST",
			url: "../scripts/billing_CRUD.php",
			data: 
			{ 	
				theAmount: theAmount,
				cus_pay_id: cus_pay_id
			},
			cache: false,
			success: function(data) {
			var resp = data;
			if(resp == 1 ){
				document.getElementById('hideWhole<?php echo $cpid; ?>').style.display = 'none';
				document.getElementById('justShow<?php echo $cpid; ?>').style.display = '';
				document.getElementById('justHide<?php echo $cpid; ?>').style.display = 'none';
			}else {}
			}
	})
	
}


function shHi<?php echo $cpid; ?>() {
  const payNowDiv<?php echo $cpid; ?> = document.getElementById("payNow<?php echo $cpid; ?>");

  if (payNowDiv<?php echo $cpid; ?>.style.display === "none") {
    payNowDiv<?php echo $cpid; ?>.style.display = "";
  } else {
    payNowDiv<?php echo $cpid; ?>.style.display = "none";
  }
}
</script>
  
<?php } ?>  
  <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">Total unpaid:<span class=""><?php echo number_format($gtinv); ?> <button class="btn btn-falcon-primary btn-sm d-none" onClick="shHix<?php echo $cus_pay_id; ?>()">&#9166;</button></span></li>
  <div style="display: none" id="payNowx<?php echo $cus_pay_id; ?>" class="input-group mb-3"><span class="input-group-text">Amount</span><input value="<?php echo number_format($gtinv); ?>" class="form-control" type="text" /><span class="cursor-pointer input-group-text">Confirm</span></div>

<script>
function shHix<?php echo $cus_pay_id; ?>() {
  const payNowDivx<?php echo $cus_pay_id; ?> = document.getElementById("payNowx<?php echo $cus_pay_id; ?>");

  if (payNowDivx<?php echo $cus_pay_id; ?>.style.display === "none") {
    payNowDivx<?php echo $cus_pay_id; ?>.style.display = "";
  } else {
    payNowDivx<?php echo $cus_pay_id; ?>.style.display = "none";
  }
}
</script>
</ul>
<hr class="my-1" />
<?php }else { ?><center><span class="badge bg-success">All invoices are cleared<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span> <br />&nbsp;</center><?php } ?>
		
		<button class="btn btn-secondary w-100" type="cancel" data-bs-dismiss="modal" >Cancel</button>
      </div>
    </div>
  </div>
</div>




<?php } ?>
        </tbody>
      </table>
<?php }else{ echo '<center><span class="badge badge  badge-subtle-secondary">No Invoices generated for this particular month</span></center>';}?>
    </div>
  </div>
</div>
	
	
	
  </div>
</div>
			</div>

<div class="modal fade" id="pickMonth" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-6" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
          <h4 class="mb-1" id="staticBackdropLabel"></h4>
          
        </div>
        <div class="p-4">

			<div class="d-flex"><span class="fa-stack ms-n1 me-3"><i class="fas fa-circle fa-stack-2x text-200"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-calendar" data-fa-transform="shrink-2"></i></span>
                <div class="flex-1">
                  <h5 class="mb-2 fs-9">Year <?php echo date('Y'); ?></h5>
                  <div class="">
<?php
$currentYear = date('Y');
$currentMonth = date('m');


for ($month = 1; $month <= $currentMonth; $month++) {
    $monthName = date('F', mktime(0, 0, 0, $month, 1, $currentYear));
    $xdate = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
	
	?>
	
				  <span onClick="window.location='?m=<?php echo $xdate; ?> '" class="cursor-pointer badge py-1 <?php if(isset($_GET['m'])) { if($xdate == $xdatex){ echo 'bg-warning'; }else{ echo 'badge-subtle-primary'; }}else{ if($xdatex == $xdate) { echo 'bg-warning'; }else{ echo 'badge-subtle-primary'; }} ?>"><?php echo $monthName; ?></span>
<?php }?>
				  </div>
				   <hr class="my-4" />
				</div>
			</div>
			
			
			
              <div class="d-flex"><span class="fa-stack ms-n1 me-3"><i class="fas fa-circle fa-stack-2x text-200"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-calendar-alt" data-fa-transform="shrink-2"></i></span>
                <div class="flex-1">
                  <h5 class="mb-2 fs-9">Pick Month to show Bills & Payments</h5>
                  <div class="">
					<input value="<?php if(isset($_GET['m'])){ echo $_GET['m']; } ?>" onChange="dateChange();" class="form-control" id="datepicker" type="month" />
                  </div>
                </div>
              </div>
              
        </div>
      </div>
    </div>
  </div>
</div>


<script>
function dateChange(){
	const datepicker = document.getElementById('datepicker').value;
	
	if(datepicker !== ''){
		//alert(datepicker);
		window.location = '?m=' + datepicker;
	}
}

function genInvoice(){
		$.ajax({
			type: "POST",
			url: "../scripts/billing_CRUD.php",
			data: 
			{ 	
				createInvoice: <?php echo $glob_vendor_id; ?>,
				invMonth: '<?php if(isset($_GET['m'])) { echo $_GET['m']; }else { echo date('Y-m'); } ?>'
				

			},
			cache: false,
			success: function(data) {
			var resp = data;
			if(resp => 1 ){
				document.getElementById('sucSave').style.display = '';
				document.getElementById('sucMsg').innerHTML = 'Cost Location Successful added';
				window.location.reload();
			}else {
				document.getElementById('errSave').style.display = '';
				document.getElementById('errMsg').innerHTML = 'Error occured creating invoices, please try aging letter ' + resp;
			}
             			 
			}
		});
}
</script>

<div class="modal fade" id="smsToAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center text-white">
		<span class="fas fa-sms text-dark fs-2"></span><br /><br />
		<h4 class="" >Send SMS Notifications to All Customers</h4>
		<h1 class="h6">This action will send SMS reminders to all customers regarding both past and current unpaid payments.</h1>
		
		<br />

		<button id="freezeBTN" onClick="verify()" class="btn btn-success w-50 me-1 mb-1" type="button">Send Now</button>
		<button class="btn btn-secondary me-1 mb-1" type="cancel" data-bs-dismiss="modal" >Cancel</button>
		
		
      </div>
    </div>
  </div>
</div>