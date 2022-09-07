




<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Account Data</strong> </h1>

					
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
											if($srvc->srvArc > 0){continue;}	
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
											
																						
											

																						
											<td><button type="submit" class="btn btn-primary" name="edit_srv" value="<?php echo $srvc->srvId?>">Edit</button></td>
											<td><button type="submit" class="btn btn-primary" name="arc_srv" value="<?php echo $srvc->srvId?>">Archive</button></td>
											</tr>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										<?php endif; ?>	
										</br></br>
										
										<?php if (count($existingServdt) < 1):?>
											<h4> Fill in the below form to add in a new service  </h4>
										<?php endif; ?>	
										<?php if (count($existingServdt) > 0):?>
											<h4> Fill in the below form to update the selected service  </h4>
										<?php endif; ?>	


										
										

										
										

												<div class="form-group">
												<div class="col-md-6 col-sm-6">
													<label for="select">Branch</label>
													<select name="brnch_name" class="form-control">
													<?php foreach($existingServsBrnch as $brnch) {
														if (count($anExistingServs) > 0 ):
															if($brnch->branchID == $anExistingServs[0]->cmpSrvBrnch):?>
																<option value="<?php echo $brnch->branchID ?>"selected><?php echo $brnch->BranchName; ?></option>
															<?php endif; ?>	
															<?php if($brnch->branchID != $anExistingServs[0]->cmpSrvBrnch):?>
																<option value="<?php echo $brnch->branchID ?>" ><?php echo $brnch->BranchName ?></option>
															<?php endif; ?>
														<?php endif;
														if (count($anExistingServs) < 1 ):?>
															<option value="<?php echo $brnch->branchID ?>"><?php echo $brnch->BranchName ?></option>
														<?php endif;?>
													<?php }?>
													</select>
													</div></div></br>
												
												
												

													<div class="form-group">
												<div class="col-md-6 col-sm-6">
													<label for="select">Department</label>
													<select name="dep_nam" class="form-control">
													<?php foreach($exstngSrvsDprtmnts as $dps) {
														if (count($anExistingServs) > 0 ):
															if($dps->DepID == $anExistingServs[0]->depKey):?>
																<option value="<?php echo $dps->DepID ?>"selected><?php echo $dps->DepName ?></option>
															<?php endif; ?>	
															<?php if($dps->DepID != $anExistingServs[0]->depKey):?>
																<option value="<?php echo $dps->DepID ?>"><?php echo $dps->DepName ?></option>
															<?php endif; ?>
														<?php endif;
														if (count($anExistingServs) < 1 ):?>
															<option value="<?php echo $dps->DepID ?>"><?php echo $dps->DepName ?></option>
														<?php endif;?>

														
													<?php }?>
													</select>
													</div></div>
												
												

												

												<div class="form-group"></br>
												<label for="">Service Name</label>
												<input type="text" class="form-control" placeholder="Ahmed" name="srvName" 
												value="<?php if (count($anExistingServs) > 0 ):
													echo $anExistingServs[0]->srvName;
												endif;?>">
												</div>

												<div class="form-group"></br>
												<label for="">Price</label>
												<input type="number" class="form-control" placeholder="100" name="srvPrice" 
												value="<?php if (count($anExistingServs) > 0 ):
													echo $anExistingServs[0]->srvPrice;
												endif;?>">
												</div>

												<div class="form-group"></br>
												<label for="">Pay URL</label>
												<input type="text" class="form-control" placeholder="www.payurl.com" name="payUrl" 
												value="<?php if (count($anExistingServs) > 0 ):
													echo $anExistingServs[0]->srvPyUrl;
												endif;?>">
												</div></br>

												<div class="form-group">
													<label for="" style="width: 97.97653%;">Service Bio</label>
													<div class="fa fa-info-circle font-i" style="right: 0px;" >
      												<div class="font-i-text"> &lt;b&gt;<b>bold</b>&lt;/b&gt;<br>&lt;i&gt;<i>italic</i>&lt;/i&gt;</div>
            										</div>
													<textarea class="form-control" name="serviceBio" rows="3"><?php if (count($anExistingServs) > 0 ):
														echo $anExistingServs[0]->srvBio;
													endif;?>
													</textarea>
												</div></br>
												

												<div class="form-group">

												<div class="col-md-6 col-sm-6">
													<label for="select">Is available</label>
													<select name="is_avilbl" class="form-control">
														<?php if(count ($anExistingServs) > 0):?>
														<?php if($anExistingServs[0]->srvAviStatus == 1):?>
															<option value="1" selected>Yes</option>
															<option value="0" >No</option>
														<?php 
														endif;
														if($anExistingServs[0]->srvAviStatus == 0):?>	
															<option value="1" >Yes</option>
															<option value="0" selected>No</option>
														<?php endif;?>
														<?php endif;?>
														<?php if(count ($anExistingServs) < 1):?>
															<option value="1" >Yes</option>
															<option value="0" >No</option>
														<?php endif;?>
													</select>
												</div>
												</div>
												</br>

												
												<input type="hidden" id="lastResDate" name="lastResDate"
												value="<?php if (count($anExistingServs) > 0 ):
													echo substr($anExistingServs[0]->srvLstResDt,0,10);
												endif;?>">

												

												

												
												



												

											<!--/form-->

										
										</div>

										
										<!------------------Default DateTime Data Table --------------------->

										<?php if (count($existingDtdt) > 0 && (count($existingServdt) < 1)):?>
										</br></br><h4>Service Working Hours Per Day</h4>
										<table class="my-table-class">
										
										<thead >
											<tr >  
											<th style="width: 1%">#</th>
											<th style="width: 19%">Days</th>
											<th style="width: 10%">Period</th>
											<th style="width: 15%">From</th>
											<th style="width: 15%">To</th>
											<th style="width: 10%">Duration(m)</th>
											<th style="width: 10%">Close Before(h)</th>
											<th style="width: 10%">Smart View</th>
											<th style="width: 10%">Is Active</th>

											
											</tr>
										</thead>
										<tbody >
										<?php 
										$row_counter = 1;
										foreach($existingDtdt as $addt) {?>
											<tr>
											<td scope="row"><?php #echo $row_counter; ?></td>
											<?php
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

											
											<input type="hidden" class="form-control" name="<?php echo $adfdtday?>" placeholder="" value="<?php echo $addt->dfdtday; ?>" >
											
											
											<?php if ($row_counter % 2 != 0) {?> 
											<td rowspan="2" ><div class="form-group">
											
											<label for="html"  ><?php echo $addt->dfdtday; ?></label>
											</div></td>
											<?php }?>

											
											<td><div class="form-group">
											<label for="html"  ><?php echo $addt->dfdtperiod; ?></label>

											<input type="hidden" class="form-control" name="<?php echo $adfdtperiod?>" placeholder="" value="<?php echo $addt->dfdtperiod; ?>" >
											</div></td>
											
											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtfrom?>" placeholder="" value="<?php echo $addt->dfdtfrom; ?>">
											</div></td> 

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtto?>" placeholder="" value="<?php echo $addt->dfdtto; ?>">
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
										


										<div class="text-center mt-3">
											<!--button type="submit" class="btn btn-lg btn-primary" name="add_account" value="add_account">Add</button </td> -->
											<button type="submit" class="btn btn-primary" name="add_srv" value="add_srv">Add New Service</button>
											</br></br></br>
										</div>

										<?php endif; ?>






										
										<?php 
										
										if (count($existingServdt) > 0):?>
										</br></br><h4>Service Working Hours Per Day</h4>
										<table class="my-table-class">
										<thead >
											<tr >  
											<th style="width: 1%"></th>
											<th style="width: 19%">Days</th>
											<th style="width: 10%">Period</th>
											<th style="width: 15%">From</th>
											<th style="width: 15%">To</th>
											<th style="width: 10%">Duration(m)</th>
											<th style="width: 10%">Close Before(h)</th>
											<th style="width: 10%">Smart View</th>
											<th style="width: 10%">Is Active</th>

											
											</tr>
										</thead>
										<tbody >
										<?php 
										$row_counter = 1;
										foreach($existingServdt as $esdt) {?>
											<tr>
											<td scope="row" ><?php #echo $row_counter; ?></td>
											
											
											<?php
											$titleName 			= $row_counter;
											$adfdtday           = "d".$row_counter;
											$adfdtperiod        = "p".$row_counter;
											$adfdtfrom          = "f".$row_counter;
											$adfdtto            = "t".$row_counter;
											$adfdtduration      = "r".$row_counter;
											$adfdtclosebefore   = "c".$row_counter;
											$adfdtsmartview     = "s".$row_counter;
											$adfdtisactive      = "a".$row_counter;
											$srvDtId			= "srvDtId".$row_counter;
											?>
											<input type="hidden" class="form-control" name="<?php echo $srvDtId?>" placeholder="" value="<?php echo $esdt->SrvDtId; ?>">

											
											<input type="hidden" class="form-control" name="<?php echo $adfdtday?>" placeholder="" value="<?php echo $esdt->srvDtDay; ?>" disabled>
											<?php if ($row_counter % 2 != 0) {?> 
											<td rowspan="2" ><div class="form-group">
											
											<label for="html"  ><?php echo $esdt->srvDtDay; ?></label>
											</div></td>
											<?php }?>

											
											<td><div class="form-group">
											<input type="hidden" class="form-control" name="<?php echo $adfdtperiod?>" placeholder="" value="<?php echo $esdt->srvDtPeriod; ?>" disabled>
											<label for="html"  ><?php echo  $esdt->srvDtPeriod; ?></label>
											</div></td>
											
											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtfrom?>" placeholder="" value="<?php echo $esdt->srvDtFrom; ?>">
											</div></td> 

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtto?>" placeholder="" value="<?php echo $esdt->srvDtTo; ?>">
											</div></td> 

											

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtduration?>" placeholder="" value="<?php echo $esdt->srvDtDur; ?>">
											</div></td> 

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $adfdtclosebefore?>" placeholder="" value="<?php echo $esdt->srvDtCloseBf; ?>">
											</div></td> 


											
											<td><div class="form-group">
												
													<select name="<?php echo $adfdtsmartview?>" class="form-control">
													<?php if($esdt->srvDtSmartView == 1):?>
															<option value="1" selected>Yes</option>
															<option value="0" >No</option>
															
														<?php 
														endif;
														if($esdt->srvDtSmartView == 0):?>	
															<option value="1" >Yes</option>
															<option value="0" selected>No</option>
														<?php endif;?>
													</select>
												
											<!--input type="text" class="form-control" name="<--?php echo $adfdtsmartview?>" placeholder="" value="<--?php echo $addt->dfdtsmartview; ?>"-->
											</div></td> 

											<td><div class="form-group">
												
													<select name="<?php echo $adfdtisactive?>" class="form-control">
														<?php if($esdt->srvDtIsActive == 1):?>
															<option value="1" selected>Yes</option>
															<option value="0" >No</option>
														<?php 
														endif;
														if($esdt->srvDtIsActive == 0):?>	
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
										


										<div class="text-center mt-3">
											<!--button type="submit" class="btn btn-lg btn-primary" name="add_account" value="add_account">Add</button </td> -->
											<button type="submit" class="btn btn-primary" name="update_srv" value="<?php echo $anExistingServs[0]->srvId?>">Update Current Service</button>
											</br></br></br>
										</div>

										<?php endif; ?>

										
										
											
									
								</div>
							</div>
						</div>


						
					</div>

					

				</div>

				
			</main>

			

