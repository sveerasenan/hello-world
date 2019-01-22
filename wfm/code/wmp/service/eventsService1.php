<?php
require_once WMP_APP_DIR .DS. 'model'. DS .'eventsModel.php';
require_once WMP_APP_DIR .DS. 'model'. DS .'employeeModel.php';
require_once WMP_APP_DIR .DS. 'model'. DS .'rollcallModel.php';
class eventsService1{
public function createEvent($event_id,$params){
		
		$userId = $_SESSION('empID');
		$eventObj = new eventsModel();
		$eventId = $eventObj->addEvent($params('event_desc'),$params('event_type'),$userId);
		
	}
	//copy data from employee table to employeeEventStatus table
	
	
	public function getActiveEvent(){
		$eventObj = new eventsModel();
		$active_event=  $eventObj->getActiveEventID();
		$active_event=$active_event(0);
		return $active_event('EOC_ENT_ID');
		
	}
	public function getDirectReportingManagers($event_id,$emp_id){
		$rollcallObj = new rollcallModel();
		$event_users=  $rollcallObj->getDirectReportingManagers($event_id,$emp_id);
		return $event_users;
	
	}
	public function getIndirectReportingManagers($event_id,$emp_id){
		$rollcallObj = new rollcallModel();
		$event_users=  $rollcallObj->getIndirectReportingManagers($event_id,$emp_id);
		return $event_users;
	}
	public function getConsultants($event_id,$emp_id){
		$mgrpram='M'.$emp_id.'M';
		$rollcallObj = new rollcallModel();
		$event_users=  $rollcallObj->getConsultants($event_id,$emp_id);
		return $event_users;
	
	}
	
public function getTotalUsersCountByManager($eventid, $managerid){
		$rollcallObj = new rollcallModel();
		$active_event_unit_employess = $rollcallObj->getTotalUsersCountByManager($eventid, $managerid);
		return $active_event_unit_employess;

	}
	public function getTotalUsersCountByEvent($eventid,$empID){
		$rollcallObj = new rollcallModel();
		$active_event_employess_count = $rollcallObj->getTotalUsersCountByEvent($eventid,$empID);
		return $active_event_employess_count(0);

	}
/*	
public function addEmpToEmpEvntStatus($event_id,$params){
		$employeeObj = new employeeModel();
		$filter = array('ORG_LOC_ID' =>  $params('location'));
		$options = array("projection" => array('_id' => 0),);
		$emp_records=$employeeObj->fetchRecords($filter,$options);
		$rollcall = array();
		foreach ($emp_records as $key=>$val)
		{
			$rollcalldata=(array)$val;
			$rollcalldata('EOC_EVNT_ID')=$event_id;
			$rollcalldata('EOC_EVNT_STATUS')=1;
			$rollcalldata('EOC_EVNT_EPM_STAT_DESC')=$params('event_desc');
			$rollcalldata('EOC_DIV_EMP_STATUS')=0;
			$rollcall()=$rollcalldata;
		}
		//print_r($rollcall);exit;
		$rollcallObj= new rollcallModel();
		$rollcallObj->_insert($rollcall,true);
	}
	public function updateStatus($params){

		$rollcallObj = new rollcallModel();
		$where = array("ORG_EMPL_ID" => $params('id'), "EOC_EVNT_ID" => (int)$params('eventid'));
		$data  = array("EOC_DIV_EMP_STATUS"=>(int)$params('status'));
		$rollcallObj->_update($data,$where);

	}
	public function updateUnitStatus($params){
		$mgrpram='M'.$params('id').'M';
		$rollcallObj = new rollcallModel();
		$where = array("ORG_MGR_ID_TREE" => new MongoDB\BSON\Regex($mgrpram), "EOC_EVNT_ID" => (int)$params('eventid'));
		$data  = array("EOC_DIV_EMP_STATUS"=>(int)$params('status'));
		$rollcallObj->_update($data,$where);
	}
	
	public function getAllActiveEvents(){
		$eventObj = new eventsModel();
		$filter = array('EOC_EVNT_STATUS' => 1);
		$options = array("projection" => array('_id' => 0),);
		$active_event=  $eventObj->fetchRecords($filter,$options);
		return $active_event;
	}
	public function deleteEvent($event_id){
		$eventObj = new eventsModel();
		$where = array('EOC_EVNT_ID' => (int)$event_id);
		$data  = array("EOC_EVNT_STATUS"=>0);
		$eventObj->_update($data,$where);
		$rollcallObj = new rollcallModel();
		$where1 = array('EOC_EVNT_ID' => (int)$event_id);
		$data1  = array("EOC_EVNT_STATUS"=>0);
		$rollcallObj->_update($data1,$where1);
	}
	public function getReportManager($empid,$event_id){
		$rollcallObj = new rollcallModel();
		$filter = array('ORG_EMPL_ID' =>  (string)$empid,'EOC_EVNT_ID' =>  (int)$event_id);
		$options = array("projection" => array('_id' => 0),);
		$report_manager=  $rollcallObj->fetchRecords($filter,$options);
		return $report_manager(0);
	}
	public function getAllUsersByStatus($event_id,$status){
		$rollcallObj = new rollcallModel();
		$filter = array('EOC_DIV_EMP_STATUS' =>  (int)$status,'EOC_EVNT_ID' =>  (int)$event_id);
		$options = array("projection" => array('_id' => 0),);
		$status_report=  $rollcallObj->fetchRecords($filter,$options);
		return $status_report;
	}
	public function getEmpDetail($empid,$event_id){
		$rollcallObj = new rollcallModel();
		$filter = array('ORG_EMPL_ID' =>  (string)$empid,'EOC_EVNT_ID' =>  (int)$event_id);
		$options = array("projection" => array('_id' => 0));
		$emp_details=  $rollcallObj->fetchRecords($filter,$options);
		return $emp_details(0);
	}
	public function getEmergencyEmpDetail($empid){
		$employeeObj = new employeeModel();
		$filter = array('ORG_EMPL_ID' =>  (string)$empid);
		$options = array("projection" => array('_id' => 0),);
		$emp_details=  $employeeObj->fetchRecords($filter,$options);
		return $emp_details(0);
	}
	public function getEmpDetailsByName($name){
		$empmodel=new employeeModel();
		$filter = array('ORG_EMPL_NAME' =>  $name);
		$options = array("projection" => array('_id' => 0),);
		$mgr_details=$empmodel->fetchRecords($filter,$options); 
		return $mgr_details(0); 
	}
	public function updateStatusByUrl($id,$eventid ){

		$rollcallObj = new rollcallModel();
		$where = array("ORG_EMPL_ID" => $id, "EOC_EVNT_ID" => (int)$eventid);
		$data  = array("EOC_DIV_EMP_STATUS"=>1);
		$rollcallObj->_update($data,$where);

	}
	public function getParentsOfEmpId($id,$event_id){
		$rollcallObj = new rollcallModel();
		$filter = array('ORG_EMPL_ID' =>  (string)$id,'EOC_EVNT_ID' =>  (int)$event_id);
		$options = array("projection" => array('_id' => 0),);
		$Parents=  $rollcallObj->fetchRecords($filter,$options);
		return $Parents(0);
	}
	public function getParentsDetails($parentstring){
		$parents=explode(",",$parentstring);
		$rollcallObj = new rollcallModel();
		$filter = array('ORG_EMPL_ID' =>  array('$in' =>  $parents));
		$options = array("projection" => array('_id' => 0),);
		$Parents=  $rollcallObj->fetchRecords($filter,$options);
		return $Parents;
	}
	public function updateGroupStatus($params){
		$users=explode(",",$params('user'));
		$units=explode(",",$params('unit'));
		$rollcallObj = new rollcallModel();
		$where = array("ORG_EMPL_ID" =>array ('$in' =>  $users), "EOC_EVNT_ID" => (int)$params('eventid'));
		$data  = array("EOC_DIV_EMP_STATUS"=>(int)$params('status'));
		$rollcallObj->_update($data,$where);
		foreach ($units as $key=>$unitid)
		{
			$mgrpram='M'.$unitid.'M';
			$where = array("ORG_MGR_ID_TREE" => new MongoDB\BSON\Regex($mgrpram), "EOC_EVNT_ID" => (int)$params('eventid'));
			$data  = array("EOC_DIV_EMP_STATUS"=>(int)$params('status'));
		$rollcallObj->_update($data,$where);
		}
	}
	*/
}
?>