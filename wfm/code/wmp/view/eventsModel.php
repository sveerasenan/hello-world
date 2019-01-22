<?php 
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BasePDOMySQLModel.php';

//Change Class name to match filename
class eventsModel extends BasePDOMySQLModel {
	
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
	
    public function addEvent($userId){
		
		$input = array();
	
		try {
	
			$sql="
		INSERT INTO `EOC_EVENT` (
		  `EOC_EVNT_DATE`,
		  `EOC_EVNT_START_TIME`
		  `CHANGE_DATE`,
		  `CHANGE_USER`,
		  `CHANGE_TYPE`
		)
		VALUES
		  (
		     NOW(),
		     NOW(),
		     NOW(),
		     :CHANGE_USER,
		    'I'
		  );" ;
					
					
					//$input[':EOC_EVNT_DESC'] = $eventDesc;
					//$input[':EOC_EVNT_TYPE'] = $eventType;
					$input[':CHANGE_USER'] = $userId;
			
					$q=$this->SQL($sql, $input);
		
			
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
			
		return $q;
		
	}
	public function getActiveEventID(){
		try {
	
			$sql="SELECT * FROM `EOC_EVENT` WHERE EOC_EVNT_END_TIME IS NULL";
					$q=$this->SQL($sql);
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
			
		return $q;
	}
	Public function deactivateEvent($event_id){
		try {
			$sql="UPDATE EOC_EVENT SET EOC_EVNT_END_TIME = current_date() WHERE EOC_ENT_ID=:event_id";
			$input[':event_id'] = $event_id;		
			$q=$this->SQL($sql,$input);
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
				return $q;
	}
	public function addEventEmployees($eventId,$userId){
		try {
			$sql="SELECT * FROM EOC_EMPLOYEE";
					$allemp=$this->SQL($sql);
					foreach($allemp as $emp){	
				$isql="INSERT INTO EOC_EMPLOYEE_EVENT ( 
				EOC_ENT_ID,
				EOC_EMPLOYEE_ID,
				ORG_EMPL_ID,
				ORG_EMPL_NAME,
				ORG_EMPL_FNAME,
				ORG_EMPL_LNAME,
				ORG_EMPL_MNAME,
				ORG_EMPL_EMAIL,
				ORG_EMPL_WORK_PHONE,
				ORG_EMPL_MOBILE_PHONE,
				ORG_EMPL_HR_ID,
				ORG_EMPL_BADGE_ID,
				ORG_EMPL_TYPE,
				ORG_EMPL_IMG_FILE_NAME,
				CHANGE_DATE,
				CHANGE_USER,
				CHANGE_TYPE,
				ORG_EMPL_NTWRK_ID,
				ORG_EMPL_STATUS,
				ORG_DIV_ID,
				ORG_DIV_NAME,
				ORG_DIV_LONG_NAME,
				ORG_UNIT_ID,
				ORG_UNIT_NAME,
				ORG_UNIT_LONG_NAME,
				ORG_LOC_DIV_ID,
				ORG_EMPL_DESIGNATION,
				ORG_EMPL_REPORT_TO,
				ORG_EMPL_ISMGR,
				ORG_MGR_ID_TREE )VALUES (:EOC_ENT_ID,
				:EOC_EMPLOYEE_ID,
				:ORG_EMPL_ID,
				:ORG_EMPL_NAME,
				:ORG_EMPL_FNAME,
				:ORG_EMPL_LNAME,
				:ORG_EMPL_MNAME,
				:ORG_EMPL_EMAIL,
				:ORG_EMPL_WORK_PHONE,
				:ORG_EMPL_MOBILE_PHONE,
				:ORG_EMPL_HR_ID,
				:ORG_EMPL_BADGE_ID,
				:ORG_EMPL_TYPE,
				:ORG_EMPL_IMG_FILE_NAME,
				NOW(),
				:CHANGE_USER,
				:CHANGE_TYPE,
				:ORG_EMPL_NTWRK_ID,
				:ORG_EMPL_STATUS,
				:ORG_DIV_ID,
				:ORG_DIV_NAME,
				:ORG_DIV_LONG_NAME,
				:ORG_UNIT_ID,
				:ORG_UNIT_NAME,
				:ORG_UNIT_LONG_NAME,
				:ORG_LOC_DIV_ID,
				:ORG_EMPL_DESIGNATION,
				:ORG_EMPL_REPORT_TO,
				:ORG_EMPL_ISMGR,
				:ORG_MGR_ID_TREE)";
				$input[':EOC_ENT_ID']=$eventId;
				$input[':EOC_EMPLOYEE_ID']=$emp['EOC_EMPLOYEE_ID'];
				$input[':ORG_EMPL_ID']=$emp['ORG_EMPL_ID'];
				$input[':ORG_EMPL_NAME']=$emp['ORG_EMPL_NAME'];
				$input[':ORG_EMPL_FNAME']=$emp['ORG_EMPL_FNAME'];
				$input[':ORG_EMPL_LNAME']=$emp['ORG_EMPL_LNAME'];
				$input[':ORG_EMPL_MNAME']=$emp['ORG_EMPL_MNAME'];
				$input[':ORG_EMPL_EMAIL']=$emp['ORG_EMPL_EMAIL'];
				$input[':ORG_EMPL_WORK_PHONE']=$emp['ORG_EMPL_WORK_PHONE'];
				$input[':ORG_EMPL_MOBILE_PHONE']=$emp['ORG_EMPL_MOBILE_PHONE'];
				$input[':ORG_EMPL_HR_ID']=$emp['ORG_EMPL_HR_ID'];
				$input[':ORG_EMPL_BADGE_ID']=$emp['ORG_EMPL_BADGE_ID'];
				$input[':ORG_EMPL_TYPE']=$emp['ORG_EMPL_TYPE'];
				$input[':ORG_EMPL_IMG_FILE_NAME']=$emp['ORG_EMPL_IMG_FILE_NAME'];
				$input[':CHANGE_USER']=$userId;
				$input[':CHANGE_TYPE']='I';
				$input[':ORG_EMPL_NTWRK_ID']=$emp['ORG_EMPL_NTWRK_ID'];
				$input[':ORG_EMPL_STATUS']=$emp['ORG_EMPL_STATUS'];
				$input[':ORG_DIV_ID']=$emp['ORG_DIV_ID'];
				$input[':ORG_DIV_NAME']=$emp['ORG_DIV_NAME'];
				$input[':ORG_DIV_LONG_NAME']=$emp['ORG_DIV_LONG_NAME'];
				$input[':ORG_UNIT_ID']=$emp['ORG_UNIT_ID'];
				$input[':ORG_UNIT_NAME']=$emp['ORG_UNIT_NAME'];
				$input[':ORG_UNIT_LONG_NAME']=$emp['ORG_UNIT_LONG_NAME'];
				$input[':ORG_LOC_DIV_ID']=$emp['ORG_LOC_DIV_ID'];
				$input[':ORG_EMPL_DESIGNATION']=$emp['ORG_EMPL_DESIGNATION'];
				$input[':ORG_EMPL_REPORT_TO']=$emp['ORG_EMPL_REPORT_TO'];
				$input[':ORG_EMPL_ISMGR']=$emp['ORG_EMPL_ISMGR'];
				$input[':ORG_MGR_ID_TREE']=$emp['ORG_MGR_ID_TREE'];
				$q=$this->SQL($isql,(array)$input);
					}
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
				return $q;
	}
	
public function updateStatus($params,$changeuser){
		try
		{
			$sql="UPDATE EOC_EMPLOYEE_EVENT SET EOC_EVENT_EMP_STATUS=:status,CHANGE_USER=:changeuser,CHANGE_DATE=NOW() WHERE ORG_EMPL_ID = :emp_id AND EOC_ENT_ID=:eventid";
				$input[':eventid'] = $params['eventid'];
				$input[':emp_id'] = $params['id'];
				$input[':status'] = $params['status'];
				$input[':changeuser'] = $changeuser;
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function updateUnitStatus($params,$changeuser){
		try
		{
			$sql="UPDATE EOC_EMPLOYEE_EVENT SET EOC_EVENT_EMP_STATUS=:status,CHANGE_USER=:changeuser,CHANGE_DATE=NOW() WHERE ORG_MGR_ID_TREE LIKE :emp_id_hash AND EOC_ENT_ID=:eventid";
				$input[':eventid'] = $params['eventid'];
				$input[':emp_id_hash'] = "%M" . $params['id'] . "M%";
				$input[':status'] = $params['status'];
				$input[':changeuser'] = $changeuser;
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	public function updateGroupEmpStatus($params,$changeuser){
		try
		{
			$sql="UPDATE EOC_EMPLOYEE_EVENT SET EOC_EVENT_EMP_STATUS=:status,CHANGE_USER=:changeuser,CHANGE_DATE=NOW() WHERE ORG_EMPL_ID IN ( ".$params['id']." ) AND EOC_ENT_ID=:eventid";
				$input[':eventid'] = $params['eventid'];
				$input[':status'] = $params['status'];
				$input[':changeuser'] = $changeuser;
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
   public function getCurrentEventStatus($event_id){
		try
		{
				$sql="SELECT ees.*,lv.EVENT_MSG FROM EOC_EVENT_STATUS ees JOIN LOV_EVENT_STATUS lv on lv.LOV_EVENT_STATUS_ID=ees.LOV_EVENT_STATUS_ID
				  WHERE EOC_ENT_ID=:eventid AND ees.CHANGE_TIME = (SELECT MAX(E2.CHANGE_TIME) FROM EOC_EVENT_STATUS E2 WHERE E2.`EOC_ENT_ID`=:eventid)";
				$input[':eventid'] =  $event_id;
			
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
  public function getEventStatus($event_id){
		try
		{
				$sql="SELECT ees.*,lv.EVENT_MSG,eee.`ORG_EMPL_FNAME`,eee.`ORG_EMPL_LNAME` FROM EOC_EVENT_STATUS ees 
						JOIN LOV_EVENT_STATUS lv ON lv.LOV_EVENT_STATUS_ID=ees.LOV_EVENT_STATUS_ID
						JOIN EOC_EMPLOYEE_EVENT eee ON eee.`EOC_ENT_ID`=ees.`EOC_ENT_ID` AND eee.`ORG_EMPL_ID`=ees.`CHANGE_USER`
						WHERE ees.EOC_ENT_ID=:eventid ORDER BY ees.CHANGE_TIME";
				$input[':eventid'] =  $event_id;
			
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
 public function getEventStatusByEvntIdStatusId($event_id,$status_id){
		try
		{
				$sql="SELECT ees.*,lv.EVENT_MSG,eee.`ORG_EMPL_FNAME`,eee.`ORG_EMPL_LNAME` FROM EOC_EVENT_STATUS ees 
						JOIN LOV_EVENT_STATUS lv ON lv.LOV_EVENT_STATUS_ID=ees.LOV_EVENT_STATUS_ID
						JOIN EOC_EMPLOYEE_EVENT eee ON eee.`EOC_ENT_ID`=ees.`EOC_ENT_ID` AND eee.`ORG_EMPL_ID`=ees.`CHANGE_USER`
						WHERE ees.EOC_ENT_ID=:eventid and ees.LOV_EVENT_STATUS_ID=:status_id";
				$input[':eventid'] =  $event_id;
				$input[':status_id'] =  $status_id;
			
				$q=$this->SQL($sql,(array)$input);
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q;
	}
	
	
	public function addEventStatus($event_id,$status_id,$userId)
	{
		$input = array();
	
		try {
	
			$sql="INSERT INTO `eoc`.`EOC_EVENT_STATUS` (
			  `EOC_ENT_ID`,
			  `LOV_EVENT_STATUS_ID`,
			  `CHANGE_USER`,
			  `CHANGE_TIME`,
			  `STATUS_MSG`
			)
			VALUES
			  (
		    :event_id,
		    :status_id,
		     :user_id,
		     NOW(),
		     null
		  )" ;
					
					
					$input[':event_id'] = $event_id;
					$input[':status_id'] = $status_id;
					$input[':user_id'] = $userId;
			
					$q=$this->SQL($sql, $input);
		
			
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
			
		return $q;
		
	}
	
	function updateEventStatus($event_id,$status_id,$userId)
	{
		$input = array();
	
		try {
	
			$sql="UPDATE `EOC_EVENT_STATUS` (
			  SET `LOV_EVENT_STATUS_ID`=:status_id
			  `CHANGE_USER`=:user_id,
			  `CHANGE_TIME`=NOW() WHERE EOC_ENT_ID=:event_id and LOV_EVENT_STATUS_ID=:status_id" ;
					
					
					$input[':event_id'] = $event_id;
					$input[':status_id'] = $status_id;
					$input[':user_id'] = $userId;
			
					$q=$this->SQL($sql, $input);
		
			
				}
				catch (PDOException $pe) {
					var_dump($pe);
					//trigger_error($pe->getMessage(), E_USER_ERROR);
				}
			
		return $q;
		
	}
	
	
}
?>