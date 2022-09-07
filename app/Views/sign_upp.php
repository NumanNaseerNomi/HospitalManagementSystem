<?php require_once($_SERVER['DOCUMENT_ROOT'].$ini_array); ?>


<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong><?php echo $lang['acc_data'] ; ?></strong> </h1>

					
					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-8 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0"><?php echo $lang['data_table'] ; ?></h5>
								</div>
								<form method="post">
								<div class="card-body px-4">
									<!------------------Accounts Data Table --------------------->

										<?php if (count($existingAccs) > 0):?>
										<h4><?php echo $lang['accs_data'] ; ?></h4>
										<table class="table table-striped">
										<thead>
											<tr>
											<th scope="col">#</th>
											<th scope="col"><?php echo $lang['name'] ; ?></th>
											<th scope="col"><?php echo $lang['phone'] ; ?></th>
											<th scope="col"><?php echo $lang['email'] ; ?></th>
											<th scope="col"><?php echo $lang['pass'] ; ?></th>
											<th scope="col"><?php echo $lang['type'] ; ?></th>
											<th scope="col"><?php echo $lang['lang'] ; ?></th>
											<th colspan="2" scope="col"><?php echo $lang['actions'] ; ?></th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										foreach($existingAccs as $acc) {?>
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
											<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $acc->AccName; ?>">
											</div></td>
											
											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aPhn?>" placeholder="" value="<?php echo $acc->AccNumb; ?>">
											</div></td>
											
											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aEml?>" placeholder="" value="<?php echo $acc->AccEmail; ?>">
											</div></td> 

											<td><div class="form-group">
											<input type="password" class="form-control" name="<?php echo $aPas?>" placeholder="***" value="">
											</div></td>

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aTyp?>" placeholder="" value="<?php echo $acc->compAccTypeKey; ?>">
											</div></td> 

											<td><div class="form-group">
											<input type="text" class="form-control" name="<?php echo $aLan?>" placeholder="" value="<?php echo $acc->AccPrefLang; ?>">
											</div></td> 
											
											<td><button type="submit" class="btn btn-primary" name="edit_acc" value="<?php echo $titleName?>">Update</button></td>
											<td><button type="submit" class="btn btn-primary" name="delete_acc" value="<?php echo $titleName?>">Delete</button></td>
											</tr>
										<?php $row_counter =  $row_counter +1;} ?>
										</tbody>
										</table>
										<?php endif; ?>	
									
								</div>
							</div>
						</div>


						<div class="col-12 col-md-6 col-xxl-4 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0"><?php echo $lang['form'] ; ?></h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
										
										

											<div class="form-group">

												<div class="col-md-6 col-sm-6">
													<label for="select"><?php echo $lang['acc_type'] ; ?></label>
													<select name="account_type" class="form-control">
														<option value="1"><?php echo $lang['admin'] ; ?></option>
														<option value="2"><?php echo $lang['receptionist'] ; ?></option>
													</select>
												</div>
												</div>
												</br>

												<div class="form-group">
												<div class="col-md-6 col-sm-6">
													<label for="select"><?php echo $lang['preferred_lang'] ; ?></label>
													<select name="Prf_lng" class="form-control">
														<option value="English"><?php echo $lang['eng'] ; ?></option>
														<option value="Arabic"><?php echo $lang['arab'] ; ?></option>
													</select>
												</div>
												</div>

												<div class="form-group"></br>
												<label for=""><?php echo $lang['name'] ; ?></label>
												<input type="text" class="form-control" placeholder="Ahmed" name="acName" value="">
												</div>

												<div class="form-group"></br>
												<label for=""><?php echo $lang['phone'] ; ?></label>
												<input type="text" class="form-control" placeholder="05XXXXXXXX" name="acPhone" value="">
												</div>

												<div class="form-group"></br>
												<label for=""><?php echo $lang['email'] ; ?></label>
												<input type="text" class="form-control" placeholder="example	@gmail.com" name="acEmail" value="">
												</div>

												<div class="form-group"></br>
												<label for=""><?php echo $lang['pass'] ; ?></label>
												<input type="Password" class="form-control" placeholder="***" name="acSec" value="">
												</div>

												


												
												</br>
												<div class="text-center mt-3">
													<button type="submit" class="btn btn-lg btn-primary" name="add_account" value="add_account"><?php echo $lang['add'] ; ?></button></br></br></br>
												</div>

											</form>

										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					

				</div>
			</main>

