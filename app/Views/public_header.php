<!DOCTYPE html>
<html lang="en">

<head >

     <title><?php echo $compPublicName; ?></title>


     
     
     
     


     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
				
     <link rel="stylesheet" href=<?php echo base_url("/css/bootstrap.min.css"); ?>  >
     <link rel="stylesheet" href=<?php echo base_url("/css/font-awesome.min.css"); ?>      >
     <link rel="stylesheet" href=<?php echo base_url("/css/animate.css"); ?>     >
     <link rel="stylesheet" href=<?php echo base_url("/css/owl.carousel.css"); ?>      >
     <link rel="stylesheet" href=<?php echo base_url("/css/owl.theme.default.min.css"); ?>     >

     <!-- MAIN CSS -->
     <link rel="stylesheet" href=<?php echo base_url("/css/tooplate-style.css"); ?>     >

     <!--link href="style.css" rel="stylesheet" type="text/css"-->
     <link rel="stylesheet"  href=<?php echo base_url("/css/calendar.css"); ?>   type="text/css">
     
     <style>
          /* header label,header h1,header h2,header h3,header h4,header h5,header h6,
          footer label,footer h1,footer h2,footer h3,footer h4,footer h5,footer h6 */

          <?php foreach($colors as $color){
          $header = $color->header;
          $footer = $color->footer;
          $font1 = $color->font1;
          $font2 = $color->font2;
          $buttons = $color->buttons;
          } 

          function hex2hsl($RGB) {
               //have we got an RGB array or a string of hex RGB values (assume it is valid!)
                   if (!is_array($RGB)) {
                       $hexstr = ltrim($RGB, '#');
                       if (strlen($hexstr) == 3) {
                           $hexstr = $hexstr[0] . $hexstr[0] . $hexstr[1] . $hexstr[1] . $hexstr[2] . $hexstr[2];
                       }
                       $R = hexdec($hexstr[0] . $hexstr[1]);
                       $G = hexdec($hexstr[2] . $hexstr[3]);
                       $B = hexdec($hexstr[4] . $hexstr[5]);
                       $RGB = array($R,$G,$B);
                   }
               // scale the RGB values to 0 to 1 (percentages)
                   $r = $RGB[0]/255;
                   $g = $RGB[1]/255;
                   $b = $RGB[2]/255;
                   $max = max( $r, $g, $b );
                   $min = min( $r, $g, $b );
               // lightness calculation. 0 to 1 value, scale to 0 to 100% at end
                   $l = ( $max + $min ) / 2;
                       
               //put the values in an array and scale the saturation and lightness to be percentages
                   
                   return round( $l*100);
               }
               
               if (hex2hsl($font2) > 80){
                    echo '.contact-info .fa{
                         color: #000000;
                    }';

               }
               if (hex2hsl($buttons) > 80){
                    echo '.public-btn{
                         color: #000000 !important;
                    }';
               } 
               ?>


          header, header p,header span, header a, .navbar-static-top, .navbar-static-top a {
               background-color: <?php echo $header ?> ;
               color: <?php echo $font1 ?> !important;
          }

          footer, footer h4, footer span, footer pre{
               background-color: <?php echo $footer ?>;
               color: <?php echo $font2 ?> !important;
          }

          footer .fa{
               background-color: <?php echo $font2 ?> !important;
          }

          .public-btn {
               border-radius: 3px;
               color: #ffffff ;
               font-weight: 600;
               padding: 12px 20px ;
          }

          .section-button, .public-btn , .btn-primary{
                         background-color: <?php echo $buttons; ?> !important;
                         border-color: <?php echo $buttons; ?> !important;

                    
          }

          header .fa-envelope-o:before, .fa-calendar-plus-o:before{
               color: <?php echo $buttons ?>;
          }
          
                    

          


     </style>



</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p><?php echo $compPublicName; ?></p>
                    </div>
                         
                    <div class="col-md-8 col-sm-7 text-align-right">



		

                         
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> <?php echo $compWorkingHrs; ?></span>
                         <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#"><?php echo $compPhoNumb; ?></a></span>


		<?php if (isset($_SESSION['logedin']))
               { ?>

		    <span class="sgn-icon"><i class="fa fa-envelop-o"></i> <a href=<?php echo base_url("/home/org_public_web/frabi/chngInfo"); ?>#register>My Info</a></span>
		    <span class="sgn-icon"><i class="fa fa-envelop-o"></i> <a href=<?php echo base_url("/home/org_public_web/frabi/appointments"); ?>  >My Appointments</a></span>
                    <span class="sgn-icon"><i class="fa fa-envelop-o"></i> <a href=<?php echo base_url("/home/logout/public"); ?>  >Sign Out</a></span>
               <?php }
               else{?>
                    <span class="sgn-icon"><i class="fa fa-envelop-o"></i> <a href=<?php echo base_url("/home/org_public_web/frabi/register"); echo '/'.$compUrlShortName; ?>#register class="smoothScroll">Register</a></span>
                    <span class="sgn-icon"><i class="fa fa-envelop-o"></i> <a href=<?php echo base_url("/home/sign_in/pp"); ?>  >Sign In</a></span>
			
		    
               <?php }; ?>

			
                    </div>

               </div>
          </div>
     </header>


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE --> 
                    <img src=<?php echo base_url("/uploads/images/manipulated/thumbs"); echo "/" . $compLogo ?>  class="img-responsive" alt="">
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href=<?php echo base_url("/home/org_public_web/"); echo '/'.$compUrlShortName; ?> class="smoothScroll">Home</a></li>
                         <li><a href=<?php echo base_url("/home/org_public_web/"); echo '/'.$compUrlShortName; ?>#about class="smoothScroll">About Us</a></li>
                         
                         
                         <?php 
                         $row_counter = 1;
                         foreach($pages as $page) { 
                         ?>
                              <li><a href=<?php echo base_url("/home/org_public_web/"); echo '/'.$compUrlShortName; ?>/b/<?php echo $row_counter; ?> class="smoothScroll"><?php echo $page->pageName; ?></a></li>
                              
                         <?php 
                         $row_counter =  $row_counter +1;
                         } ?>
                         

                         <!--?php if (isset($pageName1))?-->
                              <!--li><a href="/home/org_public_pg1/<--?php echo '/'.$compUrlShortName; ?> class="smoothScroll"><--?php echo $pageName1; ?></a></li-->
                         


                         
                         
                       <li class="appointment-btn"><a class="public-btn" href="<?php echo base_url("/home/org_public_web/") ;?>#appointment">Make an appointment</a></li>  
                    </ul>
               </div>

          </div>
     </section>
