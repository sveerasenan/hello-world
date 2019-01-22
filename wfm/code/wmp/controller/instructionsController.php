<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';



class instructionsController extends BaseController
{
	function __construct(){
		
		if (session_id() == "")
		{
			session_start();
		}
		
	}
	
	public function index(){

		$view = new View(); 
		//$eventService = new eventsService();

		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'instructions_frame.php'; 
		//$view->setParam("menuStatusMsg",$eventService->getMenuStatusMsg());
		$view->renderWithoutContainer($viewfile);
		
	}
	
		
}
	