
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Settings</strong> </h1>

					
					<div class="row">
						
<?php if (isset ($validation)):?>
<div class="text-danger">
  <?= $validation->listErrors() ?>
</div>
<?php endif; ?>		

<form method="post" enctype="multipart/form-data" >
						<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Settings</h5>
								</div>
								 
								<div class="card-body px-4">
									<!--div id="world_map" style="height:350px;"></div-->
									<div class="world_map" >
										

<form method="post" > 


<div class="form-group">
    <label for="an_url">Orgnization URL</label>
    
    <input type="text" class="form-control" name="compUrlShortName" placeholder="ABC.Ehjz.cc" value="<?php echo $compUrlShortName; ?>" disabled>
  </div></br>



  <div class="form-group">
    <label for="public_name">Name of Orgnization as Appering to Public</label>
    <input type="text" class="form-control" name="compPublicName" placeholder="Your orgnization public name " value="<?php echo $compPublicName; ?>" >
  </div></br>

  <div class="form-group">
    <label for="inputEmail">Email address</label>
    
    <input type="email" class="form-control" name="compEmail" aria-describedby="emailHelp" placeholder="ABC@gmail.com" value="<?php echo $compEmail; ?>">
    <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
  </div></br>
  <div class="form-group">
    <label for="phone_numb">Phone Number</label>
    <input type="text" class="form-control" name="compPhoNumb" placeholder="05XXXXXXXX" value="<?php echo $compPhoNumb; ?>">
  </div></br>
  <div class="form-group">
    <label for="inputPassword">Whats up number</label>
    <input type="text" class="form-control" name="compWtzNumb" placeholder="05XXXXXXXX" value="<?php echo $compWtzNumb; ?>">
    
  </div></br>
  

	<div class="form-group">
    <label for="twitter_acc">Twitter</label>
    <input type="text" class="form-control" name="twitter_acc" placeholder="@twitter" value="<?php echo $twitter_acc; ?>">
  </div></br>

  <div class="form-group">
    <label for="instgram_acc">Instgram</label>
    <input type="text" class="form-control" name="instgram_acc" placeholder="@insta" value="<?php echo $instgram_acc; ?>">
  </div></br>

  <div class="form-group">
    <label for="snap_acc">Snap</label>
    <input type="text" class="form-control" name="snap_acc" placeholder="@snap" value="<?php echo $snap_acc; ?>">
  </div></br>

  

  <div class="form-group">
    <label for="the_location">The Location</label>
    <input type="text" class="form-control" name="compLocation" placeholder="Building, Street, City, Country" value="<?php echo $compLocation; ?>">
  </div></br>

  <div class="form-group">
    <label for="working_hours">Working Hours</label>
	<textarea class="form-control" name="compWorkingHrs" rows="3"><?php echo $compWorkingHrs; ?></textarea>
  </div></br>

  <div class="form-team">
    <label for="who_r_we" style="width: 97%;">About us</label><i class="fa fa-info-circle font-i" >
      <div class="font-i-text">Background's image's height depends on number of lines</div>
            </i>


