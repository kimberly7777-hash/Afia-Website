<?php 
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');
?>

        <div class="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
            <div class="col-xxl-9">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title text-uppercase">Application Users</h5>
    
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase">Registered Users </h5>
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
		<button onClick="test();" class="btn btn-falcon-default btn-sm mx-2" type="button"><span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Filter</span></button>
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
            <th class="text-900 sort pe-1 align-middle white-space-nowrap">Fullname</th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Phone</th>
			
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Email</th>
            
			 
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Company</th>
            
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">User Category</th>
			
            <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
          </tr>
        </thead>
        <tbody class="list" id="table-number-pagination-body">
<?php 
$sql = "SELECT * FROM `tbl_users`, `tbl_user_types`, `tbl_vendors` WHERE `tbl_users`.`user_type` = `tbl_user_types`.`user_type_id` AND `tbl_users`.`vendor_id` = `tbl_vendors`.`vendor_id` ORDER BY `tbl_users`.`user_id` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$fullname = $row['full_name'];
		
	$cus_id = $row['user_id'];
?>          
		  <tr  id="trRem<?php echo $cus_id; ?>" class="btn-reveal-trigger">
            <td class="align-middle" style="width: 28px;">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="number-pagination-item-0" data-bulk-select-row="data-bulk-select-row" /></div>
            </td>
            <td class="text-uppercase align-middle white-space-nowrap fw-semi-bold name"><a href="#"><?php echo $fullname; ?></a></td>
			
			<td class="align-middle white-space-nowrap text-start phone"><?php echo $row['phone']; ?></td>
			
			<td class="align-middle text-start"><?php echo $row['email']; ?></td>
			
			<td class="text-uppercase align-middle white-space-nowrap text-start fw-bold"><?php echo $row['vendor_title']; ?></td>
			
			<td class="align-middle white-space-nowrap text-start fw-bold"><span class="badge bg-warning"><?php echo $row['title']; ?></span></td>
			
			<td class="align-middle white-space-nowrap text-end">
              <div class="dropstart font-sans-serif position-static d-inline-block"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown-number-pagination-table-item-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-number-pagination-table-item-0"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a>
				
				<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#changePassword<?php echo $cus_id; ?>">Change Password</a>
                
				<div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a>
				  <a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#custDel<?php echo $cus_id; ?>">Delete</a>
                </div>
              </div>
            </td>
          </tr>
<div class="modal fade" id="changePassword<?php echo $cus_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-white">
		
		<h4 class="text-white " >Change Password</h4>
		<h6 class="text-white"><?php echo $fullname; ?></h6>
		<br />
		

		<div class="input-group">
		<input id="passwordInput<?php echo $cus_id; ?>" class="form-control" type="password" inputmode="" placeholder="Change Password" aria-describedby="basic-addon2" /><span class="input-group-text cursor-pointer" id="passwordToggle<?php echo $cus_id; ?>" onclick="togglePasswordVisibility<?php echo $cus_id; ?>()">SHOW</span>
		
		</div>
		<div id="suggestButton<?php echo $cus_id; ?>" class="text-primary cursor-pointer small py-0 mb-0">Suggest Password</div>
		

		<br />
		
		<button class="btn btn-falcon-primary me-1 mb-1" type="cancel" data-bs-dismiss="modal" >Cancel</button>
		
		<button onClick="ChangePassword<?php echo $cus_id; ?>()" class="btn btn-falcon-success w-50 me-1 mb-1" type="button">Save changes</button>
		
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
function ChangePassword<?php echo $cus_id; ?>(){
if(passwordInput<?php echo $cus_id; ?>.value==''){
	passwordInput<?php echo $cus_id; ?>.style.border = "1px solid red";
	passwordInput<?php echo $cus_id; ?>.focus();
	return false;
}	
	const isValid<?php echo $cus_id; ?> = validatePassword(passwordInput<?php echo $cus_id; ?>.value);
	
	if (isValid<?php echo $cus_id; ?>) {
    
		$.ajax({
            type: "POST",
            url: "../scripts/user_CRUD.php",
            data: {
				
				changeUserId: <?php echo $cus_id; ?>,
				password: passwordInput<?php echo $cus_id; ?>.value
				
			},
            success: function(response) {
				var resp = response;
				if(resp == 1){
					
					$('#succDelete').modal('show');
					$('#changePassword<?php echo $cus_id; ?>').modal('hide');
				}else{
					
					$('#errDelete').modal('show');
					$('#changePassword<?php echo $cus_id; ?>').modal('hide');
				}
                
            }
        });
	
  } else {
    passwordInput<?php echo $cus_id; ?>.style.border = "1px solid red";
  }
}


const passwordInput<?php echo $cus_id; ?> = document.getElementById("passwordInput<?php echo $cus_id; ?>");
const suggestionButton<?php echo $cus_id; ?> = document.getElementById("suggestButton<?php echo $cus_id; ?>");

passwordInput<?php echo $cus_id; ?>.addEventListener("input", () => {
  const isValid<?php echo $cus_id; ?> = validatePassword(passwordInput<?php echo $cus_id; ?>.value);
  
  if (isValid<?php echo $cus_id; ?>) {
    passwordInput<?php echo $cus_id; ?>.style.border = "1px solid green";
  } else {
    passwordInput<?php echo $cus_id; ?>.style.border = "1px solid red";
  }
  
});

suggestionButton<?php echo $cus_id; ?>.addEventListener("click", () => {
  const suggestedPassword<?php echo $cus_id; ?> = suggestPassword();
  passwordInput<?php echo $cus_id; ?>.value = suggestedPassword<?php echo $cus_id; ?>;
  
  
  const isValid<?php echo $cus_id; ?> = validatePassword(passwordInput<?php echo $cus_id; ?>.value);
  if (isValid<?php echo $cus_id; ?>) {
    passwordInput<?php echo $cus_id; ?>.style.border = "1px solid green";
  } else {
    passwordInput<?php echo $cus_id; ?>.style.border = "1px solid red";
  }
  
});



