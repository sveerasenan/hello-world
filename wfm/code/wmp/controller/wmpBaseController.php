
<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';

require_once WMP_APP_DIR .DS. 'service'. DS .'loginService.php';


abstract class wmpBaseController extends BaseController
{
	
 
   public function checkLogin()
   {
   	  $loginSvc = new loginService();
   	  
   	  $loginSvc->check_login();
   }
}