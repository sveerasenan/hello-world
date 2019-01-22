<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'loginService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'employeeService.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';


class logInController extends BaseController
{
	
	public function showloginError($errcode)
	{
		
		$config = include(WMP_CONFIG_DIR .DS."config_" . ENVIRONMENT . ".php");
		
		$WMP_SSO = $config['USE_SSO'];
	
		if($WMP_SSO == true)
		{
		  //send to calPERS OIM login page
		  $ssologinpg = $config['OIM_LOGOUT_PAGE'];
		  
		  $errUrl = $ssologinpg.'?error='.$errcode;
					
					
		  
		}
		else {
		    $errUrl = APP_PATH."/loginerror&error=".$errcode;
					
					
		}
		
		$this->redirect($errUrl);
		
	}
	
	public function error()
	{
		    $view = new View(); 
	        
	        $view->setParam("csrftoken", $this->generateCSRFToken());
			$viewfile = WMP_APP_DIR .DS.'view'.DS. 'logIn.php';
			$view->renderWithoutContainer($viewfile);
	}
	
	
	
	
	
	
	public function index(){
	
		

		if (session_id() == "")
		{
			session_start();
		}
       
	    $loginSvc = new loginService(); 
		
		$config = include(WMP_CONFIG_DIR .DS."config_" . ENVIRONMENT . ".php");
		
		$WMP_SSO = $config['USE_SSO'];
		
		
	  
		//Trigger to allow SSO for this app or not
		if($WMP_SSO == true)
		{
			 
			
			//if coming back go to dashboard
			$loggedIn = $_SESSION ['LOGGED_IN'];
				
			if(!empty($loggedIn) && $loggedIn=='Y')
			{
				
			    header("Location: ".APP_PATH."/home");	
			}

			//Unserialize and put as an array
			$unserializedSSO = unserialize (SSO_HEADER_MAP_WMP) ;
			//Loads ILLUMINET_SSO_HEADER_MAP variables into the session to use within the app
			$this->loadOpenSSOHeaders($unserializedSSO);

			$networkId = $_SESSION['networkID'];
			
			$networkId = "mfrost2";
			
			if($loginSvc->isCEOViewUser($networkId))
			{
				$networkId = CEO_USER_NAME;
			}
			/*
		   if(strcasecmp($_SESSION['networkID'], 'mclark')==0)
			{
				$networkId= 'mfrost2';
			}
			*/

			$empSvc = new employeeService();
				$mgr_details=$empSvc->getEmployeeByNetworkId($networkId);
				
			
		        if(empty($mgr_details) || ($mgr_details['ORG_EMPL_ISMGR']!='1' && !$loginSvc->isEMTUser($mgr_details['ORG_EMPL_ID'])))
				{
					//$this->showloginError(UNAUTH_USR_ERR_MSG);
					//return;
					//$errUrl = APP_PATH."/loginerror&peeps102";
					
					//$this->redirect($errUrl);
					
					$this->showloginError("peeps102");
					return;
				}
				
				
				
		      
				
				if($mgr_details)
				{
					
					if (session_id() == "")
					{
						session_start();
					}
					
					//register login
					
					$loginSvc->registerLogin($_SESSION['networkID'], $mgr_details['ORG_EMPL_ID']);
					
					$loginSvc->initUserSession($mgr_details['ORG_EMPL_ID']);
					$url=APP_PATH."/home";
					
					if($loginSvc->isEMTUser($mgr_details['ORG_EMPL_ID']) && $mgr_details['ORG_EMPL_ISMGR']!='1')
					{
						$url=APP_PATH."/emuserhome";
					}
					
											
					
					
					

					// Extend cookie life time by an amount of your liking
					$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
					setcookie(session_name(),session_id(),time()+$cookieLifetime);
					
					
					//exit;
					$this->redirect($url);
				}

		}else{
			
			
          //New View 
		$view = new View(); 
		
		$view->setParam('metadata', $this->getBaseModel()->getPageMetaData());
	    $view->setParam("csrftoken", $this->generateCSRFToken());

		//Set View File, change STARTING_TEMPLATE_APP_DIR to proper global variable
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'logIn.php';
		$view->renderWithoutContainer($viewfile);
		}
		
		
			
		
		
	}
	
	public function process()
	{
	   $params = $this->getSanizitedParams ();
		//$this->CheckCSRF();

		if (session_id() == "")
		{
			session_start();
		}

		$loginSvc = new loginService();
		
		
	   
				
		if(  $loginSvc->authenticate($params['username'], $_POST['pwd']) == 1){
		
			
			
			  $empSvc = new employeeService();
				$mgr_details=$empSvc->getEmployeeByNetworkId($params['username']);
				
			
				if(empty($mgr_details) || ($mgr_details['ORG_EMPL_ISMGR']!='1' && !$loginSvc->isEMTUser($mgr_details['ORG_EMPL_ID'])))
				{
					//$this->showloginError(UNAUTH_USR_ERR_MSG);
					//return;
					//$errUrl = APP_PATH."/loginerror&peeps102";
					
					//$this->redirect($errUrl);
					
					$this->showloginError("peeps102");
					return;
				}
				
				
				
		      
				
				if($mgr_details)
				{
					
					if (session_id() == "")
					{
						session_start();
					}

					$loginSvc->initUserSession($mgr_details['ORG_EMPL_ID']);
					$url=APP_PATH."/home";
					
					if($loginSvc->isEMTUser($mgr_details['ORG_EMPL_ID']) && $mgr_details['ORG_EMPL_ISMGR']!='1')
					{
						$url=APP_PATH."/emuserhome";
					}
					
					//echo 'redirecting url';
					
					

					// Extend cookie life time by an amount of your liking
					$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
					setcookie(session_name(),session_id(),time()+$cookieLifetime);
					
                 
					
					
					$this->redirect($url);
					
				}
		}
		else{
			
				//$this->showloginError(INVALID_USR_ERR_MSG);
				
				//$errUrl = APP_PATH."/loginerror&peeps101";
					
					//$this->redirect($errUrl);
					
					$this->showloginError("peeps101");
					return;
			
		}
		
	}
	
	public function getSSOPage()
	{
		
		$view = new View(); 
		
		$view->setParam('metadata', $this->getBaseModel()->getPageMetaData());
	    

		//Set View File, change STARTING_TEMPLATE_APP_DIR to proper global variable
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'ssologin.php';
		$view->renderWithoutContainer($viewfile);
		
	}
	
	public function getSSOTestPage()
	{
		
		$view = new View(); 
		
		$view->setParam('metadata', $this->getBaseModel()->getPageMetaData());
	    

		//Set View File, change STARTING_TEMPLATE_APP_DIR to proper global variable
		$viewfile = WMP_APP_DIR .DS.'view'.DS. 'ssologinhome.php';
		$view->renderWithoutContainer($viewfile);
		
	}

	
		
}
		 
		