<div id="editor">
<p><?php echo $compWhoRwe; ?></p>
</div><br>

  <textarea name="compWhoRwe" class="form-control" style="display:none;" id="compWhoRwe"></textarea>

  <button class="btn btn-primary" onclick="whoRWeSubmit()">Save</button></br></br></br>

  <button style="display:none;" id="compWhoRwe-submit" type="submit" class="btn btn-primary" name="save_main_settings"></button>



 <div class="form-group">

    <label for="public_name">Logo Upload</label></br>

    <input type="file" class="form-control-file" name="compLogo" placeholder="Logo" value="<?php echo $compLogo; ?>">
  </div>

  </br><button type="submit" class="btn btn-primary" name="save_img_upload" >Add</button></br></br></br>

  <!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv by fares -->

  <?php foreach ($colors as $color){ ?>

  <div class="form-group">
    <h4>Website Theme Color</h4>
    <div style="display: inline-block;">
    <label for="header" style="width: 200px;">Header</label><br><br>
    <input type="color" name="header" value="<?php echo $color->header;?>" style="border: none; width: 200px;"></div>

    <div style="display: inline-block;">
    <label for="footer" style="width: 200px;">Footer</label><br><br>
    <input type="color"  name="footer" value="<?php echo $color->footer;?>" style="border: none; width: 200px;"></div>

    <div style="display: inline-block;" >
    <div style="display: inline-block; width: 200px;">
    <label for="font" style="width: 200px;">Font</label><br>
    <label for="font1" style="width: 100px; font-size: 12px;">header</label> <label for="font2" style="width: 96px; font-size: 12px;">footer</label><br>
    
    <input type="color" name="font1" value="<?php echo $color->font1;?>" style="border: none; width: 96px;">
    <input type="color" name="font2" value="<?php echo $color->font2;?>" style="border: none; width: 96px;"></div>
    
    <div style="display: inline-block;">
    <label for="buttons" style="width: 200px;">Buttons</label><br><br>
    <input type="color" name="buttons" value="<?php echo $color->buttons; }?>" style="border: none; width: 200px;"></div>
    </div>
  </br>

  <button type="submit" class="btn btn-primary" name="change_color" >Change</button> 
  <button type="submit" class="btn btn-secondary" name="default_color">Reset Default</button><br><br><br></div>


<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ by fares -->

<div class="form-group">
  <h4>Page Settings</h4>
    <input type="file" class="form-control-file" name="pagePhoto" placeholder="Page1 Image Name" value="">
  </div></br>

  <div class="form-group">
    <label for="page_title">Page Title</label>
    <input type="text" class="form-control" placeholder="Page Title" name="pageName" value="">
  </div></br>

  <div class="form-group">
    <label for="pg_content" style="width: 98%;">Page Content</label><i class="fa fa-info-circle font-i" >
      <div class="font-i-text"> &lt;b&gt;<b>bold</b>&lt;/b&gt;<br>&lt;i&gt;<i>italic</i>&lt;/i&gt;</div>
            </i>
	<textarea class="form-control" name="pageTxt" rows="3" placeholder="Page Content"></textarea>
  </div>

  </br><button type="submit" class="btn btn-primary" name="save_img_upload" >Add</button></br></br></br>


<!------------------Pages Data Table --------------------->
</br></br>
<?php if (count($pages) > 0):?>
<h4>Pages Data</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th colspan="2" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $row_counter = 1;
  foreach($pages as $page) {?>
    <tr>
      <th scope="row"><?php echo $row_counter; ?></th>
      <?php
      $titleName = $row_counter;
      $pName = "p".$row_counter;
      $cName = "c".$row_counter;
      ?>
      
      <td><input type="text" class="form-control" name="<?php echo $pName;?>" placeholder="www.www.com" value="<?php echo $page->pageName ?>"></td> 
      <td><textarea class="form-control" name="<?php echo $cName;?>" rows="3"><?php echo $page->pageTxt; ?></textarea></td>
      <td><button type="submit" class="btn btn-primary" name="edit_page" value="<?php echo $titleName?>">Update</button></td>
      <td><button type="submit" class="btn btn-danger" name="delete_page" value="<?php echo $titleName?>">Delete</button></td>
    </tr>
<?php $row_counter =  $row_counter +1;} ?>
  </tbody>
</table>
  </br></br>
<?php endif; ?>	


<div class="form-group">
  <h4>Ad. Settings</h4>

    <input id="imgInp" accept="image/*" type="file" class="form-control-file" name="adPhoto" placeholder="Ad. Image Name" value="">

  <div id="ad-preview">
    <img id="blah" src="#" alt="your image"/>
  <span>

    <h6>phone size: 1920x1280</h6>
    </span>
  </div>
  </div></br>

  <div class="form-group">
    <label for="ad_url">Ad. URL</label>
    <input type="text" class="form-control" placeholder="Ad. URL " name="adURL" value="">
  </div>

  </br><button type="submit" class="btn btn-primary" name="save_img_upload" >Add</button></br></br></br>


<!------------------Ads Data Table --------------------->
<?php if (count($ads) > 0):?>
<h4>Ads Data</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Ad URL</th>
      <th colspan="2" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $ad_counter = 1;
  foreach($ads as $ad) {?>
    <tr>
      <th scope="row"><?php echo $ad_counter; ?></th>
      <?php
      $adURL = 'adUrlTb'.$ad->adId;
      $titleName = $ad_counter;
      ?>
      <td><?php echo $ad->adPhotoName; ?></td>
      <td>
      <div class="form-group">
      <input type="text" class="form-control" name="<?php echo $adURL ?>" placeholder="www.www.com" value="<?php echo $ad->adUrl; ?>"></td> 
      </div>
      <td><button type="submit" class="btn btn-primary" name="edit_ads" value="<?php echo $ad->adId?>">Update</button></td>
      <td><button type="submit" class="btn btn-danger" name="delete_ads" value="<?php echo $ad->adId?>">Delete</button></td>
    </tr>
<?php $ad_counter =  $ad_counter +1;} ?>
  </tbody>
</table>
<?php endif; ?>		


<div class="form-group">
    <h4>Branch</h4>
    <label for="page_title">Branch Name</label>
    <input type="text" class="form-control" placeholder=" Branch Name " name="branch_name" value="">
  </div>
  </br><button type="submit" class="btn btn-primary" name="add_branch" value="add_branch">Add</button>

<!------------------Branch Data Table --------------------->
  </br></br>
<?php if (count($branches) > 0):?>
<h4>Branches Data</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Branch</th>
      
      <th colspan="2" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $br_counter = 1;
  foreach($branches as $branch) {?>
    <tr>
      <th scope="row"><?php echo $br_counter; ?></th>
      <?php
      $titleName = 'brnchTb'.$branch->branchID;
      ?>
      <td>
      <div class="form-group">
      <input type="text" class="form-control" name="<?php echo $titleName?>" placeholder="Branch Name" value="<?php echo $branch->BranchName; ?>"></td> 
      </div>
      
      <td><button type="submit" class="btn btn-primary" name="edit_branches" value="<?php echo $branch->branchID?>">Update</button></td>
      <td><button type="submit" class="btn btn-danger" name="delete_branches" value="<?php echo $branch->branchID?>">Delete</button></td>
    </tr>
<?php $br_counter =  $br_counter +1;} ?>
  </tbody>
</table>
<?php endif; ?>		


</br></br></br><div class="form-group">
    <h4>Departments</h4>
    <label for="page_title">Department Name</label>
    <input type="text" class="form-control" placeholder=" Department Name " name="department_name" value="">
  </div>
  </br><button type="submit" class="btn btn-primary" name="add_department" value="add_department">Add</button>

</form>



<!------------------Department Data Table --------------------->
</br></br>
<?php if (count($departments) > 0):?>
<h4>Department Data</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Departments</th>
      
      <th colspan="2" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $row_counter = 1;
  foreach($departments as $department) {?>
    <tr>
      <th scope="row"><?php echo $row_counter; ?></th>
      <?php
      $titleName = $row_counter;
      ?>
      <td>
      <div class="form-group">
      <input type="text" class="form-control" name="<?php echo $titleName?>" placeholder="Department Name" value="<?php echo $department->DepName; ?>"></td> 
      </div>
      
      <td><button type="submit" class="btn btn-primary" name="edit_department" value="<?php echo $titleName?>">Update</button></td>
      <td><button type="submit" class="btn btn-danger" name="delete_department" value="<?php echo $titleName?>">Delete</button></td>
    </tr>
<?php $row_counter =  $row_counter +1;} ?>
  </tbody>
</table>
<?php endif; ?>

  <!--button type="submit" class="btn btn-primary" name="save_contact_setting">Save</button-->
</form>


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>