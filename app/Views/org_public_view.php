
     <!-- HOME -->


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
                                             <div class="caption">
                                                  <div class="col-md-offset-1 col-md-10">
							<a href="<?php echo $ad->adUrl; ?>" target="_blank" rel="noopener noreferrer" class="section-btn btn btn-default smoothScroll public-btn">Book Now</a>
						  </div>
                                             </div>
                                        </div>
                                        
  
    
  					
                                        
                                        

                                   <?php 
                                   $row_counter =  $row_counter +1;
                                   } ?>

                              
                              

                              

                             

                         </div>

               </div>
          </div>
     </section>
<section id="appointment">
<?php if ($page_link == 'm') :?>
     <!--  -->
    <nav class="navtop">
         
         <form method="POST">
          </br>
          <div class="container-fluid">
          <div class="row">
	  <div class="col-sm-4" >
          <label for="select">Branch</label>
               <select name="brnch_name" id="aj_brnch_name" class="form-control">
               <option value="select a branch" ><?php echo "select a branch" ?></option>
               
               <?php 
                    
                    foreach($existingServsBrnch as $brnch) {
                    
                    ?>
                         <option value="<?php echo $brnch->branchID ?>" ><?php echo $brnch->BranchName ?></option>
                    

                    
               <?php }?>

               </select> 
          </div>
          </div>
	  
         
          <div class="row">
	  <div class="col-sm-4" >
               <label for="select" >Department</label> <span class="loader" id="aj_dep_loader" title="2" visibility="hidden">
          </span>
               <select name="dep_name" id="aj_dep_name" class="form-control" disabled></select>
              
          </div></div>

          
          
          <div class="row">
	  <div class="col-sm-4" >
               <label for="select">Service</label><span class="loader" id="aj_serv_loader" title="2" visibility="hidden">
          </span>
               <select name="serv_name" id="aj_serv_name" class="form-control" disabled="true"></select>
              
          </div></div>

          
          
          
          <div class="row">
	  <div class="col-sm-4" >
          <label name="bio_name" id="aj_bio_name"  for="bio"><?php #echo $srvs_bio; ?></label>
          </div>
          </div>
	  



          <div class="row">
	  <div class="col-sm-4" >
               <label for="select">Choose Day</label><span class="loader" id="aj_day_loader" title="2" visibility="hidden">
          </span>
               <select name="open_days" id="aj_open_days" class="form-control" disabled="true"></select>
          </div></div>
          

          
          <div class="row">
	  <div class="col-sm-4" >
               <label for="select">Choose Time</label><span class="loader" id="aj_time_loader" title="2" visibility="hidden">
          </span>
               <select name="open_times" id="aj_open_times" class="form-control" disabled="true">
               <?php foreach($ftime_list as $opt) {
                   ?>
                         <option value="<?php echo $opt ?>"><?php echo $opt ?></option>
 
               <?php }?>
               </select>

          </div></div>

        
          
          
          <div class="row">
	  <div class="col-sm-4" >
               <label for="PatintName">Visitor Name</label>
               <input type="text" class="form-control" name="PatintName" placeholder="Visitor Name" value="<?php if (isset($_SESSION['logedin']))
                                                                                                                   { echo $_SESSION['logedin']; }
                                                                                                                   else{
                                                                                                                        echo "";
                                                                                                                   } ?>"> 
          </div></div>
          
          <div><p style="color:red;"><?php echo $theError; ?> </p></div>

          

          



          <div class="row">
	  <div class="col-sm-4" ></br>
               <?php if (isset($_SESSION['logedin']))
               { ?>
                    <button type="submit" class="btn btn-primary public-btn" name="save_apnt" value="save_apnt">Save</button>
               <?php }
               else{?>
               <span class="sgn-icon"><i class="fa fa-envelop-o"></i> <a class="public-btn" href=<?php echo base_url("/home/sign_in/pp"); ?>  >Sign In</a></span>

                  
               <?php }; ?>
               
            
          </div>
          </div>
          </div>
          </form>

          

          
          

          </br></br></br><div>

          

          

              
	    		<!--h4>Event Calendar</h4-->
	    	</div>
	    </nav>
		<div class="content home">
			<!--?=$calendar?-->
		</div>

          
												
          
          

          
   </section>

    


     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s"><?php echo $compPublicName; ?></h2>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <pre><?php echo $compWhoRwe; ?></pre>
                                   
                              </div>
                              <!--figure class="profile wow fadeInUp" data-wow-delay="1s">
                                   <img src="/images/author-image.jpg" class="img-responsive" alt="">
                                   <figcaption>
                                        <h3>Dr. Neil Jackson</h3>
                                        <p>General Principal</p>
                                   </figcaption>
                              </figure-->
                         </div>
                    </div>
                    
               </div>
          </div>
     </section>



     <!--button type="type" id="btn-click">Click Me</button-->
     



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <script>
   
                  

   $(document).ready(function(){

     
     

     
           
     
     

     //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv by fares
     
     function loader(item){
        

          $(item).show();
          const innerHTML = '  <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"'
                         + 'width="20px" height="20px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">'
                     + '<path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">'
                        + '<animateTransform attributeType="xml"attributeName="transform"type="rotate"from="0 25 25"to="360 25 25"dur="0.6s"repeatCount="indefinite"/>'
                    +'</path></svg>';
          
          $(item).html(innerHTML);

          
     }

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ by fares


$('#aj_brnch_name').change(function(){
console.log("b11" );


    var brn_id = $('#aj_brnch_name').val();

    //var action = 'get_service';
    var action = 'get_department';

   
    if(brn_id != '')
    {


	 
        $.ajax({
	    url:  " <?=site_url('handle-myajax');?>", 
            method:"POST",
            data:{brn_id:brn_id, action:action},
            dataType: "json",
            success:function(data)
            {
	       console.log("b22" );
               //console.log(data.data[0].srvId);
	       //alert(data.data.length);	
               //var html = '<option value="">Select Service</option>';
               loader("#aj_dep_loader");
	       var html = '<option value="">Select Department</option>';


               for(var count = 0; count < data.data.length; count++)
               {   
                    

                   //html += '<option value="'+data.data[count].srvId+'">'+data.data[count].srvName+'</option>';
		   html += '<option value="'+data.data[count].DepID+'">'+data.data[count].DepName+'</option>';

               }

               //$('#aj_serv_name').html(html);
               
		$('#aj_dep_name').html(html);
          $('#aj_dep_name').attr('disabled', false)
          // $('#aj_dep_loader').html('');
          // $('#aj_dep_loader').hide()
            }, 

        });
    }
    else
    {
        //$('#aj_serv_name').val('');
	$('#aj_dep_name').val('');
    }
    //$('#aj_open_days').val('');
    $('#aj_serv_name').val('');

});

$('#aj_dep_name').change(function(){
console.log("b11" );


    var brn_id = $('#aj_brnch_name').val();
    var dep_id = $('#aj_dep_name').val();
    var action = 'get_service';
    //var action = 'get_department';

   
    if(brn_id != '' && dep_id != '')
    {


	 
        $.ajax({
	    url:  " <?=site_url('handle-myajax');?>", 
            method:"POST",
            data:{brn_id:brn_id, dep_id:dep_id, action:action},
            dataType: "json",
            success:function(data)
            {
	       console.log("b22" );
               //console.log(data.data[0].srvId);
	       //alert(data.data.length);	
               loader('#aj_serv_loader');
               var html = '<option value="">Select Service</option>';
	       //var html = '<option value="">Select Department</option>';


               for(var count = 0; count < data.data.length; count++)
               {   
                    

                   html += '<option value="'+data.data[count].srvId+'">'+data.data[count].srvName+'</option>';
		   //html += '<option value="'+data.data[count].DepID+'">'+data.data[count].DepName+'</option>';

               }

               $('#aj_serv_name').html(html);
               $('#aj_serv_name').attr('disabled', false)
               $('#aj_serv_loader').html('');
               $('#aj_serv_loader').hide();
		//$('#aj_dep_name').html(html);
            }, 

        });
    }
    else
    {
        $('#aj_serv_name').val('');
	//$('#aj_dep_name').val('');
    }
    $('#aj_open_days').val('');
    //$('#aj_serv_name').val('');

});


$('#aj_serv_name').change(function(){

var brn_id = $('#aj_brnch_name').val();
var srv_id = $('#aj_serv_name').val();

var action = 'get_open_days';
console.log("b33" );
if(srv_id != '')
{
    $.ajax({
        url:  " <?=site_url('handle-myajax');?>", 
        method:"POST",
        data:{brn_id:brn_id, srv_id:srv_id, action:action},
        dataType: "json",
        success:function(data)
          {
	   console.log("b44" );
               loader('#aj_day_loader');
           var html = '<option value="">Select Day</option>';

           for(var count = 1; count < data.arr_len; count++)
           {   
                
	       if (typeof data.data[count] !== 'undefined') {
                    html += '<option value="'+data.data[count]+'">'+data.data[count]+'</option>';
               }

               

           }

           $('#aj_open_days').html(html);
	   var anHtml = data.data[0];
	   $('#aj_bio_name').html(anHtml);
        $('#aj_open_days').attr('disabled', false)
               $('#aj_day_loader').html('');
               $('#aj_day_loader').hide();

        }
    });
}
else
{
    $('#aj_open_days').val('');
}
$('#aj_open_times').val('');
});





$('#aj_open_days').change(function(){

var brn_id = $('#aj_brnch_name').val();
var srv_id = $('#aj_serv_name').val();
var day_id = $('#aj_open_days').val();

var action = 'get_open_times';

if(day_id != '')
{
    $.ajax({
        url:      " <?= base_url('handle-myajax'); ?>", 
        method:"POST",
        data:{brn_id:brn_id, srv_id:srv_id, day_id:day_id, action:action},
        dataType:"JSON",
        success:function(data)
        {
           console.log(data.arr_len);
           loader('#aj_time_loader');
           var html = '<option value="">Select Time</option>';

           for(var count = 0; count <= data.arr_len+100; count++)
           {   
               if (typeof data.data[count] !== 'undefined') {
                    html += '<option value="'+data.data[count]+'">'+data.data[count]+'</option>';
               }

           }

           $('#aj_open_times').html(html);
          $('#aj_open_times').attr('disabled', false)
               $('#aj_time_loader').html('');
               $('#aj_time_loader').hide();
           
        }
    });
}
else
{
    $('#aj_open_times').val('');
}
//$('#aj_open_times').val('');
});





});

     </script>


     

