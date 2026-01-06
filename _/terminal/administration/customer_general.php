<div class="col-xxl-9">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title text-uppercase">Customers</h5>
    
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase">Registered customers </h5>
      </div>
      <div class="col-6 col-sm-auto ms-auto text-end ps-0">
        <div class="d-none" id="table-number-pagination-actions">
          <div class="d-flex"><select class="form-select form-select-sm" aria-label="Bulk actions">
              <option selected="">Bulk actions</option>
              <option value="Refund">Refund</option>
              <option value="Delete">Delete</option>
              <option value="Archive">Archive</option>
            </select><button class="btn btn-falcon-default btn-sm ms-2" type="button">Apply</button></div>
        </div>
        <div id="table-number-pagination-replace-element">
		<button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#newCustomer">
		<span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">New</span>
		</button>
		<button data-bs-toggle="modal" data-bs-target="#cusCategory" class="btn btn-falcon-default btn-sm mx-2" type="button"><span class="fas fa-filter" data-fa-transform="shrink-3 down-2" ></span>
		<span class="d-none d-sm-inline-block ms-1">Customer Category</span></button>
		<button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Export</span></button>
		</div>
      </div>
    
	</div>
  </div>
  <div class="card-body p-0">
    <div class="falcon-data-table">
      <table class="table table-sm mb-0 data-table fs-10" data-datatables='{"searching":true,"responsive":true,"pageLength":8,"info":true,"lengthChange":false,"dom":"<&#39;row mx-1&#39;<&#39;col-sm-12 col-md-6&#39;l><&#39;col-sm-12 col-md-6&#39;f>><&#39;table-responsive scrollbar&#39;tr><&#39;row no-gutters px-1 pb-3 align-items-center justify-content-center&#39;<&#39;col-auto&#39; p>>","language":{"paginate":{"next":"<span class=\"fas fa-chevron-right\"></span>","previous":"<span class=\"fas fa-chevron-left\"></span>"}}}'>
        <thead class="bg-200">
          <tr>
            <th class="text-900 no-sort white-space-nowrap" data-orderable="false">
              <div class="form-check mb-0 d-flex align-items-center"><input class="form-check-input" id="checkbox-bulk-table-item-select" type="checkbox" data-bulk-select='{"body":"table-number-pagination-body","actions":"table-number-pagination-actions","replacedElement":"table-number-pagination-replace-element"}' /></div>
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap">Customer name</th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Customer ID</th>
			
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Phone</th>
			
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">House No.</th>
			
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Category.</th>
            
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Site Location</th>
            
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Status</th>
            <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
          </tr>
        </thead>
        <tbody class="list" id="table-number-pagination-body">
<?php 
$sql = "SELECT * FROM `tbl_customers`, `tbl_locations`, `tbl_customer_category` WHERE `tbl_customers`.`customer_location_id` = `tbl_locations`.`district_id` AND `tbl_customers`.`customer_category_id` = `tbl_customer_category`.`customer_category_id` ORDER BY `tbl_customers`.`customer_id` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$fullname = $row['customer_first_name'].' '.$row['customer_mid_name'].' '.$row['customer_surname'];
	$loc = $row['region']."->".$row['district']."->".$row['ward']."->".$row['street'];
	
	$cus_id = $row['customer_id'];
	$customer_phone = $row['customer_phone'];
	$custID = $row['custID'];
	$street =  $row['street'];
	$customer_link_id =  $row['customer_link_id'];
	$customer_category_title = $row['customer_category_title'];
	$pv = 0;
	$sqlLoc = "SELECT * FROM `tbl_sms_number_verification` WHERE `customer_id`=$cus_id";
	$resultLoc = $conn->query($sqlLoc);
	if ($resultLoc->num_rows > 0) {
	while($rowLoc = $resultLoc->fetch_assoc()) { $pv = $rowLoc['status']; }}
	
	
