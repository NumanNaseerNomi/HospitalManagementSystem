<?php

namespace App\Controllers;



use App\Models\GenInfoModel;
use App\Models\ComPagesModel;
use App\Models\CompAccModel;
use App\Models\ComAdsModel;
use App\Models\ComBranchModel;
use App\Models\ComDprtmntModel;
use App\Models\CompDdtModel;
use App\Models\CompSrvDdtModel;
use App\Models\CompServiceModel;
use App\Models\ComRsrvModel;
use App\Models\ComAttchModel;
use App\Models\CompWklySrvDdtModel;
use App\Models\CompColorsModel;

use CodeIgniter\I18n\Time;

use PharIo\Manifest\Library;
use Prophecy\Argument;



//Set the session timeout for 2 seconds

$timeout = 86400;

//Set the maxlifetime of the session

ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session

ini_set( "session.cookie_lifetime", $timeout );


//Start a new session

session_start();

//Set the default session name

$s_name = session_name();


//Check the session exists or not

if(isset( $_COOKIE[ $s_name ] )) {


    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );

    # echo "Session is created for $s_name.<br/>";

}

#else

    #echo "Session is expired.<br/>";



date_default_timezone_set('Asia/Riyadh');


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");


class cCalendar {
    const cmnVrb = 'd F, Y (l)'; 
    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days" >';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name" >
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore" id="'. ($num_days_last_month-$i+1) .'" >
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '" >';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '" onclick="myFunction('. ($i) .', ' . ($this->active_month) .', '. $this->active_year .')">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore" id="'. ($i) .' " >
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    

    

    function get_formated_time($eServsDt, $lop_date, $existingRservs, $filter=true)
    {
	
	$rsrve_allowed = 0;
        $formated_list = [];
        $existing_list = [];
	$smart_list = [];

	

        foreach($eServsDt as $anExistingServdt)
        {
            $date = Time::createFromFormat(self::cmnVrb , $lop_date);

            $theday = strtoupper(($date)->format("D"));

            $dayOnDB = strtoupper(substr($anExistingServdt->srvDtDay, 0, 3));
            
            if ($theday == $dayOnDB)
            {
                
                if($anExistingServdt->srvDtIsActive == 1)
		{
		
                $fdgt = substr($anExistingServdt->srvDtFrom,0, strpos($anExistingServdt->srvDtFrom, ":"));
                $sdgt = substr($anExistingServdt->srvDtFrom,strpos($anExistingServdt->srvDtFrom, ":")+1, 2);
                $tdgt = substr($anExistingServdt->srvDtTo,0, strpos($anExistingServdt->srvDtTo, ":"));
                $fodgt = substr($anExistingServdt->srvDtTo,strpos($anExistingServdt->srvDtTo, ":")+1, 2);

                $rsrve_allowed = $rsrve_allowed + (($tdgt - $fdgt)*60 + ($fodgt - $sdgt))/$anExistingServdt->srvDtDur;
                
                $x = $fdgt*60;  
                $to_hour = 0; 
                                                        
                while ($x<($tdgt*60))
                {
                    
                    $time_list[] = $x/60;
                    $x=$x+$anExistingServdt->srvDtDur;
                    
                }
                
                $formated_list = [];
		#print_r($time_list);
		$smrtViewCont = 0;
		$smart_list = [];
                foreach($time_list as $ttll)
                {
		    #print('ttll===== '.$ttll);
                    if(is_int($ttll))
                    {
			
                        $d1 = date("d");
			$h1 = date("H");
			$m1 = date("m");
			$s1 = date("s");
			#print("ttll= ". $ttll);
			#print("h1= ". intval($h1));
			#print("anExistingServdt= ". intval($anExistingServdt->srvDtCloseBf)); exit();
			$today_now = new Time();
			if($date > $today_now)
			{
				$ttll = $ttll . ":00";
				$formated_list[] = $ttll;
                        	if($anExistingServdt->srvDtSmartView== 0 )
                        		{$smart_list[] = $ttll;}
				else
				{
					if($smrtViewCont < 2) 
					{
						$smart_list[] = $ttll;
					}

					$smrtViewCont = $smrtViewCont + 1; 
			
					if($smrtViewCont == 4)
						{$smrtViewCont = 0;}
				}

				
			}
			else
			{
				if( ($h1 + $anExistingServdt->srvDtCloseBf) <= $ttll )
				{
					$ttll = $ttll . ":00";
					$formated_list[] = $ttll;
					if($anExistingServdt->srvDtSmartView== 0 )
                        			{$smart_list[] = $ttll;}
					else
					{
						if($smrtViewCont < 2) 
						{
							$smart_list[] = $ttll;
						}

						$smrtViewCont = $smrtViewCont + 1; 
			
						if($smrtViewCont == 4)
							{$smrtViewCont = 0;}
					}
				}
			}
			
                    }
                    else
                    {
                        $pos1  = strpos($ttll,".",0);
                        $part1 = substr($ttll,0, $pos1);
                        $part2 = substr($ttll,$pos1+1 );

                        if($part2 == '5')
                        {
                            $part2 = '30';
                        }

                        if($part2 == '25')
                        {
                            $part2 = '15';
                        }

                        if($part2 == '75')
                        {
                            $part2 = '45';
                        }

			
			if($date > $today_now)
			{
                        	$app_time = $part1 . ':' . $part2;
				$formated_list[] = $app_time;
                        	if($anExistingServdt->srvDtSmartView== 0 )
                        		{$smart_list[] = $app_time;}
				else
				{
					if($smrtViewCont < 2) 
					{
						$smart_list[] = $app_time;
					}

					$smrtViewCont = $smrtViewCont + 1; 
			
					if($smrtViewCont == 4)
						{$smrtViewCont = 0;}
				}
			}
			else if( ($h1 + $anExistingServdt->srvDtCloseBf) <= $part1  ) 
			{
				$app_time = $part1 . ':' . $part2;
				$formated_list[] = $app_time;
                        	if($anExistingServdt->srvDtSmartView== 0 )
                        		{$smart_list[] = $app_time;}
				else
				{
					if($smrtViewCont < 2) 
					{
						$smart_list[] = $app_time;
					}

					$smrtViewCont = $smrtViewCont + 1; 
			
					if($smrtViewCont == 4)
						{$smrtViewCont = 0;}
				}
			}

  
                    }
                }
		
                
                $rsrve_allowed = $rsrve_allowed * $anExistingServdt->srvBokCnt;
                
                foreach ($existingRservs as $ers)
                {
                   
                    $dtfromdb = $ers->custResDt; 
                    
                    $pos1  = strpos($dtfromdb," ",0);
                    
                    $dtfromdb = substr($dtfromdb,0,$pos1 );
                   

                    $dateTimestamp1 = Time::createFromFormat("Y-m-d", $dtfromdb);
                    $dateTimestamp2 = Time::createFromFormat(self::cmnVrb , $lop_date);

                   
                   
                    if ($dateTimestamp1 == $dateTimestamp2)
                    {

                        $dtfromdb = $ers->custResDt;
                        $pos1  = strpos($dtfromdb," ",0);
                       
                        $dtfromdb = substr($dtfromdb,$pos1+1 );
                        
                        $pos2  = strpos($dtfromdb,":",0);
                        $db_hour = (int) substr($dtfromdb,0, $pos2); #(int)
                        $db_min = (int) substr($dtfromdb,$pos2+1,2); #(int)

			
			
                        if($db_hour < 10)
			{
				$db_hour = "" . $db_hour;
			}
			else
			{
				$db_hour = "" . $db_hour;
			}


			if($db_min < 10)
			{
				$db_min = "0" . $db_min;
			}
			else
			{
				$db_min = "" . $db_min;
			}
                       
                        $db_time = $db_hour . ":" . $db_min;

                        
                        $app_is_res = array_intersect(array($db_time), $formated_list);
			$app_is_res2 = array_intersect(array($db_time), $smart_list);                   
			
                        if(count($app_is_res)>0)
                        {
                            $existing_list[$db_time] = $ers;

                            if($filter)
                            {
                                $formated_list = array_diff($formated_list, array($db_time));
				
                            }
                        }
			
			if(count($app_is_res2)>0)
                        {
                            $existing_list[$db_time] = $ers;

                            if($filter)
                            {
                                $smart_list = array_diff($smart_list, array($db_time));
				
                            }
                        }
			
			$smart_jump = 0; 
			$smart_list = [];
			#print_r($formated_list);exit();
			foreach($formated_list as $f)
			{
				if($smart_jump < 2)
					$smart_list[] = $f;
				

				$smart_jump = $smart_jump + 1;

				
				if($smart_jump > 3)
					$smart_jump = 0;
					

			}
			
                        
                    }

                    
                }
		}

            }
            else{
                $time_list = [];
            }
            
           
        }
        #print_r();exit();
        $f_results = [$rsrve_allowed, $formated_list, $existing_list, $smart_list];
	
        return $f_results;
    }

}


class Home extends BaseController
{
    	
    

