<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';
require_once WMP_APP_DIR . DS.'controller'.DS. 'wmpBaseController.php';

class reportController extends wmpBaseController
{
	
	
	public function index(){
		
		if (session_id() == "")
		{
			session_start();
		}
			
	    $this->checkLogin();
		
		$view = new View(); 
		
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'report_home.php';  
		$eventService = new eventsService(); 
		$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		$view->renderWithoutContainer($viewfile);
	}
	
		
}
	