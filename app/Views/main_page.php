<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>The Main Page</strong> </h1>

					
					<div class="row">
						
						
						<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Real-Time</h5>
								</div>
								 
								
								<div class="card-body px-4">
									<!------------------Accounts Data Table --------------------->

										<?php if (count($existingSvs) > 0){?>
										<h4>Services Data</h4>
										<form method="post">
										<table class="table table-striped">
										<thead>
											
											<tr>
											<th scope="col">#</th>
											<th scope="col">Name</th>
																						<th scope="col">Week</th>
											<th colspan="2" scope="col">Actions</th>
											</tr>
											
										</thead>
										<tbody>

										<?php 
										$row_counter = 1;
										foreach($existingSvs as $svs) {
											if($svs->srvArc > 0){continue;}
											$titleName = $row_counter;
											
											$sNam = "sn".$row_counter;
      										
      										
											?>
											
											<tr>
											<th scope="row"><?php echo $row_counter; ?></th>
											

											
											
											<td><div class="form-group">
												
													<input type="text" class="form-control" name="<?php echo $sNam?>" placeholder="" value="<?php echo $svs->srvName; ?>" >


													<input type="hidden" class="form-control" name="<?php echo $sNam.$row_counter?>" placeholder="" value="<?php echo $svs->srvId; ?>" >

												
											</div></td> 


											
											

											<td>
												<select name="<?php echo "week_head".$row_counter?>" class="form-control">
													<option value=""></option>

													<?php foreach($week_heads as $a_week_head) { 
														
													if(count($sev_dt_crds[$svs->srvId]) > 0) {
														$abool = true;
														foreach($sev_dt_crds[$svs->srvId] as $dt_card) {	
															
															if(($a_week_head == $dt_card->wklyDtCrd)){
																$abool = false;?>
																<option style="font-weight: bold;" value="<?php echo $a_week_head; ?>"><?php echo $a_week_head; ?></option>
														<?php } } 
														
														if($abool) { ?>
															<option value="<?php echo $a_week_head; ?>"><?php echo $a_week_head; ?></option>

														
														<?php }
														} else { ?>
															
														
															<option value="<?php echo $a_week_head; ?>"><?php echo $a_week_head; ?></option>
														 <?php } } ?>
														
														
															
																																											
													


													</select>

											</td>
											

											

											<td><button type="submit" class="btn btn-primary" name="acti_svs" value="<?php echo $svs->srvId.".".$row_counter?>">Activate</button></td>
											<td><button type="submit" class="btn btn-primary" name="edit_svs" value="<?php echo $svs->srvId.".".$row_counter ?>">Edit</button></td>

											</tr>
											
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										</form>



										<table  class="table">
										<thead>
											
											<tr >
											
											<th scope="col">Name</th>
											<th scope="col">Week</th>
											<th scope="col">Sunday</th>
											<th scope="col">Monday</th>
											<th scope="col">Tuesday</th>
											<th scope="col">Wednesday</th>
											<th scope="col">Thersday</th>
											<th scope="col">Friday</th>
											<th scope="col">Saterday</th>
											</tr>
											
										</thead>
										<tbody>


										<?php  }; 

										foreach($existingSvs as $svs) {
											
											$week_counter = 1;
											foreach ( $detaiedNextWeeksHolder[$svs->srvId] as $key=>$value)
											{
												if($week_counter == 1)
												{
													echo "<tr>";
												 	echo "<td>" . $svs->srvName . "</td>";
													echo "<td>" . $key . "</td>";

												}													
												if($value == 0)
												{echo "<td class=\"bg-success\" ></td>";}
												if($value == 1)
												{echo "<td class=\"bg-warning\" ></td>";}

												if($value == 2)
												{echo "<td class=\"bg-danger\" ></td>";}
												if($value == -1)
												{echo "<td class=\"bg-secondary\" ></td>";}

												
												
												
												$week_counter = $week_counter + 1;
												if($week_counter > 7)
												{echo "</tr>";$week_counter = 1;}
												
											}
											
										}

										?>	
										</tbody>
										</table>

									
								</div>
							</div>
						</div>


						
					</div>

					

				</div>
			</main>