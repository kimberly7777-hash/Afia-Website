<?php
$customer_link_id = $_GET['edit'];

$sql = "SELECT * FROM `tbl_customers`, `tbl_locations` WHERE `tbl_customers`.`customer_location_id` = `tbl_locations`.`district_id` AND `tbl_customers`.`customer_link_id` = '$customer_link_id'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$fullname = $row['customer_first_name'].' '.$row['customer_mid_name'].' '.$row['customer_surname'];
	
	$customer_first_name = $row['customer_first_name'];
	$customer_mid_name = $row['customer_mid_name'];
	$customer_surname = $row['customer_surname'];
	
	$customer_address = $row['customer_address'];
	$customer_email = $row['customer_email'];
	$house_number = $row['house_number'];
	
	$loc = $row['region']."->".$row['district']."->".$row['ward']."->".$row['street'];
	
	$cus_id = $row['customer_id'];
	$customer_phone = $row['customer_phone'];
	$custID = $row['custID'];
	$street =  $row['street'];
	$customer_id =  $row['customer_id'];
}}	
?>
<div class="col-xxl-9">
<div class="card" >
  <div class="card-body">
    <h5 id="editedName" class="card-title text-uppercase">Edit: <?php echo $fullname; ?></h5>
    
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase"></h5>
      </div>
	<div class="col-6 col-sm-auto ms-auto text-end ps-0">

        <div id="table-number-pagination-replace-element">
		<button onClick="window.location='customer-management'" class="btn btn-primary btn-sm" type="button" >
		<span class="fas fa-chevron-left" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">All customers</span>
		</button>
		
		</div>
      </div>
    
	
	</div>
  </div>
  <div class="card-body p-0">
    <div class="row">
<div id="sucSave" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">Customer successfully updated</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSave" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1" id="errMsg"></p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>		  
		  
            <div class="col-lg-12">
				<div class="text-danger" id="errLog"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_first_name" type="text" placeholder="First name" value="<?php echo $customer_first_name; ?>" />
						<label for="customer_first_name">First name</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_mid_name" type="text" placeholder="Middle name" value="<?php echo $customer_mid_name; ?>" />
						<label for="customer_mid_name">Middle name</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input class="form-control" id="customer_surname" type="text" placeholder="Surname" value="<?php echo $customer_surname; ?>" />
						<label for="customer_surname">Surname</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input value="<?php echo $customer_phone; ?>" maxlength="10" class="form-control" id="customer_phone" type="text" inputmode="numeric" placeholder="Phone number" />
						<label for="customer_phone">Phone number</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input value="<?php echo $customer_email; ?>" class="form-control" id="customer_email" type="text" placeholder="Email address" inputmode="email" />
						<label for="customer_email">Email</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating mb-3">
						<input value="<?php echo $house_number; ?>" class="form-control" id="house_number" type="text" placeholder="House No." />
						<label for="house_number">House No.</label>
						</div>
					</div>
				
				
				<div class="col-md-8">
				<input value="<?php echo $customer_link_id; ?>" class="form-control d-none" id="customer_location_id" type="text" />
						<div class="form-floating mb-3">
						<input onFocus="normalForm()" onKeyup="searchStreetLocation()" class="form-control" id="searchLocation" type="text" placeholder="Search customer location" />
						
						<label id="showAddress" for="searchLocation"><?php echo $loc; ?></label>
						</div>
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
				<textarea class="form-control" id="customer_address" placeholder="Customer address" style="height: 70px"><?php echo $customer_address; ?></textarea>
				<label for="customer_address">Customer address (Optional)</label>
				</div>
			<br />
			<div class="text-end">
				<button onClick="updateCustomer()" class="btn btn-primary w-100" type="button">Update Customer</button>
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

function updateCustomer()
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
	let customer_id = <?php echo $customer_id; ?>;
	
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
            edit_house_number: house_number,
            customer_location_id: customer_location_id,
            customer_address: customer_address,
			customer_category_id: customer_category_id,
			updateCustomer: customer_id
        };

        $.ajax({
            type: "POST",
            url: "../scripts/customer_CRUD.php",
            data: data,
            success: function(response) {
				var resp = response;
				if(resp == 1){
					document.getElementById("sucSave").style.display = "";
					document.getElementById("editedName").innerHTML = 'Edit: ' + customer_first_name + ' ' + customer_mid_name + ' ' + customer_surname;
	
				}else{
					document.getElementById("errSave").style.display = "";
					document.getElementById("errMsg").innerHTML = resp;
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