    public function handleAjaxRequest($compId='frabi')
    {
        
        if($this->request->getVar('action'))
        {
            $action = $this->request->getVar('action');
            $srv_id = $this->request->getVar('srv_id');
	    $a_counter = 0;
	    $data      =[];
	    $db2                = db_connect('frabiedb');
            $compWklySrvDdtModel= new CompWklySrvDdtModel($db2);
	    if($action == 'get_cnfig' && $srv_id > -1 ) 
            {
		$data = $compWklySrvDdtModel->find_dst_sdc($srv_id);
            }
	    else
	    {

	    $brn_id = $this->request->getVar('brn_id');
            $day_id = $this->request->getVar('day_id');

	    $dep_id = $this->request->getVar('dep_id');


            if($action == 'get_department' && $brn_id > -1 ) 
            {
		$genInfoModel       = new GenInfoModel();
            	$existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();


                $db2                = db_connect('frabiedb');
		$comDprtmntModel     = new ComDprtmntModel($db2);
		
                $data   = $comDprtmntModel->find_whr( $existingData['compId']);
		                
            }


            if($action == 'get_service' && $brn_id > -1 && $dep_id > -1) 
            {

                $db2                = db_connect('frabiedb');
                $compSrvModel       = new CompServiceModel($db2);
                //$data               = $compSrvModel->find_whr_brnch($brn_id );
		$data               = $compSrvModel->find_whr_brnch_nDep($brn_id,  $dep_id);
            }

            if($action == 'get_open_days' && $srv_id > -1 ) 
            {

                $db2                = db_connect('frabiedb');
		        $comRsrvModel       = new ComRsrvModel($db2);

                $compSrvModel       = new CompServiceModel($db2);
                $existingServs       = $compSrvModel->find_whr_brnch( $brn_id);

                $serv_name           = $srv_id;
                $data['slctd_srvz']  = $srv_id;
                $anExistingServs     = $compSrvModel->find_whr( $srv_id);
		
		        $data [] = $anExistingServs[0]->srvBio;

                $st_date             = new Time('now');
		        $st_date->modify('-1 day');


		        #print($st_date);
                $dteEnd              = $anExistingServs[0]->srvLstResDt;
		        #print($dteEnd);	
                $opn_app_list        = [];
                $dteEnd              = new Time($dteEnd);

                $opn_app_list[] =null ;
                
		
		        $date_heads = $compWklySrvDdtModel->find_dst_sdc($srv_id);
		
		        $a_counter = 0;
		        foreach( $date_heads as $date_head)
		        {
			
			        #print($date_head->wklyDtCrd);exit();
			        $head_as_date_obj  = new Time($date_head->wklyDtCrd);
			        $week_counter = 7;
			        while($week_counter > 0){
				        if($head_as_date_obj >= $st_date)
					    {
                            
                            $day_id      = $head_as_date_obj->format(cCalendar::cmnVrb);
                    
                    $st_date = new Time();
                    $dteEnd = $anExistingServs[0]->srvLstResDt;
                
                # $existingApnts  = $comRsrvModel->find_srv_dt($srv_id, $anExistingServs[0]->srvLstResDt);
		
		
		
		        $y_day = Time::createFromFormat(cCalendar::cmnVrb, $day_id);
		        $t_day = Time::createFromFormat(cCalendar::cmnVrb, $day_id);
		        $y_day->modify('-1 days');
		        $t_day->modify('+1 days');
		        $existingApnts      = $comRsrvModel->find_srv_sdt($srv_id,$y_day,$t_day);

		

                               

                $compSrvDtModel     = new CompSrvDdtModel($db2);
                
                # $existingApnts      = $compSrvDtModel->find_whr($srv_id);
		

                
		
                
		        $t_date= Time::createFromFormat(cCalendar::cmnVrb, $day_id);
                
		        $theday = strtoupper(($t_date)->format("D"));
		        if($theday != "SUNDAY")
		        {
			        $t_date->modify('next sunday');
			        $t_date->modify('-7 days');
		        }
		        $string_date = $t_date->format('Y-m-d');

		
		        $existingCompWklySrvDdtModel = $compWklySrvDdtModel->find_whr_sdc(strval($srv_id),$string_date);

		 
                $calendar = new cCalendar(date('2022-03-01'));
		        # print($open_days);exit();
                $f_results = $calendar->get_formated_time($existingCompWklySrvDdtModel , $day_id, $existingApnts, true); #existingServdt 
		        # print_r($f_results); exit();
                $formated_list = $f_results[1];
                $anexisting_list = $f_results[2];

		        $smart_list = $f_results[3];
                            if(count($smart_list) > 0)
                            {
						        $data[]       = $day_id;
                            }
                        }
				            $head_as_date_obj->modify('+1 day'); 
				            $week_counter = $week_counter -1;
			        }
			        $a_counter = $a_counter + 1;
		        }


                //just to check if the day has time ?

                
                
                
                
                $a_counter          = 0;
		        $compWklySrvDdtModel = new CompWklySrvDdtModel($db2);
                $st_date             = new Time();
                $opn_app_list        = [];
                $dteEnd              = new Time($dteEnd);
                
                while( $st_date < $dteEnd )
                {
                    $opn_app_list[]  = $st_date;
                    $just_holder  = $st_date->format(cCalendar::cmnVrb);

                    $openDaysList[] = $just_holder;
                    
                    $st_date->modify('+1 day'); 
                }
                #---------------------------------
                


            }

            if($action == 'get_open_times' && $day_id  > -1 ) 
            {
                $a_counter          = 0;
                

                $db2                = db_connect('frabiedb');
                $compSrvModel       = new CompServiceModel($db2);
		        $compWklySrvDdtModel = new CompWklySrvDdtModel($db2);

                $comRsrvModel       = new ComRsrvModel($db2);

                $existingServs       = $compSrvModel->find_whr_brnch( $brn_id);
                
                $serv_name           = $srv_id;
                $data['slctd_srvz']  = $srv_id;
                $anExistingServs     = $compSrvModel->find_whr( $srv_id);
                $st_date             = new Time();
                $dteEnd              = $anExistingServs[0]->srvLstResDt;
                $opn_app_list        = [];
                $dteEnd              = new Time($dteEnd);
                while( $st_date < $dteEnd )
                {
                    
                    $opn_app_list[]  = $st_date;
                    $openDaysList[]  = $st_date->format(cCalendar::cmnVrb);
                    $st_date->modify('+1 day'); 
                }
                #---------------------------------
                
                $open_days      = $day_id;

                //print($day_id);exit();

                $anExistingServs = $compSrvModel->find_whr($srv_id);
                $st_date = new Time();
                $dteEnd = $anExistingServs[0]->srvLstResDt;
                
                # $existingApnts  = $comRsrvModel->find_srv_dt($srv_id, $anExistingServs[0]->srvLstResDt);
		
		
		
		        $y_day = Time::createFromFormat(cCalendar::cmnVrb, $day_id);
		        $t_day = Time::createFromFormat(cCalendar::cmnVrb, $day_id);
		        $y_day->modify('-1 days');
		        $t_day->modify('+1 days');
		        $existingApnts      = $comRsrvModel->find_srv_sdt($srv_id,$y_day,$t_day);

		

                               

                $compSrvDtModel     = new CompSrvDdtModel($db2);
                
                # $existingApnts      = $compSrvDtModel->find_whr($srv_id);
		

                
		

		        $t_date= Time::createFromFormat(cCalendar::cmnVrb, $day_id);
		        $theday = strtoupper(($t_date)->format("D"));
		        if($theday != "SUNDAY")
		        {
			        $t_date->modify('next sunday');
			        $t_date->modify('-7 days');
		        }
		        $string_date = $t_date->format('Y-m-d');

		
		        $existingCompWklySrvDdtModel = $compWklySrvDdtModel->find_whr_sdc(strval($srv_id),$string_date);

		 
                $calendar = new cCalendar(date('2022-03-01'));
		        # print($open_days);exit();
                $f_results = $calendar->get_formated_time($existingCompWklySrvDdtModel , $open_days, $existingApnts, true); #existingServdt 
		        # print_r($f_results); exit();
                $formated_list = $f_results[1];
                $anexisting_list = $f_results[2];

		        $smart_list = $f_results[3];

		

                

                #$data = $formated_list;
		        $data  = $smart_list;

                

            }
	    }

            


            $a_counter = count($data);
            echo json_encode(array(
                "arr_len"   => $a_counter,
                "status"    => 1,
                "message"   => "Successful request",
                "data"      => $data
            ));


        }


    }

    

    public function index()
    {

    }
    public function loyality($compId='frabi')
    {

        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        $compDdtModel = new CompDdtModel($db2);
        $existingDtdt = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel = new GenInfoModel();
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
        }   
        
	$data['isCollapsed'] = "sidebar js-sidebar";
        if(strlen($compId) > 0)
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
        
        $data['existingDtdt'] = $existingDtdt;

