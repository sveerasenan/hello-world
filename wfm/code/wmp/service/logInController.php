<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'loginService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'employeeService.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';


class logInController extends BaseController
{
	
	public function showloginError($message)
	{
		
		$view = new View(); 
        $view->setParam("errorMsg",$message);
        $view->setParam("csrftoken", $this->generateCSRFToken());
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'logIn.php';
		$view->renderWithoutContainer($viewfile);
		
	}
	
	
	public function index(){
	
		

		if (session_id() == "")
		{
			session_start();
		}

	
		
		//New View 
		$view = new View(); 
		
		$view->setParam('metadata', $this->getBaseModel()->getPageMetaData());
	    $view->setParam("csrftoken", $this->generateCSRFToken());

		//Set View File, change STARTING_TEMPLATE_APP_DIR to proper global variable
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'logIn.php';
		$view->renderWithoutContainer($viewfile);
			
		
		
	}
	
	public function process()
	{
	   $params = $this->getSanizitedParams ();
		$this->CheckCSRF();

		if (session_id() == "")
		{
			session_start();
		}

		$loginSvc = new loginService();
	    
				
		if(  $loginSvc->authenticate($params['username'], $_POST['pwd']) == 1){
		
			
			
			  $empSvc = new employeeService();
				$mgr_details=$empSvc->getEmployeeByNetworkId($params['username']);
				
			
				if(empty($mgr_details) || $mgr_details['ORG_EMPL_ISMGR']!='1')
				{
					$this->showloginError(UNAUTH_USR_ERR_MSG);
					return;
				}
				
				
				
		      
				
				if($mgr_details)
				{
					
					if (session_id() == "")
					{
						session_start();
					}
					$_SESSION['empID'] = $mgr_details['ORG_EMPL_ID'];
					$_SESSION['orgempID'] = $mgr_details['ORG_EMPL_ID'];
					$_SESSION['roleID'] = $mgr_details['ORG_ROLE_ID'];
					$_SESSION['ORG_EMPL_FNAME'] = $mgr_details['ORG_EMPL_FNAME'];
					$_SESSION['ORG_EMPL_LNAME'] = $mgr_details['ORG_EMPL_LNAME'];
					$_SESSION['unit_ID'] = $mgr_details['ORG_UNIT_ID'];
					$_SESSION['ORG_DIV_ID'] = $mgr_details['ORG_DIV_ID'];
					$_SESSION['ORG_LOC_ID'] = $mgr_details['ORG_LOC_ID'];
					$_SESSION['ORG_EMPL_UNIT_NAME'] = $mgr_details['ORG_UNIT_NAME'];
					$_SESSION['LOGGED_IN'] = 'Y';						
					$url="/page/wmp/home";
					
					//echo 'redirecting url';
					
					//exit;
					$this->redirect($url);
					
				}
		}
		else{
			
				$this->showloginError(INVALID_USR_ERR_MSG);
			
		}
		
	}

	
		
}
		 
		