?>          
		  <tr  id="trRem<?php echo $cus_id; ?>" class="btn-reveal-trigger">
            <td class="align-middle" style="width: 28px;">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="number-pagination-item-0" data-bulk-select-row="data-bulk-select-row" /></div>
            </td>
            <td class="align-middle white-space-nowrap fw-semi-bold name"><a href="#"><?php echo $fullname; ?></a></td>
            <td class="align-middle white-space-nowrap text-start fw-bold"><?php echo $row['custID']; ?></td>
			<td class="align-middle white-space-nowrap text-start phone"><?php echo $row['customer_phone']; ?></td>
			
			<td class="align-middle text-start fw-bold"><?php echo $row['house_number']; ?></td>
			
			<td class="align-middle text-start fw-bold"><?php echo $row['customer_category_title']; ?></td>
			
            
            <td class="align-middle text-start fs-9 white-space-nowrap payment">
<?php
echo '<span class="badge badge badge-subtle-success">'.$loc.'</span>';
?> 
			
			</td>
            
			
			<td class="align-middle text-start fw-bold"><?php if($pv==1){ echo '<span class="badge badge  badge-subtle-success">Verified<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>'; }else { echo '<span class="cursor-pointer badge badge  badge-subtle-danger" data-bs-toggle="modal" data-bs-target="#smsVerify'.$cus_id.'">Verify now<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>'; }  ?></td>
			
            <td class="align-middle white-space-nowrap text-end">
              <div class="dropstart font-sans-serif position-static d-inline-block"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown-number-pagination-table-item-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-number-pagination-table-item-0"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="?edit=<?php echo $customer_link_id; ?>">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a>
				  <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#custDel<?php echo $cus_id; ?>">Delete</a>
                </div>
              </div>
            </td>
          </tr>
<div class="modal fade" id="smsVerify<?php echo $cus_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center text-white">
		<span class="fas fa-sms text-dark fs-2"></span><br /><br />
		<h4 class="" >Verify Customer</h4>
		<h6 class="text-uppercase">Customer: <?php echo $fullname; ?></h6>
		<h6 class="text-uppercase">Street: <?php echo $row['street']; ?></h6>
		<br />
		<div  id="showErr<?php echo $cus_id; ?>"></div>
		<br />

		<button id="freezeBTN<?php echo $cus_id; ?>" onClick="verify<?php echo $cus_id; ?>()" class="btn btn-success w-50 me-1 mb-1" type="button">Send Verification code</button>
		<button class="btn btn-secondary me-1 mb-1" type="cancel" data-bs-dismiss="modal" >Cancel</button>
		
		<hr class="my-4" />
		<div class="input-group mb-0">
		<span class="input-group-text">ENTER CODE</span><input onKeyup="codeVerificationx<?php echo $cus_id; ?>()" id="codeVerification<?php echo $cus_id; ?>" maxlength="6" placeholder="_ _ _ _ _ _" class="form-control text-center" type="text" inputmode="numeric" /><span class="input-group-text"><button onClick="chkVerifyBtn<?php echo $cus_id; ?>()" class="btn btn-primary w-100">VERIFY</button></span>
		</div>
		<div id="errcodeVerification<?php echo $cus_id; ?>" class="text-start text-danger mb-0"></div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="custDel<?php echo $cus_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content bg-danger">
      <div class="modal-body text-center text-white">
		<span class="fas fa-exclamation-circle text-white fs-2"></span><br /><br />
		<h4 class="text-white " >Confirm Delete</h4>
		<h6 class="text-white"><?php echo $fullname; ?></h6>
		<br />
		<button onClick="del<?php echo $cus_id; ?>()" class="btn btn-falcon-success w-50" type="button">Delete</button>
		<button class="btn btn-falcon-primary me-1 mb-1" type="cancel" data-bs-dismiss="modal" >Cancel</button>
		
      </div>
    </div>
  </div>
</div>

