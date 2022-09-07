<?php if ($type != 'cp'){ ?>
<section id="home" class="slider" data-stellar-background-ratio="0.5" >
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              

                                   <?php 
                                   $row_counter = 1;
                                   $img_name = '';
                                   
                                   foreach($ads as $ad) {
                                   ?>
					
                                        <div class="item item-first" style="background-image: url(<?php echo base_url("/uploads/images/manipulated/thumbs/"); echo "/" . $ad->adPhotoName; ?>)" >
                                             
                                        </div>
                                        
  
    
  					
                                        
                                        

                                   <?php 
                                   $row_counter =  $row_counter +1;
                                   } ?>

                              
                              

                              

                             

                         </div>

               </div>
          </div>
     </section>
<br><br> 
<?php } ?>

<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<!--h1 class="h2">Welcome back, Charles</h1-->
							<!-- p class="lead">
								Sign in to your account to continue
							</p-->
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<!--img src=<?php echo base_url("/img/avatars/avatar.jpg"); ?> alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" /-->
									</div>
									<?php if (isset ($validation)):?>

										<div class="text-danger">
											<?= $validation->listErrors() ?>
										</div>
									<?php endif; ?> 

									<form id="frmUsers" name="frmUsers" method="POST"  enctype="multipart/form-data" >
										<div class="mb-3">
											<label class="form-label">Phone Number</label>
											<input class="form-control form-control-lg" type="text" name="phoneNumber" id="phone_number" placeholder="Enter your phone" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<small>
            <a href="/home/sign_in">Forgot password?</a>
          </small>
										</div>
										<div>
											<label class="form-check">
            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
            <span class="form-check-label">
              Remember me next time
            </span>
          </label>
										</div>
										<div class="text-center mt-3">
											 
											 <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
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

	<script src=<?php echo base_url("/js/app.js"); ?> ></script>