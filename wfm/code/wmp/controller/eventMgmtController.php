<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR . DS.'controller'.DS. 'wmpBaseController.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'employeeService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'loginService.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';


class eventMgmtController extends wmpBaseController
{
	public function index(){
		
		
	    if (session_id() == "")
		{
			session_start();
		}
			
	    $this->checkLogin();
	    
	    $eventService = new eventsService();
	    
	    $active_event_id = $eventService->getActiveEvent();
		
		
		
		$event_id =0;
		
		if(isset($active_event_id))
		{
		
			$event_id=$active_event_id['EOC_ENT_ID'];
		}
		$view = new View(); 

		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'manage_event.php';  
		
		
		
		//get current event status
		
		$currentEvntStatus = $eventService->getCurrentEventStatus($event_id);
		
		
		
		//get all statuses
		$currentEvntAllStatus = $eventService->getEventStatuses($event_id);
		
		 
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		
		$view->setParam("currEvnt",$currentEvntStatus);
		$view->setParam("currEvntStatuses",$currentEvntAllStatus);
		
		
		
		
		$view->renderWithoutContainer($viewfile);
	}
	
 
	
	public function addEvent()
	{
		 if (session_id() == "")
		{
			session_start();
		}
			
	    $this->checkLogin();
	    
	    $empID=$_SESSION['empID'];
	    
	    $loginSvc = new loginService();
	    
	    
		//check if admin
		if($loginSvc->isAdmin())
		{
			$eventSvc = new eventsService();
			
			//add event
			$eventSvc->createEvent($empID);
		}
		
		echo json_encode("success");
		
	}
	
	
	
    public function changeEventStatus()
	{
		
	 if (session_id() == "")
		{
			session_start();
		}
		
		
			
	    $this->checkLogin();
	    
	    
	    
	    $params = $this->getSanizitedParams ();
	    
	    $empID=$_SESSION['empID'];
	    
	    $loginSvc = new loginService();
	    
	   
		//check if admin
		
	    
		if($loginSvc->isAdmin())
		{
			
			//var_dump($loginSvc->isAdmin());
			$eventSvc = new eventsService();
			
			$active_event_id = $eventSvc->getActiveEvent();
			
			
			$event_id =0;
			
			if(isset($active_event_id))
			{
			
				$event_id=$active_event_id['EOC_ENT_ID'];
			}
			//$event_id,$status_id,$user_id
			if($event_id>0)
			{
			$changeId= $params['changeId'];
			
			$eventSvc->changeEventStatus($event_id,$changeId,$empID);
			
				if($changeId==CLOSED_STATUS)
				{
					$eventSvc->deactivateEvent($event_id);
				}
			}
		}
		
		echo json_encode("success");
		
		
		
	}

}