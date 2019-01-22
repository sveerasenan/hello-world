<?php

require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR . DS.'controller'.DS. 'wmpBaseController.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'employeeService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'loginService.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';


class dashBoardController extends wmpBaseController
{
function __construct(){
		
		if (session_id() == "")
		{
			session_start();
		}
		$this->statusLabels = array("0"=>"Pending","1"=>"In","2"=>"Out","3"=>"Missing");
	}
	
	
	public function index(){
		
		
		
	     if (session_id() == "")
			{
				session_start();
			}
			
	    
			
	    $this->checkLogin();
	    
		$params = $this->getSanizitedParams ();
		
		$eventService = new eventsService();
		$employeeService = new employeeService();
		$loginSvc = new loginService();
		
		
		$active_event_id = $eventService->getActiveEvent();
		
		$event_id =0;
		
		if(isset($active_event_id))
		{
		
			$event_id=$active_event_id['EOC_ENT_ID'];
		}
		
		//CEO directs reports need to be presented with naviagtion bar with ability to get to CEO view
		//If CEO direct reports, Please redirect to CEO View.
		
		$checkEmpId = $_SESSION['empID'];
		
		
		//switch the user to original logged in user, when home button clicked.
		if(array_key_exists('switch', $params))
		{
			$checkEmpId = $_SESSION['orgempID'];
			
			$loginSvc->changeProxyUserSession($checkEmpId);
		
		}
		
		 $isCEODirectRpt = $employeeService->isCEODirectReport($checkEmpId,CEO_EMP_ID,$event_id);
			
		
		if(!$params['id'])
		{
		     $isCEODirectRpt = $employeeService->isCEODirectReport($_SESSION['empID'],CEO_EMP_ID,$event_id);
			
			 $url=APP_PATH."/home&id=".$_SESSION['empID'];
			
			if($isCEODirectRpt)
			{
				$this->redirect($url);
				exit;
			}
		}
		$empID=$_SESSION['empID'];
		
		//if subunit view
		if($params['id'] )
		{
			$empID=$params['id'];
			
			//if subunit is CEO Id session information.
			
			if($empID==CEO_EMP_ID)
			{
				$loginSvc->changeProxyUserSession(CEO_EMP_ID);
			}
			//if subunit user is same as orignal logged in user, change session back.
			$loggedUserEmplId = $_SESSION['orgempID'];
			
			if($empID==$loggedUserEmplId)
			{
				$loginSvc->changeProxyUserSession($loggedUserEmplId);
			}
			
		}
		
		$name = $_SESSION['ORG_EMPL_FNAME']." ".$_SESSION['ORG_EMPL_LNAME'];
		
		
		
		
		
		
			if($params['id'])
			{
				$parents=$employeeService->getParentsOfEmpId($params['id'],$event_id);
				$manager_parents=$parents['ORG_MGR_ID_TREE'];
				$unitparents=explode(",",$manager_parents);
				
				foreach($unitparents as $key=>$parent){
					if(!empty($parent))
					{
						$parentarray[]=trim($parent,"M");
						$parentstring.=trim($parent,"M").",";
						if($parent=='M'.$_SESSION['empID'].'M')
							break;
					}
					
				}
				//$first_parentarray=array_slice($parentarray,0,4,true);
				//$second_parentarray=array_slice($parentarray,5,5,true);
				
				$first_parentarray=$parentarray;
				
				//var_dump($parentarray);
				//echo '<br/>';
				//var_dump($parentstring);
				//var_dump($second_parentarray);
				
				//exit;
				if(!empty($parentstring))
				{
					$parentstring=rtrim($parentstring,",");
					$parentstring=$params['id'].",".$parentstring;
				}
				else 
				{
					$parentstring=$params['id'];
				}
				// to get parent firstname, lastname and other details
				$parent_details=$employeeService->getParentsDetails($parentstring,$event_id);
				//var_dump($parent_details);
				//exit;
				//echo '<br/>';
				foreach ($parent_details as $pdatils){
					
					$unit_parents[$pdatils['ORG_EMPL_ID']]=array('name'=>substr($pdatils['ORG_EMPL_FNAME'],0,1).substr($pdatils['ORG_EMPL_LNAME'],0,1),'image'=>$pdatils['ORG_EMPL_HR_ID']);
				}
				
			}
			
			
			// Get total employees direct and indirect reports to manager;
			$event_users_count = $employeeService->getTotalUsersCountByManager($event_id,$_SESSION['empID'] );
			
			
		
			$status_count = $event_users_count['INCNT'] + $event_users_count['OUTCNT'] + $event_users_count['MISS'];
			
			
			if(!isset($status_count))
			{
				$status_count=0;
			}
			
			if($params['id'])
			{
				$report_mgr=$employeeService->getReportManager($params['id'],$event_id);
				$mgr_unit_count = $employeeService->getTotalUsersCountByManager($event_id,$params['id']);
				$total_mgr_unit_count=$mgr_unit_count['ALLCNT'];
				$mgr_Unit_status_count = $mgr_unit_count['INCNT'] + $mgr_unit_count['OUTCNT'] + $mgr_unit_count['MISS'];
			}

			//Get direct reports to manager 
			$event_users = $employeeService->getDirectReportingManagers($event_id,$empID);
			
			//var_dump($event_users);
			//exit;

			// Total users count
			$total_users = $event_users_count['ALLCNT']; 
			$status_percent=($status_count / $total_users)*100;
			
			//check if mgar has multipe divs
			
			$mgrdivisions=$employeeService->getDivisionsByManagers($empID,$event_id);
			
			$division_count=count($mgrdivisions);
			
			
		   foreach($event_users as $key=>$val)
			{
				// Getting units where empl is manager
				
				if($val['ORG_EMPL_ISMGR']==1){
					
					$event_unit_count = $employeeService->getTotalUsersCountByManager($event_id,$val['ORG_EMPL_ID']);
					$total_unit_count=$event_unit_count['ALLCNT'];
					$in_unit_count=$event_unit_count['INCNT'];
					$out_unit_count=$event_unit_count['OUTCNT'];
					$miss_unit_count=$event_unit_count['MISS'];
				    $status_unit_count = $event_unit_count['INCNT'] + $event_unit_count['OUTCNT'] + $event_unit_count['MISS'];

					if($total_unit_count==$in_unit_count)
						$ustatus='I';
					else if($total_unit_count==$out_unit_count)
						$ustatus='O';
					else if($total_unit_count==$miss_unit_count)
						$ustatus='M';
					else $ustatus='';
					
					
				    
					$event_users[$key]['unit_total']=$total_unit_count;
					$event_users[$key]['unit_in']=$in_unit_count;
					$event_users[$key]['unit_out']=$out_unit_count;
					$event_users[$key]['unit_miss']=$miss_unit_count;
					$event_users[$key]['unit_status']=$status_unit_count;
					$event_users[$key]['unit_current_status']=$ustatus;
					
					//var_dump($val);
					//echo '<br/>';
					
				    //$manager_units[$key]=array('ORG_EMPL_ID' => $val['ORG_EMPL_ID'], 'ORG_UNIT_NAME' => $val['ORG_UNIT_NAME'], 'unit_total' =>$total_unit_count,'unit_in' =>$in_unit_count,'unit_out' =>$out_unit_count,'unit_miss' =>$miss_unit_count, 'unit_status'=>$status_Unit_count, 'unit_current_status'=>$ustatus);
				}
			}
			
			
		
			
		// Get consultants
		$consultants = $employeeService->getConsultants($event_id,$empID);
	
		
		

		
		$placeholder = "/apps/wmp/resources/images/demo.jpg";
		//New View 
		$view = new View(); 
		
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		$view->setParam("placeholder",$placeholder);
		$view->setParam("unit_parents",$unit_parents);
		$view->setParam("subunitmgrid",$params['id']);
		
		$view->setParam("first_parentarray",$first_parentarray);
		$view->setParam("second_parentarray",$second_parentarray);
		
		
		
		$view->setParam("groupStatus",$event_users_count);
		$view->setParam("status_count",$status_count);
		$view->setParam("manager_name",$name);
		$view->setParam("managerId",$_SESSION['empID']);
		$view->setParam("empId",$empID);
		$view->setParam("loggedinmgrId",$_SESSION['orgempID']);
		$view->setParam("roleId",$_SESSION['roleID']);
		$view->setParam("divisionId",$_SESSION ['ORG_LOC_ID']);
		$view->setParam("user_unit_name",$_SESSION ['ORG_EMPL_UNIT_NAME']);
		$view->setParam("my_unit",$event_users);
		
		//var_dump($event_users);
		//exit;
		$view->setParam("indirect_managers",$indirect_managers);
		$view->setParam("other_units",$manager_units);
		$view->setParam("indirect_manager_units",$indirect_manager_units);
		$view->setParam("consultants",$consultants);
		$view->setParam("status_percent",$status_percent);
		$view->setParam("unit_count",$total_users);
		$view->setParam("event_id",$event_id);
		if($division_count>1)
		{
			$view->setParam("division_count",1);
		}
		if($params['id'])
		{
			$view->setParam("subunit",$report_mgr);
			$view->setParam("total_mgr_unit_count",$total_mgr_unit_count);
			$view->setParam("mgr_Unit_status_count",$mgr_Unit_status_count);
		}
		$view->setParam("cea_direct_report",$isCEODirectRpt);
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'dashBoard.php'; 
		$view->renderWithoutContainer($viewfile);
		
	
}

// Function to Create Event page. 
	public function addEvent(){
		// Temporaarily Defined Type of events list. We need to discuss to move to another collection
		$eventTypes  = array(1=>"Fire",2=>"Floods",3=>"Earthquake",4=>"Drill");
		$locations  = array(1=>"LPW 400 Q Street",2=>"LPE 400 Q street",3=>"LPN 400 Q STREET",4=>"10 River Park Place East,fresno");
		// Get All unique Divisions from Employees collection
		//$employeeService = new employeeService();
		//$divisions = $employeeService->getUniqueDivisions(); 
		$eventService = new eventsService();
		$event_id = $eventService->getActiveEvent();
		
		// View variables & render part starts
		$view = new View(); 
		$view->setParam("eventTypes",$eventTypes);
		$view->setParam("locations",$locations);
		$view->setParam("activeevent",$event_id);
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'addEvent.php'; 
		$view->renderWithoutContainer($viewfile);
	}
	
