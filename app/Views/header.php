

<!--?php
include 'Calendar.php';
$calendar = new Calendar('2021-02-02');
$calendar->add_event('Birthday', '2021-02-03', 1, 'green');
$calendar->add_event('Doctors', '2021-02-04', 1, 'red');
$calendar->add_event('Holiday', '2021-02-16', 7);
?-->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href=<?php echo base_url("/img/icons/icon-48x48.png"); ?> />

	<link rel="canonical" href="" />

	<title>Hospital Demo - Ehjz</title>

	<link href=<?php echo base_url("/css/app.css"); ?> rel="stylesheet" type="text/css">
	<link href=<?php echo base_url("/css/style.css"); ?>  rel="stylesheet" type="text/css">
	<link href=<?php echo base_url("/css/calendar.css"); ?>  rel="stylesheet" type="text/css">
	<link href=<?php echo base_url("/css/font-awesome.min.css"); ?>  rel="stylesheet" type="text/css">
	<link href=<?php echo base_url("/css/quill.snow.css"); ?>  rel="stylesheet" type="text/css">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	
	

</head>

<body>

	<div class="wrapper">
		<?php if (isset($isCollapsed))?>
			<nav id="sidebar" class="<?php echo $isCollapsed; ?>">
		

			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href=<?php echo base_url("/home/main_page"); ?> >
          <span class="align-middle">Hospital Demo Ehjz</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					

					
					

<li class="sidebar-item "> <!--active-->  
						<a class="sidebar-link" href=<?php echo base_url("/home/main_page"); ?> >
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Main Page</span>
            </a>
					</li>

<li class="sidebar-item "> 
						<a class="sidebar-link" href=<?php echo base_url("/home/cp_settings"); ?> >
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Settings</span>
            </a>
					</li>

<li class="sidebar-item">
						<a class="sidebar-link" href=<?php echo base_url("/home/default_dt"); ?>>
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Default Time Table</span>
            </a>
					</li>


					

					<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/services"); ?> >
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Services</span>

					
            </a>
					</li>

					<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/archived_services"); ?> >
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Archived Services</span>

					
            </a>
					</li>


<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/wklyservices"); ?> >
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Weekly Config. Services</span>

					
            </a>
					</li>


					


					<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/cust_app"); ?> >
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Customer Appointments</span>
            </a>
					</li>

<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/srvs_apnt"); ?> >
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Services Appointments</span>
            </a>
					</li>

<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/sign_up"); ?> >
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
            </a>
					</li>

<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/loyality"); ?> >
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Loyality</span>
            </a>
					</li>

<li class="sidebar-item"> 
						<a class="sidebar-link" href=<?php echo base_url("/home/reports"); ?> >
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Reports</span>
            </a>
					</li>




					<!--li class="sidebar-header">
						Tools & Components
data-feather="align-left"
data-feather="coffee"
data-feather="bar-chart-2"
data-feather="map"


					</li-->

					
					
					
				</ul>

				<div class="sidebar-cta">
									</div>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						
						
								<a class="dropdown-item" href=<?php echo base_url("/home/logout"); ?>><i class="align-middle me-1" data-feather="user"></i> Log out</a>
								
							
					</ul>
				</div>
			</nav>