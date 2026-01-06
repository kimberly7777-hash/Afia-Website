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
    <h5 class="card-title text-uppercase">My Customers</h5>
    
	<div class="card shadow-none">
  <div class="card-header">
    <div class="row flex-between-center">
      <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
        <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase">Vendor: <?php echo $glob_vendor_title; ?></h5>
      </div>

    </div>
  </div>
  <div class="card-body p-0">
    <div class="falcon-data-table">
      <table class="table table-sm mb-0 data-table fs-10" data-datatables='{"searching":true,"responsive":true,"pageLength":8,"info":true,"lengthChange":false,"dom":"<&#39;row mx-1&#39;<&#39;col-sm-12 col-md-6&#39;l><&#39;col-sm-12 col-md-6&#39;f>><&#39;table-responsive scrollbar&#39;tr><&#39;row no-gutters px-1 pb-3 align-items-center justify-content-center&#39;<&#39;col-auto&#39; p>>","language":{"paginate":{"next":"<span class=\"fas fa-chevron-right\"></span>","previous":"<span class=\"fas fa-chevron-left\"></span>"}}}'>
        <thead class="bg-200">
          <tr>
            
           
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Site Location</th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-end">No. of Clients</th>
            
          </tr>
        </thead>
        <tbody class="list" id="table-number-pagination-body">
<?php 
$sn=0; 
$sqlLoc = "SELECT * FROM `tbl_vendor_street_linkup`, `tbl_locations` WHERE `tbl_vendor_street_linkup`.`vendor_id` = $glob_vendor_id AND `tbl_vendor_street_linkup`.`street_id` = `tbl_locations`.`district_id`";
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
            <td class="align-middle text-end amount">
			<?php 
$sql = "SELECT * FROM `tbl_customers` WHERE `customer_location_id` = $district_id";
$result = $conn->query($sql);
echo number_format($result->num_rows);
	?>		
			
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