	public function updateEmpStatus(){
		
	   if (session_id() == "")
			{
				session_start();
			}
		$params = $this->getSanizitedParams();
		
		$empID=$_SESSION['orgempID'];
		
		// updating status in Ajax request
		$eventService = new eventsService();
		$eventService->updateStatus($params,$empID);
		
		// Get total count to update on screen
		$employeeService = new employeeService();
		
		$event_users = $employeeService->getTotalUsersCountByEvent($params['eventid'],$_SESSION['empID']);
		$groupStatus['total'] = $event_users['ALLCNT']; 
		$groupStatus['status_count'] = $event_users['INCNT'] + $event_users['OUTCNT'] + $event_users['MISS'];
		$groupStatus['INCNT'] = $event_users['INCNT'];
		$groupStatus['OUTCNT'] = $event_users['OUTCNT'];
		$groupStatus['MISS'] = $event_users['MISS'];
		echo json_encode($groupStatus);
	}
	// Get employees list based on unit 
	public function showEmps(){
		
	   if (session_id() == "")
			{
				session_start();
			}
			
		$this->checkLogin();
			
		$params = $this->getSanizitedParams();
		$type="Unaccounted For";
		
		if($params['status']=='I')
		{
			$type=" Checked In ";
		}
		else if($params['status']=='O')
		{
			$type=" Checked Out ";
		}     
		else if($params['status']=='M')
		{
			$type="Missing ";
	     }
	    
			
			
		$status = $params['status'];
		
		
		
		$name = $_SESSION['ORG_EMPL_FNAME']." ".$_SESSION['ORG_EMPL_LNAME'];
		
		$mgrID=$_SESSION['empID'];
		
		$eventService = new eventsService();
		
		$employeeService = new employeeService();
		
		$active_event_id = $eventService->getActiveEvent();
		
		$event_id=$active_event_id['EOC_ENT_ID'];
		
		$employeeService = new employeeService();
		
		$currentPg =1;
		//get current page
	   if(isset($params['pageno']))
		{
			$currentPg=$params['pageno'];
		}
		
		//get users per page
		$event_status_users = $eventService->getEmployeesByStatus($event_id,$mgrID,$status,$currentPg);
		
		//get all users
		$event_status_all_users = $eventService->getEmployeesCountByStatus($event_id,$mgrID,$status);
		
		$event_status_users_cnt =0;
		
		if(!empty($event_status_all_users))
		{
			$event_status_users_cnt = count($event_status_all_users);
		}
		
		//next page calc
		
		$nextPage = $eventService->getEmployeesStatusNextPage($currentPg,$event_status_users_cnt);
		
		//var_dump($event_status_users);
		//exit;
		/*
		$event_users_count = $employeeService->getTotalUsersCountByEvent($event_id);
			foreach($event_users_count as $key=>$val)
			{
				$groupStatus[$this->statusLabels[$val->EOC_DIV_EMP_STATUS]]++;	
			}
			$status_count = $groupStatus['In'] + $groupStatus['Out'] + $groupStatus['Missing'];
			
			if($params['id'])
			{
				$report_mgr=$employeeService->getReprotManager($empID,$event_id);
			}

			// Total users count
			$total_users = count($event_users_count); 
			$status_percent=($status_count / $total_users)*100;
			*/
			
		$placeholder = "/apps/wmp/resources/images/demo.jpg";	
		$view = new View(); 
		
		
		$view->setParam("placeholder",$placeholder);
		//$view->setParam("manager_name",$name);		
		$view->setParam("empId",$params['id']);
		//$view->setParam("divisionId",$params['divisionid']);
		//$view->setParam("event_id",$params['eventid']);
		
		//$view->setParam("groupStatus",$groupStatus);
		//$view->setParam("status_count",$status_count);
		
		//$view->setParam("unit_count",$total_users);
		//$view->setParam("status_percent",$status_percent);
		//$view->setParam("designation",$_SESSION ['ORG_EMPL_DESIGNATION']);
		
		
		$view->setParam("event_id",$event_id);
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		$view->setParam("type",$type);
		$view->setParam("empStatus",$params['status']);
		$view->setParam("employees",$event_status_users);
		$view->setParam("employees_count",$event_status_users_cnt);
		$view->setParam("next_page",$nextPage);
		if($currentPg==1)
		{
		  $viewfile = WMP_APP_DIR .DS.'view'.DS. 'statusEmp.php';  
		}
		else
		{
			$viewfile = WMP_APP_DIR .DS.'view'.DS. 'empsbystatusPage.php';  
		}
		$view->renderWithoutContainer($viewfile);
	}
	
	
// Get employees list based on unit 
	public function showEmtUserHome(){
		
	   if (session_id() == "")
			{
				session_start();
			}
			
		$this->checkLogin();
			
		$params = $this->getSanizitedParams();
		
	    
			
			
		$status = "M";
		
		
		
		$name = $_SESSION['ORG_EMPL_FNAME']." ".$_SESSION['ORG_EMPL_LNAME'];
		
		$mgrID=CEO_EMP_ID;
		
		$eventService = new eventsService();
		
		$employeeService = new employeeService();
		
		$active_event_id = $eventService->getActiveEvent();
		
		$event_id=$active_event_id['EOC_ENT_ID'];
		
		$employeeService = new employeeService();
		
		$currentPg =1;
		//get current page
	   if(isset($params['pageno']))
		{
			$currentPg=$params['pageno'];
		}
		
		//get users per page
		$event_status_users = $eventService->getEmployeesByStatus($event_id,$mgrID,$status,$currentPg);
		
		//get all users
		$event_status_all_users = $eventService->getEmployeesCountByStatus($event_id,$mgrID,$status);
		
		$event_status_users_cnt =0;
		
		if(!empty($event_status_all_users))
		{
			$event_status_users_cnt = count($event_status_all_users);
		}
		
		//next page calc
		
		$nextPage = $eventService->getEmployeesStatusNextPage($currentPg,$event_status_users_cnt);
		
	    $event_users_count = $employeeService->getTotalUsersCountByManager($event_id,$mgrID);
			
			
		
		$status_count = $event_users_count['INCNT'] + $event_users_count['OUTCNT'] + $event_users_count['MISS'];
		
		
		if(!isset($status_count))
		{
			$status_count=0;
		}
		
		// Total users count
		$total_users = $event_users_count['ALLCNT']; 
		$status_percent=($status_count / $total_users)*100;
			
		$placeholder = "/apps/wmp/resources/images/demo.jpg";	
		$view = new View(); 
		
		
		$view->setParam("placeholder",$placeholder);
		//$view->setParam("manager_name",$name);		
		$view->setParam("empId",$params['id']);
		
		
		$view->setParam("groupStatus",$event_users_count);
		$view->setParam("status_count",$status_count);
		$view->setParam("status_percent",$status_percent);
		$view->setParam("unit_count",$total_users);
		
		$view->setParam("event_id",$event_id);
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		$view->setParam("type",$type);
		$view->setParam("empStatus",$params['status']);
		$view->setParam("employees",$event_status_users);
		$view->setParam("employees_count",$event_status_users_cnt);
		$view->setParam("next_page",$nextPage);
		if($currentPg==1)
		{
		  $viewfile = WMP_APP_DIR .DS.'view'.DS. 'emtuserstatus.php';  
		}
		else
		{
			$viewfile = WMP_APP_DIR .DS.'view'.DS. 'empsbystatusPage.php';  
		}
		$view->renderWithoutContainer($viewfile);
	}
	
	
	public function closeEvent(){ 
		$params = $this->getSanizitedParams();
		$eventService = new eventsService();
		$event_id = $eventService->getActiveEvent();
		$view = new View(); 
		$view->setParam("active_events",$event_id);
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'activeEvents.php';  
		$view->renderWithoutContainer($viewfile);
	}
	public function removeEvent(){
		$params = $this->getSanizitedParams();
		$event_id=$params['eventid'];
		$eventService = new eventsService();
		$eventService->deactivateEvent((int)$event_id);
		return "yes";
	}
	public function updateUnitStatus(){
		
	    if (session_id() == "")
			{
				session_start();
			}
			
		$params = $this->getSanizitedParams();
		
		$empID=$_SESSION['orgempID'];
		
		// updating status in Ajax request
		$eventService = new eventsService();
		$eventService->updateUnitStatus($params,$empID);
		
		$employeeService = new employeeService();
		
		$event_users = $employeeService->getTotalUsersCountByEvent($params['eventid'],$_SESSION['empID']);
		$groupStatus['total'] = $event_users['ALLCNT']; 
		$groupStatus['status_count'] = $event_users['INCNT'] + $event_users['OUTCNT'] + $event_users['MISS'];
		$groupStatus['INCNT'] = $event_users['INCNT'];
		$groupStatus['OUTCNT'] = $event_users['OUTCNT'];
		$groupStatus['MISS'] = $event_users['MISS'];
		echo json_encode($groupStatus);
	}
	public function getEmpDetails(){
		
		 if (session_id() == "")
			{
				session_start();
			}
			
		$params = $this->getSanizitedParams();
		
		$eventService = new eventsService();
		$active_event_id = $eventService->getActiveEvent();
		$eventId=$active_event_id['EOC_ENT_ID'];
		
		
		$employeeService = new employeeService();
		$emp_details=$employeeService->getEmpDetail($params['id'],$eventId);
		echo json_encode($emp_details);
	}
	
    public function getMenuStatusMsg(){
		
		 if (session_id() == "")
			{
				session_start();
			}
			
		$eventService = new eventsService();
		
		$msg['menuMsg']=$eventService->getMenuStatusMsg() ;
		echo json_encode($msg);
	}
	
	public function updateGroupStatus(){
		
	   if (session_id() == "")
			{
				session_start();
			}
			
		$params = $this->getSanizitedParams();
		
		$empID=$_SESSION['orgempID'];
		$eventService = new eventsService();
		$eventService->updateGroupStatus($params,$empID);
		return "yes";
	}
	
		
}
	