<?php 
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");


if (isset($_POST['street'])) 
  {
	  
      $street = $_POST['street'];
	  
	  $sql = "SELECT * FROM `tbl_locations` WHERE (`street` LIKE '%$street%' OR `region` LIKE '%$street%' OR `district` LIKE '%$street%' OR `ward` LIKE '%$street%')";
	  $result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			echo '<ul class="list-group list-group-flush">';
		while($row = mysqli_fetch_assoc($result)) {
			$did = $row["district_id"];
			$loc = $row['region']."-&gt;".$row['district']."-&gt;".$row['ward']."-&gt;".$row['street']; ?>
				
		<li  data-id="<?php echo $did; ?>" class="list-group-item"><?php echo $loc; ?>
		</li>
		


		<?php }echo '</ul>'; }else{
			
			echo "Street not found";
			
			
			
		}
		
  }
 
?>

