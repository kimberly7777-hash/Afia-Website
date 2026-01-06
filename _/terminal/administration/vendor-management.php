<?php
include('../scripts/authentication.php');
include('../incl/upper.php');
include('../incl/sidebar.php');
?>

<div class="content">
	<?php include('../incl/uppermenu.php'); ?>
	<div class="row g-3">
		<div class="col-xxl-9">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title text-uppercase text-uppercase">Contractors</h5>

					<div class="card shadow-none">
						<div class="card-header">
							<div class="row flex-between-center">
								<div class="col-6 col-sm-auto d-flex align-items-center pe-0">
									<h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-uppercase">Registered vendors </h5>
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
									<div id="table-number-pagination-replace-element"><button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#newVendor"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">New</span></button><button class="btn btn-falcon-default btn-sm mx-2" type="button"><span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Filter</span></button><button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Export</span></button></div>
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
											<th class="text-900 sort pe-1 align-middle white-space-nowrap">Vendor name</th>
											<th class="text-900 sort pe-1 align-middle white-space-nowrap">Email</th>
											<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Phone</th>
											<th class="text-900 sort pe-1 align-middle white-space-nowrap text-start">Site Location</th>
											<th class="text-900 sort pe-1 align-middle white-space-nowrap text-end">No. of Clients</th>
											<th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
										</tr>
									</thead>
									<tbody class="list" id="table-number-pagination-body">
										<?php
										$sql = "SELECT * FROM `tbl_vendors`";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												$vendor_id = $row['vendor_id'];
												$vendor_title = $row['vendor_title'];
										?>
												<tr id="trRem<?php echo $vendor_id; ?>" class="btn-reveal-trigger">
													<td class="align-middle" style="width: 28px;">
														<div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="number-pagination-item-0" data-bulk-select-row="data-bulk-select-row" /></div>
													</td>
													<td class="align-middle white-space-nowrap fw-semi-bold name text-uppercase"><a href="#"><?php echo $row['vendor_title']; ?></a></td>
													<td class="align-middle white-space-nowrap email"><?php echo $row['vendor_email']; ?></td>
													<td class="align-middle white-space-nowrap text-start phone"><?php echo $row['vendor_phone']; ?></td>
													<td class="align-middle text-start fs-9 white-space-nowrap">
														<?php
														$sn = 0;
														$tCustl = 0;
														$sqlLoc = "SELECT * FROM `tbl_vendor_street_linkup`, `tbl_locations` WHERE `tbl_vendor_street_linkup`.`vendor_id` = $vendor_id AND `tbl_vendor_street_linkup`.`street_id` = `tbl_locations`.`district_id`";
														$resultLoc = $conn->query($sqlLoc);
														if ($resultLoc->num_rows > 0) {
															while ($rowLoc = $resultLoc->fetch_assoc()) {
																$district_id = $rowLoc['district_id'];


																$sqlx = "SELECT * FROM `tbl_customers` WHERE `customer_location_id` = $district_id";
																$resultx = $conn->query($sqlx);
																$tCust = $resultx->num_rows;

																$tCustl = $tCust + $tCustl;
																$sn++;
																$loc = $sn . ". " . $rowLoc['region'] . "->" . $rowLoc['district'] . "->" . $rowLoc['ward'] . "->" . $rowLoc['street'];
																echo '<span onClick="window.location=\'site-management?rec=' . $district_id . '\'" class="badge badge  badge-subtle-success cursor-pointer">' . $loc . '</span><br />';
															}
														} else {
															echo '<span class="badge badge  badge-subtle-secondary">No Site added yet</span>';
														}
														?>

													</td>
													<td class="align-middle text-end amount">
														<?php
														echo number_format($tCustl);
														?>

													</td>
													<td class="align-middle white-space-nowrap text-end">
														<div class="dropstart font-sans-serif position-static d-inline-block"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end" type="button" id="dropdown-number-pagination-table-item-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
															<div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-number-pagination-table-item-0"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a>
																<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#addSite<?php echo $vendor_id; ?>">Add Sites</a>
																<div class="dropdown-divider"></div>

																<a class="dropdown-item text-danger" href="#!" data-bs-toggle="modal" data-bs-target="#custDel<?php echo $vendor_id; ?>">Delete</a>
															</div>
														</div>
													</td>
												</tr>

												<div class="modal fade" id="custDel<?php echo $vendor_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-sm">
														<div class="modal-content bg-danger">
															<div class="modal-body text-center text-white">
																<span class="fas fa-exclamation-circle text-white fs-2"></span><br /><br />
																<h4 class="text-white ">Confirm Delete</h4>
																<h6 class="text-white"><?php echo $vendor_title; ?></h6>
																<br />
																<button onClick="del<?php echo $vendor_id; ?>()" class="btn btn-falcon-success w-50" type="button">Delete</button>
																<button class="btn btn-falcon-primary me-1 mb-1" type="cancel" data-bs-dismiss="modal">Cancel</button>

															</div>
														</div>
													</div>
												</div>

												<script>
													function del<?php echo $vendor_id; ?>() {
														$.ajax({
															type: "POST",
															url: "../scripts/vendor_CRUD.php",
															data: {

																custDelete: <?php echo $vendor_id; ?>
															},
															success: function(response) {
																var resp = response;
																if (resp == 1) {

																	$('#custDel<?php echo $vendor_id; ?>').modal('hide');
																	document.getElementById('trRem<?php echo $vendor_id; ?>').style.display = 'none';
																	$('#succDelete').modal('show');

																} else {
																	$('#custDel<?php echo $vendor_id; ?>').modal('hide');
																	$('#errDelete').modal('show');
																}

															}
														});
													}
												</script>

												<div class="modal fade" id="addSite<?php echo $vendor_id; ?>" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg mt-6" role="document">
														<div class="modal-content border-0">
															<div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
															<div class="modal-body p-0">
																<div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
																	<h4 class="mb-1" id="staticBackdropLabel">Add or Remove Site Locations</h4>
																	<p class="fs-11 mb-0"><a class="link-600 fw-semi-bold" href="#!"></a></p>
																</div>
																<div class="p-4">
																	<div class="row">
																		<div class="col-lg-12">
																			<div class="d-flex"><span class="fa-stack ms-n1 me-3"><i class="fas fa-circle fa-stack-2x text-200"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-tag" data-fa-transform="shrink-2"></i></span>
																				<div class="flex-1">
																					<h5 class="mb-2 fs-9 text-uppercase"><?php echo $vendor_title; ?></h5>

																					<span class="badge badge-subtle-danger" id="errAddLocation<?php echo $vendor_id; ?>"></span>
																					<span class="badge badge-subtle-success" id="saveAddLocation<?php echo $vendor_id; ?>"></span>

																					<input class="form-control d-none" id="street_id<?php echo $vendor_id; ?>" type="text" />

																					<div class="form-floating mb-3">
																						<input onFocus="normalForm<?php echo $vendor_id; ?>()" onKeyup="searchStreetLocation<?php echo $vendor_id; ?>()" class="form-control" id="searchLocation<?php echo $vendor_id; ?>" type="text" placeholder="Search customer location" />

																						<label id="showAddress<?php echo $vendor_id; ?>">Location</label>
																					</div>
																					<div id="ds_Locations<?php echo $vendor_id; ?>" class="text-success h6"></div>
																					<div class="text-end">
																						<button onClick="addLocationBtn<?php echo $vendor_id; ?>()" class="btn btn-primary" type="button">Add Site Location</button>
																					</div>


																					<hr class="my-4" />
																					<div class="">


																						<?php
																						$snx = 0;
																						$sqlLoc = "SELECT * FROM `tbl_vendor_street_linkup`, `tbl_locations` WHERE `tbl_vendor_street_linkup`.`vendor_id` = $vendor_id AND `tbl_vendor_street_linkup`.`street_id` = `tbl_locations`.`district_id`";
																						$resultLoc = $conn->query($sqlLoc);
																						if ($resultLoc->num_rows > 0) {
																							while ($rowLoc = $resultLoc->fetch_assoc()) {
																								$district_id = $rowLoc['district_id'];


																								$sqlx = "SELECT * FROM `tbl_customers` WHERE `customer_location_id` = $district_id";
																								$resultx = $conn->query($sqlx);
																								$tCust = $resultx->num_rows;
																								$snx++;
																								$loc = $snx . ". " . $rowLoc['region'] . "->" . $rowLoc['district'] . "->" . $rowLoc['ward'] . "->" . $rowLoc['street'];
																								echo '<span id="sitetrRem' . $district_id . '" onClick="remSite' . $district_id . '()" class="badge badge  badge-subtle-success">' . $loc . ' &nbsp; <span class="fas fa-times"></span></span><br />';
																						?>

																								<script>
																									function remSite<?php echo $district_id; ?>() {
																										$('#remSite<?php echo $district_id; ?>').modal('show');
																									}

																									function delSite<?php echo $district_id; ?>() {
																										$.ajax({
																											type: "POST",
																											url: "../scripts/vendor_CRUD.php",
																											data: {

																												siteDelete: <?php echo $district_id; ?>
																											},
																											success: function(response) {
																												var resp = response;
																												if (resp == 1) {

																													$('#remSite<?php echo $district_id; ?>').modal('hide');
																													document.getElementById('sitetrRem<?php echo $district_id; ?>').style.display = 'none';
																													//$('#succDelete').modal('show');

																												} else {
																													$('#remSite<?php echo $district_id; ?>').modal('hide');
																													$('#errDelete').modal('show');
																												}

																											}
																										});
																									}
																								</script>

																								<div class="modal fade" id="remSite<?php echo $district_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																									<div class="modal-dialog modal-dialog-centered modal-sm">
																										<div class="modal-content bg-danger">
																											<div class="modal-body text-center text-white">
																												<span class="fas fa-exclamation-circle text-white fs-2"></span><br /><br />
																												<h4 class="text-white ">Confirm Delete</h4>
																												<h6 class="text-white"><?php echo $loc; ?></h6>
																												<br />
																												<button onClick="delSite<?php echo $district_id; ?>()" class="btn btn-falcon-success w-50" type="button">Delete</button>
																												<button class="btn btn-falcon-primary me-1 mb-1" type="cancel" data-bs-dismiss="modal">Cancel</button>

																											</div>
																										</div>
																									</div>
																								</div>



																						<?php }
																						} else {
																							echo '<span class="badge badge  badge-subtle-secondary">No Site</span>';
																						}
																						?>

																					</div>

																				</div>
																			</div>

																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<script>
													function addLocationBtn<?php echo $vendor_id; ?>() {
														var street_id<?php echo $vendor_id; ?> = document.getElementById('street_id<?php echo $vendor_id; ?>').value;
														if (street_id<?php echo $vendor_id; ?> == '') {
															document.getElementById('errAddLocation<?php echo $vendor_id; ?>').innerHTML = 'Please select Site location';
															return false;
														}


														$.ajax({
															type: "POST",
															url: "../scripts/vendor_CRUD.php",
															data: {
																street_id: street_id<?php echo $vendor_id; ?>,
																addLocation: <?php echo $vendor_id; ?>
															},
															cache: false,
															success: function(data) {
																var addLocatio = data;
																if (addLocatio == 1) {
																	document.getElementById('saveAddLocation<?php echo $vendor_id; ?>').innerHTML = 'SUCCESSFUL ADDED SITE LOCATION';
																	document.getElementById('searchLocation<?php echo $vendor_id; ?>').focus();
																} else if (addLocatio == 2) {
																	document.getElementById('errAddLocation<?php echo $vendor_id; ?>').innerHTML = 'Could not add location at the moment, try again letter';
																} else {
																	document.getElementById('errAddLocation<?php echo $vendor_id; ?>').innerHTML = addLocatio;
																}

															}
														});

													}
													document.addEventListener('click', (event) => {
														if (event.target.tagName === 'LI') {
															const id<?php echo $vendor_id; ?> = event.target.dataset.id;
															const locName<?php echo $vendor_id; ?> = event.target.innerHTML;
															document.getElementById('street_id<?php echo $vendor_id; ?>').value = id<?php echo $vendor_id; ?>;
															document.getElementById('searchLocation<?php echo $vendor_id; ?>').value = '';
															document.getElementById('showAddress<?php echo $vendor_id; ?>').innerHTML = locName<?php echo $vendor_id; ?>;
															document.getElementById('ds_Locations<?php echo $vendor_id; ?>').innerHTML = '';
															document.getElementById('errAddLocation<?php echo $vendor_id; ?>').innerHTML = '';
														}
													});

													function normalForm<?php echo $vendor_id; ?>() {
														document.getElementById('showAddress<?php echo $vendor_id; ?>').innerHTML = 'Location';
														document.getElementById('street_id<?php echo $vendor_id; ?>').value = '';
														document.getElementById('errAddLocation<?php echo $vendor_id; ?>').innerHTML = '';
													}


													function searchStreetLocation<?php echo $vendor_id; ?>() {
														document.getElementById('saveAddLocation<?php echo $vendor_id; ?>').innerHTML = '';
														var street<?php echo $vendor_id; ?> = document.getElementById("searchLocation<?php echo $vendor_id; ?>").value;
														var ds_Locations<?php echo $vendor_id; ?> = document.getElementById("ds_Locations<?php echo $vendor_id; ?>");

														if (street<?php echo $vendor_id; ?>.length < 3) {
															ds_Locations<?php echo $vendor_id; ?>.innerHTML = 'Please enter a minimum of 3 characters to search'
															return false;
														}

														$.ajax({
															type: "POST",
															url: "../scripts/load_locations.php",
															data: {
																street: street<?php echo $vendor_id; ?>
															},
															cache: false,
															success: function(data) {
																var regsuccess = data;
																ds_Locations<?php echo $vendor_id; ?>.innerHTML = regsuccess;

															}
														});

													}
												</script>
										<?php }
										} ?>

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
					<h4 class="text-white ">Confirm Deleted</h4>
					<h6 class="text-white">Contractor information has been successfully removed from the database.</h6>
					<br />

					<button class="btn btn-falcon-success w-100" type="cancel" data-bs-dismiss="modal">Okay</button>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="errDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content bg-danger">
				<div class="modal-body text-center text-white">
					<span class="far fa-times-circle text-white fs-2"></span><br /><br />
					<h4 class="text-white ">Can't Deleted</h4>
					<h6 class="text-white">We're currently unable to process your request to delete this contractor.</h6>
					<br />

					<button class="btn btn-falcon-success w-100" type="cancel" data-bs-dismiss="modal">Okay</button>

				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="newVendor" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg mt-6" role="document">
			<div class="modal-content border-0">
				<div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
				<div class="modal-body p-0">
					<div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
						<h4 class="mb-1" id="staticBackdropLabel">Add new Contractor</h4>
						<p class="fs-11 mb-0">By <a class="link-600 fw-semi-bold" href="#!"><?php echo $glog_full_name; ?></a></p>
					</div>
					<div class="p-4">
						<div class="row">
							<div id="sucSave" style="display: none;">
								<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
									<div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
									<p class="mb-0 flex-1">Contractor Registered Successfully</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							</div>
							<div id="errSave" style="display: none;">
								<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
									<div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
									<p class="mb-0 flex-1">Oops! Contractor Registration Failed. Please try again later.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="text-danger" id="errLog"></div>

								<div class="form-floating mb-3">
									<input class="form-control" id="vendor_title" type="text" placeholder="Company name" />
									<label for="vendor_title">Contractor name</label>
									<div class="text-danger" id="errvendor_title"></div>
								</div>


								<div class="row">
									<div class="col-md-6">
										<div class="form-floating mb-3">
											<input maxlength="10" class="form-control" id="vendor_phone" type="text" inputmode="numeric" placeholder="Phone number" />
											<label for="vendor_phone">Phone number</label>
											<div class="text-danger" id="errvendor_phone"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-floating mb-3">
											<input class="form-control" id="vendor_email" type="text" placeholder="Email address" inputmode="email" />
											<label for="vendor_email">Email</label>
											<div class="text-danger" id="errvendor_email"></div>
										</div>
									</div>

								</div>

								<br />
								<div class="form-floating">
									<textarea class="form-control" id="vendor_address" placeholder="Customer address" style="height: 70px"></textarea>
									<label for="vendor_address">Contractor address (Optional)</label>
								</div>
								<br />
								<div class="form-floating">
									<textarea class="form-control" id="vendor_description" placeholder="Customer address" style="height: 70px"></textarea>
									<label for="vendor_description">Contractor Description (Optional)</label>
								</div>
								<br />
								<div class="text-end">
									<button onClick="saveVendor()" class="btn btn-primary w-100" type="button">Save Contrator</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function validateEmail(email) {
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return emailRegex.test(email);
		}

		function validatePhone(phone) {
			const phoneRegex = /^0\d{9}$/;
			return phoneRegex.test(phone);
		}



		function saveVendor() {
			var vendor_title = document.getElementById('vendor_title').value;
			var vendor_phone = document.getElementById('vendor_phone').value;
			var vendor_email = document.getElementById('vendor_email').value;
			var vendor_address = document.getElementById('vendor_address').value;
			var vendor_description = document.getElementById('vendor_description').value;

			if (vendor_title === "") {
				document.getElementById('errvendor_title').innerHTML = "Contractor name can not be empty";
				return false;
			}
			//alert(vendor_email);
			if (vendor_email !== "") {
				if (!validateEmail(vendor_email)) {
					document.getElementById('errvendor_email').innerHTML = "Invalid email format";
					document.getElementById('vendor_email').focus();
					return false;
				}
			}
			if (!validatePhone(vendor_phone)) {
				document.getElementById('errvendor_phone').innerHTML = "Invalid phone number format";
				document.getElementById('vendor_phone').focus();
				return false;
			}



			var data = {
				vendor_title: vendor_title,
				vendor_phone: vendor_phone,
				vendor_email: vendor_email,
				vendor_address: vendor_address,
				vendor_description: vendor_description,
				created_user_id: <?php echo $glob_user_id; ?>
			};

			$.ajax({
				type: "POST",
				url: "../scripts/vendor_CRUD.php",
				data: data,
				success: function(response) {
					var resp = response;
					if (resp == 1) {
						document.getElementById("sucSave").style.display = "";
						document.getElementById('vendor_title').value = '';

						document.getElementById('vendor_phone').value = '';
						document.getElementById('vendor_email').value = '';
						document.getElementById('vendor_address').value = '';
						document.getElementById('vendor_description').value = '';


					} else {
						document.getElementById("errSave").style.display = "";
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
				document.getElementById('errvendor_title').innerHTML = "";
				document.getElementById('errvendor_email').innerHTML = "";
				document.getElementById('errvendor_phone').innerHTML = "";
				document.getElementById("sucSave").style.display = "none";
				document.getElementById("errSave").style.display = "none";

			});
		});




		//Retrieve Locations
	</script>

	<?php include('../incl/footer.php'); ?>