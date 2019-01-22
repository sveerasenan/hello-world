<?php  
require_once WMP_APP_DIR .DS. 'model'. DS .'employeeModel.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';

require_once WMP_APP_DIR .DS. 'service'. DS .'employeeService.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';


class loginService
{
	
	public function check_login()
	{
	     if (session_id() == "")
			{
				session_start();
			}
			
			
			
			$loggedIn = $_SESSION['LOGGED_IN'];
			
		    
			
			if(empty($loggedIn) || $loggedIn!='Y')
			{
				$_SESSION['from_url'] = $_SERVER['REQUEST_URI'];
			    //header("Location: /page/wmp");
			    if(USE_SSO)	
			    {
			    	//sent to oracle login
			    	header("Location: ".OIM_LOGIN_PAGE);
			    }
			    else {
			    	header("Location: ".APP_PATH);
			    }
			      	
			}
		
	}//public function checkLogin(){
	
	
	public function isAdmin()
	{
	     if (session_id() == "")
			{
				session_start();
			}
			
			$admin = $_SESSION['IS_ADMIN'];
			
			
			
			if($admin)
			{
				
				return true;
			}
			
			return false;
		
	}//public function checkLogin(){
	
	
		
	public function authenticate($user_param, $pass_param){
		
		return true; 
		
	}//public function authenticate(){
	
	public function changeProxyUserSession($ceo_emp_id)
	{
		$empSvc = new employeeService();
	     $ceo_details=$empSvc->getEmployeeById($ceo_emp_id);
	     
	     
		$_SESSION['empID'] = $ceo_details['ORG_EMPL_ID'];
		
		$_SESSION['roleID'] = $ceo_details['ORG_ROLE_ID'];
		$_SESSION['ORG_EMPL_FNAME'] = $ceo_details['ORG_EMPL_FNAME'];
		$_SESSION['ORG_EMPL_LNAME'] = $ceo_details['ORG_EMPL_LNAME'];
		$_SESSION['unit_ID'] = $ceo_details['ORG_UNIT_ID'];
		$_SESSION['ORG_DIV_ID'] = $ceo_details['ORG_DIV_ID'];
		$_SESSION['ORG_LOC_ID'] = $ceo_details['ORG_LOC_ID'];
		$_SESSION['ORG_EMPL_UNIT_NAME'] = $ceo_details['ORG_UNIT_NAME'];
		$this->setSessionEmpRoles($ceo_details['ORG_EMPL_ID'],$ceo_details['ORG_EMPL_ISMGR']);	
		
	}
	
   public function initUserSession($emp_id)
	{
		
	      if (session_id() == "")
			{
				session_start();
			}
		$empSvc = new employeeService();
	     $mgr_details=$empSvc->getEmployeeById($emp_id);
	     
	     
		$_SESSION['empID'] = $mgr_details['ORG_EMPL_ID'];
		$_SESSION['orgempID'] = $mgr_details['ORG_EMPL_ID'];					
		$_SESSION['ORG_EMPL_FNAME'] = $mgr_details['ORG_EMPL_FNAME'];
		$_SESSION['ORG_EMPL_LNAME'] = $mgr_details['ORG_EMPL_LNAME'];
		$_SESSION['unit_ID'] = $mgr_details['ORG_UNIT_ID'];
		$_SESSION['ORG_DIV_ID'] = $mgr_details['ORG_DIV_ID'];
		$_SESSION['ORG_LOC_ID'] = $mgr_details['ORG_LOC_ID'];
		$_SESSION['ORG_EMPL_UNIT_NAME'] = $mgr_details['ORG_UNIT_NAME'];
		$_SESSION['LOGGED_IN'] = 'Y';	
		$this->setSessionEmpRoles($mgr_details['ORG_EMPL_ID'],$mgr_details['ORG_EMPL_ISMGR']);

		
		
		
	}
	
	public function setSessionEmpRoles($empId,$isMgrInd)
	{
		$empSvc = new employeeService();
	     $empRoles=$empSvc->getEmployeeRoles($empId);
		
	     if (in_array(ADMIN_ROLE, $empRoles)){
			$_SESSION['IS_ADMIN'] = TRUE;
		 }
		 
	    if (in_array(EM_USER_ROLE, $empRoles)){
			$_SESSION['IS_EM_USER'] = TRUE;
		 }
		 
		 if($this->isEMTUser($empId) && $isMgrInd!='1')
		 {
		 	$_SESSION['IS_EM_USER_NON_MGR'] = TRUE;
		 }
	  		
	}
	
    public function isEMTUser($empId)
	{
		$empSvc = new employeeService();
	     $empRoles=$empSvc->getEmployeeRoles($empId);
		
	     
		 
	    if (in_array(EM_USER_ROLE, $empRoles) ) {
			return true;
		 }
		 
		 return false;
	  		
	}
	
   public function isCEOViewUser($username)
	{
		$empSvc = new employeeService();
	     $empRoles=$empSvc->getEmployeeRolesByUserName($username);
		
	     
		 
	    if (in_array(CEO_VIEW_USER_ROLE, $empRoles) ) {
			return true;
		 }
		 
		 return false;
	  		
	}
	
	public function registerLogin($username,$userId)
	{
		$empModel = new employeeModel();
		
	    $eventService = new eventsService();
		
		
		
		
		$active_event_id = $eventService->getActiveEvent();
		
		$event_id =0;
		
		if(isset($active_event_id))
		{
		
			$event_id=$active_event_id['EOC_ENT_ID'];
		}
		
		$empModel->registerLogin($username, $userId, $event_id);
	}
	
	public function showExecContacts()
	{
		if (session_id() == "")
		{
			session_start();
		}
		
	    $eventService = new eventsService();
		$employeeService = new employeeService();
		
		
		
		$active_event_id = $eventService->getActiveEvent();
		
		$event_id =0;
		
		if(isset($active_event_id))
		{
		
			$event_id=$active_event_id['EOC_ENT_ID'];
		}
		
		$empId = $_SESSION['empID'];
		
		
		
		$isCEODirectRpt = $employeeService->isCEODirectReport($empId,CEO_EMP_ID,$event_id);
		
		if($empId==CEO_EMP_ID || $isCEODirectRpt || $this->isAdmin() )
		{
			return true;
		}
		
		return false;
		
	}
		 
	
	
	
}//class signUpToSpeakServicer {
?>