<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'emergencyService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'loginService.php';


class emergencyContactsController extends BaseController
{
	function __construct(){
		
		if (session_id() == "")
		{
			session_start();
		}
		
	}
	
	public function index(){

		$view = new View(); 
         
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'emergency_categories.php'; 
		$eventService = new eventsService(); 
		$loginSvc = new loginService();
		
		$showExecs = $loginSvc->showExecContacts();
		$view->setParam("showExecs",$showExecs);
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		$view->renderWithoutContainer($viewfile);
		
	}
	public function getStaffByCat(){ 
		$params = $this->getSanizitedParams();
		$catId =$params['catId'];
		
		$emergencyService = new emergencyService();
		$teamDetails=$emergencyService->getEmergencyContactsByCatId($catId);
		//var_dump($teamDetails);
		//exit;
		
		$team=$emergencyService->getEmergencyCategoryById($catId);
		$teamName=$team['CAT_NAME'];
		$view = new View(); 
		
		$eventService = new eventsService(); 
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		
		$view->setParam("teamName",$teamName);
		$view->setParam("teamDetails",$teamDetails);
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'emergency_team.php';  
		$view->renderWithoutContainer($viewfile);
	}
	
    public function getEmergencyEmpDetails(){
		$params = $this->getSanizitedParams();
		$emergencyService = new emergencyService();
		$emp_details=$emergencyService->getEmergencyContactById($params['id']);
		echo json_encode($emp_details);
	}
	
		
}
	