<script>
function codeVerificationx<?php echo $cus_id; ?>(){
	codeVerification<?php echo $cus_id; ?>.style.borderColor = '';
	errcodeVerification<?php echo $cus_id; ?>.innerHTML = '';
}

function chkVerifyBtn<?php echo $cus_id; ?>()
{
	var codeVerification<?php echo $cus_id; ?> = document.getElementById('codeVerification<?php echo $cus_id; ?>');
	
	var errcodeVerification<?php echo $cus_id; ?> = document.getElementById('errcodeVerification<?php echo $cus_id; ?>');
	
	if(codeVerification<?php echo $cus_id; ?>.value == ''){
		codeVerification<?php echo $cus_id; ?>.style.borderColor = 'red';
		errcodeVerification<?php echo $cus_id; ?>.innerHTML = 'Enter SMS code to verify';
		codeVerification<?php echo $cus_id; ?>.focus();
		return false;
	}
	
	$.ajax({
            type: "POST",
            url: "../scripts/sms_CRUD.php",
            data: {
				
				customer_id: <?php echo $cus_id; ?>,
				verification_CODE: codeVerification<?php echo $cus_id; ?>.value
			},
            success: function(response) {
				var resp = response;
				if(resp == 1){
					
					$('#smsVerify<?php echo $cus_id; ?>').modal('hide');
					$('#succSMSVerify').modal('show');
	
				}else{
					
					$('#errSMSVerify').modal('show');
				}
                
            }
        });
	
	
}
function verify<?php echo $cus_id; ?>()
{
	const freezeBtn<?php echo $cus_id; ?> = document.getElementById("freezeBTN<?php echo $cus_id; ?>");
    freezeBtn<?php echo $cus_id; ?>.disabled = true;
	 $.ajax({
            type: "POST",
            url: "../scripts/sms_CRUD.php",
            data: {
				
				verifyID: <?php echo $cus_id; ?>,
				fullname: '<?php echo $fullname; ?>',
				customer_phone: '<?php echo $customer_phone; ?>',
				custID: '<?php echo $custID; ?>',
				street: '<?php echo $street; ?>'
				
				
			},
            success: function(response) {
				var resp = response;
				
				if (resp.includes("100")) {
					freezeBtn<?php echo $cus_id; ?>.disabled = true;
					document.getElementById('showErr<?php echo $cus_id; ?>').style.color = 'green';
					document.getElementById('showErr<?php echo $cus_id; ?>').innerHTML = resp;
				
				}else{
				
				document.getElementById('showErr<?php echo $cus_id; ?>').style.color = 'red';
				document.getElementById('showErr<?php echo $cus_id; ?>').innerHTML = resp; 
				freezeBtn<?php echo $cus_id; ?>.disabled = false;
            }}
        });
}
function del<?php echo $cus_id; ?>()
{
	 $.ajax({
            type: "POST",
            url: "../scripts/customer_CRUD.php",
            data: {
				
				custDelete: <?php echo $cus_id; ?>
			},
            success: function(response) {
				var resp = response;
				if(resp == 1){
					
					$('#custDel<?php echo $cus_id; ?>').modal('hide');
					document.getElementById('trRem<?php echo $cus_id; ?>').style.display = 'none';
					$('#succDelete').modal('show');
	
				}else{
					$('#custDel<?php echo $cus_id; ?>').modal('hide');
					$('#errDelete').modal('show');
				}
                
            }
        });
}
</script>

<?php }} ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
	
	
	
  </div>
</div>
			
			
			</div>




<div class="modal fade" id="succSMSVerify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content bg-success">
      <div class="modal-body text-center text-white">
		<span class="far fa-check-circle text-white fs-2"></span><br /><br />
		<h4 class="text-white " >Customer Verified</h4>
		<h6 class="text-white">You have successfully verified customer mobile number</h6>
		<br />
		
		<button onClick="window.location.reload();" class="btn btn-falcon-success w-100" type="cancel" data-bs-dismiss="modal" >Okay</button>
		
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="errSMSVerify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content bg-danger">
      <div class="modal-body text-center text-white">
		<span class="far fa-times-circle text-white fs-2"></span><br /><br />
		<h4 class="text-white " >Error Code</h4>
		<h6 class="text-white">You have entered wrong verification code. Try again</h6>
		<br />
		
		<button class="btn btn-falcon-success w-100" type="cancel" data-bs-dismiss="modal" >Okay</button>
		
      </div>
    </div>
  </div>
