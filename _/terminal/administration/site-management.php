<?php 
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');

$district_id = $_GET['rec'];

 $sql = "SELECT * FROM `tbl_locations` WHERE `district_id` = $district_id";
	  $result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
			$loc = $row['region']."-&gt;".$row['district']."-&gt;".$row['ward']."-&gt;".$row['street'];
			$street = $row['street'];
			}
		}

$sql = "SELECT * FROM `tbl_vendors`, `tbl_vendor_street_linkup` WHERE `tbl_vendors`.`vendor_id` = `tbl_vendor_street_linkup`.`vendor_id` AND `tbl_vendor_street_linkup`.`street_id` = $district_id";
	  $result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
			$vendor_title = $row['vendor_title'];
			
			}
		}


				
 $sql = "SELECT * FROM `tbl_customers` WHERE `customer_location_id` = $district_id";
	  $result = mysqli_query($conn, $sql);
	  $custCount = mysqli_num_rows($result);
		

?>

        <div class="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
            <div class="col-xxl-9">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title text-uppercase">Site Management</h5>
    
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0 text-uppercase">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0">REGION: <?php echo $loc; ?><br />STREET: <?php echo $street; ?><br />CUSTOMER COUNT: <?php echo number_format($custCount); ?><br />CONTRACTOR: <?php echo $vendor_title; ?></h5>
      </div>
      <div class="col-6 col-sm-auto ms-auto text-end ps-0">
        
        
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
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">House No.</th>
            
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Site Location</th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Phone</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Status</th>
            
          </tr>
        </thead>
        <tbody class="list" id="table-number-pagination-body">
<?php 
$sql = "SELECT * FROM `tbl_customers`, `tbl_locations` WHERE `tbl_customers`.`customer_location_id` = `tbl_locations`.`district_id` AND `tbl_customers`.`customer_location_id` = $district_id ORDER BY `tbl_customers`.`customer_id` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$fullname = $row['customer_first_name'].' '.$row['customer_mid_name'].' '.$row['customer_surname'];
	$loc = $row['region']."->".$row['district']."->".$row['ward']."->".$row['street'];
	
	$cus_id = $row['customer_id'];
	
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
			
			<td class="align-middle text-start fw-bold"><?php echo $row['house_number']; ?></td>
			
			
            
            <td class="align-middle text-start fs-9 white-space-nowrap payment">
<?php
echo '<span class="badge badge badge-subtle-success">'.$loc.'</span>';
?> 
			
			</td>
            <td class="align-middle white-space-nowrap text-start phone"><?php echo $row['customer_phone']; ?></td>
			
			<td class="align-middle text-start fw-bold"><?php if($pv==1){ echo '<span class="badge badge  badge-subtle-success">Verified<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>'; }else { echo '<span class="badge badge  badge-subtle-danger">Unverified<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>'; }  ?></td>
			
            
          </tr>



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
          

<?php include('../incl/footer.php'); ?>