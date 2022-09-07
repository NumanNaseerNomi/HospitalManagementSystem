

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Account Data</strong> </h1>

					
					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-8 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<form method="post">
								<div class="card-body px-4">

						<div class="form-group"></br>
						<label for="">User Phone</label>
						<input type="text" class="form-control" placeholder="0541000000" name="acPhone" value="">
						</div>

						
						<div class="text-left mt-3">
							<button type="submit" class="btn btn-lg btn-primary" name="search" value="search">Search</button></br></br></br>
						</div>

									<!------------------Accounts Data Table --------------------->

										<?php if (count($existingRss) > 0):?>
										<h4>Reservations Data for <?php echo $acPhone ?></h4>
										<input type="hidden" class="form-control" name="lAcPhone" placeholder="" value="<?php echo $acPhone; ?>">

										<table class="table table-striped">
										<thead>
											<tr>
											<th scope="col">#</th>
											
											<th scope="col">Visitor</th>
											<th scope="col">Service</th>
											<th scope="col">Date & Time</th>
											<th scope="col">Attended</th>
											<th colspan="2" scope="col">Actions</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										foreach($existingRss as $res) {?>
											<tr>
											<th scope="row"><?php echo $row_counter; ?></th>
											<?php
											$titleName = $row_counter;
											$hNam = "hn".$row_counter;
      										$vNam = "vn".$row_counter;
											$sNam = "sn".$row_counter;
      										$dNam = "dn".$row_counter;
											$aNam = "an".$row_counter;
      										#$aLan = "l".$row_counter;
											?>

																						
											<td><div class="form-group">
											<label for=""><?php echo $res->vstrNam; ?></label>
											<input type="hidden" class="form-control" name="<?php echo $vNam?>" placeholder="" value="<?php echo $res->vstrNam; ?>">
											</div></td>
											
											<td><div class="form-group">
											<label for=""><?php echo $th_srv_nm[$res->compSrvKey]; ?></label>
											<input type="hidden" class="form-control" name="<?php echo $sNam?>" placeholder="" value="<?php echo $th_srv_nm[$res->compSrvKey]; ?>">
											</div></td> 

											

											<td><div class="form-group">
											<label for=""><?php echo $res->custResDt; ?></label>
											<input type="hidden" class="form-control" name="<?php echo $dNam?>" placeholder="" value="<?php echo $res->custResDt; ?>">
											</div></td> 

											<td><div class="form-group">
													<?php if(count ($existingRss) > 0):?>
														<?php if($res->custResAttended == 1):?>
															<label for="">Yes</label>														<?php 
														endif;
														if($res->custResAttended == 0):?>	
															<label for="">No</label>
														<?php endif;?>
														<?php endif;?>
														
													

											<input type="hidden" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $res->custResAttended; ?>">
											</div></td> 
											

											<td><button type="submit" class="btn btn-primary" name="delete_res" value="<?php echo $res->custResID?>">Delete</button></td>
											</tr>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										<?php endif; ?>	
									
								</div>





								<div class="card-body px-4">
									<!------------------Accounts Data Table --------------------->

										<?php if (FALSE): # count($existingAts) > 0?>
										<h4>Attchment Data</h4>
										<table class="table table-striped">
										<thead>
											
											<tr>
											<th scope="col">#</th>
											<th scope="col">Name</th>
											
											<th scope="col">Size</th>
											<th scope="col">Status</th>
											
											<th colspan="2" scope="col">Actions</th>
											</tr>
											
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										foreach($existingAts as $ats) {
										
											$titleName = $row_counter;
											$hNam = "hn".$row_counter;
      										$aNam = "an".$row_counter;
											$sNam = "sn".$row_counter;
      										$tNam = "tn".$row_counter;
											
											$uNam = "un".$row_counter;
      										
											?>
											
											<tr>
											<th scope="row"><?php echo $row_counter; ?></th>
											

											
											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $ats->attchName; ?>">
											</div></td>
											
											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $sNam?>" placeholder="" value="<?php echo $ats->attchSize; ?>">
											</div></td> 

											

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $tNam?>" placeholder="" value="<?php echo $ats->attchSntStat; ?>">
											</div></td> 

											
											

											<td><button type="submit" class="btn btn-primary" name="delete_ats" value="<?php echo $titleName?>">Delete</button></td>
											</tr>
											<tr>
											<td></td>
											<td alt="rtl"><strong>Summary</strong></td>
											<td colspan="4"><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $uNam?>" placeholder="" value="<?php echo $ats->attchSmary; ?>">
											</div></td> 
											</tr>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										<?php endif; ?>	
									
								</div>
							</div>
						</div>


						
					</div>

					

				</div>
			</main>

