

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Appointments View</strong> </h1>
					
					
					<div class="row">
						
						<div class="col-12 col-md-12 col-xxl-8 d-flex order-3 order-xxl-2">

							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Data Table</h5>
								</div>
								<form method="post">
								<div class="card-body px-4">
									<!------------------Accounts Data Table --------------------->
										<?php echo $c_n_f_msg; ?>
										<?php if (count($formated_list) > 0):?>
										<h4>Appointment Data</h4>
										
										<?php          
											echo "$brnch_name</br>" ;
											echo "$dept_name</br>" ;
											echo "$serv_name</br>" ;
											echo "$open_days</br>" ;
										?>

										<table class="table table-striped">
										<thead>
											<tr>
											<th scope="col">#</th>
											<th scope="col">Time</th>
											<th scope="col">Phone</th>
											<th scope="col">Name</th>
											<th scope="col">Attended</th>
											
											
											<th colspan="2" scope="col">Actions</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$row_counter = 1;
										foreach($formated_list as $tl) {?>
											<tr>
											<th scope="row"><?php echo $row_counter; ?></th>
											<?php
											$titleName = $row_counter;
											$aTime     = "time".$row_counter;
											$aNam 	   = "name".$row_counter;
											$aPhn 	   = "phon".$row_counter;
      										$aAtt 	   = "attn".$row_counter;
											
											
      										
											?>
											
											<td><div class="form-group">
												
											<input type="text" class="form-control" name="<?php echo $aTime?>" placeholder="" value="<?php echo $tl; ?>" > 
											</div></td>

											
											
											<td><div class="form-group">
												<?php if(isset($existing_list[$tl])):?>
													<input type="text" class="form-control" name="<?php echo $aPhn?>" placeholder="" value="<?php echo $existing_list[$tl][1]->AccNumb; ?>" disabled>
												<?php 
											
												else:?>
													<input type="text" class="form-control" name="<?php echo $aPhn?>" placeholder="" value="<?php #echo $existing_list[$tl]->vstrNam; ?>">
												<?php endif; ?>
											</div></td>

											<td><div class="form-group">
												<?php if(isset($existing_list[$tl])):?>
													<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php echo $existing_list[$tl][0]->vstrNam; ?>">
												<?php 
											
												else:?>
													<input type="text" class="form-control" name="<?php echo $aNam?>" placeholder="" value="<?php #echo $existing_list[$tl]->vstrNam; ?>">
												<?php endif; ?>
											</div></td>

											<td><div class="form-group">
												
													<select name="<?php echo $aAtt?>" class="form-control">
													
													<?php if(isset($existing_list[$tl])):?>
														<?php if($existing_list[$tl][0]->custResAttended == 1):?>
															<option value="1" selected>Yes</option>
															<option value="0" >No</option>
															<option value="-1" >Blocked</option>
														<?php 
														endif;
														if($existing_list[$tl][0]->custResAttended == 0):?>	
															<option value="1" >Yes</option>
															<option value="0" selected>No</option>
															<option value="-1" >Blocked</option>
														<?php endif;
														if($existing_list[$tl][0]->custResAttended == -1):?>	
															<option value="1" >Yes</option>
															<option value="0" >No</option>
															<option value="-1" selected>Blocked</option>
														<?php endif;?>
														<?php 
														else:?>
															<option value="1" >Yes</option>
															<option value="0" selected>No</option>
															<option value="-1" >Blocked</option>
														<?php endif;
														?>
													</select>
												
											
											</div></td>
											
											<td><div class="form-group">
												<?php $btn_val = $row_counter;?>
												<?php if(isset($existing_list[$tl])):?>
													<button type="submit" class="btn btn-primary" name="edit_res" value="<?php echo $btn_val . ":" . $existing_list[$tl][0]->custResID; ?>">S</button>
												<?php 
											
												else:?>
													<button type="submit" class="btn btn-primary" name="edit_res" value="<?php echo $btn_val;?>">S</button>
												<?php endif; ?>
											</div></td>

											<td><div class="form-group">
												<?php $btn_val = $row_counter;?>
												<?php if(isset($existing_list[$tl])):?>
													<button type="submit" class="btn btn-primary" name="delt_res" value="<?php echo $existing_list[$tl][0]->custResID; ?>">D</button>
												<?php 
												else:?>
													<button type="submit" class="btn btn-primary" name="delt_res" value="<?php #echo $btn_val;?>">D</button>
												<?php endif; ?>
											</div></td>
											
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

									<h5 class="card-title mb-0">Form</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
										
										
	<input type="hidden" class="form-control" name="serv_name" placeholder="" value="<?php echo $serv_nam; ?>">
	<input type="hidden" class="form-control" name="open_day" placeholder="" value="<?php echo $open_day; ?>">							
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
               <select name="serv_name" id="aj_serv_name" class="form-control"></select>
              
          </div></div>


          <div class="form-group">
          <div class="col-md-6 col-sm-6">
               <label for="select">Choose Day</label>
               <select name="open_days" id="aj_open_days" class="form-control"></select>
          </div></div>
          
          
<button type="submit" class="btn btn-primary" name="list_open_days" value="list_open_days">List</button>


          
          
												
												
												

											</form>

										
										</div>
									</div>
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
    $('#aj_open_days').val('');
    //$('#aj_serv_name').val('');

});

$('#aj_serv_name').change(function(){

var brn_id = $('#aj_brnch_name').val();
var srv_id = $('#aj_serv_name').val();
var dep_id = $('#aj_dep_name').val();

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
           var html = '<option value="">Select Day</option>';

           for(var count = 1; count < data.arr_len; count++)
           {   
                
	       if (typeof data.data[count] !== 'undefined') {
                    html += '<option value="'+data.data[count]+'">'+data.data[count]+'</option>';
               }

               

           }

           $('#aj_open_days').html(html);
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
           var html = '<option value="">Select Time</option>';

           for(var count = 0; count < data.arr_len; count++)
           {   
               if (typeof data.data[count] !== 'undefined') {
                    html += '<option value="'+data.data[count]+'">'+data.data[count]+'</option>';
               }

           }

           $('#aj_open_times').html(html);
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