function togglePasswordVisibility<?php echo $cus_id; ?>() {
  const passwordInput<?php echo $cus_id; ?> = document.getElementById('passwordInput<?php echo $cus_id; ?>');
  const passwordToggle<?php echo $cus_id; ?> = document.getElementById('passwordToggle<?php echo $cus_id; ?>');

  if (passwordInput<?php echo $cus_id; ?>.type === 'password') {
    passwordInput<?php echo $cus_id; ?>.type = 'text';
    passwordToggle<?php echo $cus_id; ?>.textContent = 'HIDE';
  } else {
    passwordInput<?php echo $cus_id; ?>.type = 'password';
    passwordToggle<?php echo $cus_id; ?>.textContent = 'SHOW';
  }
}
function del<?php echo $cus_id; ?>()
{
	 $.ajax({
            type: "POST",
            url: "../scripts/user_CRUD.php",
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
            
          </div>
          

<div class="modal fade" id="succDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content bg-success">
      <div class="modal-body text-center text-white">
		<span class="far fa-check-circle text-white fs-2"></span><br /><br />
		<h4 class="text-white " >Confirmed</h4>
		<h6 class="text-white">Your action was successful.</h6>
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
          <h4 class="mb-1" id="staticBackdropLabel">Add new user</h4>
          <p class="fs-11 mb-0">By <a class="link-600 fw-semi-bold" href="#!"><?php echo $glog_full_name; ?></a></p>
        </div>
        <div class="p-4">
          <div class="row">
<div id="sucSave" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">User successfully created</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSave" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1" id="errShowMSG">We could not create new user for the moment, try again in a while</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>		  
		  
            <div class="col-lg-12">
				<div class="text-danger" id="errLog"></div>
					<div class="form-floating mb-3">
						<input class="form-control" id="full_name" type="text" placeholder="" />
						<label for="full_name">Fullname</label>
					</div>
					
				<div class="row">
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input maxlength="10" class="form-control" id="phone" type="text" inputmode="numeric" placeholder="Phone number" />
						<label for="phone">Phone number</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="email" type="text" placeholder="Email address" inputmode="email" />
						<label for="email">Email</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="password" type="text" placeholder="Password" inputmode="password" />
						<label for="password">Password</label>
						</div>
					</div>
					<div class="col-md-6">
					
					<select class="form-select js-choice" id="vendor_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>
					  <option value="">Select company...</option>
<?php
$sql = "SELECT * FROM `tbl_vendors` ORDER BY `vendor_title` ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $vendor_title = $row["vendor_title"];
	$vendor_id = $row["vendor_id"];
?>
					  <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_title; ?>
					  </option>
<?php }} ?>
	
					</select>
							
					</div>
					<div class="col-md-6">
					<select class="form-select js-choice" id="user_type" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>
					  <option value="">Select user category...</option>
<?php
$sql = "SELECT * FROM `tbl_user_types` WHERE `user_type_id` <> 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $title = $row["title"];
	$user_type_id = $row["user_type_id"];
?>
					  <option value="<?php echo $user_type_id; ?>"><?php echo $title; ?></option>
<?php }} ?>
					</select>
					</div>
				</div>
				
				
				
			<br />
			<div class="text-end">
				<button onClick="saveUser()" class="btn btn-primary w-100" type="button">Create user</button>
			</div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
function validatePassword(password) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  return regex.test(password);
}

function suggestPassword() {
  const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$!%*?&";
  let password = "";
  for (let i = 0; i < 12; i++) {
    password += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  return password;
}



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

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    const phoneRegex = /^0\d{9}$/;
    return phoneRegex.test(phone);
}

function saveUser()
{
	var full_name = document.getElementById('full_name').value;
	var phone = document.getElementById('phone').value;
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	var vendor_id = document.getElementById('vendor_id').value;
	var user_type = document.getElementById('user_type').value;
	
	var emptyFields = [];

    if (full_name === "") {
        emptyFields.push("Full Name");
    }
    
    if (vendor_id === "") {
        emptyFields.push("Company name");
    }
    if (user_type === "") {
        emptyFields.push("User category");
    }
	if (email === "") {
        emptyFields.push("User email");
    }
    

    if (emptyFields.length > 0) {
        document.getElementById('errLog').innerHTML = "Please fill in the following fields: <br />" + emptyFields.join("<br /> ");
        // Set focus on the first empty field
        document.getElementById(emptyFields[0].toLowerCase().replace(/\s+/g, '_')).focus();
        return false;
    }
	
	if (email !== "") {
		if (!validateEmail(email)) {
			alert("Invalid email format");
			document.getElementById('email').focus();
			return false;
		}
	}
	if (phone !== "") {
    if (!validatePhone(phone)) {
        alert("Invalid phone number format");
		document.getElementById('phone').focus();
		return false;
    }}
	
	
	
	var data = {
			full_name: full_name,
            phone: phone,
            email: email,
            password: password,
            vendor_id: vendor_id,
            user_type: user_type,
			created_by_user_id: <?php echo $glob_user_id; ?>
        };

        $.ajax({
            type: "POST",
            url: "../scripts/user_CRUD.php",
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
	
				}else{
					document.getElementById("errSave").style.display = "";
					document.getElementById("errShowMSG").innerHTML = resp;
					errShowMSG
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


$(document).ready(function() {
    $('#countrySelect').select2();
});
</script>
<?php include('../incl/footer.php'); ?>