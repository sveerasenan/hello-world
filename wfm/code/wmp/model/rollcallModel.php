<?php 
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BasePDOMySQLModel.php';

//Change Class name to match filename
class rollcallModel extends BasePDOMySQLModel {
	
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
		
	}
	public function getDirectReportingManagers($event_id,$emp_id){

		try
		{
			$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid AND ORG_EMPL_REPORT_TO =:emp_id AND ORG_EMPL_DESIGNATION !='Consultant' ORDER BY FIELD(ORG_EMPL_ISMGR, '1') DESC,ORG_EMPL_LNAME,ORG_EMPL_FNAME";
				$input[':eventid'] =  $event_id;
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
	public function getIndirectReportingManagers($event_id,$emp_id){

		try
		{
			$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A'AND EOC_ENT_ID=:eventid AND ORG_EMPL_REPORT_TO !=:emp_id AND ORG_EMPL_DESIGNATION !='Consultant' AND ORG_EMPL_ISMGR=1 AND ORG_MGR_ID_TREE LIKE :emp_id_hash ORDER BY FIELD(ORG_EMPL_ISMGR, '1') DESC,ORG_EMPL_LNAME,ORG_EMPL_FNAME";
				$input[':eventid'] =  $event_id;
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
	/*
	public function getTotalUsersCountByEvent($event_id,$empID){
		try
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
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
	public function getTotalUsersCountByManager($event_id, $managerid){
		try
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
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	*/
	public function getConsultants($event_id,$emp_id){
		try
		{
			$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid AND ORG_EMPL_TYPE='Consultant' AND ORG_EMPL_REPORT_TO =:emp_id order by ORG_EMPL_LNAME,ORG_EMPL_FNAME";
				$input[':eventid'] =  $event_id;
				$input[':emp_id'] =  $emp_id ;
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $q;
	}
	
    public function getEmployeesByStatus($event_id,$emp_id,$status){
		try
		{
			
			$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid AND ORG_MGR_ID_TREE like :mgr_id_hash AND EOC_EVENT_EMP_STATUS=:status order by ORG_EMPL_LNAME,ORG_EMPL_FNAME";
				$input[':eventid'] =  $event_id;
				$input[':mgr_id_hash'] =  "%M" . $emp_id . "M%";
				$input[':status'] =  $status;
				$q=$this->SQL($sql, (array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $q;
	}
	public function getParentsOfEmpId($id,$event_id){
		try
		{
			$sql="SELECT ORG_MGR_ID_TREE FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_STATUS='A' AND EOC_ENT_ID=:eventid  AND ORG_EMPL_ID =:emp_id";
				$input[':eventid'] =  $event_id;
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
	public function getParentsDetails($parentstring){
		try
		{
			$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_ID IN(".$parentstring.")";
				$q=$this->SQL($sql);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $q;
	}
	public function getReportManager($empid,$event_id){
		try
		{
			$sql="SELECT ORG_EMPL_REPORT_TO FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_ID=:emp_id AND EOC_ENT_ID=:eventid";
				$input[':eventid'] = $event_id;
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
	
	public function getEmpDetail($empid,$event_id){
		try
		{
			$sql="SELECT * FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_ID =:empid AND EOC_ENT_ID=:eventid";
				$input[':eventid'] = $event_id;
				$input[':empid'] = $empid;
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function getDivisionsByManagers($empID,$event_id=NULL){
		try {
			if($event_id)
			$event_condition= " AND EOC_ENT_ID=:eventid and ORG_EMPL_ISMGR=1 ";
			$sql="SELECT ORG_DIV_ID FROM EOC_EMPLOYEE_EVENT WHERE ORG_EMPL_REPORT_TO =:empid".$event_condition." GROUP BY ORG_DIV_ID";
					$input[':eventid'] = $event_id;
					$input[':empid'] = $empID;
					$q=$this->SQL($sql, (array)$input);
			
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
		return $q;
	}

}
?>