<?php endif; ?>


<?php if ($page_link == 'b') :?>
     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment1" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    

                    <div class="col-md-6 col-sm-6">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   
                                   <?php 
                                   $row_counter = 1;
                                   $img_name = '';
                                   foreach($pages as $page) {
                                   ?>
                                        <?php if ($row_counter == $to_page):?>
                                        <h2><?php echo $page->pageName; ?></h2>
                                        <h4><?php echo $page->pageTxt; $img_name= $page->pagePhoto;?></h4>
                                        <?php endif; ?>	

                                   <?php 
                                   $row_counter =  $row_counter +1;
                                   } ?>

                              </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!--"/images/appointment-image.jpg"-->
                         <!--/uploads/images/manipulated/pagePhoto1.jpg-->
                         <img src=" <?= base_url("/uploads/images/manipulated/")?><?php echo "/". $img_name?>" class="img-responsive" alt="">
                    </div>

               </div>
          </div>
     </section>
<?php endif; ?>


<?php if ($page_link == 'register' || $page_link == 'chngInfo') :?>
     <!-- MAKE AN APPOINTMENT -->
     <!-- <Style>
          #home {
               display: none;
          }
     </Style> -->

     <section id="register" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

              
               <div class="col-12 col-md-6 col-xxl-4 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
							
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
																					
										<?php if (isset ($validation)){?>

										<div class="text-danger">
											<?= $validation->listErrors();?>
											
											
												
										
										<?php } 
										if(count($listErrors) > 0)
											{
												print($listErrors[0]);
											}
										?> 
										
										</div>

										


										
										<form id="rgUsers" name="rgUsers" method="POST" action="" enctype="multipart/form-data" >


											
											

												<div class="form-group">
												
													<label for="select">Preferred Language</label>
													<select name="Prf_lng" class="form-control">
														<option value="English">English</option>
														<option value="Arabic">Arabic</option>
													</select>
												
												</div>
                                                            

												<div class="form-group"></br>
												<label for="">Name</label>
												<?php if($page_link == 'register') {?>
													<input type="text" class="form-control" placeholder="Ahmed" name="acName" value="">
												<?php } else { ?>
													<input type="text" class="form-control" placeholder="info" name="acName" value="<?php echo $exUsrData->AccName; ?>">
												<?php } ?>

												
												</div>

												<div class="form-group"></br>
												<label for="">Phone</label>
												<?php if($page_link == 'register') {?>
													<input type="text" class="form-control" placeholder="0541000000" name="acPhone" value="">
												<?php } else { ?>
													<input type="text" class="form-control" placeholder="info" name="acPhone" value="<?php echo $exUsrData->AccNumb; ?>">
												<?php } ?>


												
												</div>

												<div class="form-group"></br>
												<label for="">Email</label>
												<?php if($page_link == 'register') {?>
													<input type="text" class="form-control" placeholder="abc@gmail.com" name="acEmail" value="">
												<?php } else { ?>
													<input type="text" class="form-control" placeholder="info@gmail.com" name="acEmail" value="<?php echo $exUsrData->AccEmail; ?>">
												<?php } ?>

												
												</div>

												<div class="form-group"></br>
												<label for="">Password</label>
												<input type="Password" class="form-control" placeholder="***" name="acSec" value="">
												</div>

												


												
												</br>
												<div class="text-center mt-3">
													<?php if($page_link == 'register') {?>
													<button type="submit" class="btn btn-lg btn-primary" name="add_account" value="add_account">Register</button></br></br></br>
													<?php } else { ?>
													<button type="submit" class="btn btn-lg btn-primary" name="cng_account" value="cng_account">Update</button></br></br></br>
													<?php } ?>
												</div>

											</form>

										
										</div>
									</div>
								</div>
							</div>
						</div>
     

                   

               </div>
          </div>
     </section>
