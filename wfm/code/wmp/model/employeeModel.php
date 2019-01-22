<?php 
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BasePDOMySQLModel.php';

//Change Class name to match filename
class employeeModel extends BasePDOMySQLModel {
	
	public function __construct()
	{
		try
		{
			//Change ADMINFAQ_CONFIG_DIR to the global variable for your app
			$config = include(WMP_CONFIG_DIR .DS."config_" . ENVIRONMENT . ".php");
			

			$dbname = $config['DBNAME'];
			$username = $config['DBUSER'];
			$password = $config['DBPASS'];
			$host = $config['DBHOST'];
			$port = $config['DBPORT'];
	
			parent::__construct($dbname,$username,$password,$host,$port);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		
	}//__construct
	
	
	public function getEmployeeByNetworkId($networkId)
	{
		$employeeInfo = null;
		$input = array();
			
		try {
	
			$sql="SELECT
			  `EOC_EMPLOYEE_ID`,
			  ee.`ORG_EMPL_ID`,
			  `ORG_EMPL_NAME`,
			  `ORG_EMPL_FNAME`,
			  `ORG_EMPL_LNAME`,
			  `ORG_EMPL_MNAME`,
			  `ORG_EMPL_EMAIL`,
			  `ORG_EMPL_WORK_PHONE`,
			  `ORG_EMPL_MOBILE_PHONE`,
			  `ORG_EMPL_HR_ID`,
			  `ORG_EMPL_BADGE_ID`,
			  `ORG_EMPL_TYPE`,
			  `ORG_EMPL_IMG_FILE_NAME`,
			  `ORG_EMPL_NTWRK_ID`,
			  `ORG_EMPL_STATUS`,
			  `ORG_DIV_ID`,
			  `ORG_DIV_NAME`,
			  `ORG_DIV_LONG_NAME`,
			  `ORG_UNIT_ID`,
			  `ORG_UNIT_NAME`,
			  `ORG_UNIT_LONG_NAME`,
			  `ORG_LOC_DIV_ID`,
			  `ORG_EMPL_DESIGNATION`,
			  `ORG_EMPL_REPORT_TO`,
			  `ORG_EMPL_ISMGR`,
			  `ORG_MGR_ID_TREE`
			FROM
			  EOC_EMPLOYEE ee where ORG_EMPL_STATUS='A' and ORG_EMPL_NTWRK_ID=:networkId";
				
						
						$input = array(":networkId"=>$networkId);
				
						$q=$this->SQL($sql, (array)$input);
				
						//var_dump($employeeID);
				
						foreach ($q as $row) {
							$employeeInfo= array(
									"ORG_EMPL_ID" =>$row["ORG_EMPL_ID"],
									"ORG_EMPL_LNAME" =>$row["ORG_EMPL_LNAME"],
									"ORG_EMPL_FNAME" =>$row["ORG_EMPL_FNAME"],
									"ORG_EMPL_NAME" =>$row["ORG_EMPL_NAME"],
									"ORG_EMPL_EMAIL" =>$row["ORG_EMPL_EMAIL"],
									"ORG_EMPL_ID" =>$row["ORG_EMPL_ID"],
									"ORG_EMPL_MOBILE_PHONE" =>$row["ORG_EMPL_MOBILE_PHONE"],
									"EMPL_NTWRK_ID" =>$row["EMPL_NTWRK_ID"],
									"ORG_EMPL_HR_ID" =>$row["ORG_EMPL_HR_ID"],
									"ORG_EMPL_ISMGR" =>$row["ORG_EMPL_ISMGR"],
									"ORG_UNIT_NAME" =>$row["ORG_UNIT_NAME"],
									"ORG_DIV_NAME" =>$row["ORG_DIV_NAME"]
				
				
							);
						}
				
					}
					catch (PDOException $pe) {
						trigger_error($pe->getMessage(), E_USER_ERROR);
					}
					
					
					
					
				
					return $employeeInfo;
		
	}
	
public function getEmployeeRolesId($empId)
	{
		$employeeRoles = array();
		$input = array();
			
		try {
	
			$sql="SELECT ORG_ROLE_ID FROM ORG_ROLE_EVNT where ORG_EMPL_ID=:empId";
				
						
						$input = array(":empId"=>$empId);
				
						$q=$this->SQL($sql, (array)$input);
				
						//var_dump($employeeID);
				
						foreach ($q as $row) {
							$employeeRoles[]= $row["ORG_ROLE_ID"];
				
				
							
						}
				
					}
					catch (PDOException $pe) {
						trigger_error($pe->getMessage(), E_USER_ERROR);
					}
					
					
					
					
				
					return $employeeRoles;
		
	}
	
public function getEmployeeRolesByUserName($username)
	{
		$employeeRoles = array();
		$input = array();
			
		try {
	
			$sql="SELECT ore.ORG_ROLE_ID FROM ORG_ROLE_EVNT ore JOIN EOC_EMPLOYEE ee ON ee.ORG_EMPL_ID = ore.ORG_EMPL_ID
					WHERE ee.ORG_EMPL_NTWRK_ID =:username";
				
						
						$input = array(":username"=>$username);
				
						$q=$this->SQL($sql, (array)$input);
				
						//var_dump($employeeID);
				
						foreach ($q as $row) {
							$employeeRoles[]= $row["ORG_ROLE_ID"];
				
				
							
						}
				
					}
					catch (PDOException $pe) {
						trigger_error($pe->getMessage(), E_USER_ERROR);
					}
					
					
					
					
				
					return $employeeRoles;
		
	}
	
 public function getEmployeeById($empId)
	{
		$employeeInfo = null;
		$input = array();
			
		try {
	
			$sql="SELECT
			  `EOC_EMPLOYEE_ID`,
			  ee.`ORG_EMPL_ID`,
			  `ORG_EMPL_NAME`,
			  `ORG_EMPL_FNAME`,
			  `ORG_EMPL_LNAME`,
			  `ORG_EMPL_MNAME`,
			  `ORG_EMPL_EMAIL`,
			  `ORG_EMPL_WORK_PHONE`,
			  `ORG_EMPL_MOBILE_PHONE`,
			  `ORG_EMPL_HR_ID`,
			  `ORG_EMPL_BADGE_ID`,
			  `ORG_EMPL_TYPE`,
			  `ORG_EMPL_IMG_FILE_NAME`,
			  `ORG_EMPL_NTWRK_ID`,
			  `ORG_EMPL_STATUS`,
			  `ORG_DIV_ID`,
			  `ORG_DIV_NAME`,
			  `ORG_DIV_LONG_NAME`,
			  `ORG_UNIT_ID`,
			  `ORG_UNIT_NAME`,
			  `ORG_UNIT_LONG_NAME`,
			  `ORG_LOC_DIV_ID`,
			  `ORG_EMPL_DESIGNATION`,
			  `ORG_EMPL_REPORT_TO`,
			  `ORG_EMPL_ISMGR`,
			  `ORG_MGR_ID_TREE`
			FROM
			  EOC_EMPLOYEE ee where ORG_EMPL_STATUS='A' and ee.ORG_EMPL_ID=:empId";
				
						
						$input = array(":empId"=>$empId);
				
						$q=$this->SQL($sql, (array)$input);
				
						//var_dump($employeeID);
				
						foreach ($q as $row) {
							$employeeInfo= array(
									"ORG_EMPL_ID" =>$row["ORG_EMPL_ID"],
									"ORG_EMPL_LNAME" =>$row["ORG_EMPL_LNAME"],
									"ORG_EMPL_FNAME" =>$row["ORG_EMPL_FNAME"],
									"ORG_EMPL_NAME" =>$row["ORG_EMPL_NAME"],
									"ORG_EMPL_EMAIL" =>$row["ORG_EMPL_EMAIL"],
									"ORG_EMPL_ID" =>$row["ORG_EMPL_ID"],
									"ORG_EMPL_MOBILE_PHONE" =>$row["ORG_EMPL_MOBILE_PHONE"],
									"EMPL_NTWRK_ID" =>$row["EMPL_NTWRK_ID"],
									"ORG_EMPL_HR_ID" =>$row["ORG_EMPL_HR_ID"],
									"ORG_EMPL_ISMGR" =>$row["ORG_EMPL_ISMGR"],
									"ORG_UNIT_NAME" =>$row["ORG_UNIT_NAME"],
									"ORG_DIV_NAME" =>$row["ORG_DIV_NAME"]
				
				
							);
						}
				
					}
					catch (PDOException $pe) {
						trigger_error($pe->getMessage(), E_USER_ERROR);
					}
					
					
					
					
				
					return $employeeInfo;
		
	}
	public function getDirectReportingManagers($emp_id,$event_id,$readonly){

		try
		{
			if($readonly)
			{
				$sql="SELECT * FROM EOC_EMPLOYEE WHERE ORG_EMPL_STATUS='A' AND ORG_EMPL_REPORT_TO =:emp_id AND ORG_EMPL_DESIGNATION !='Consultant' ORDER BY FIELD(ORG_EMPL_ISMGR, '1') DESC,ORG_EMPL_LNAME,ORG_EMPL_FNAME";
				
				  $input[':emp_id'] =  $emp_id;
			   
			}
			else {
				 
			   $sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid AND ORG_EMPL_REPORT_TO =:emp_id AND ORG_EMPL_DESIGNATION !='Consultant' ORDER BY FIELD(ORG_EMPL_ISMGR, '1') DESC,ORG_EMPL_LNAME,ORG_EMPL_FNAME";
				$input[':eventid'] =  $event_id;
				$input[':emp_id'] =  $emp_id;
				
			}
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
    public function isCEODirectReport($emp_id,$ceo_id,$readonly){
        
    	$input = array();
    	
    	$isCEODirectReport = FALSE;
    	
    	if($readonly)
    	{
    		$table = ' EOC_EMPLOYEE ';
    	}
    	else
    	{
    		$table = ' EOC_EMPLOYEE_EVENT ';
    	}
    	
		try
		{
			$sql="SELECT * FROM ". $table." WHERE ORG_EMPL_STATUS='A' AND ORG_EMPL_REPORT_TO =:ceo_id AND ORG_EMPL_ID=:emp_id";
				$input[':emp_id'] =  $emp_id;
				$input[':ceo_id'] =  $ceo_id;
				$q=$this->SQL($sql, (array)$input);
				
		 foreach ($q as $row) {
				 	$isCEODirectReport = TRUE;
				 	break;
				 }
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $isCEODirectReport;
	}
	public function getIndirectReportingManagers($emp_id){

		try
		{
			$sql="SELECT * FROM EOC_EMPLOYEE WHERE ORG_EMPL_STATUS='A' AND ORG_EMPL_REPORT_TO !=:emp_id AND ORG_EMPL_DESIGNATION !='Consultant' AND ORG_EMPL_ISMGR=1 AND ORG_MGR_ID_TREE LIKE :emp_id_hash ORDER BY FIELD(ORG_EMPL_ISMGR, '1') DESC,ORG_EMPL_NAME";
				$input[':emp_id_hash'] =  "%M" . $emp_id . "M%";
				$input[':emp_id'] = $emp_id;
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function getTotalUsersCountByEvent($empID,$event_id,$readonly){
		try
		{
		   if($readonly)
			{
				$sql="SELECT 0 INCNT,0 OUTCNT,0 MISS,COUNT(*) ALLCNT  FROM EOC_EMPLOYEE WHERE `ORG_EMPL_STATUS`='A' AND ORG_MGR_ID_TREE LIKE :managerid_hash ";
					
						$input[':managerid_hash'] =  "%M" . $empID . "M%";
			   
			}
			else 
			{
				$sql="SELECT SUM(incnt) INCNT,SUM(outcnt) OUTCNT,SUM(misscnt) MISS,sum(allcnt) ALLCNT
				FROM
				(SELECT 
				CASE
					  WHEN (
						EOC_EVENT_EMP_STATUS  = 'I'
					  )
					  THEN 1
					  ELSE 0
					END AS incnt,
				CASE
					  WHEN (
						EOC_EVENT_EMP_STATUS  = 'O'
					  )
					  THEN 1
					  ELSE 0
					END AS outcnt,
				CASE
					  WHEN (
						EOC_EVENT_EMP_STATUS  = 'M'
					  )
					  THEN 1
					  ELSE 0
				END AS misscnt,1 as allcnt FROM EOC_EMPLOYEE_EVENT WHERE `ORG_EMPL_STATUS`='A' AND ORG_MGR_ID_TREE LIKE :managerid_hash AND EOC_ENT_ID=:eventid) AS T";
						$input[':eventid'] =  $event_id;
						$input[':managerid_hash'] =  "%M" . $empID . "M%";
			}
			
			
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function getTotalUsersCountByManager($managerid,$event_id,$readonly){
		try
		{
		if($readonly)
			{
				$sql="SELECT 0 INCNT,0 OUTCNT,0 MISS,COUNT(*) ALLCNT  FROM EOC_EMPLOYEE WHERE `ORG_EMPL_STATUS`='A' AND ORG_MGR_ID_TREE LIKE :managerid_hash ";
					
						$input[':managerid_hash'] =  "%M" . $managerid . "M%";
			   
			}
			else 
			{
				$sql="SELECT SUM(incnt) INCNT,SUM(outcnt) OUTCNT,SUM(misscnt) MISS,sum(allcnt) ALLCNT
						FROM
						(SELECT 
						CASE
							  WHEN (
								EOC_EVENT_EMP_STATUS  = 'I'
							  )
							  THEN 1
							  ELSE 0
							END AS incnt,
						CASE
							  WHEN (
								EOC_EVENT_EMP_STATUS  = 'O'
							  )
							  THEN 1
							  ELSE 0
							END AS outcnt,
						CASE
							  WHEN (
								EOC_EVENT_EMP_STATUS  = 'M'
							  )
							  THEN 1
							  ELSE 0
							END AS misscnt,1 as allcnt FROM EOC_EMPLOYEE_EVENT WHERE ORG_MGR_ID_TREE LIKE :managerid_hash AND`ORG_EMPL_STATUS`='A' AND EOC_ENT_ID=:eventid) AS T";
									$input[':eventid'] =  $event_id;
									$input[':managerid_hash'] =  "%M" . $managerid . "M%";
			}
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function getConsultants($emp_id,$event_id,$readonly){
		try
		{
		   if($readonly)
			{
				$sql="SELECT * FROM EOC_EMPLOYEE WHERE ORG_EMPL_STATUS='A' AND ORG_EMPL_TYPE='Consultant' AND ORG_EMPL_REPORT_TO =:emp_id ORDER BY ORG_EMPL_NAME";
				
			   
			}
			else {
				$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid AND ORG_EMPL_TYPE='Consultant' AND ORG_EMPL_REPORT_TO =:emp_id ORDER BY ORG_EMPL_NAME";
				$input[':eventid'] =  $event_id;
				
			}
			    $input[':emp_id'] =  $emp_id;
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $q;
	}

	
   public function getParentsOfEmpId($id,$event_id,$readonly){
		try
		{
			if($readonly)
			{
				$sql="SELECT ORG_MGR_ID_TREE FROM EOC_EMPLOYEE WHERE ORG_EMPL_STATUS='A' AND ORG_EMPL_ID =:emp_id";
			   
			}
			else 
			{
				$sql="SELECT ORG_MGR_ID_TREE FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid  AND ORG_EMPL_ID =:emp_id";
			     $input[':eventid'] =  $event_id;
			}
				
				$input[':emp_id'] = $id;
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $q;
	}
	public function getParentsDetails($parentstring,$event_id,$readonly){
		try
		{
		   if($readonly)
			{
				$sql="SELECT * FROM EOC_EMPLOYEE WHERE ORG_EMPL_STATUS='A' AND ORG_EMPL_ID IN(".$parentstring.")";
				
				$q=$this->SQL($sql);
			    
			}
			else 
			{
				$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid  AND ORG_EMPL_ID  IN (".$parentstring.")";
			    $input[':eventid'] =  $event_id;
			    
			    $q=$this->SQL($sql,(array)$input);
			}
			
				//$q=$this->SQL($sql);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $q;
	}
	public function getReportManager($empid,$event_id,$readonly){
		try
		{
			if($readonly)
			{
			   $sql="SELECT ORG_EMPL_REPORT_TO FROM EOC_EMPLOYEE WHERE ORG_EMPL_ID=:emp_id";
			   
			}
			else 
			{
				$sql="SELECT ORG_EMPL_REPORT_TO FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid AND ORG_EMPL_ID=:emp_id";
				$input[':eventid'] =  $event_id;
			}
			
				$input[':emp_id'] = $empid;
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function getEmpDetail($empid,$eventId,$readonly){
		
		$input = array();
		
		try
		{
			
			if($readonly)
			{
				$sql="SELECT ee.ORG_EMPL_HR_ID,ee.ORG_EMPL_REPORT_TO,ee.ORG_EMPL_FNAME,ee.ORG_EMPL_EMAIL,ee.ORG_EMPL_WORK_PHONE,ee.ORG_EMPL_MOBILE_PHONE,
			      ee.ORG_EMPL_LNAME,ee.ORG_DIV_NAME,ee.ORG_UNIT_NAME 
			      FROM EOC_EMPLOYEE ee WHERE ee.ORG_EMPL_ID=:empid";
				$input[':empid'] = $empid;
				
				
			}
			else
			{
				$sql="SELECT ee.ORG_EMPL_HR_ID,ee.ORG_EMPL_REPORT_TO,ee.ORG_EMPL_FNAME,ee.ORG_EMPL_EMAIL,ee.ORG_EMPL_WORK_PHONE,ee.ORG_EMPL_MOBILE_PHONE,
			      ee.ORG_EMPL_LNAME,ee.ORG_DIV_NAME,ee.ORG_UNIT_NAME,eed.EOC_EVENT_EMP_STATUS,eed.EOC_ENT_ID,eed.CHANGE_USER,eed.CHANGE_DATE 
			      FROM EOC_EMPLOYEE ee LEFT JOIN EOC_EMPLOYEE_EVENT eed ON eed.ORG_EMPL_ID = ee.ORG_EMPL_ID AND eed.EOC_ENT_ID=:eventId WHERE ee.ORG_EMPL_ID=:empid";
				$input[':empid'] = $empid;
				$input[':eventId'] = $eventId;
				
			}
			
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
     public function getChangeUser($empid,$eventId,$readonly){
     	
     	$input = array();
		try
		{
			if($readonly)
			{
				$sql="SELECT ee.ORG_EMPL_FNAME,ee.ORG_EMPL_LNAME,ee.ORG_UNIT_NAME,ee.ORG_EMPL_STATUS,ee.CHANGE_USER,ee.CHANGE_DATE FROM EOC_EMPLOYEE ee WHERE ee.ORG_EMPL_ID = :empid
				";
				$input[':empid'] = $empid;
				
				$q=$this->SQL($sql,(array)$input);
				
				
			}
			else
			{
			$sql="SELECT ee.ORG_EMPL_FNAME,ee.ORG_EMPL_LNAME,ee.ORG_UNIT_NAME,ee.ORG_EMPL_STATUS,ee.CHANGE_USER,ee.CHANGE_DATE FROM EOC_EMPLOYEE_EVENT ee WHERE ee.ORG_EMPL_ID = :empid AND ee.EOC_ENT_ID=:eventId
				";
				$input[':empid'] = $empid;
				$input[':eventId'] = $eventId;
				$q=$this->SQL($sql,(array)$input);
			}
				
				
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
      public function getDivisionsByManagers($empID,$event_id,$readonly){
		try {
			
		  if($readonly)
			{
			   $sql="SELECT ORG_DIV_ID FROM EOC_EMPLOYEE WHERE ORG_EMPL_REPORT_TO =:empid and ORG_EMPL_ISMGR=1  GROUP BY ORG_DIV_ID";
			   
			}
			else 
			{
				$sql="SELECT ORG_DIV_ID FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_REPORT_TO =:empid AND EOC_ENT_ID=:eventid and ORG_EMPL_ISMGR=1  GROUP BY ORG_DIV_ID";
					$input[':eventid'] = $event_id;
					
			}
					
					$input[':empid'] = $empID;
					$q=$this->SQL($sql, (array)$input);
			
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
		return $q;
	}
	
	public function registerLogin($username,$userId,$eventId)
	{
		
		$input = array();
	
		try {
	
			$sql="INSERT INTO `EOC_USER_LOGINS` (LOGIN_ID,ORG_EMPL_NTWRK_ID,`ORG_EMPL_ID`,`CHANGE_DATE`,`EOC_ENT_ID`) VALUES (NULL,:username,:userId,now(),:eventId);" ;
					
					
					//$input[':EOC_EVNT_DESC'] = $eventDesc;
					//$input[':CHANGE_DT'] = now();
					$input[':username'] = $username;
					$input[':userId'] = $userId;
					$input[':eventId'] = $eventId;
			
					$q=$this->SQL($sql, $input);
					
					
		
			
				}
				catch (PDOException $pe) {
					var_dump($pe);
					trigger_error($pe->getMessage(), E_USER_ERROR);
				}
			
		return $q;
		
	}

}
?>