</div>

          

<div class="modal fade" id="succDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content bg-success">
      <div class="modal-body text-center text-white">
		<span class="far fa-check-circle text-white fs-2"></span><br /><br />
		<h4 class="text-white " >Confirm Deleted</h4>
		<h6 class="text-white">Customer information has been successfully removed from the database.</h6>
		<br />
		
		<button class="btn btn-falcon-success w-100" type="cancel" data-bs-dismiss="modal" >Okay</button>
		
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="errDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content bg-danger">
      <div class="modal-body text-center text-white">
		<span class="far fa-times-circle text-white fs-2"></span><br /><br />
		<h4 class="text-white " >Can't Deleted</h4>
		<h6 class="text-white">We're currently unable to process your request to delete this customer.</h6>
		<br />
		
		<button class="btn btn-falcon-success w-100" type="cancel" data-bs-dismiss="modal" >Okay</button>
		
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newCustomer" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-6" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
          <h4 class="mb-1" id="staticBackdropLabel">Add new customer</h4>
          <p class="fs-11 mb-0">By <a class="link-600 fw-semi-bold" href="#!"><?php echo $glog_full_name; ?></a></p>
        </div>
        <div class="p-4">
          <div class="row">
<div id="sucSave" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">New Customer Added successfully</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSave" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">Oops! we could not add new customer at the moment. try again letter.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>		  
		  
            <div class="col-lg-12">
				<div class="text-danger" id="errLog"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_first_name" type="text" placeholder="First name" />
						<label for="customer_first_name">First name</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_mid_name" type="text" placeholder="Middle name" />
						<label for="customer_mid_name">Middle name</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_surname" type="text" placeholder="Surname" />
						<label for="customer_surname">Surname</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input maxlength="10" class="form-control" id="customer_phone" type="text" inputmode="numeric" placeholder="Phone number" />
						<label for="customer_phone">Phone number</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_email" type="text" placeholder="Email address" inputmode="email" />
						<label for="customer_email">Email</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="house_number" type="text" placeholder="House No." />
						<label for="house_number">House No.</label>
						</div>
					</div>
				
				
				<div class="col-md-8">
				<input  class="form-control d-none" id="customer_location_id" type="text" />
				<div class="form-floating mb-3">
				<input onFocus="normalForm()" onKeyup="searchStreetLocation()" class="form-control" id="searchLocation" type="text" placeholder="Search customer location" />
						
				<label id="showAddress" for="searchLocation">Location</label></div>
				<div id="ds_Locations" class="text-success h6"></div>
				</div>
				<div class="col-md-4">
				Customer Category
<select class="form-select js-choice" id="customer_category_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>
					  
<?php
$sql = "SELECT * FROM `tbl_customer_category` ORDER BY `customer_category_title` ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $customer_category_title = $row["customer_category_title"];
	$customer_category_id = $row["customer_category_id"];
?>
					  <option <?php if($customer_category_id==1){ echo 'selected'; } ?> value="<?php echo $customer_category_id; ?>"><?php echo $customer_category_title; ?>
					  </option>
<?php }} ?>
	
					</select>
				
				</div>
				
				</div>

				<br />
				<div class="form-floating">
				<textarea class="form-control" id="customer_address" placeholder="Customer address" style="height: 70px"></textarea>
				<label for="customer_address">Customer address (Optional)</label>
				</div>
			<br />
			<div class="text-end">
				<button onClick="saveCustomer()" class="btn btn-primary w-100" type="button">Save Customer</button>
			</div>
            </div>
            
          </div>
		  
		  
		  
        </div>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('click', (event) => {
  if (event.target.tagName === 'LI') {
    const id = event.target.dataset.id;
	const locName = event.target.innerHTML;
    document.getElementById('customer_location_id').value = id;
	document.getElementById('searchLocation').value ='';
	document.getElementById('showAddress').innerHTML = locName;
	document.getElementById('ds_Locations').innerHTML = '';
  }
});

