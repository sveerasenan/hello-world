<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'employeeService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService1.php';


class TestController extends BaseController
{
	
	public function index(){
		
		$view = new View(); 
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'dashBoard.php'; 
		$view->renderWithoutContainer($viewfile);
	
	}
}