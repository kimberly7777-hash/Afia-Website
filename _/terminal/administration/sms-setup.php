<?php 
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');


$sqlLoc = "SELECT * FROM `tbl_sms_setup`";
$resultLoc = $conn->query($sqlLoc);
if ($resultLoc->num_rows > 0) {
while($rowLoc = $resultLoc->fetch_assoc()) {
	
	$api_key = $rowLoc['api_key'];
	$base_Url	= $rowLoc['base_Url'];
	$secret_key = $rowLoc['secret_key'];
	$source_addr = $rowLoc['source_addr'];
	
}}
?>

        <div class="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
            <div class="col-xxl-9">
<div class="card">
  <div class="card-body">
    <h5 class="card-title text-uppercase">SMS API Setup</h5>
    <h6 class="card-subtitle mb-2 text-muted">Ask your SMS provide to give you the following details</h6>

	<hr class="my-4" />
<div id="succMsg" class="" style="display: none">
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1">SMS API updated Successful</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
	<div class="form-floating mb-3">
		<input value="<?php echo $source_addr; ?>" class="form-control" id="source_addr" type="text" placeholder="" />
		<label for="source_addr">Source Address</label>
	</div>
	<div class="form-floating mb-3">
		<input value="<?php echo $base_Url; ?>" class="form-control" id="base_Url" type="text" placeholder="" />
		<label for="base_Url">Base URL</label>
	</div>
	
	<div class="form-floating mb-3">
		<input value="<?php echo $api_key; ?>" class="form-control" id="api_key" type="text" placeholder="" />
		<label for="api_key">API Key</label>
	</div>
	<div class="form-floating mb-3">
		<input value="<?php echo $secret_key; ?>" class="form-control" id="secret_key" type="text" placeholder="" />
		<label for="secret_key">Secret Key / Password</label>
	</div>
	
	<div class="text-end">
				<button onClick="saveAPI()" class="btn btn-primary" type="button">Save Credentials</button>
			</div>
  </div>
</div>
			</div>
            
          </div>
          

<?php include('../incl/footer.php'); ?>
<script>

document.addEventListener('focus', (event) => {
  if (event.target.tagName === 'INPUT') {
   alert();
  }
});


function saveAPI(){
	var source_addr = document.getElementById('source_addr').value;
	var base_Url = document.getElementById('base_Url').value;
	var api_key = document.getElementById('api_key').value;
	var secret_key = document.getElementById('secret_key').value;
	
	//alert(api_key);
	
	var data = {
			source_addr: source_addr,
            base_Url: base_Url,
            api_key: api_key,
            secret_key: secret_key,
			setUpAPI: 1
        };

        $.ajax({
            type: "POST",
            url: "../scripts/sms_CRUD.php",
            data: data,
            success: function(response) {
				var resp = response;
				if(resp == 1){
				document.getElementById('succMsg').style.display = 'block';
				}else{
					
				}
                
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
}


</script>