<?php 
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');
?>

        <div class="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
			<?php
			
			if(isset($_GET['edit'])) {
				include('customer_edit.php');
			}else{
				include('customer_general.php'); 
			}
			
			?>
			
          </div>


<?php include('../incl/footer.php'); ?>