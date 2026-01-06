<?php 
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');
if(isset($_GET['m'])) { $xdatex = $_GET['m']; }else{ $xdatex = date('Y-m'); }
?>

        <div class="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
<?php
			
			if(isset($_GET['invoice'])) {
				include('billing_invoice.php');
			}else{
				include('billing_general.php'); 
			}
			
			?>
                        
          </div>
          

<?php include('../incl/footer.php'); ?>

