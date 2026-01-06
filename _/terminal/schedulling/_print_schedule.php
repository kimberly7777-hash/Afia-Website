 <style>
@media print {
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }

    body * {
        visibility: hidden;
    }

    .modal-content,
    .modal-content * {
        visibility: visible;
    }



    .modal-dialog {
        max-width: none;
        margin: 0;
    }

    .modal-header .btn-close,
    .modal-footer .btn {
        display: none;
    }
    /* Hide default browser header and footer */
    @page {
        margin: 0; /* Important: Set all margins to zero */
        size: auto;
    }
}
    </style>
 
<div class="falcon-data-table" id="print-area">
 <table class="table table-sm mb-0 data-table fs-10" data-datatables='{"searching":true,"responsive":true,"pageLength":8,"info":true,"lengthChange":false,"dom":"<&#39;row mx-1&#39;<&#39;col-sm-12 col-md-6&#39;l><&#39;col-sm-12 col-md-6&#39;f>><&#39;table-responsive scrollbar&#39;tr><&#39;row no-gutters px-1 pb-3 align-items-center justify-content-center&#39;<&#39;col-auto&#39; p>>","language":{"paginate":{"next":"<span class=\"fas fa-chevron-right\"></span>","previous":"<span class=\"fas fa-chevron-left\"></span>"}}}'>
        <thead class="bg-200">
          <tr>
            
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Reg No.</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap">Customer name</th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">House No.</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Type.</th>
            
            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Week 1</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Week 2</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Week 3</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Week 4</th>
			<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Remarks</th>
            
            
          </tr>
        </thead>
<tbody class="list" id="table-number-pagination-body">
<?php 
//error_reporting(0);
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");

$eventId = $_POST['event_id'];
 
$sql = "SELECT * FROM `tbl_customers`, `tbl_locations`, `tbl_customer_category` WHERE `tbl_customers`.`customer_location_id` = `tbl_locations`.`district_id` AND `tbl_customers`.`customer_location_id` = $eventId AND `tbl_customers`.`customer_category_id`= `tbl_customer_category`.`customer_category_id` ORDER BY `tbl_customers`.`customer_id` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$fullname = $row['customer_first_name'].' '.$row['customer_mid_name'].' '.$row['customer_surname'];
	
?>          
		  <tr class="btn-reveal-trigger">
           <td class="align-middle white-space-nowrap text-start fw-bold"><?php echo $row['custID']; ?></td>
		   
            <td class="align-middle white-space-nowrap fw-semi-bold name"><?php echo strtoupper($fullname); ?>
			</td>
			
			<td class="align-middle text-start fw-semi-bold"><?php echo $row['house_number']; ?>
			</td>
			<td class="align-middle text-start fw-semi-bold"><?php echo $row['customer_category_title']; ?>
			</td>
			
            <td class="align-middle text-start fw-bold">
			<input style="width: 25px; height: 25px;" class="form-check-input" type="checkbox"  />
			</td>
			<td class="align-middle text-start fw-bold">
			<input style="width: 25px; height: 25px;" class="form-check-input" type="checkbox"  />
			</td>
			<td class="align-middle text-start fw-bold">
			<input style="width: 25px; height: 25px;" class="form-check-input" type="checkbox"  />
			</td>
			<td class="align-middle text-start fw-bold">
			<input style="width: 25px; height: 25px;" class="form-check-input" type="checkbox"  />
			</td>
			<td class="align-middle text-start fw-bold">
			
			</td>

			
            
          </tr>



<?php }} ?>
</tbody>
</table>
</div>