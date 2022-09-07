




<main class="content">
				 <div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Reservations  Data</strong> </h1>

					
					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-8 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Data Table</h5>
								</div>
								<form method="post">
								<div class="card-body px-4">
									<!------------------Accounts Data Table --------------------->

																				<h4>Reservations Data</h4>
										<table class="table table-striped">
										<thead>
											<tr>
											<th scope="col" >#</th>
											
											<th scope="col" >Visitor</th>
											<th scope="col" >Service</th>
											<th scope="col" >Date & Time</th>
											<th scope="col" >Evaluation</th>
											

											
											
											</tr>
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										$row_checker = 1;
										foreach($existingRss as $res) {
											if($start_at > 0 && $row_checker < $start_at)
											{
												$row_checker = $row_checker + 1;
												continue;
											}	
										?>
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
											
											<label ><?php echo $res->vstrNam; ?></label>
											

											</div></td>
											
											<td><div class="form-group">
											
											<label><?php echo $th_srv_nm[$res->compSrvKey];  ?></label>
											
											</div></td> 

											

											<td><div class="form-group">
											<label > <?php echo  $res->custResDt; ?></label>											</div></td> 

											
											
											
											
											
											
											<?php if ($res->custResEval > 0) { ?>
											
											

											<td>
											<div class="wrapper">
											<div class="star-rating"> 
      											<input type="radio" name="stars<?php echo $row_counter?>" id="star<?php echo $row_counter?>-a" value="5" <?php if($res->custResEval == 5){echo "checked=\"checked\"";}?> />
      											<label for="star<?php echo $row_counter?>-a"></label>
      											<input type="radio" name="stars<?php echo $row_counter?>" id="star<?php echo $row_counter?>-b" value="4" <?php if($res->custResEval == 4){echo "checked=\"checked\"";}?> />
      											<label for="star<?php echo $row_counter?>-b"></label>
      											<input type="radio" name="stars<?php echo $row_counter?>" id="star<?php echo $row_counter?>-c" value="3" <?php if($res->custResEval == 3){echo "checked=\"checked\"";}?> />
     											<label for="star<?php echo $row_counter?>-c"></label>
     											<input type="radio" name="stars<?php echo $row_counter?>" id="star<?php echo $row_counter?>-d" value="2" <?php if($res->custResEval == 2){echo "checked=\"checked\"";}?> />
      											<label for="star<?php echo $row_counter?>-d"></label>
      											<input type="radio" name="stars<?php echo $row_counter?>" id="star<?php echo $row_counter?>-e" value="1" <?php if($res->custResEval == 1){echo "checked=\"checked\"";}?> />
      											<label for="star<?php echo $row_counter?>-e"></label>
											</div>
											</td>
											<tr>
											<td colspan="5">
												<input type="text" class="form-control" name="ratngCmnt<?php echo $row_counter?>" placeholder="" value="<?php echo $res->custResCmnt; ?>">
											</td> 
											</tr>
											
											
											 <?php } ?>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
																			
								</div>
 										
										

										
										

										
										

												
												
												
												

													
												
												

												

												
												

												

												

												

												
												


											
									
								
							</div>
						</div>


						
					</div>

					

				</div>

				
			</main>

			

