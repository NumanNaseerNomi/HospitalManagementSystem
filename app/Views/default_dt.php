




<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Account Data</strong> </h1>

					
				<!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv by fares -->
					<?php if ($_SESSION['conflict'] == true) 
							echo '<div style="
							padding: 15px;
							color: rgb(115 0 11);
							background-color: rgb(255 140 151);
							border: 1px solid rgb(255 0 27);
							margin-bottom: 15px;
							border-radius: 4px;">
											  Couldn\'t save; inserted times are not logical
										</div>';
					?>
					<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ By fares-->


					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-9 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Default datetime </h5>
								</div>
								<form method="post">
								<div class="card-body px-4">
									
									
									<!------------------Accounts Data Table --------------------->

										<?php if (count($existingDtdt) > 0):?>
										<h4>Default Working Hours Per Day</h4>
										<table class="my-table-class"> 
										<thead >
											<tr >  
											<th style="width: 19%">Days</th>
											<th style="width: 10%">Period</th>
											<th style="width: 15%">From</th>
											<th style="width: 15%">To</th>
											<th style="width: 10%">Duration</th>
											<th style="width: 10%">Close Before</th>
											<th style="width: 10%">Smart View</th>
											<th style="width: 10%">Is Active</th>

											
											</tr>
										</thead>
										<tbody >
										<?php 
										$row_counter = 1;
										$sh_row_counter = 1;
										foreach($existingDtdt as $addt) {?>
											
											<?php if ($row_counter % 2 != 0) { ?>
											<tr >
											<?php $sh_row_counter = $sh_row_counter + 1;} else {?>
											<tr>
											<?php }
											$titleName 			= $row_counter;
											$adfdtday           = "d".$row_counter;
											$adfdtperiod        = "p".$row_counter;
											$adfdtfrom          = "f".$row_counter;
											$adfdtto            = "t".$row_counter;
											$adfdtduration      = "r".$row_counter;
											$adfdtclosebefore   = "c".$row_counter;
											$adfdtsmartview     = "s".$row_counter;
											$adfdtisactive      = "a".$row_counter;

											?>
											<input type="hidden" class="form-control" name="<?php echo $adfdtday?>" placeholder="" value="<?php echo $addt->dfdtday; ?>">
											<?php if ($row_counter % 2 != 0) {?> 
											<td rowspan="2" ><div class="form-group">
											
											<label for="html"  ><?php echo $addt->dfdtday; ?></label>
											</div></td>
											<?php }?>
											<input type="hidden" class="form-control" name="<?php echo $adfdtperiod?>" placeholder="" value="<?php echo $addt->dfdtperiod; ?>">
											<td><div class="form-group">
											<label for="html"  ><?php echo $addt->dfdtperiod; ?></label>
											</div></td>
											
											<td><div class="form-group">
											<input type="time" class="form-control" name="<?php echo $adfdtfrom?>" placeholder="" value="<?php echo $addt->dfdtfrom; ?>" >
											</div></td> 

											<td><div class="form-group">
											<input type="time" class="form-control" name="<?php echo $adfdtto?>" placeholder="" value="<?php echo $addt->dfdtto; ?>">
											</div></td> 

											

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtduration?>" placeholder="" value="<?php echo $addt->dfdtduration; ?>">
											</div></td> 

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtclosebefore?>" placeholder="" value="<?php echo $addt->dfdtclosebefore; ?>">
											</div></td> 

											<td><div class="form-group">
												
													<select name="<?php echo $adfdtsmartview?>" class="form-control">
													<?php if($addt->dfdtsmartview == 1):?>
															<option value="1" selected>Yes</option>
															<option value="0" >No</option>
														<?php 
														endif;
														if($addt->dfdtsmartview == 0):?>	
															<option value="1" >Yes</option>
															<option value="0" selected>No</option>
														<?php endif;?>
													</select>
												
											<!--input type="text" class="form-control" name="<--?php echo $adfdtsmartview?>" placeholder="" value="<--?php echo $addt->dfdtsmartview; ?>"-->
											</div></td> 

											<td><div class="form-group">
												
													<select name="<?php echo $adfdtisactive?>" class="form-control">
														<?php if($addt->isActive == 1):?>
															<option value="1" selected>Yes</option>
															<option value="0" >No</option>
														<?php 
														endif;
														if($addt->isActive == 0):?>	
															<option value="1" >Yes</option>
															<option value="0" selected>No</option>
														<?php endif;?>
													</select>
												
											<!--input type="text" class="form-control" name="<--?php echo $adfdtisactive?>" placeholder="" value="<--?php echo $addt->isActive; ?>"-->
											</div></td> 
											
											</tr>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										<?php endif; ?>	
										<button type="submit" class="btn btn-primary" name="edit_dt" value="edit_dt">Save</button></td>
										
											
									
								</div>
							</div>
						</div>


						
					</div>

					

				</div>
			</main>

