<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';

class signoutController extends BaseController
{
	
	
	public function index(){
		if (session_id() == "")
			{
				session_start();
			}
			unset($_SESSION);
			session_destroy();
			
			$config = include(WMP_CONFIG_DIR .DS."config_" . ENVIRONMENT . ".php");
		
			$WMP_SSO = $config['USE_SSO'];
			
			$signouturl = APP_PATH;
		
			if($WMP_SSO == true)
			{
				$signouturl= OIM_LOGOUT_PAGE;
			}
			$this->redirect($signouturl);
	}
	
		
}
	