function normalForm()
{
	document.getElementById('showAddress').innerHTML = 'Location';
	document.getElementById('customer_location_id').value ='';
}


function searchStreetLocation()
{
	var street = document.getElementById("searchLocation").value;
	var ds_Locations = document.getElementById("ds_Locations");
		
	if (street.length < 3) 
	{
		ds_Locations.innerHTML = 'Please enter a minimum of 3 characters to search'
		return false;
	}
	
	$.ajax({
			type: "POST",
			url: "../scripts/load_locations.php",
			data: 
			{ street: street },
			cache: false,
			success: function(data) {
			var regsuccess = data;
             ds_Locations.innerHTML = regsuccess;
			 
			}
		});
	
}

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    const phoneRegex = /^0\d{9}$/;
    return phoneRegex.test(phone);
}

function saveCustomer()
{
	let customer_first_name = document.getElementById('customer_first_name').value;
	let customer_mid_name = document.getElementById('customer_mid_name').value;
	let customer_surname = document.getElementById('customer_surname').value;
	let customer_phone = document.getElementById('customer_phone').value;
	let customer_email = document.getElementById('customer_email').value;
	let house_number = document.getElementById('house_number').value;
	let customer_location_id = document.getElementById('customer_location_id').value;
	let customer_address = document.getElementById('customer_address').value;
	let customer_category_id = document.getElementById('customer_category_id').value;
	
	var emptyFields = [];

    if (customer_first_name === "") {
        emptyFields.push("First Name");
    }
    
    if (customer_surname === "") {
        emptyFields.push("Surname");
    }
    if (customer_phone === "") {
        emptyFields.push("Phone Number");
    }
   
    if (house_number === "") {
        emptyFields.push("House Number");
    }
    if (customer_location_id === "") {
        emptyFields.push("Location");
    }
    if (customer_category_id === "") {
        emptyFields.push("Customer Category");
    }

    if (emptyFields.length > 0) {
        document.getElementById('errLog').innerHTML = "Please fill in the following fields: <br />" + emptyFields.join("<br /> ");
        // Set focus on the first empty field
        document.getElementById(emptyFields[0].toLowerCase().replace(/\s+/g, '_')).focus();
        return false;
    }
	
	if (customer_email !== "") {
		if (!validateEmail(customer_email)) {
			alert("Invalid email format");
			document.getElementById('customer_email').focus();
			return false;
		}
	}
    if (!validatePhone(customer_phone)) {
        alert("Invalid phone number format");
		document.getElementById('customer_phone').focus();
		return false;
    }
	
	
	
	var data = {
            customer_first_name: customer_first_name,
            customer_mid_name: customer_mid_name,
            customer_surname: customer_surname,
            customer_phone: customer_phone,
            customer_email: customer_email,
            house_number: house_number,
            customer_location_id: customer_location_id,
            customer_address: customer_address,
			created_by_user_id: <?php echo $glob_user_id; ?>,
			customer_category_id: customer_category_id
        };

        $.ajax({
            type: "POST",
            url: "../scripts/customer_CRUD.php",
            data: data,
            success: function(response) {
				var resp = response;
				if(resp == 1){
					document.getElementById("sucSave").style.display = "";
					document.getElementById('customer_first_name').value = '';
					document.getElementById('customer_mid_name').value = '';
					document.getElementById('customer_surname').value = '';
					document.getElementById('customer_email').value = '';
					document.getElementById('house_number').value = '';
					document.getElementById('customer_location_id').value = '';
					document.getElementById('customer_address').value = '';
					document.getElementById('customer_phone').value = '';
					document.getElementById('showAddress').innerHTML = 'Location';
					document.getElementById('customer_location_id').value ='';
					document.getElementById('customer_category_id').value ='';
	
				}else{
					document.getElementById("errSave").style.display = "";
				}
                
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });

	
	
}


const inputElements = document.querySelectorAll('input[type="text"]');

// Add an event listener to each input element
inputElements.forEach(input => {
  input.addEventListener('focus', () => {
    // Code to execute when the input is focused
    document.getElementById('errLog').innerHTML = "";
	document.getElementById("sucSave").style.display = "none";
	document.getElementById("errSave").style.display = "none";

  });
});

</script>

<div class="modal fade" id="cusCategory" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-6" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
          <h4 class="mb-1" id="staticBackdropLabel">Add / Edit customer category</h4>
          <p class="fs-11 mb-0">By <a class="link-600 fw-semi-bold" href="#!"><?php echo $glog_full_name; ?></a></p>
        </div>
		
<div id="sucSaveCate" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">New Category created successfully</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSaveCate" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">Oops! we could not add new category at the moment. try again letter.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>

<div id="sucSaveCateedit" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">Category updated successfully</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSaveCateedit" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">Oops! we could not update category at the moment. try again letter.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>

<div id="sucSaveCateDelete" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">Category deleted successfully</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSaveCateDelete" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">We couldn't delete the category right now. It's currently being used.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>


		
		
        <div class="p-4">
          <div class="row">
            <div class="col-lg-8">
              <div class="d-flex"><span class="fa-stack ms-n1 me-3"><i class="fas fa-circle fa-stack-2x text-200"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-tag" data-fa-transform="shrink-2"></i></span>
                <div id="newCat" class="flex-1">
                  <h5 class="mb-2 fs-9">Add new category</h5>
                  <div class="">
<div class="form-floating mb-0">
<input onKeyup="cct();" class="form-control" id="customer_category_title" type="text" placeholder="" /><label for="customer_category_title">Customer category title</label></div>
<div class="text-danger" id="errcustomer_category_title"></div>
<div class="text-end py-2">
<button onClick="createCategoty();" class="btn btn-primary me-1 mb-1" type="button">Create Category</button>
</div>

                  </div>
                 
				 <hr class="my-4" />
                </div>
				
				<div id="editCat" class="flex-1" style="display: none;">
                  <h5 class="mb-2 fs-9">Edit category</h5>
                  <div class="">
<div class="form-floating mb-0">
<input onKeyup="cct();" class="form-control" id="customer_category_titleedit" type="text" placeholder="" />
<input id="cc_id_edit" type="hidden">
<label for="customer_category_titleedit">Edit customer category title</label></div>
<div class="text-danger" id="errcustomer_category_titleedit"></div>
<div class="text-end py-2">
<button onClick="createCategotydelete();" class="btn btn-danger me-1 mb-1" type="button">Delete</button>
<button onClick="createCategotyedit();" class="btn btn-primary me-1 mb-1" type="button">Edit Category</button>
</div>

                  </div>
                 
				 <hr class="my-4" />
                </div>
				
				
              </div>
              <div class="d-flex"><span class="fa-stack ms-n1 me-3"><i class="fas fa-circle fa-stack-2x text-200"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-align-left" data-fa-transform="shrink-2"></i></span>
                <div class="flex-1">
                  <h5 class="mb-2 fs-9">Description</h5>
                  <p class="text-break fs-10">Categorize Your Customers: Easily classify your customers into specific groups like residential, business, hotel, bar, or any other custom category you define. </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <h6 class="mt-5 mt-lg-0">Categories</h6>
              <ul class="nav flex-lg-column fs-10">
                
<?php 
$sql = "SELECT * FROM `tbl_customer_category` ORDER BY `customer_category_title` ASC ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$customer_category_title = $row['customer_category_title']; 
	$cc_id = $row['customer_category_id'];
	?>			
				
				<li onClick="editCategory<?php echo $cc_id; ?>();" class="nav-item me-2 me-lg-0"><a class="nav-link nav-link-card-details" href="#!"><span class="fas fa-angle-right me-2"></span><?php echo $customer_category_title; ?></a></li>
<script>
function editCategory<?php echo $cc_id; ?>(){
	const newCat = document.getElementById('newCat');
	const editCat = document.getElementById('editCat');
	const cc_id_edit = document.getElementById('cc_id_edit');
	const customer_category_titleedit = document.getElementById('customer_category_titleedit');
	
	newCat.style.display = 'none';
	editCat.style.display = '';
	customer_category_titleedit.value = '<?php echo $customer_category_title; ?>';
	cc_id_edit.value = '<?php echo $cc_id; ?>';
	
	
}
</script>
<?php }} ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function cct(){
	errcustomer_category_title.innerHTML = '';
	sucSaveCate.style.display = 'none';
	sucSaveCateedit.style.display = 'none';
	errSaveCate.style.display = 'none';
	

}
function createCategoty(){
	
	const customer_category_title = document.getElementById('customer_category_title');
	const errcustomer_category_title = document.getElementById('errcustomer_category_title');
	const errSaveCate = document.getElementById('errSaveCate');
	const sucSaveCate = document.getElementById('sucSaveCate');
	
	if(customer_category_title.value == ''){
		
		errcustomer_category_title.innerHTML = 'Enter Category title';
		customer_category_title.focus();
		return false;
	}
	
	$.ajax({
			type: "POST",
			url: "../scripts/customer_CRUD.php",
			data: 
			{ customer_category_title: customer_category_title.value },
			cache: false,
			success: function(data) {
			let regsuc = data;
			if(regsuc == 1){
				sucSaveCate.style.display = '';
				customer_category_title.value = '';
				customer_category_title.focus();
			}else{
				errSaveCate.style.display = '';
				customer_category_title.focus();
			}
			 
			}
		});
	
}

