<?php

require_once WMP_APP_DIR .DS. 'model'. DS .'employeeModel.php';

class employeeService{
	
	public function isCEODirectReport($emp_id,$ceo_emp_id,$eventId)
	{
		$empModel = new employeeModel();
		
		$readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		
		return $empModel->isCEODirectReport($emp_id, $ceo_emp_id,$readonly);
		
		
	}
	
	public function getEmployeeByNetworkId($networkId)
	{
		$empModel = new employeeModel();
		
		$empInfo = $empModel->getEmployeeByNetworkId($networkId);
		return $empInfo;
	}
	
	public function getEmployeeRoles($empId)
	{
		$empModel = new employeeModel();
		
		$empRoles = $empModel->getEmployeeRolesId($empId);
		
		return $empRoles;
	}
	
    public function getEmployeeRolesByUserName($username)
	{
		$empModel = new employeeModel();
		
		$empRoles = $empModel->getEmployeeRolesByUserName($username);
		
		return $empRoles;
	}
	
   public function getEmployeeById($empId)
	{
		$empModel = new employeeModel();
		
		$empInfo = $empModel->getEmployeeById($empId);
		return $empInfo;
	}
	
	public function getDirectReportingManagers($event_id,$emp_id){
		
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$event_users=  $employeeObj->getDirectReportingManagers($emp_id,$event_id,$readonly);
		return $event_users;
	
	}
	
	public function getConsultants($event_id,$emp_id){
		
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$mgrpram='M'.$emp_id.'M';
		$employeeObj = new employeeModel();;
		$event_users=  $employeeObj->getConsultants($emp_id,$event_id,$readonly);
		return $event_users;
	
	}
	public function getTotalUsersCountByManager($event_id,$managerid){
		
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$active_event_unit_employess = $employeeObj->getTotalUsersCountByManager($managerid,$event_id,$readonly);
		return $active_event_unit_employess[0];

	}
	public function getTotalUsersCountByEvent($event_id,$empID){
		
	     $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$active_event_employess_count = $employeeObj->getTotalUsersCountByEvent($empID,$event_id,$readonly);
		return $active_event_employess_count[0];

	}
	public function getParentsOfEmpId($id,$event_id){
		
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$Parents=  $employeeObj->getParentsOfEmpId($id,$event_id,$readonly);
		return $Parents[0];
	}
	public function getParentsDetails($parentstring,$event_id){
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$Parents=  $employeeObj->getParentsDetails($parentstring,$event_id,$readonly);
		return $Parents;
	}
	public function getEmpDetail($empid,$eventId){
		
	    $readonly = FALSE;
		
		if($eventId==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$emp_details=  $employeeObj->getEmpDetail($empid,$eventId,$readonly);
		$change_user_id = $emp_details[0]['CHANGE_USER'];
		
		
	
		if(!empty($change_user_id))
		{
			$change_user = $employeeObj->getChangeUser($change_user_id,$eventId,$readonly);
			
			
			
			$checked_user_name = $change_user[0]['ORG_EMPL_FNAME'].' '.$change_user[0]['ORG_EMPL_LNAME'];
			
			
			$emp_details[0]['CHANGE_USER']=$checked_user_name;
			//format date to include only time
			if(!empty($emp_details[0]['CHANGE_DATE']))
			{
				
				$change_time = str_replace(array('am','pm'),array('a.m.','p.m.'),date("h:i a",strtotime($emp_details[0]['CHANGE_DATE'])));
				
				$emp_details[0]['CHANGE_DATE']=$change_time;
			}
			//$emp_details[0]['CHANGE_USER']=$this->getInitials($checked_user_name);
				
		}
		
		//GET MANAGER NAME
		$mgr_user = $employeeObj->getChangeUser($emp_details[0]['ORG_EMPL_REPORT_TO'],$eventId,$readonly);
		//var_dump($emp_details[0]['ORG_EMPL_REPORT_TO']);
		//var_dump($mgr_user);
		//exit;
		$mgr_name = $mgr_user[0]['ORG_EMPL_FNAME'].' '.$mgr_user[0]['ORG_EMPL_LNAME'];
			
		
		$emp_details[0]['MGR_NAME'] =$mgr_name;
		
		
		
		$unitname = explode("-", $emp_details[0]['ORG_UNIT_NAME']);
	    $emp_details[0]['ORG_UNIT_NAME_INIT'] = $this->getInitials($unitname[1]);
	    
	    
		return $emp_details[0];
	}
	public function getReportManager($empid,$event_id){
		
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$report_manager=  $employeeObj->getReportManager($empid,$event_id,$readonly);
		return $report_manager[0]['ORG_EMPL_REPORT_TO'];
	}
	public function getDivisionsByManagers($empID,$event_id){
	    $readonly = FALSE;
		
		if($event_id==0)
		{
			$readonly = TRUE;
		}
		$employeeObj = new employeeModel();
		$divisions=$employeeObj->getDivisionsByManagers($empID,$event_id,$readonly);
		return $divisions;
	}
	
	public function getInitials($word)
	{
		
		$words = explode(" ", $word);
		$initial = "";
		foreach ($words as $value) {
		    $initial .= strtoupper(substr($value, 0, 1));
		}
		
		return $initial;
	}
}
?>