<?php endif; ?>



<?php if ($page_link == 'appointments') :?>

     <!-- 

     

     -->

     <!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">My Appointments</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Attended Appointments</button>
</div>





<!-- Tab content -->
<div id="London" class="tabcontent">



     <div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Account Data</strong> </h1>

					
					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-8 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Data Table</h5>
								</div>
								<form method="post">
								<div class="card-body px-4">
									<!------------------Accounts Data Table --------------------->

										<?php if (count($existingRss) > 0):?>
										<h4>Reservations Data</h4>
										<table class="table table-striped">
										<thead>
											<tr>
											<th scope="col" WIDTH="1%">#</th>
											
											<th scope="col" WIDTH="19%">Visitor</th>
											<th scope="col" WIDTH="60%">Service</th>
											<th scope="col" WIDTH="20%">Date & Time</th>
											
											<th scope="col" >Actions</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										$row_checker = 1;
										
										$new_count_chk = 0;
										
										for ($x = count($existingRss)-1; $x > -1 && $new_count_chk < 10; $x--) {
											$new_count_chk = $new_count_chk + 1;
  											# echo count($existingRss);
											
											$res = (object) $existingRss[$x];
											
											#}
											#foreach($existingRss as $res) {
											#if($start_at > 0 && $row_checker < $start_at)
											#{
											#	$row_checker = $row_checker + 1;
											#	continue;
											#}	
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

											
											
											
											
											<td>
												<?php  $c_time = date('Y-m-d'); # echo $c_time; ?> 
												<?php  $r_time = date('Y-m-d',strtotime($res->custResDt));  # echo $r_time; ?> 
												
												<button type="submit" class="btn btn-danger" name="delete_res" value="<?php echo $res->custResID?>"  <?php if($r_time <= $c_time) {echo "disabled";} ?>>Delete</button>
											</td>
											</tr>
											<?php if ($res->custResAttended == 1 && $res->custResEval < 1) { ?>
											<tr>
											<td></td>

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
											<td colspan="2">
												<input type="text" class="form-control" name="ratngCmnt<?php echo $row_counter?>" placeholder="" value="<?php echo $res->custResCmnt; ?>">
											</td> 
											<td><button type="submit" class="btn btn-primary" name="rate_res" value="<?php echo $titleName . "." . $res->custResID;?>" <?php if($res->custResAttended == 0){echo "disabled";}?>>Rate</button></td>
											</tr> <?php } ?>
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
											<th scope="col">Hospital</th>
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
											<input type="text" class="form-control" name="<?php echo $hNam?>" placeholder="" value="<?php echo $ats->compKey; ?>">
											</div></td>
											
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
<?php endif; ?>

</div>

<div id="Paris" class="tabcontent">
  <h3>Paris</h3>
  <p>Paris is the capital of France.</p>
</div>




     


     

