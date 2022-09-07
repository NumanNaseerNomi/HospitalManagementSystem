




<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Weekly Config Data</strong> </h1>

					
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

												<div class="form-group">
          <div class="col-md-6 col-sm-6">
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
         
          
          <div class="form-group">
	  <div class="col-md-6 col-sm-6">
               <label for="select">Department</label>
               <select name="dep_name" id="aj_dep_name" class="form-control"></select>
              
          </div></div>

          
          <div class="form-group">
          <div class="col-md-6 col-sm-6">
               <label for="select">Service</label>
               <select name="srvc_name" id="aj_serv_name" class="form-control"></select>
              
          </div></div>

												<div class="form-group">
												<div class="col-md-6 col-sm-6">
													<label for="select">Config Week</label>
													<select name="srvc_dt" id="aj_srvc_dt" class="form-control">
													<?php foreach($cwsdh as $a_cwsdh) {?>;
														<option value="<?php echo $a_cwsdh->wklyDtCrd?>"><?php echo $a_cwsdh->wklyDtCrd  ?></option>													<?php }?>
													</select>
												</div></div></br>
	
												<div class="form-group">

												<button type="submit" class="btn btn-primary" name="get_cnfig_data" value="get_cnfig_data">Get Config Data</button>
												</div>


																						
																				


										





										
										<?php 
										
										if (count($existingServdt) > 0):
										

										echo $brnch_name . 	"</br>";
										echo $dept_name  . 	"</br>";

										echo $serv_name  . 	"</br>";
										echo $date_of_week_head ."</br>";



										?>
										
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
										$update_id = -1;
										foreach($existingServdt as $esdt) { 
											$update_id = -1;
											if(property_exists($esdt,'wklySrvDtId')){
												$update_id = $esdt->wklySrvDtId;
												
											}
											if(property_exists($esdt,'SrvDtId')){
												$update_id = $sevId . "." . $srvDt;//$esdt->SrvDtId;
												
											}
											
											?>
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
											$wklySrvDtId	    = "wklySrvDtId".$row_counter;
											?>
											
											<input type="hidden" class="form-control" name="<?php echo $wklySrvDtId;?>" placeholder="" value="<?php echo $update_id; ?>" >
											
											
											<input type="hidden" class="form-control" name="<?php echo $adfdtday?>" placeholder="" value="<?php echo $esdt->srvDtDay; ?>" disabled>
											<?php if ($row_counter % 2 != 0) {?> 
											<td rowspan="2" ><div class="form-group">
											
											<label for="html"  ><?php echo $esdt->srvDtDay; ?></label>
											</div></td>
											<?php }?>


																						
											<td><div class="form-group">
											<label for="html"  ><?php echo $esdt->srvDtPeriod; ?></label>
											<input type="hidden" class="form-control" name="<?php echo $adfdtperiod?>" placeholder="" value="<?php echo $esdt->srvDtPeriod; ?>" disabled>
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
											<?php if(!$is_found) {?>
												<button type="submit" class="btn btn-primary" name="upt_wkly_srv" value="<?php echo $update_id?>">Update Current Service Weekly Config</button>
											<?php } ?>
											<?php if($is_found) {?>
												There are reservations on this week; you have to take care of them before you can adjest this week configurations !
												<button type="submit" class="btn btn-primary" name="upt_wkly_srv" value="<?php echo $update_id;?>"disabled>Update Current Service Weekly Config</button>
											<?php } ?>

											</br></br></br>
										</div>

										<?php endif; ?>

										
										
											
									
								</div>
							</div>
						</div>


						
					</div>

					

				</div>

				
			</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     
<script>
   
$(document).ready(function(){

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
	       var html = '<option value="">Select Department</option>';


               for(var count = 0; count < data.data.length; count++)
               {   
                    

                   //html += '<option value="'+data.data[count].srvId+'">'+data.data[count].srvName+'</option>';
		   html += '<option value="'+data.data[count].DepID+'">'+data.data[count].DepName+'</option>';

               }

               //$('#aj_serv_name').html(html);
		$('#aj_dep_name').html(html);
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
               var html = '<option value="">Select Service</option>';
	       //var html = '<option value="">Select Department</option>';


               for(var count = 0; count < data.data.length; count++)
               {   
                    

                   html += '<option value="'+data.data[count].srvId+'">'+data.data[count].srvName+'</option>';
		   //html += '<option value="'+data.data[count].DepID+'">'+data.data[count].DepName+'</option>';

               }

               $('#aj_serv_name').html(html);
		//$('#aj_dep_name').html(html);
            }, 

        });
    }
    else
    {
        $('#aj_serv_name').val('');
	//$('#aj_dep_name').val('');
    }
    // $('#aj_open_days').val('');
    //$('#aj_serv_name').val('');

});



$('#aj_serv_name').change(function(){


var srv_id = $('#aj_serv_name').val();

    var action = 'get_cnfig';

   
    if(srv_id != '')
    {
        $.ajax({
	    url:  " <?=site_url('handle-myajax');?>", 
            method:"POST",
            data:{srv_id:srv_id, action:action},
            dataType: "json",
            success:function(data)
            {
               var html = '<option value="">Select a week to configure</option>';

               for(var count = 0; count < data.data.length; count++)
               {   
                   html += '<option value="'+data.data[count].wklyDtCrd+'">'+data.data[count].wklyDtCrd+'</option>';
               }

               $('#aj_srvc_dt').html(html);
            }, 

        });
    }
    else
    {
        $('#aj_srvc_dt').val('');
    }
 
});
});
</script>