function createCategotyedit(){
	
	const customer_category_titleedit = document.getElementById('customer_category_titleedit');
	const errcustomer_category_titleedit = document.getElementById('errcustomer_category_titleedit');
	const errSaveCateedit = document.getElementById('errSaveCateedit');
	const sucSaveCateedit = document.getElementById('sucSaveCateedit');
	
	if(customer_category_titleedit.value == ''){
		
		errcustomer_category_titleedit.innerHTML = 'Enter Category title';
		customer_category_titleedit.focus();
		return false;
	}
	
	$.ajax({
			type: "POST",
			url: "../scripts/customer_CRUD.php",
			data: 
			{ 	customer_category_titleedit: customer_category_titleedit.value,
				cc_id_edit: cc_id_edit.value
				
			},
			cache: false,
			success: function(data) {
			let regsuc = data;
			if(regsuc == 1){
				sucSaveCateedit.style.display = '';
				newCat.style.display = '';
				editCat.style.display = 'none';
				customer_category_title.focus();
			}else{
				errSaveCateedit.style.display = '';
				customer_category_titleedit.focus();
			}
			 
			}
		});	
}



function createCategotydelete(){
	
	const errSaveCateDelete = document.getElementById('errSaveCateDelete');
	const sucSaveCateDelete = document.getElementById('sucSaveCateDelete');
	
	
	$.ajax({
			type: "POST",
			url: "../scripts/customer_CRUD.php",
			data: 
			{ 	cc_id_delete: cc_id_edit.value
				
			},
			cache: false,
			success: function(data) {
			let regsuc = data;
			if(regsuc == 1){
				sucSaveCateDelete.style.display = '';
				newCat.style.display = '';
				editCat.style.display = 'none';
				customer_category_title.focus();
			}else{
				errSaveCateDelete.style.display = '';
				customer_category_titleedit.focus();
			}
			 
			}
		});	
}
</script>