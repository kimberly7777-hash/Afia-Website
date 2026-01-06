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
    <h5 class="card-title text-uppercase">Billing Setup</h5>
    
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase">Monthly waste collection fees setup</h5>
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
		<button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#billing_setup">
		<span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Add / Update</span>
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
            
           
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Site Location</th>
<?php 
$sqlLoc = "SELECT * FROM `tbl_customer_category` ";
$resultLoc = $conn->query($sqlLoc);
$tdT = $resultLoc->num_rows;
if ($resultLoc->num_rows > 0) {
while($rowLoc = $resultLoc->fetch_assoc()) {
$customer_category_title = $rowLoc['customer_category_title'];


?>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-end"><?php echo $customer_category_title; ?></th>
<?php }} ?>			
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-end">No. of Clients</th>
            
          </tr>
        </thead>
        <tbody class="list" id="table-number-pagination-body">
<?php 
$sn=0; 
$sqlLoc = "SELECT * FROM `tbl_billing_setup`,`tbl_locations` WHERE `tbl_billing_setup`.`location_id` = `tbl_locations`.`district_id` GROUP BY `tbl_locations`.`district_id`";
$resultLoc = $conn->query($sqlLoc);

if ($resultLoc->num_rows > 0) {
while($rowLoc = $resultLoc->fetch_assoc()) {
$district_id = $rowLoc['district_id'];

$sn++;	
$loc = $sn.". ".$rowLoc['region']."->".$rowLoc['district']."->".$rowLoc['ward']."->".$rowLoc['street']; 
?>          
		  <tr class="btn-reveal-trigger">
            
            <td class="align-middle text-start fs-9 white-space-nowrap">
<?php 
echo '<span onClick="window.location=\'../administration/site-management?rec='.$district_id.'\'" class="cursor-pointer badge badge  badge-subtle-success">'.$loc.'</span><br />';
?> 
			</td>
<?php 
$sqlLocx = "SELECT * FROM `tbl_billing_setup`, `tbl_customer_category` WHERE `tbl_billing_setup`.`category_id` = `tbl_customer_category`.`customer_category_id` AND `location_id` = $district_id";
$resultLocx = $conn->query($sqlLocx);
$tdTx = $resultLocx->num_rows;
if ($resultLocx->num_rows > 0) {
while($rowLocx = $resultLocx->fetch_assoc()) {
$category_title_amount = $rowLocx['category_title_amount'];


?>
     <td class="align-middle text-end amount"><?php echo number_format($category_title_amount); ?></td>
	 
<?php }} ?>
<?php  $xxTdx = $tdT - $tdTx;

for ($i = 1; $i <= $xxTdx; $i++) { 

?>
	<td class="align-middle text-end amount">0</td>
<?php }?>
			<td class="align-middle text-end ">
<?php 
			
$sql = "SELECT * FROM `tbl_customers` WHERE `customer_location_id` = $district_id";
$result = $conn->query($sql);
echo number_format($result->num_rows);
//echo $xxTdx;	?>		
			
			</td>
            
          </tr>
<?php }}else{ echo '<span class="badge badge  badge-subtle-secondary">No Site</span>';}?>
        </tbody>
      </table>
    </div>
  </div>
</div>
	
	
	
  </div>
</div>
			</div>
            
          </div>
          

<?php include('../incl/footer.php'); ?>

<div class="modal fade" id="billing_setup" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-6" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
          <h4 class="mb-1" id="staticBackdropLabel">Waste Collection Cost Setup</h4>
          <p class="fs-11 mb-0">By <a class="link-600 fw-semi-bold" href="#!"><?php echo $glog_full_name; ?></a></p>
        </div>
        <div class="p-4">
          <div class="row">
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
		  
            <div class="col-lg-12">
				<div class="text-danger" id="errLog"></div>
				
				<input class="form-control d-none" id="location_id" type="text" />
						<div class="form-floating mb-3">
						<input onFocus="normalForm()" onKeyup="searchStreetLocation()" class="form-control" id="searchLocation" type="text" placeholder="Search customer location" />
						
						<label id="showAddress" for="searchLocation">Location</label>
						</div>
						<div id="ds_Locations" class="text-success h6"></div>
						<div id="ds_Locationsx" class="text-danger"></div>
					
					<div class="row">
