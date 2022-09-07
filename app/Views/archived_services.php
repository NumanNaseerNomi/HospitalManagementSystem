




<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Archived Services Data</strong> </h1>

					
					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-9 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Services </h5>
								</div>
								<form method="post">
								<div class="card-body px-4">
									
									
								<div class="chart">

									<!------------------Accounts Data Table --------------------->

									<?php if (count($existingServs) > 0):?>
										<h4>Accounts Data</h4>
										<table class="table table-striped">
										<thead>
											<tr>
											<th  scope="col">#</th>
											<th  scope="col">Branch</th>
											<th  scope="col">Depart.</th>
											<th  scope="col">Name</th>
											<th  colspan="2" scope="col">Actions</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										foreach($existingServs as $srvc) {
											if($srvc->srvArc == 0){continue;}	
										?>
											<tr>
											<th scope="row"><?php echo $row_counter; ?></th>
											<?php
											$titleName = $row_counter;
											$aNam = "n".$row_counter;
      										$aPhn = "p".$row_counter;
											$aEml = "e".$row_counter;
      										$aPas = "s".$row_counter;
											$aTyp = "t".$row_counter;
      										$aLan = "l".$row_counter;
											?>

											<td><div class="form-group"> 
											<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $srvc->BranchName; ?>" disabled>
											</div></td>

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $srvc->DepName; ?>" disabled>
											</div></td>

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $srvc->srvName; ?>" disabled>
											</div></td>
											
																						
											

																						
											<td><button type="submit" class="btn btn-primary" name="rstor_srv" value="<?php echo $srvc->srvId?>">Restore</button></td>
											<td><button type="submit" class="btn btn-primary" name="dlt_srv" value="<?php echo $srvc->srvId?>">Delete</button></td>
											</tr>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										<?php endif; ?>	
										</br></br>
										
										

										
										

										
										

												
												
												
												

													
												
												

												

												
												

												

												

												

												
												


											
									
								</div>
							</div>
						</div>


						
					</div>

					

				</div>

				
			</main>

			