        echo view ('header', $data);
        echo view ('loyality');
        echo view ('footer');

    }

	
    	
    public function main_page($compId='frabi')
    {
        #session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
        
           
        $db2 = db_connect('frabiedb');
        $compServiceModel = new CompServiceModel($db2);
	$compWklySrvDdtModel = new CompWklySrvDdtModel($db2);
        $comRsrvModel = new ComRsrvModel($db2);
	$compSrvDdtModel = new CompSrvDdtModel($db2);

        $existingSvs = [];
	$nextWeeks = [];
        $opening[] = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel = new GenInfoModel();
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingSvs = $compServiceModel->find_all_servs( $existingData['compId']);
            $tDate = new Time();
	    
	    $theday = strtoupper(($tDate)->format("D"));
	    if($theday != "SUNDAY")
	    {
		$tDate ->modify('next sunday');
		$tDate ->modify('-7 days');
	    }

	    $nextWeeks = [];
	    $detaiedNextWeeks = [];
	    $detaiedNextWeeksHolder = [];
	    foreach($existingSvs as $eSrv){
	    	$nextWeeks[$eSrv->srvId] = $compWklySrvDdtModel->find_upcmng_wks($eSrv->srvId, $tDate->format('Y-m-d'));
		#print($eSrv->srvId);
	    }
		
	    
	    

	    foreach($existingSvs as $eSrv){
		#print($eSrv->srvId);
		#print_r($nextWeeks[$eSrv->srvId]);continue;
	    	foreach ($nextWeeks[$eSrv->srvId] as $activeWeekOfSer)
		{
			$this_week_config = $compWklySrvDdtModel->find_whr_sdc($eSrv->srvId, $activeWeekOfSer->wklyDtCrd);
			#print_r($this_week_config);exit();
			$week_counter = 1;
			$config_index = 0;
			$wk_dt = new Time($activeWeekOfSer->wklyDtCrd);
			

			while($week_counter < 8){
				
				if($this_week_config[$config_index]->srvDtIsActive == 0 && $this_week_config[$config_index+1]->srvDtIsActive == 0)
				{
					$detaiedNextWeeks[$wk_dt->format('Y-m-d')] = -1;	
				}
				else
				{
				
				
				$y_day = new Time($wk_dt->format('Y-m-d'));
				$t_day = new Time($wk_dt->format('Y-m-d'));
				$y_day->modify('-1 days');
				$t_day->modify('+1 days');
				$aWexistingRes = $comRsrvModel->find_srv_sdt($eSrv->srvId,$y_day,$t_day);
				
				
				if(count($aWexistingRes) > 0)
				{
					$is_found = FALSE;
					$res_counter = 0; 
					foreach($aWexistingRes as $anExstRes)
					{
						$tst_dt = new Time($anExstRes->custResDt);
						#print($tst_dt->day);
						if($tst_dt->day == $wk_dt->day)
						{
							$detaiedNextWeeks[$wk_dt->format('Y-m-d')] = 1;
							$is_found = TRUE;
							$res_counter = $res_counter + 1;
						}
					}
					if(!$is_found)
					{$detaiedNextWeeks[$wk_dt->format('Y-m-d')] = 0;}

					$calendar = new cCalendar(date('2022-03-01'));
					#print_r($aWexistingRes);exit();
                			$f_results = $calendar->get_formated_time($this_week_config , $wk_dt->format(cCalendar::cmnVrb), [], false); #existingServdt
					#print_r($f_results );exit();
					if(count($f_results[1]) > 0 && $res_counter >= count($f_results[1]))
					{
						$detaiedNextWeeks[$wk_dt->format('Y-m-d')] = 2;
						#print($res_counter);print(count ($f_results[1]));exit();
						#print_r($f_results);exit();

					}
					$res_counter = 0; 
				}
				else
				{
					$detaiedNextWeeks[$wk_dt->format('Y-m-d')] = 0;
				}
				}
				$config_index = $config_index + 2;
				$week_counter = $week_counter +1;
				$wk_dt->modify('+1 days');
			}
		}
		
		$detaiedNextWeeksHolder[$eSrv->srvId] = $detaiedNextWeeks;
		#print_r($detaiedNextWeeksHolder);exit();
		$detaiedNextWeeks = [];
		
	    } 
	   
	    

	    
        }   

        if($this->request->getMethod() == 'post')
        {
            if(isset($_POST['acti_svs']))
            {
		#print_r($_POST);
		$the_id = substr($_POST['acti_svs'],0,strpos($_POST['acti_svs'], "."));
		$the_row= substr($_POST['acti_svs'],strpos($_POST['acti_svs'], ".")+1);
		$the_week_head = "week_head" . $the_row;
		$date_of_week_head = $_POST[$the_week_head];
		#print($_POST['acti_svs']);
		#print("the_id= ".$the_id);
		#print("the_row= ".$the_row);
		#print("date_of_week_head= ".$date_of_week_head);
		#exit();

				
		
		$the_service = $compServiceModel->find_whr($the_id);
		//tring to find if exist ! 
		$the_sdc = $compWklySrvDdtModel->find_whr_sdc($the_id, $date_of_week_head);
		$the_sdc = $compWklySrvDdtModel->find_whr_sdc($the_id, $date_of_week_head);
		if(count($the_sdc) > 0){
			print("what are you doing, if the server dc is there, I have no idea what to do !!");
		}
		else
		{	
			$existing_compSrvDdtModel = $compSrvDdtModel->find_whr($the_id);
			foreach( $existing_compSrvDdtModel as $config_line)
			{	
				
				$compWklySrvDdtModel->insert_record($date_of_week_head, $config_line->compKey,
								$config_line->compSrvKey, $config_line->srvDtDay,
								$config_line->srvDtPeriod, $config_line->srvDtFrom,
								$config_line->srvDtTo, $config_line->srvDtDur,
								$config_line->srvDtCloseBf, $config_line->srvDtSmartView,
								$config_line->srvDtIsActive);
			}
		}

		#print_r($the_service);
		#return redirect()->to(base_url('/home/main_page'));

            }
	    if(isset($_POST['edit_svs']))
            {
		$the_id = substr($_POST['edit_svs'],0,strpos($_POST['edit_svs'], "."));
		$the_row= substr($_POST['edit_svs'],strpos($_POST['edit_svs'], ".")+1);
		$the_week_head = "week_head" . $the_row;
		$date_of_week_head = $_POST[$the_week_head];
		#print($_POST['edit_svs']);
		#print("the_id= ".$the_id);
		#print("the_row= ".$the_row);
		#print("date_of_week_head= ".$date_of_week_head);
		#exit();
		if($date_of_week_head != '')
		{	
			return redirect()->to(base_url("/home/wklyservices/$compId/$the_id/$date_of_week_head"));
		}


	    }
            
        }
	
	$sev_dt_crds = [];
	foreach($existingSvs as $es)
	{	
		#print( $es->srvId);
		$cwsdh = $compWklySrvDdtModel->find_dst_sdc($es->srvId);
		$sev_dt_crds[$es->srvId] = $cwsdh;
	

	}
	//print_r($sev_dt_crds);exit();
	

	// Create a new DateTime object
	$date = new Time();

	$counter = 10;
	$week_heads = [];

	$theday = strtoupper(($date)->format("D"));
	if($theday != "SUNDAY")
	{
		$date->modify('next sunday');
		$date->modify('-7 days');
	}
	$week_heads[] = $date->format('Y-m-d');
	while($counter > 0){
		$date->modify('next sunday');
        	$week_heads[] = $date->format('Y-m-d');
		$counter = $counter - 1;
	}

	#print_r($week_heads);
	#print_r($sev_dt_crds);exit();

	$data['week_heads'] = $week_heads;
	$data['sev_dt_crds'] = $sev_dt_crds;
        $data['existingSvs'] = $existingSvs;
        $data['opening'] = $opening;
	$data['detaiedNextWeeksHolder'] = $detaiedNextWeeksHolder;
        
        $data['isCollapsed'] = "sidebar js-sidebar";
        #$data['isCollapsed'] = "sidebar js-sidebar collapsed";
        echo view ('header', $data);
        echo view ('main_page');
        echo view ('footer');
    }

    public function services($compId='frabi', $sevId=1)
    {
        #session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        $compDdtModel        = new CompDdtModel($db2);
        $compSrvModel        = new CompServiceModel($db2);
        $comBranchModel      = new ComBranchModel($db2);
        $comDprtmntModel     = new ComDprtmntModel($db2);
        $compSrvDtModel     = new CompSrvDdtModel($db2);
        $existingDtdt        = [];
        $existingServs       = [];
        $existingServsBrnch  = [];
        $exstngSrvsDprtmnts  = [];
        $existingServdt      = [];
        $anExistingServs     = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel       = new GenInfoModel();
            $existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingDtdt       = $compDdtModel->find_whr( $existingData['compId']);
            $existingServs      = $compSrvModel->join_records( $existingData['compId']);
            $existingServsBrnch = $comBranchModel->find_whr( $existingData['compId']);
            $exstngSrvsDprtmnts = $comDprtmntModel->find_whr( $existingData['compId']);
        }   
        if($this->request->getMethod() == 'post')
        {
            
            
            #adding
            $ddt_record_id = -1;
            if(isset($_POST['add_srv']))
            {
                $compSrvModel->insert_record($existingData['compId'], $_POST['brnch_name'], $_POST['dep_nam'], $_POST['srvName'] , $_POST['srvPrice'], $_POST['payUrl'], $_POST['serviceBio'], $_POST['lastResDate']);
                $a_compSrvModel = $compSrvModel->find_all_servs($existingData['compId']);
                
                
                
                if(count($a_compSrvModel)>0)
                {
                    $servKey = $a_compSrvModel[count($a_compSrvModel)-1]->srvId;
                    $counters = 1  ;
                    while($counters <= count($existingDtdt))  
                    {  
                        #$record_id = $existingDtdt[$counters-1]->dfdtId;

                        $adfdtday           = "d".$counters;
                        $adfdtperiod        = "p".$counters;
                        $adfdtfrom          = "f".$counters;
                        $adfdtto            = "t".$counters;
                        $adfdtduration      = "r".$counters;
                        $adfdtclosebefore   = "c".$counters;
                        $adfdtsmartview     = "s".$counters;
                        $aisActive          = "a".$counters;
                        
                        $compSrvDtModel->insert_record($existingData['compId'], $servKey, $_POST[$adfdtday], $_POST[$adfdtperiod], $_POST[$adfdtfrom], $_POST[$adfdtto],  $_POST[$adfdtduration], $_POST[$adfdtclosebefore], $_POST[$adfdtsmartview], $_POST[$aisActive]);
                        #update 
                        $counters = $counters + 1;
			

                    }
                }
		return redirect()->to(base_url('/home/services'));


            }

            if(isset($_POST['arc_srv']))
            {
                $compSrvModel->update_archived(1,$_POST['arc_srv']);
                #$compSrvDtModel->delete_record($_POST['dlt_srv']);
            }

            if(isset($_POST['edit_srv']))
            {
                $existingServdt  = $compSrvDtModel->find_whr($_POST['edit_srv']);
                $anExistingServs = $compSrvModel->find_whr( $_POST['edit_srv']);
                #print_r($existingServdt);
                #print_r($anExistingServs);
                #exit();
            }

            if(isset($_POST['update_srv']))
            {
                $compSrvModel->update_record($_POST['brnch_name'], $_POST['dep_nam'], $_POST['srvName'], $_POST['srvPrice'], $_POST['payUrl'], $_POST['serviceBio'], $_POST['lastResDate'], $_POST['update_srv']);
                
                $counters = 1  ;
                while($counters <= 14)  
                {  
                    
                    $asrvDtFrom          = "f".$counters;
                    $asrvDtTo            = "t".$counters;
                    $asrvDtDur           = "r".$counters;
                    $asrvDtCloseBf       = "c".$counters;
                    $asrvDtSmartView     = "s".$counters;
                    $asrvDtIsActive      = "a".$counters;
                    $srvDtId			 = "srvDtId".$counters;
                    
                    $compSrvDtModel->update_record( $_POST[$asrvDtFrom], $_POST[$asrvDtTo], $_POST[$asrvDtDur], $_POST[$asrvDtCloseBf], $_POST[$asrvDtSmartView],  $_POST[$asrvDtIsActive], $_POST[$srvDtId]);
                     
                    $counters = $counters + 1;
                }
                
            }
	    

	     


        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        

        if(strlen($compId) > 0)
        {
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
            $existingServs = $compSrvModel->join_records( $existingData['compId']);
        }

        $data['existingDtdt']           = $existingDtdt;
        $data['existingServs']          = $existingServs;
        $data['existingServsBrnch']     = $existingServsBrnch;
        $data['exstngSrvsDprtmnts']     = $exstngSrvsDprtmnts;
        $data['existingServdt']         = $existingServdt;
        $data['anExistingServs']        = $anExistingServs;
        

        echo view ('header', $data);
        echo view ('services');
        echo view ('footer');

    }


    public function archived_services($compId='frabi', $sevId=1)
    {
        #session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        $compDdtModel        = new CompDdtModel($db2);
        $compSrvModel        = new CompServiceModel($db2);
        $comBranchModel      = new ComBranchModel($db2);
        $comDprtmntModel     = new ComDprtmntModel($db2);
        $compSrvDtModel     = new CompSrvDdtModel($db2);
        $existingDtdt        = [];
        $existingServs       = [];
        $existingServsBrnch  = [];
        $exstngSrvsDprtmnts  = [];
        $existingServdt      = [];
        $anExistingServs     = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel       = new GenInfoModel();
            $existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingDtdt       = $compDdtModel->find_whr( $existingData['compId']);
            $existingServs      = $compSrvModel->join_records( $existingData['compId']);
            $existingServsBrnch = $comBranchModel->find_whr( $existingData['compId']);
            $exstngSrvsDprtmnts = $comDprtmntModel->find_whr( $existingData['compId']);
        }   
        if($this->request->getMethod() == 'post')
        {
            
            
            #adding
            $ddt_record_id = -1;
           

            if(isset($_POST['rstor_srv']))
            {
                $compSrvModel->update_archived(0,$_POST['rstor_srv']);
		return redirect()->to(base_url('/home/archived_services'));
            }
 	    
	    if(isset($_POST['dlt_srv']))
            {
                $compSrvModel->delete_record($_POST['dlt_srv']);
		$compSrvDtModel->delete_record($_POST['dlt_srv']);

		return redirect()->to(base_url('/home/archived_services'));
            }


        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        

        if(strlen($compId) > 0)
        {
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
            $existingServs = $compSrvModel->join_records( $existingData['compId']);
        }

        $data['existingDtdt']           = $existingDtdt;
        $data['existingServs']          = $existingServs;
        $data['existingServsBrnch']     = $existingServsBrnch;
        $data['exstngSrvsDprtmnts']     = $exstngSrvsDprtmnts;
        $data['existingServdt']         = $existingServdt;
        $data['anExistingServs']        = $anExistingServs;
        

        echo view ('header', $data);
        echo view ('archived_services');
        echo view ('footer');

    }

    public function reports($compId='frabi')
    {
        #session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
	$comRsrvModel = new ComRsrvModel($db2);
	$existingData = [] ;
	$existingRss = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel       = new GenInfoModel();
            $existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingRss= $comRsrvModel->find_whr_comp($existingData['compId']);
        }   
	
	

        if($this->request->getMethod() == 'post')
        {

        }
	
	$compServiceModel = new CompServiceModel($db2);
	$th_srv_nm = [];
	foreach( $existingRss as $an_ex_srv )
	{
		
		$ful_srv_rec = $compServiceModel->find_whr($an_ex_srv->compSrvKey);
		if(count($ful_srv_rec)>0)
		{
			$th_srv_nm[$an_ex_srv->compSrvKey] = $ful_srv_rec[0]->srvName;
			#print_r($ful_srv_rec);exit();
		}
		else
		{
			$th_srv_nm[$an_ex_srv->compSrvKey] = "service is deleted!";
		}
	}


	$c_time = date('Y-m-d');
	
	$total_count = 0;
	$total_ahead = 0;
	$start_at    = 0;

	foreach($existingRss as $an_ex_srv){
		$r_time = date('Y-m-d',strtotime($an_ex_srv->custResDt));
		
		if($r_time <= $c_time)
		{
			$total_ahead = $total_ahead + 1;
		}
		else{
			$total_count = $total_count + 1;
		}
		
	}
	
	if($total_ahead > 10)
	{
		$start_at = $total_ahead - 9;
	}

	$data['th_srv_nm'] = $th_srv_nm;

	$data['start_at'] = $start_at; 

	$data['existingRss'] = $existingRss; 
	#print(count($existingRss));exit();
	#print_r($existingRss);exit();
        $data['isCollapsed'] = "sidebar js-sidebar";        

        echo view ('header', $data);
        echo view ('reports');
        echo view ('footer');

    }




    public function wklyservices($compId='frabi', $sevId=1, $srvDt='')
    {
        #session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        $compDdtModel        = new CompDdtModel($db2);
        $compSrvModel        = new CompServiceModel($db2);
        $comBranchModel      = new ComBranchModel($db2);
        $comDprtmntModel     = new ComDprtmntModel($db2);
        $compSrvDtModel     = new CompSrvDdtModel($db2);
	$compWklySrvDdtModel = new CompWklySrvDdtModel($db2);
	$comRsrvModel        = new ComRsrvModel($db2);

        $existingDtdt        = [];
        $existingServs       = [];
        $existingServsBrnch  = [];
        $exstngSrvsDprtmnts  = [];
        $existingServdt      = [];
        $anExistingServs     = [];

	$brnch_name	     ='';
	$dept_name           ='';
	$serv_name           ='';
	$date_of_week_head   ='';
        if(strlen($compId) > 0)
        {
            $genInfoModel       = new GenInfoModel();
            $existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingDtdt       = $compDdtModel->find_whr( $existingData['compId']);
            $existingServs      = $compSrvModel->join_records( $existingData['compId']);
            $existingServsBrnch = $comBranchModel->find_whr( $existingData['compId']);
            $exstngSrvsDprtmnts = $comDprtmntModel->find_whr( $existingData['compId']);
		
        }   
	$the_sdc = [];
	if($srvDt != '')
	{
		$the_sdc = $compWklySrvDdtModel->find_whr_sdc($sevId, $srvDt);
		if(count($the_sdc) < 1)
		{
			$the_sdc = $compSrvDtModel->find_whr($sevId);
		}
		//print_r($the_sdc);exit();
	}
	$is_found = FALSE;
        if($this->request->getMethod() == 'post')
        {
            
            
            #adding
            #$ddt_record_id = -1;
            
           
	   if(isset($_POST['get_cnfig_data']))
	   {
		$the_id = $_POST['srvc_name'];
		$date_of_week_head = $_POST['srvc_dt'];
		# print($the_id);print($date_of_week_head);exit();

		foreach($existingServsBrnch as $asExBrnch){
			if( $_POST['brnch_name'] == $asExBrnch->branchID){
				$brnch_name     = $asExBrnch->BranchName;
			}
		}
		
		foreach($exstngSrvsDprtmnts as $asExDeps){
			if( $_POST['dep_name'] == $asExDeps->DepID){
				$dept_name     = $asExDeps->DepName;
			}
		}

		$anExistingServs = $compSrvModel->find_whr($_POST['srvc_name']);
		$serv_name      = $anExistingServs[0]->srvName;


		$the_sdc = $compWklySrvDdtModel->find_whr_sdc($the_id, $date_of_week_head);
		//print_r($the_sdc);

		#print_r($_POST);exit();
		
                    		$this_week_config = $compWklySrvDdtModel->find_whr_sdc($the_id, $date_of_week_head);
				#print_r($this_week_config);exit();
				$week_counter = 1;
				$config_index = 0;
				$wk_dt = new Time($this_week_config[0]->wklyDtCrd);
				
				
				
				$res_counter = 0; 
				while($week_counter < 8){
				
					
					
				
				
						$y_day = new Time($wk_dt->format('Y-m-d'));
						$t_day = new Time($wk_dt->format('Y-m-d'));
						$y_day->modify('-1 days');
						$t_day->modify('+1 days');
						$aWexistingRes = $comRsrvModel->find_srv_sdt($the_id,$y_day,$t_day);
				
						
						if(count($aWexistingRes) > 0)
						{
						
							foreach($aWexistingRes as $anExstRes)
							{
								$tst_dt = new Time($anExstRes->custResDt);
								#print($tst_dt->day);
								if($tst_dt->day == $wk_dt->day)
								{
									$detaiedNextWeeks[$wk_dt->format('Y-m-d')] = 1;
									$is_found = TRUE;
									$res_counter = $res_counter + 1;
									break;
								}
							}
						
						
						}

						if($is_found == TRUE)
							{break;}

					
					
						$config_index = $config_index + 2;
						$week_counter = $week_counter +1;
						$wk_dt->modify('+1 days');
				}

           }
	   
	   if(isset($_POST['upt_wkly_srv']))
	   {
		if($srvDt != '')
		{
			$the_sdc = $compWklySrvDdtModel->find_whr_sdc($sevId, $srvDt);
		}
		if(strpos($_POST['upt_wkly_srv'], ".") > -1 && count($the_sdc) < 1)
		{
			# print('Hi Hello');exit();	
			$the_id = substr($_POST['upt_wkly_srv'],0,strpos($_POST['upt_wkly_srv'], "."));
			$the_dcrd = substr($_POST['upt_wkly_srv'],strpos($_POST['upt_wkly_srv'], ".")+1);

			$counters = 1  ;
                	while($counters <= 14)  
                	{  
                    
                    		$asrvDtFrom          = "f".$counters;
                    		$asrvDtTo            = "t".$counters;
                    		$asrvDtDur           = "r".$counters;
                    		$asrvDtCloseBf       = "c".$counters;
                    		$asrvDtSmartView     = "s".$counters;
                    		$asrvDtIsActive      = "a".$counters;
                    		$srvDtId	     = "wklySrvDtId".$counters;
				
				$period = 1;
				if($counters % 2 == 0)
					{$period = 2;}		

				$day = "";
				if($counters <3)
					{$day = "Sunday";}
				if($counters > 2 && $counters < 5 )
					{$day = "Monday";}
				if($counters > 4 && $counters < 7 )
					{$day = "Tuesday";}
				if($counters > 6 && $counters < 9 )
					{$day = "Wednesday";}
				if($counters > 8 && $counters < 11 )
					{$day = "Thursday";}
				if($counters > 10 && $counters < 13 )
					{$day = "Friday";}
				if($counters > 12 && $counters < 15 )
					{$day = "Saturday";}

				#print($period);
				#print_r($_POST);
				#exit();

				
                    		$compWklySrvDdtModel->insert_record($the_dcrd, $existingData['compId'],
								$the_id, $day, $period,  $_POST[$asrvDtFrom], $_POST[$asrvDtTo], $_POST[$asrvDtDur], $_POST[$asrvDtCloseBf], $_POST[$asrvDtSmartView],  $_POST[$asrvDtIsActive], $_POST[$srvDtId]);
                     
                    		$counters = $counters + 1;
                	}
			
		
		  }
		  else
		  {
		
			

		
			$counters = 1  ;
                	while($counters <= 14)  
                	{  
                    
                    		$asrvDtFrom          = "f".$counters;
                    		$asrvDtTo            = "t".$counters;
                    		$asrvDtDur           = "r".$counters;
                    		$asrvDtCloseBf       = "c".$counters;
                    		$asrvDtSmartView     = "s".$counters;
                    		$asrvDtIsActive      = "a".$counters;
                    		$srvDtId			 = "wklySrvDtId".$counters;
                    		
				
				
				$compWklySrvDdtModel->update_record( $_POST[$asrvDtFrom], $_POST[$asrvDtTo], $_POST[$asrvDtDur], $_POST[$asrvDtCloseBf], $_POST[$asrvDtSmartView],  $_POST[$asrvDtIsActive], $_POST[$srvDtId]);
                     
                    		$counters = $counters + 1;
                	}
		  }
		return redirect()->to(base_url('/home/wklyservices'));

           }

	   //exit();

	     


        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        

        if(strlen($compId) > 0)
        {
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
            $existingServs = $compSrvModel->join_records( $existingData['compId']);
        }

        $data['existingDtdt']           = $existingDtdt;
        $data['existingServs']          = $existingServs;
	//print_r($existingServs);exit();
	$cwsdh = [];
	//foreach($existingServs as $es)
	//{	
		//print( $es->srvId);
		//$cwsdh = $compWklySrvDdtModel->find_dst_sdc($es->srvId);
		//break;
		//print_r($cwsdh);exit();

	//}
        $data['existingServsBrnch']     = $existingServsBrnch;
        $data['exstngSrvsDprtmnts']     = $exstngSrvsDprtmnts;
        $data['existingServdt']         = $the_sdc;
        $data['anExistingServs']        = $anExistingServs;
	$data['cwsdh']                  = $cwsdh;
	$data['sevId']                  = $sevId;
	$data['srvDt']                  = $srvDt;
	$data['is_found']               = $is_found;

	$data['brnch_name']             = $brnch_name;
	$data['dept_name']              = $dept_name;
	$data['serv_name']              = $serv_name;
	$data['date_of_week_head']      = $date_of_week_head;




        echo view ('header', $data);
        echo view ('wklyservices');
        echo view ('footer');

    }


    public function default_dt($compId='frabi')
    {
        #session_start();

        $_SESSION['conflict'] = false;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< by fares 


        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        $compDdtModel = new CompDdtModel($db2);
        $existingDtdt = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel = new GenInfoModel();
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
        }   
        if($this->request->getMethod() == 'post')
        {
            #if(isset($_POST['add_account']))
            #{
            #    print_r($_POST);
            #    $compAccModel->insert_record($existingData['compId'], $_POST['account_type'], $_POST['acName'], $_POST['acPhone'], $_POST['acEmail'], $_POST['acSec'], $_POST['Prf_lng']);
            #}
	
	    #print_r($_POST);exit();
            
            #for acc update and delete 
            $ddt_record_id = -1;
            if(isset($_POST['edit_dt']))
            {
                #$ddt_record_id = $existingDtdt[$_POST['edit_dt']-1]->dfdtId;
                

                //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv by fares
                $flag = true;
                $counters = 1;
                while($counters <= count($existingDtdt))  {
                    $tempFrom = "f".$counters;
                    $tempFromTime = substr($_POST[$tempFrom],0,2) . substr($_POST[$tempFrom],3);

                    $tempTo = "t".$counters;
                    $tempToTime = substr($_POST[$tempTo],0,2) . substr($_POST[$tempTo],3);


                    if ($tempFromTime > $tempToTime){

                        $flag = false;
                        $_SESSION['conflict'] = true;
                        echo '<style > 
                        input[name='.$tempTo.'] {border: 1px solid red !important;}
                        input[name='.$tempFrom.'] {border: 1px solid red !important;}
                        </style>';
                    }
                    $counters++;
                    if ($counters % 2 == 0){
                        $tempFrom = "f".$counters;
                        $tempFromTime = substr($_POST[$tempFrom],0,2) . substr($_POST[$tempFrom],3);
                        
                        if ($tempToTime > $tempFromTime){
                        
                            $flag = false;
                            $_SESSION['conflict'] = true;
                            echo '<style > 
                            input[name='.$tempTo.'] {border: 1px solid red !important;}
                            input[name='.$tempFrom.'] {border: 1px solid red !important;}
                            </style>';
                        }
                        
                        
                    }

                }    
                if ($flag){
                    $_SESSION['conflict'] = false;
                //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ By fares



                    $counters = 1  ;
                    while($counters <= count($existingDtdt))  
                    {  
                        $record_id = $existingDtdt[$counters-1]->dfdtId;

                        $adfdtday           = "d".$counters;
                        $adfdtperiod        = "p".$counters;
                        $adfdtfrom          = "f".$counters;
                        $adfdtto            = "t".$counters;
                        $adfdtduration      = "r".$counters;
                        $adfdtclosebefore   = "c".$counters;
                        $adfdtsmartview     = "s".$counters;
                        $aisActive          = "a".$counters;

                        $compDdtModel->update_record($_POST[$adfdtday], $_POST[$adfdtperiod], $_POST[$adfdtfrom], $_POST[$adfdtto], $_POST[$adfdtduration], $_POST[$adfdtclosebefore], $_POST[$adfdtsmartview], $_POST[$aisActive], $record_id);
                        $counters = $counters + 1;
                    }
            
                }   
            }    
            #if(isset($_POST['delete_acc']))
            #{
            #    $acc_record_id = $existingAccs[$_POST['delete_acc']-1]->accId;
            #    if($acc_record_id > -1)
            #        $compAccModel->delete_record($acc_record_id);
            #}
        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        if(strlen($compId) > 0)
            $existingDtdt = $compDdtModel->find_whr( $existingData['compId']);
        
        $data['existingDtdt'] = $existingDtdt;

        echo view ('header', $data);
        echo view ('default_dt');
        echo view ('footer');
    }

    public function sign_in($type='cp', $compId='frabi')
    {
	
        # session_start();
        $autoload['helper'] = array('url','html','form','file');

        $data=[];

	if($type != 'cp')
	{
	    $genInfoModel       = new GenInfoModel();
            $existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();

            $socialMedia = ($existingData['compSocialAcc']);
            #print($socialMedia);
            $coma_pos = strpos($socialMedia, ',');
            $atwitter = substr($socialMedia, 0, $coma_pos);
            #print("twitter");
            #print($atwitter);
            $socialMedia = substr($socialMedia,$coma_pos+1);

            $coma_pos = strpos($socialMedia, ',');
            $insta = substr($socialMedia, 0, $coma_pos);
            #print("insta");
            #print($insta);
            $snap = substr($socialMedia,$coma_pos+1);
            #print("snap");
            #print($snap);

             
            

            $data = [
                'compPublicName'    => $existingData['compPublicName'],
                'compUrlShortName'  => $existingData['compUrlShortName'],
                'compWhoRwe'        => $existingData['compWhoRwe'],
                'compWorkingHrs'    => $existingData['compWorkingHrs'],
                'compLocation'      => $existingData['compLocation'],
                'compPhoNumb'       => $existingData['compPhoNumb'],
                'compWtzNumb'       => $existingData['compWtzNumb'],
                'compEmail'         => $existingData['compEmail'],
                'compLogo'          => $existingData['compLogo'],
                'twitter_acc'       => $atwitter,
                'instgram_acc'      => $insta, 
                'snap_acc'          => $snap,
                'pages'             => [],
            ];

	}

        $session = isset($_SESSION['logedin']); //here you can take loginid, email whatever you store in session
	
	//print_r();

        if(!$session)
        {
	    #print($_SERVER['REQUEST_METHOD']);
	    if($this->request->getMethod() == 'post')
            {
		
		#print_r($_POST);exit();
		//print('pppppppp2');

                $phoneNumer = $_POST['phoneNumber'];//$this->input->post('email');  
                $pass = $_POST['password'];//$this->input->post('password');  
                
                $rules = [
                    'phoneNumber' => [
                        'rules' => 'required|min_length[10]',
                        'label' => 'Phone Number',
                        'errors' => [
                            'required' => 'The phone number is required',
                            'auser_check' => 'The phone number has to be ten digits',
                        ]
                    ],
                ];

                if($this->validate($rules))
                {
		    //('pppppppp3');

                    $db2 = db_connect('frabiedb');
                    $a_comp_acc_model = new CompAccModel($db2);
                    $result = $a_comp_acc_model->checkUser($phoneNumer, crypt(md5($pass),"st123"));
                    
                    if(count($result) > 0)
                    {   
			//print('pppppppp4');
       
                        $_SESSION['logedin']=$result[0]->AccName;
                        $_SESSION['logedinid']=$result[0]->accId;
                        if($result[0]->compAccTypeKey == 1)
                        {
			    //print('pppppppp5');

			    //print ('$result[0]->compAccTypeKey');
			    //print ($result[0]->compAccTypeKey);

                            return redirect()->to(base_url('/home/main_page'));
                        }
                        else{
			    //print ('not $result[0]->compAccTypeKey');
			    //print ($result[0]->compAccTypeKey);

                            return redirect()->to(base_url('/home/org_public_web'));
                        }
                    }  
                    else
                    {  
                        $data['error'] = 'Your Account is Invalid';  
                        #$this->load->view('login_view', $data);  
                    }

                }else{
                   $data['validation'] = $this->validator;     
                }
            }  
        }
        else
        {
            #ob_start();
            #defined('BASEPATH') OR exit('No direct script access allowed');
            if($type=='cp')
            {
                return redirect()->to(base_url('/home/main_page'));
            }
            else{
                return redirect()->to(base_url('/home/org_public_web'));
            }
            #print("nice you have the session! ");
            #print($_SESSION['logedin']);
	
            
        }
	
	$data['type'] = $type;
        $data['isCollapsed'] = "sidebar js-sidebar";
        $data['isCollapsed'] = "sidebar js-sidebar collapsed";
        
	if($type=='cp')
	{
        	echo view ('header', $data);
        	echo view ('sign_in', $data);
        	echo view ('footer');
	}
	else
	{
        
        $db2            = db_connect('frabiedb');
        $comAdModel     = new ComAdsModel($db2);
        $existingAds    = $comAdModel->find_whr( $existingData['compId']);
        $data ['ads']   = $existingAds;
        $data['colors'] = (new CompColorsModel($db2))->find_whr($existingData['compId']);//<<<<<<<< fares        
		
		echo view ('public_header', $data);
        	#echo view ('org_public_view', $data);
		echo view ('sign_in', $data);
        	echo view ('public_footer', $data);
	}
    }
    public function logout($type='')  
    {  
        //removing session
        #session_start();
        $autoload['helper'] = array('url','html','form','file');
        #print($_SESSION['logedin']);
        $_SESSION['logedin']=null; 
        $_SESSION['logedinid']=null;
        #print("logouting");
        if($type=='')
        {
            return redirect()->to(base_url('/home/sign_in'));  
        }
        else{
            return redirect()->to(base_url('/home/org_public_web'));  
        }
        
    }

    public function sign_up($compId='frabi', $lng='ar')
    {

        # session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        $compAccModel = new CompAccModel($db2);
        $existingAccs = [];
        if(strlen($compId) > 0)
        {
            $genInfoModel = new GenInfoModel();
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingAccs = $compAccModel->find_whr( $existingData['compId']);
            
        }   
        if($this->request->getMethod() == 'post')
        {
            if(isset($_POST['add_account']))
            {
                //print_r($_POST);
                $compAccModel->insert_record($existingData['compId'], $_POST['account_type'], $_POST['acName'], $_POST['acPhone'], $_POST['acEmail'], crypt(md5($_POST['acSec']),"st123") , $_POST['Prf_lng']);
            }
            
            #for acc update and delete 
            $acc_record_id = -1;
            if(isset($_POST['edit_acc']))
            {
                $acc_record_id = $existingAccs[$_POST['edit_acc']-1]->accId;
                $aTyp = "t".$_POST['edit_acc'];
                $aNam = "n".$_POST['edit_acc'];
                $aPhn = "p".$_POST['edit_acc'];
                $aEml = "e".$_POST['edit_acc'];
                $aPas = "s".$_POST['edit_acc'];
                $aLan = "l".$_POST['edit_acc'];
                if($acc_record_id > -1)
                    $compAccModel->update_record($_POST[$aTyp], $_POST[$aNam], $_POST[$aPhn], $_POST[$aEml], crypt(md5($_POST[$aPas]),"st123"),$_POST[$aLan],$acc_record_id);
            }

            if(isset($_POST['delete_acc']))
            {
                $acc_record_id = $existingAccs[$_POST['delete_acc']-1]->accId;
                if($acc_record_id > -1)
                    $compAccModel->delete_record($acc_record_id);
            }
        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        if(strlen($compId) > 0)
            $existingAccs = $compAccModel->find_whr( $existingData['compId']);
        
        $data['existingAccs'] = $existingAccs;
	$data['lng']	      = $lng; 
	
	$ini_array = ("/Language/" . $lng . "/constants.php"); # base_url
	$data['ini_array']	      = $ini_array; 
		
        echo view ('header', $data);
        echo view ('sign_up');
        echo view ('footer');
    }

    public function cust_app($compId='frabi')
    {
        
        #session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
        
           
        $db2 = db_connect('frabiedb');
	$compAccModel = new CompAccModel($db2);
        $comRsrvModel = new ComRsrvModel($db2);
        $comAttchModel = new ComAttchModel($db2);
	$compServiceModel = new CompServiceModel($db2);
        $existingRss = [];
        $existingAts = [];
	$existingSvs = [];
	$acPhone = "";
        if(strlen($compId) > 0)
        {
            $genInfoModel = new GenInfoModel();
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
            #$existingSvs = $compServiceModel->find_whr( );
	   
        }   
        
        if($this->request->getMethod() == 'post')
        {
		
            if(isset($_POST['search']))
            {
                
		$acPhone = $_POST['acPhone'];
                $result = $compAccModel->find_by_phone($_POST['acPhone']);
                if(count($result)>0)
                {
                    $existingRss = $comRsrvModel->find_cust( $result[0]->accId);
                    $existingAts = $comAttchModel->find_whr( $result[0]->accId);
                }
                
            }

            $res_record_id = -1;
            if(isset($_POST['delete_res']))
            {
		$acPhone = $_POST['lAcPhone'];

                #$res_record_id = $existingRss[$_POST['delete_res']-1]->custResID;
                #if($res_record_id > -1)
                #{
                    $comRsrvModel->delete_record($_POST['delete_res']);
                    #$existingRss = $comRsrvModel->find_cust( $_SESSION['logedinid']);
		    $result = $compAccModel->find_by_phone($_POST['lAcPhone']);
                    if(count($result)>0)
                    {
                    	$existingRss = $comRsrvModel->find_cust( $result[0]->accId);
                    	$existingAts = $comAttchModel->find_whr( $result[0]->accId);
                    }

                #}
            }
            if(isset($_POST['delete_ats']))
            {
                $res_record_id = $existingAts[$_POST['delete_ats']-1]->attchId;
                if($res_record_id > -1)
                {
                    $comAttchModel->delete_record($res_record_id);
                    $existingAts = $comAttchModel->find_whr( $_SESSION['logedinid']);
                }
            }
        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        #if(strlen($compId) > 0)
            #$existingAccs = $compAccModel->find_whr( $existingData['compId']);
        
        
	
	$th_srv_nm = [];
	foreach( $existingRss as $an_ex_srv )
	{
		
		$ful_srv_rec = $compServiceModel->find_whr($an_ex_srv->compSrvKey);
		if(count($ful_srv_rec)>0)
		{
			$th_srv_nm[$an_ex_srv->compSrvKey] = $ful_srv_rec[0]->srvName;
			#print_r($ful_srv_rec);exit();
		}
		else
		{
			$th_srv_nm[$an_ex_srv->compSrvKey] = "service is deleted!";
		}
	}
	
	
	
	$data['existingRss'] = $existingRss;
        $data['existingAts'] = $existingAts;
	$data['th_srv_nm'] = $th_srv_nm;
	$data['acPhone'] = $acPhone;
	

        echo view ('header', $data);
        echo view ('cust_app');
        echo view ('footer');
    }

    public function srvs_apnt($compId='frabi')
    {

        # session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));
            
        $db2 = db_connect('frabiedb');
        
        $comBranchModel = new ComBranchModel($db2);
        $compSrvModel   = new CompServiceModel($db2);
        $comRsrvModel   = new ComRsrvModel($db2);
	$comDprtmntModel     = new ComDprtmntModel($db2);

        $a_comp_acc_model = new CompAccModel($db2);
                    
        $existingServsBrnch  = [];
        $existingServs       = [];
        $openDaysList        = [];
        $existingApnts       = [];

        $formated_list       = [];

        $brnch_name          = '';
	$dept_name           = '';
        $serv_name           = '';
        $open_days           = '';
        $existing_list      = [];
	$existingDeps       = [];
	$c_n_f_msg          = ""; 	
                

        if(strlen($compId) > 0)
        {
            $genInfoModel = new GenInfoModel();
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
            $existingServsBrnch = $comBranchModel->find_whr( $existingData['compId']);
	    $existingDeps = $comDprtmntModel->find_whr( $existingData['compId']);
            $existingServs = $compSrvModel->find_all_servs($existingData['compId']);            
        }   
        if($this->request->getMethod() == 'post')
        {
            if(isset($_POST['list_open_days']))
            {
		# print_r($existingDeps);exit();
		
		
		foreach($existingServsBrnch as $asExBrnch){
			if( $_POST['brnch_name'] == $asExBrnch->branchID){
				$brnch_name     = $asExBrnch->BranchName;
			}
		}
		
		foreach($existingDeps as $asExDeps){
			if( $_POST['dep_name'] == $asExDeps->DepID){
				$dept_name     = $asExDeps->DepName;
			}
		}


		
        	
                $open_days      = $_POST['open_days'];


		$y_day = Time::createFromFormat(cCalendar::cmnVrb, $open_days);
		$t_day = Time::createFromFormat(cCalendar::cmnVrb, $open_days);
		$y_day->modify('-1 days');
		$t_day->modify('+1 days');
		$existingApnts      = $comRsrvModel->find_srv_sdt($_POST['serv_name'],$y_day,$t_day);


                $anExistingServs = $compSrvModel->find_whr($_POST['serv_name']);
		$serv_name      = $anExistingServs[0]->srvName;
                $st_date = new Time();
                $dteEnd = $anExistingServs[0]->srvLstResDt;
                
                # $existingApnts  = $comRsrvModel->find_srv_dt($_POST['serv_name'], $anExistingServs[0]->srvLstResDt);
                

                $compSrvDtModel     = new CompSrvDdtModel($db2);
                $existingServdt  = $compSrvDtModel->find_whr($_POST['serv_name']);

                $calendar = new cCalendar(date('2022-03-01'));

		#print_r($existingServdt);
		#print($open_days);
   		#print_r($existingApnts);

                $f_results = $calendar->get_formated_time($existingServdt, $open_days, $existingApnts, false);
                $formated_list = $f_results[1];
                $anexisting_list = $f_results[2];
		
		# print_r($anexisting_list);exit();
	
                $existing_list = [];

		#print_r($anexisting_list );
		

                foreach($anexisting_list as $key => $value) {


                    $result = $a_comp_acc_model->find_by_accId($value->compAccKey);
		    if(count($result)>0)
		    {
		    	$anaray = [ $value, $result[0] ];
                    	$existing_list[$key] = $anaray;
                    }
                }

            }
            
            if(isset($_POST['edit_res']))
            {
                $row_val_pos = strpos($_POST['edit_res'],":", 0);
                
                if($row_val_pos > 0)
                {
                    //edit
                    $row_counter    = substr($_POST['edit_res'],0,$row_val_pos);
                    $aCustResID     = substr($_POST['edit_res'],$row_val_pos+1);
                    $avstrNam           = "name".$row_counter;
                    $aCustResAttended   = "attn".$row_counter;
                    $comRsrvModel->update_record($_POST[$avstrNam], $_POST[$aCustResAttended], $aCustResID);
                }
                else{
                    $row_counter = $_POST['edit_res'];
                    $aTime     = "time".$row_counter;
                    $aNam      = "name".$row_counter;
                    $aPhn      = "phon".$row_counter;
                    $aAtt      = "attn".$row_counter;

                    $customer = $a_comp_acc_model->find_by_phone($_POST[$aPhn]);
		    if(count($customer) > 0)
		    {
		    	
                    	$adatetime = Time::createFromFormat(cCalendar::cmnVrb, $_POST['open_day']);
                    	$adatetime->setTime(0, 0, 0);
                   	$tim_pck = $_POST[$aTime];
                    	$pos1  = strpos($tim_pck,":",0); 
                    	$part1 = substr($tim_pck,0, $pos1);
                    	$part2 = substr($tim_pck,$pos1+1 );
                    	$adatetime->add(new \DateInterval('PT' . $part1 . 'H'));
                    	$adatetime->add(new \DateInterval('PT' . $part2 . 'M'));

                    	$aCustResDt = $adatetime->format('Y-m-d H:i:s');

                    	if($_POST[$aAtt] == -1)
                    	{
                        	$comRsrvModel->insert_record($existingData['compId'], $_SESSION['logedinid'], $_POST[$aNam], $_POST['serv_name'], $aCustResDt, $_POST[$aAtt]);
                    	}
                    	else{
                        	$comRsrvModel->insert_record($existingData['compId'], $customer[0]->accId, $_POST[$aNam], $_POST['serv_name'], $aCustResDt, $_POST[$aAtt]);
                    	}
		    }
		    else{
			$c_n_f_msg = "The user does not exist please register the user first!";
		    }
                }
               
            }

            if(isset($_POST['delt_res']))
            {
                if($_POST['delt_res'] > -1)
                    $comRsrvModel->delete_record($_POST['delt_res']);
            }
        }
        $data['isCollapsed'] = "sidebar js-sidebar";
        #if(strlen($compId) > 0)
        #    $existingAccs = $compAccModel->find_whr( $existingData['compId']);
        
        $data['existingServs']          = $existingServs;
        $data['existingServsBrnch']     = $existingServsBrnch;
        $data['existingApnts']          = $existingApnts;
        $data['openDaysList']           = $openDaysList;
        
        $data['brnch_nam']             = $brnch_name;
        if(isset($_POST['brnch_name'])) 
        {
            $data['brnch_nam'] = $_POST['brnch_name'];
        }

        $data['serv_nam']              = '';
        if(isset($_POST['serv_name'])) 
        {
            $data['serv_nam'] = $_POST['serv_name'];
        }

	$data['open_day']              = '';
	if(isset($_POST['open_days'])) 
        {
            $data['open_day']              = $_POST['open_days'];
        }

        
        
        $data['formated_list']         = $formated_list;
        $data['existing_list']         = $existing_list;

	$data['brnch_name']         = $brnch_name;
	$data['dept_name']          = $dept_name;
	$data['serv_name']          = $serv_name;
	$data['open_days']          = $open_days;
	$data['c_n_f_msg']          = $c_n_f_msg;


	


        echo view ('header', $data);
        echo view ('srv_appntmnt');
        echo view ('footer');
    }


    public function cp_settings($compId='frabi')
    {
	ini_set('memory_limit', '1024M'); // or you could use 1G
	        
        //helper(['form']);

        //removing session
        # session_start();
        $autoload['helper'] = array('url','html','form','file', 'image');
        if(!isset($_SESSION['logedin']))
            return redirect()->to(base_url('/home/sign_in'));

        $genInfoModel = new GenInfoModel();
        $db2 = db_connect('frabiedb');
        $comPagesModel = new ComPagesModel($db2);
        $comAdModel = new ComAdsModel($db2);
        $comBranchModel = new ComBranchModel($db2);
        $comDprtmntModel = new ComDprtmntModel($db2);
        $CompColorsModel = new CompColorsModel($db2);//<<<<<<< fares


        #hash password model 9 @ 39

        if($this->request->getMethod() == 'post')
        {
            
            $existingData = $genInfoModel->where('compUrlShortName', $compId)->first();
//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv by fares
	    
            if(isset($_POST["change_color"])){
                $colors = array(
                    'header' => $_POST['header'],
                    'footer' => $_POST['footer'],
                    'font1' => $_POST['font1'],
                    'font2' => $_POST['font2'],
                    'buttons' => $_POST['buttons'],

                );

                $CompColorsModel->update_record('1',$colors);
            }

            if(isset($_POST["default_color"])) $CompColorsModel->set_default();

            
            // $data['footer'] = $CompColorsModel->find($existingData['compId'], 'footer')->hex_color;
            // $data['font'] = $CompColorsModel->find($existingData['compId'], 'font')->hex_color;
            // $data['buttons'] = $CompColorsModel->find($existingData['compId'], 'buttons')->hex_color;

            
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ by fares

            if(isset($_POST['save_img_upload']))
            {
               
                $rules = [
                    'compLogo' => [
                        'rules' => 'max_size[compLogo, 100024]|ext_in[compLogo,png]|max_dims[compLogo,10000,10000]',# 
                        'label' => 'The logo image'
                        
                    ],
                    'pagePhoto' => [
                        'rules' => 'max_size[pagePhoto, 1000024]|ext_in[pagePhoto,jpg]|max_dims[pagePhoto,10000,10000]',#uploaded[page1_image]|
                        'label' => 'The page image'
                        
                    ],
                    'adPhoto' => [
                        'rules' => 'max_size[adPhoto, 1000024]|ext_in[adPhoto,jpg]|max_dims[adPhoto,10000,10000]',#uploaded[adPhoto]|
                        'label' => 'The ad. image'
                        
                    ],
		    



                ];

                

                if($this->validate($rules))
                {
                    
                    $imgLogo = $this->request->getFile('compLogo');
                    $path = './uploads/images/manipulated/';
                    $srv_image = service('image');
		    
                    if($imgLogo->isValid() && !$imgLogo->hasMoved())
                    {
                        $imgLogo->move($path, 'logo_img.' . $imgLogo->getExtension());
                        $afileName = $imgLogo->getName();
			
                        if(! file_exists($path . 'thumbs/'))
                            mkdir($path . 'thumbs/', 755);
                        $srv_image->withFile($path . '/' . $afileName)
                        #->fit(150,150, 'top-right')
                        ->fit(50,50, 'center')
                        ->save($path . 'thumbs/' . $afileName );
                        $data['img_loc'] = $path . 'thumbs/' . $afileName;
                        $_POST['compLogo']=$afileName;
                        $genInfoModel->update($existingData['compId'], $_POST);
                    }

                    $page1_image = $this->request->getFile('pagePhoto');
                    if($page1_image->isValid() && !$page1_image->hasMoved())
                    {
			    $rules = [
                    		'pageName' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'page name',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						                        		]
                    		],
		    		'pageTxt' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'page content',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						                        		]
                    		],		    	
			    ];

		    	if($this->validate($rules))
               	    	{
				
		    			
                        	$page1_image->move($path);#, 'pagePhoto1.' . $page1_image->getExtension()
                        	$afileName = $page1_image->getName();
                        	if(! file_exists($path . 'thumbs/'))
                            		mkdir($path . 'thumbs/', 755);
                        	$srv_image->withFile($path . '/' . $afileName)
                        	#->fit(150,150, 'top-right')
                        	->fit(1200,1348, 'center')
                        	->save($path . 'thumbs/' . $afileName );
                        	$data['pg_img_loc'] = $path . 'thumbs/' . $afileName;
                        	#print_r($data);
                        	$comPagesModel->insert_record($existingData['compId'], $_POST['pageName'], $afileName, $_POST['pageTxt']);

			}
		    	else
		    	{
                   		$data['validation'] = $this->validator;     
                    	}

                    }

                    $ad_image = $this->request->getFile('adPhoto');
                    if($ad_image->isValid() && !$ad_image->hasMoved())
                    {
                        $ad_image->move($path);
                        $afileName = $ad_image->getName();
                        if(! file_exists($path . 'thumbs/'))
                            mkdir($path . 'thumbs/', 755);
                        $srv_image->withFile($path . '/' . $afileName)
                        #->fit(150,150, 'top-right')
                        ->fit(1920,1280, 'center')
                        ->save($path . 'thumbs/' . $afileName );
                        $data['ad_img_loc'] = $path . 'thumbs/' . $afileName;
                        #print_r($data);
                        $comAdModel->insert_record($existingData['compId'],  $afileName, $_POST['adURL']);

                    }
 
                }
                else
                {
                    #print_r($this->validator);
                    $data['validation'] = $this->validator;
                }
            }
            #exit();

            
            
            if(isset($_POST['twitter_acc']))
            {
                $_POST['compSocialAcc'] = 
                    $_POST['twitter_acc'] 
                    . ',' . $_POST['instgram_acc']  
                    . ',' . $_POST['snap_acc'] ;
                
                #print($_POST['compSocialAcc']);
            }
            
            

            if($existingData)
            {
                if(isset($_POST['save_main_settings']))
                {
		   
                    
		    		    
    			
                	$rules = [
                    		'compPublicName' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'company public name',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						                        		]
                    		],
				
				'compWhoRwe' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'who are we',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						
                        		]
                    		],
				'compWorkingHrs' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'working hours',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						
                        		]
                    		],
				'compLocation' => [
                        		'rules' => 'required|min_length[5]|valid_url_strict[https]',
                        		'label' => 'location',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'valid_url_strict' => 'The {field} has to be a valid URL taken from Google embedded',
                        		]
                    		],
				'compPhoNumb' => [
                        		'rules' => 'required|min_length[10]|integer',
                        		'label' => 'phone number',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'integer' => 'The {field} has to be ten digits',
                        		]
                    		],
				'compWtzNumb' => [
                        		'rules' => 'required|min_length[12]|integer',
                        		'label' => 'whatsapp number',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'integer' => 'The {field} has to be twelve digits',

                        		]
                    		],
				'compEmail' => [
                        		'rules' => 'required|min_length[5]|valid_email',
                        		'label' => 'email',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'valid_email' => 'The {field} has to be of a vaild format',
                        		]
                    		],
				'twitter_acc' => [
                        		'rules' => 'required|min_length[5]|valid_url_strict[https]',
                        		'label' => 'twitter',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'valid_url_strict' => 'The {field} has to be a valid URL for twitter acc.',
                        		]
                    		],
				'instgram_acc' => [
                        		'rules' => 'required|min_length[5]|valid_url_strict[https]',
                        		'label' => 'instgram',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'valid_url_strict' => 'The {field} has to be a valid URL for instgram account',
                        		]
                    		],

				'snap_acc' => [
                        		'rules' => 'required|min_length[5]|valid_url_strict[https]',
                        		'label' => 'snap',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'valid_url_strict' => 'The {field} has to be a valid URL for twitter account',
                        		]
                    		],

				





               	 	];

                	if($this->validate($rules))
               	 	{
				$genInfoModel->update($existingData['compId'], $_POST);
			}else{
                   		$data['validation'] = $this->validator;     
                	}


                   
                }

                if(isset($_POST['add_branch']))
                {
		    $rules = [
                    		'branch_name' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'branch',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						    ]
                    		],
		    ];

		    if($this->validate($rules))
               	    {
			$comBranchModel->insert_record($existingData['compId'], $_POST['branch_name']);
		    }
		    else
		    {
                   	$data['validation'] = $this->validator;     
                    }


                    
                }

		$branches_records = $comBranchModel->find_whr( $existingData['compId']);
                $branch_record_id = -1;
                if(isset($_POST['edit_branches']))
                {
		    
		    $branch_tx = 'brnchTb'.$_POST['edit_branches'];

		    
                    if($_POST['edit_branches'] > -1)
		    {
			$rules = [
                    		$branch_tx => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'branch',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						    ]
                    		],
		    	];

		    	if($this->validate($rules))
               	    	{
				$comBranchModel->update_record($_POST[$branch_tx], $_POST['edit_branches']);
		    	}
		    	else
		    	{
                   		$data['validation'] = $this->validator;     
                    	}

		    }
                }

                if(isset($_POST['add_department']))
                {
		    $rules = [
                    		'department_name' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'department',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						    ] 
                    		],
		    ];

		    if($this->validate($rules))
               	    {
			$comDprtmntModel->insert_record($existingData['compId'], $_POST['department_name']);
		    }
		    else
		    {
                   	$data['validation'] = $this->validator;     
                    }


                    
                }

		$department_records = $comDprtmntModel->find_whr( $existingData['compId']);
                $department_record_id = -1;
                if(isset($_POST['edit_department']))
                {
                    $department_record_id = $department_records[$_POST['edit_department']-1]->DepID;
                    if($department_record_id > -1)
		    {
                        $rules = [
                    		'department_name' => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'department',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						    ] 
                    		],
		    	];

		    	if($this->validate($rules))
               	    	{
				$comDprtmntModel->update_record($_POST[$_POST['edit_department']], $department_record_id);
		    	}
		   	else
		    	{
                   		$data['validation'] = $this->validator;     
                   	}


			
		    }
                }
                

                #for pages update and delete 
                $records = $comPagesModel->find_whr( $existingData['compId']);//[$_POST['edit_page']-1]['pageId'];
                $record_id = -1;
                
                if(isset($_POST['edit_page']))
                {
                    $record_id = $records[$_POST['edit_page']-1]->pageId;
                    
                    $pName = "p".$_POST['edit_page'];
                    $cName = "c".$_POST['edit_page'];
                    if($record_id > -1)
		    {
			$rules = [
                    		$pName => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'page name',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						    ] 
                    		],
				$cName => [
                        		'rules' => 'required|min_length[5]',
                        		'label' => 'page content',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						    ] 
                    		],

		    	];

		    	if($this->validate($rules))
               	    	{
				$comPagesModel->update_record($_POST[$pName], $_POST[$cName],$record_id);
		    	}
		   	else
		    	{
                   		$data['validation'] = $this->validator;     
                   	}

                        
		    }
                }
               
                $ads_records = $comAdModel->find_whr( $existingData['compId']);
                $ad_record_id = -1;
                if(isset($_POST['edit_ads']))
                {
		    
                    $ad_url_tx = 'adUrlTb'.$_POST['edit_ads'];
		    
                    if($_POST['edit_ads'] > -1)
		    {
			$rules = [
                    		$ad_url_tx => [
                        		'rules' => 'required|min_length[5]|valid_url_strict',
                        		'label' => 'Ads.',
                        		'errors' => [
                            			'required' => 'The {field} is required',
                            			'min_length' => 'The {field} has to be at least five characters',
						'valid_url_strict' => 'The {field} has to be a valid URL',

						    ]
                    		],
		    	];

		    	if($this->validate($rules))
               	    	{
				$comAdModel->update_record($_POST[$ad_url_tx], $_POST['edit_ads']);
		    	}
		    	else
		    	{
                   		$data['validation'] = $this->validator;     
                    	}


                        
		    }
                }

                

                if(isset($_POST['delete_branches']))
                {
                    $branch_record_id = $_POST['delete_branches'];
                    if($branch_record_id > -1)
                        $comBranchModel->delete_record($branch_record_id);
                }

                if(isset($_POST['delete_department']))
                {
                    $department_record_id = $department_records[$_POST['delete_department']-1]->DepID;
                    if($department_record_id > -1)
                        $comDprtmntModel->delete_record($department_record_id);
                }

		if(isset($_POST['delete_page']))
                {
                    $record_id = $records[$_POST['delete_page']-1]->pageId;
                    if($record_id > -1)
                        $comPagesModel->delete_record($record_id);
                }

		if(isset($_POST['delete_ads']))
                {
                    $ad_record_id = $_POST['delete_ads'];
                    if($ad_record_id > -1)
                        $comAdModel->delete_record($ad_record_id);
                }

                
            }
        }

        $existingData = 
        $genInfoModel->where('compUrlShortName', $compId)->first();

        $data = [
            'compPublicName'    => '',
            'compUrlShortName'  => '',
            'compWhoRwe'        => '',
            'compWorkingHrs'    => '',
            'compLocation'      => '',
            'compPhoNumb'       => '',
            'compWtzNumb'       => '',
            'compEmail'         => '',
            'twitter_acc'       => '',
            'instgram_acc'      => '', 
            'snap_acc'          => '',
            'compLogo'          => '',
            'pages'             => [],
            'ads'               => [], 
            'branches'          => [], 
            'departments'       => [],

        ];

        $existingPages          = null;
        $existingAds            = null;
        $existingBranches       = null;
        $existingDepartments    = null;
        //[ 'compKey', 'pageName', 'pagePhoto', 'pageTxt'];

        if($existingData)
        {
            $existingPages          = $comPagesModel->find_whr( $existingData['compId']);
            $existingAds            = $comAdModel->find_whr( $existingData['compId']);
            $existingBranches       = $comBranchModel->find_whr( $existingData['compId']);
            $existingDepartments    = $comDprtmntModel->find_whr( $existingData['compId']);
            $existingColors = $CompColorsModel->find_whr($existingData['compId']);//<<<<<<<<<<<<< fares
            
            $socialMedia            = ($existingData['compSocialAcc']);
            #print($socialMedia);
            $coma_pos = strpos($socialMedia, ',');
            $atwitter = substr($socialMedia, 0, $coma_pos);
            #print("twitter");
            #print($atwitter);
            $socialMedia = substr($socialMedia,$coma_pos+1);

            $coma_pos = strpos($socialMedia, ',');
            $insta = substr($socialMedia, 0, $coma_pos);
            #print("insta");
            #print($insta);
            $snap = substr($socialMedia,$coma_pos+1);
            #print("snap");
            #print($snap);

            $data = [
                'compPublicName'    => $existingData['compPublicName'],
                'compUrlShortName'  => $existingData['compUrlShortName'],
                'compWhoRwe'        => $existingData['compWhoRwe'],
                'compWorkingHrs'    => $existingData['compWorkingHrs'],
                'compLocation'      => $existingData['compLocation'],
                'compPhoNumb'       => $existingData['compPhoNumb'],
                'compWtzNumb'       => $existingData['compWtzNumb'],
                'compEmail'         => $existingData['compEmail'],
                'twitter_acc'       => $atwitter,
                'instgram_acc'      => $insta, 
                'snap_acc'          => $snap,
                'compLogo'          => $existingData['compLogo'],
                'pages'             => $existingPages,
                'ads'               => $existingAds,
                'branches'          => $existingBranches,
                'departments'       => $existingDepartments,
                'colors'            => $existingColors//<<<<<<<<<<<<<<< fares


            ];
           
        }

        $data['validation'] = $this->validator;
        $data['isCollapsed'] = "sidebar js-sidebar";

        echo view ('header', $data);
        echo view ('cp_settings', $data);
        echo view ('footer');


    }

    public function save_org()
    {
        if($this->request->getMethod() == 'post')
        {
            print_r($_POST);
            $genInfoModel = new GenInfoModel();
            #$genInfoModel->save($_POST);
        }
    }

    


    

 
    public function org_public_web($compId='frabi', $page_link='m', $to_page=0)
    {
        
        # session_start();
	$autoload['helper'] = array('url','html','form','file');
	$listErrors = [];
	$data = [];

        $genInfoModel       = new GenInfoModel();

        $existingData       = $genInfoModel->where('compUrlShortName', $compId)->first();

        $db2                = db_connect('frabiedb');
	$compAccModel       = new CompAccModel($db2);
        $comPagesModel      = new ComPagesModel($db2);
        $comAdsModel        = new ComAdsModel($db2);
        $existingPages      = $comPagesModel->find_whr( $existingData['compId']);
        $existingAds        = $comAdsModel->find_whr( $existingData['compId']);

        $comBranchModel     = new ComBranchModel($db2);
        $comDprtmntModel    = new ComDprtmntModel($db2);
        $compSrvModel       = new CompServiceModel($db2);
        $compSrvDtModel     = new CompSrvDdtModel($db2);
        $comRsrvModel       = new ComRsrvModel($db2);
        $a_comp_acc_model   = new CompAccModel($db2);

	$comAttchModel = new ComAttchModel($db2);

	$compServiceModel = new CompServiceModel($db2);
        
        
        $existingServsBrnch = $comBranchModel->find_whr( $existingData['compId']);
        $department_records  = [];
        $existingServs       = $compSrvModel->find_all_servs( $existingData['compId']);

	
        
        $existingServdt     = [];
        $existingRservs     = [];

        $time_list          = [];
        $formated_list      = [];
        $formated_list_dic  = ['' => []];

        $srvs_bio           = "";

        $openDaysList       = [];

        $open_days           = '';

        $open_times         = '';

	$existingRss = [];
        $existingAts = [];
	$exUsrData = []; 


	
	if(isset($_SESSION['logedinid']))
	{
        	$existingRss = $comRsrvModel->find_cust( $_SESSION['logedinid']);
        	$existingAts = $comAttchModel->find_whr( $_SESSION['logedinid']);
		$exUsrData   = $compAccModel->find_by_accId($_SESSION['logedinid']);
		$exUsrData   = $exUsrData[0];
	}

	$th_srv_nm = [];
	foreach( $existingRss as $an_ex_srv )
	{
		
		$ful_srv_rec = $compServiceModel->find_whr($an_ex_srv->compSrvKey);
		if(count($ful_srv_rec)>0)
		{
			$th_srv_nm[$an_ex_srv->compSrvKey] = $ful_srv_rec[0]->srvName;
			#print_r($ful_srv_rec);exit();
		}
		else
		{
			$th_srv_nm[$an_ex_srv->compSrvKey] = "service is deleted!";
		}
	}




        
        

	
        $theError = "";
        if($this->request->getMethod() == 'post')
        {

	    $res_record_id = -1;
	    if(isset($_POST['rate_res']))
            {
                # print_r($_POST);exit();
		$res_record_id = substr($_POST['rate_res'], strpos($_POST['rate_res'],".")+1);
		$the_index     = substr($_POST['rate_res'], 0, strpos($_POST['rate_res'],"."));
		#print($res_record_id);
		#print($the_index);exit();
		$starName = "stars".$the_index ;
		$cmntName = "ratngCmnt".$the_index;
		#print($_POST['rate_res']);
		#print($res_record_id);
		#exit();
		
		$comRsrvModel->update_rating($_POST[$starName], $_POST[$cmntName], $res_record_id);

                $existingRss = $comRsrvModel->find_cust( $_SESSION['logedinid']);

            }

            if(isset($_POST['delete_res']))
            {
                #$res_record_id = $existingRss[$_POST['delete_res']-1]->custResID;
                #if($res_record_id > -1)
                #{
                    $comRsrvModel->delete_record($_POST['delete_res']);
                    $existingRss = $comRsrvModel->find_cust( $_SESSION['logedinid']);
                #}
            }
            if(isset($_POST['delete_ats']))
            {
                $res_record_id = $existingAts[$_POST['delete_ats']-1]->attchId;
                if($res_record_id > -1)
                {
                    $comAttchModel->delete_record($res_record_id);
                    $existingAts = $comAttchModel->find_whr( $_SESSION['logedinid']);
                }
            }

	    $rules = [];
	     
	    if(isset($_POST['add_account']) || isset($_POST['cng_account']))
	    {

		

		$acName= $_POST['acName'];
		$acPhone= $_POST['acPhone'];
		$acEmail= $_POST['acEmail']; 
		
                $acSec= $_POST['acSec'];
  
                
                $rules = [
                    
		    'acName' => [
                        'rules' => 'required|min_length[3]|alpha',
                        'label' => 'name',
                        'errors' => [
                            'required' => 'The {field} is required',
                            'min_length' => 'The {field} has to be at least 3 alphabetical characters',
			    'alpha' => 'The {field} has to be alphabetical',
                        ]
                    ],
		    'acPhone' => [
                        'rules' => 'required|min_length[10]|integer',
                        'label' => 'phone Number',
                        'errors' => [
                            'required' => 'The {field} is required',
                            'min_length' => 'The {field} has to be ten digits',
			    'integer' => 'The {field} has to be ten digits',

                        ]
                    ],
		    'acEmail' => [
                        'rules' => 'required|valid_email',
                        'label' => 'email',
                        'errors' => [
                            'required' => 'The {field} is required',
                            'valid_email' => 'The {field} has to be of a vaild format',
                        ]
                    ],
		    'acSec' => [
                        'rules' => 'required|min_length[8]|regex_match[/^(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.*[A-Za-z]).*$/]',
                        'label' => 'password',
                        'errors' => [
                            'required' => 'The {field} is required',
                            'min_length' => 'The {field} has to be eight digits',
			    'regex_match' => 'The {field} has to be a mix of digits, special characters, and alphabetical characters',
                        ]
                    ],


                ];
	    }
	    
	    if(isset($_POST['add_account']))
            {
                //print_r($_POST);
		//exit();

		

                if($this->validate($rules))
                {
			$reserved_phone = $compAccModel->find_by_phone($_POST['acPhone']);
			if(count($reserved_phone) < 1) 
			{
                		$compAccModel->insert_record($existingData['compId'], '3', $_POST['acName'], $_POST['acPhone'], $_POST['acEmail'], crypt(md5($_POST['acSec']),"st123"), $_POST['Prf_lng']);
				return redirect()->to(base_url('/home/sign_in/pp'));
			}
			else
			{
				$listErrors[] = "The phone number is already registered!";
				
			}
		}
		else
		{
                   $data['validation'] = $this->validator; 
                }
		
            }
		
	    
	    
	    if(isset($_POST['cng_account']))
            {
                #print_r($_POST);
		#print();
		#exit();
		
		#update_record($acompAccTypeKey, $aAccName, $aAccNumb, $aAccEmail, $aAccPassword, $aAccPrefLang, $accId)

                $compAccModel->update_record('3', $_POST['acName'], $_POST['acPhone'], $_POST['acEmail'], crypt(md5($_POST['acSec']),"st123"), $_POST['Prf_lng'], $_SESSION['logedinid']);
		
            }

            
            if(isset($_POST['save_apnt']))
            {
                
                #Array ( [brnch_name] => 4 [serv_name] => 34 
                # [open_days] => 24th, March 2022 [open_times] => 16:00 
                # [PatintName] => Faris [save_apnt] => save_apnt )
                
                #$_SESSION['logedinid']
                #$customer = $a_comp_acc_model->find_by_phone($_POST[$aPhn]);
                #Array ( [brnch_name] => 1 [dep_name] => 1 [serv_name] => 75 [open_days] => [PatintName] => AboFaisal [save_apnt] => save_apnt )
                
                $theError = "Please ensure to provide all input";
                if(isset($_POST['brnch_name']) && isset($_POST['dep_name'])
                    && isset($_POST['serv_name']) && isset($_POST['open_days'])
                    && isset($_POST['open_times']) && isset($_POST['PatintName']))
                {
                

                    if($_POST['brnch_name'] == ''
                    || $_POST['dep_name'] == ''
                    || $_POST['serv_name'] == ''
                    || $_POST['open_days'] == ''
                    || $_POST['open_times'] == ''
                    || $_POST['PatintName'] == '') 
                    {
                        //do something
                        
                    }
                    else 
                    {
                        $theError = "";
                        #print_r($_POST);exit();
                
                        $adatetime = Time::createFromFormat(cCalendar::cmnVrb, $_POST['open_days']);
                        $adatetime->setTime(0, 0, 0);
                        $tim_pck = $_POST['open_times'];
                        $pos1  = strpos($tim_pck,":",0); 
                        $part1 = substr($tim_pck,0, $pos1);
                        $part2 = substr($tim_pck,$pos1+1 );
                        $adatetime->add(new \DateInterval('PT' . $part1 . 'H'));
                        $adatetime->add(new \DateInterval('PT' . $part2 . 'M'));

                        $aCustResDt = $adatetime->format('Y-m-d H:i:s');

                        $comRsrvModel->insert_record($existingData['compId'], $_SESSION['logedinid'], $_POST['PatintName'], $_POST['serv_name'], $aCustResDt, 0);
		                return redirect()->to(base_url('/home/org_public_web/frabi/appointments'));
                    }
                }

            }
            
                       
        }
        

	
    $data ['compPublicName'] = '';
	$data ['compUrlShortName'] = '';
	$data ['compWhoRwe'] = '';

	$data ['compWorkingHrs'] = '';
	$data ['compLocation'] = '';
	$data ['compPhoNumb'] = '';

	$data ['compWtzNumb'] = '';
	$data ['compEmail'] = '';
	$data ['compLogo'] = '';

	$data ['twitter_acc'] = '';
	$data ['instgram_acc'] = '';
	$data ['snap_acc'] = '';

	$data ['pages'] = [];
	$data ['ads'] = [];
	$data ['slctd_brnch'] = '';

	$data ['slctd_dprtz'] = '';
	$data ['slctd_srvz'] = '';

	$data ['page_link'] = $page_link;
	$data ['to_page'] = $to_page;
	$data ['existingServsBrnch'] = $existingServsBrnch;

	$data ['department_records'] = $department_records;
	$data ['existingServs'] = $existingServs;
	$data ['ftime_list'] = $formated_list;

	$data ['ftime_list_dic'] = $formated_list_dic;
	$data ['srvs_bio'] = $srvs_bio;
	$data ['listErrors'] = $listErrors;

	$data ['openDaysList'] = [];
	$data ['open_days'] = '';
	$data ['open_times'] = '';

	


        if($existingData)
        {
		
            $socialMedia = ($existingData['compSocialAcc']);
            #print($socialMedia);
            $coma_pos = strpos($socialMedia, ',');
            $atwitter = substr($socialMedia, 0, $coma_pos);
            #print("twitter");
            #print($atwitter);
            $socialMedia = substr($socialMedia,$coma_pos+1);

            $coma_pos = strpos($socialMedia, ',');
            $insta = substr($socialMedia, 0, $coma_pos);
            #print("insta");
            #print($insta);
            $snap = substr($socialMedia,$coma_pos+1);
            #print("snap");
            #print($snap);

             
            $data ['compPublicName'] = $existingData['compPublicName'];
	    $data ['compUrlShortName'] = $existingData['compUrlShortName'];
	    $data ['compWhoRwe'] = $existingData['compWhoRwe'];

	    $data ['compWorkingHrs'] = $existingData['compWorkingHrs'];
	    $data ['compLocation'] = $existingData['compLocation'];
	    $data ['compPhoNumb'] = $existingData['compPhoNumb'];

	    $data ['compWtzNumb'] = $existingData['compWtzNumb'];
	    $data ['compEmail'] = $existingData['compEmail'];
	    $data ['compLogo'] = $existingData['compLogo'];

	    $data ['twitter_acc'] = $atwitter;
	    $data ['instgram_acc'] = $insta;
	    $data ['snap_acc'] = $snap;

	    $data ['pages'] = $existingPages;
	    $data ['ads'] = $existingAds;
	    $data ['slctd_brnch'] = '';
	    $data ['slctd_dprtz'] = '';
	    $data ['slctd_srvz'] = '';



            
        }

		

	$c_time = date('Y-m-d');
	
	$total_count = 0;
	$total_ahead = 0;
	$start_at    = 0;
	foreach($existingRss as $an_ex_srv){
		$r_time = date('Y-m-d',strtotime($an_ex_srv->custResDt));
		
		if($r_time <= $c_time)
		{
			$total_ahead = $total_ahead + 1;
		}
		else{
			$total_count = $total_count + 1;
		}
		
	}
	
	if($total_ahead > 10)
	{
		$start_at = $total_ahead - 9;
	}
	
	    #print($total_ahead);print($total_count);exit();
	
	    #print_r($existingServs);exit();

        # [brnch_name] => 4 [serv_name] => 34 [open_days] => 16th, March 2022 [list_open_days] => list_open_days
        if(isset($_POST['brnch_name']))
        {
            $data['slctd_brnch']=$_POST['brnch_name'];
        }
        if(isset($_POST['serv_name']))
        {
            $data['slctd_srvz']=$_POST['serv_name'];
        }
        
	    #print_r($listErrors);	

	
	    $data['exUsrData']   = $exUsrData;
        $data['isCollapsed'] = "sidebar js-sidebar";        
        $data['existingRss'] = $existingRss;
        $data['existingAts'] = $existingAts;
	    $data['th_srv_nm']   = $th_srv_nm;
	    $data['start_at']    = $start_at;
        $data['colors']      = (new CompColorsModel($db2))->find_whr($existingData['compId']);        
        
        $data['theError']   = $theError;

        echo view ('public_header', $data);
        echo view ('org_public_view', $data);
        echo view ('public_footer', $data);
    }

    

}