<?php
$sql = "SELECT * FROM `tbl_customer_category`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$customer_category_id = $row['customer_category_id'];
	$customer_category_title = $row['customer_category_title'];	
?>
					<div class="col-lg-4">
					<label class="form-label" for="street_amount"><?php echo $customer_category_title; ?></label>
						<div class="input-group">
						<input class="d-none" name="category_id[]" value="<?php echo $customer_category_id; ?>" />
						<span class="input-group-text" id="">TZS</span>
						<input name="category_title_amount[]" class="form-control" type="text" inputmode="numeric" />
						</div>
					</div>
<?php }} ?>
					</div>
					
					<div id="ds_Locationsxx" class="text-danger"></div>


			<br />
			<div class="text-end">
				<button onClick="saveSiteCost()" class="btn btn-primary w-100" type="button">Save site Cost</button>
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
    document.getElementById('location_id').value = id;
	document.getElementById('searchLocation').value ='';
	document.getElementById('showAddress').innerHTML = locName;
	document.getElementById('ds_Locations').innerHTML = '';
	document.getElementById('ds_Locationsx').innerHTML = '';
  }
});

function normalForm()
{
	document.getElementById('showAddress').innerHTML = 'Location';
	document.getElementById('location_id').value ='';
	document.getElementById('ds_Locationsx').innerHTML = '';
	document.getElementById('sucSave').style.display = 'none';
	document.getElementById('errSave').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
  const inputFields = [
    document.getElementById('street_amount'),
    document.getElementById('street_amount_business'),
    document.getElementById('street_amount_industry')
  ];

  inputFields.forEach(input => {
    input.addEventListener('input', (event) => {
      const inputValue = event.target.value.replace(/\D/g, '');
      const formattedValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      event.target.value = formattedValue;
    });
  });
});


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

function saveSiteCost()
{
   const location_id = document.getElementById('location_id').value;
   const categoryIds = document.querySelectorAll('input[name="category_id[]"]');
   const categoryTitleAmounts = document.querySelectorAll('input[name="category_title_amount[]"]');

  // Create an array to store the values
  const categoryIdValues = [];
  categoryIds.forEach(input => {
    categoryIdValues.push(input.value);
  });
  const categoryTitleAmountValues = [];
  categoryTitleAmounts.forEach(input => {
    categoryTitleAmountValues.push(input.value);
  });
   
if(location_id == '') {
	document.getElementById('ds_Locationsx').innerHTML = 'Choose site Location';
	document.getElementById('searchLocation').focus();
	return false;}
	
let atLeastOneFilled = false;

categoryTitleAmounts.forEach(input => {
  categoryTitleAmountValues.push(input.value);
  if (input.value.trim() !== '') {
    atLeastOneFilled = true;
  }
});

if (atLeastOneFilled) {
  
} else {
  document.getElementById('ds_Locationsxx').innerHTML = "Please fill at least one category title amount.";
  return false;
}
  
	  
  $.ajax({
			type: "POST",
			url: "../scripts/billing_CRUD.php",
			data: 
			{ 	category_ids: categoryIdValues,
				category_title_amounts: categoryTitleAmountValues,
				costSetup: location_id
			},
			cache: false,
			success: function(data) {
			var resp = data;
			if(resp == 1 ){
				document.getElementById('sucSave').style.display = '';
				document.getElementById('sucMsg').innerHTML = 'Cost Location Successful added';
			}else if(resp == 2 ){
				document.getElementById('sucSave').style.display = '';
				document.getElementById('sucMsg').innerHTML = 'Cost Location Successful updated';
			}else{
				document.getElementById('errSave').style.display = '';
				document.getElementById('errMsg').innerHTML = 'Duplicate Key: This location exists, please choose another one.'+ resp;
			}
             			 
			}
		});

}


</script>