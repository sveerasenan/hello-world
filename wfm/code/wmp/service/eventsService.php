<?php
require_once WMP_APP_DIR .DS. 'model'. DS .'eventsModel.php';
require_once WMP_APP_DIR .DS. 'model'. DS .'employeeModel.php';
require_once WMP_APP_DIR .DS. 'model'. DS .'eventsModel.php';
require_once WMP_APP_DIR .DS. 'view'. DS .'wmpConstants.php';

class eventsService{
	
	public function createEvent($userId){
		
		$eventObj = new eventsModel();
		
		//get active event 
	    $active_event_id = $this->getActiveEvent();
		
		$oldevent_id =0;
		
		if(isset($active_event_id))
		{
		
			$oldevent_id=$active_event_id['EOC_ENT_ID'];
		}
		
		//if active event exists deactivate it.
		if($oldevent_id>0)
		{
			$this->changeEventStatus($oldevent_id,CLOSED_STATUS,$userId);
			
			$this->deactivateEvent($oldevent_id);
		}
		
		//create event
		$eventId = $eventObj->addEvent($userId);
		
		//add status to status table
		
		$this->changeEventStatus($eventId,EVACUATION_STATUS,$userId);
			
		//add employees
		$eventObj->addEventEmployees($eventId,$userId);
	}
	
	
	
	public function getActiveEvent(){
		$eventObj = new eventsModel();
		$active_event=  $eventObj->getActiveEventID();
		
		$actevent=$active_event[0];
		return $actevent;
		
	}
	
   public function getCurrentEventStatus($event_id){
		$eventObj = new eventsModel();
		$curr_event_status=  $eventObj->getCurrentEventStatus($event_id);
		$evnt_status=$curr_event_status[0];
		return $evnt_status;
		
	}
	
	public function getMenuStatusMsg()
	{
		
	    $active_event_id = $this->getActiveEvent();
		
		$event_id =0;
		
		if(isset($active_event_id))
		{
		
			$event_id=$active_event_id['EOC_ENT_ID'];
		}
		
	    $currEvntStatus = $this->getCurrentEventStatus($event_id);
		
		$menuStatusMsg ="READ ONLY";
		
		if(!empty($currEvntStatus))
		{
			$menuStatusMsg =$currEvntStatus['EVENT_MSG'];
		}
		
		return $menuStatusMsg;
	}
	
	public function getEventStatuses($event_id){
		$eventObj = new eventsModel();
		$evnt_statuses=  $eventObj->getEventStatus($event_id);
		
		return $evnt_statuses;
		
	}
	
	public function changeEventStatus($event_id,$status_id,$user_id)
	{
		$eventObj = new eventsModel();
		//check if status exists
		$existingEvnt = $eventObj->getEventStatusByEvntIdStatusId($event_id, $status_id);
		
		
		//if exists update else add
		if(empty($existingEvnt))
		{
			$eventObj->addEventStatus($event_id, $status_id, $user_id);
		}
		
	}

public function getEmployeesByStatus($event_id,$emp_id,$status,$page){
	
	   $pgOffset = 0;
	   if(!empty($page))
	   {
	   	  $pgOffset = ($page-1) * STATUS_PAGE_LIMIT;
	   }
	   
	   $pagelimit = STATUS_PAGE_LIMIT;
		
		$eventsModel = new eventsModel();
		$event_users=  $eventsModel->getEmployeesByStatus($event_id,$emp_id,$status,$pagelimit,$pgOffset);
		return $event_users;
	
	}
	
public function getEmployeesCountByStatus($event_id,$emp_id,$status){
	
	  	
		$eventsModel = new eventsModel();
		$event_users=  $eventsModel->getEmployeesCountByStatus($event_id,$emp_id,$status);
		return $event_users;
	
	}
	
public function getEmployeesStatusNextPage($currentPg,$totalusers){
	
	  $nextpage =0;
	  
	  if($totalusers>0 && ($totalusers>STATUS_PAGE_LIMIT))
	  {
	  	$totalPages = ($totalusers)/STATUS_PAGE_LIMIT;
	  	
	  	if(($totalPages-$currentPg)>0)
	  	{
	  		$nextpage = $currentPg+1;
	  	}
	  }
	  	
		
		return $nextpage;
	
	}
	
	
public function updateStatus($params,$changeuser){

		$eventsModel = new eventsModel();
		$eventsModel->updateStatus($params,$changeuser);


	}
	public function updateUnitStatus($params,$changeuser){
		$eventsModel = new eventsModel();
		$eventsModel-> updateUnitStatus($params,$changeuser);
	}
	
	public function updateGroupStatus($params,$changeuser){
		$units=explode(",",$params['unit']);
		$eventsModel = new eventsModel();
		$updateuser['id']=$params['user'];
		$updateuser['eventid']=$params['eventid'];
		$updateuser['status']=$params['status'];
		if(!empty($params['user']))
		{
			$eventsModel->updateGroupEmpStatus($updateuser,$changeuser);
		}
		foreach ($units as $key=>$unitid)
		{
			$updateunit['eventid']=$params['eventid'];
			$updateunit['id']=$unitid;
			$updateunit['status']=$params['status'];
			$eventsModel->updateUnitStatus($updateunit,$changeuser);
		}
	}
	
	public function deactivateEvent($event_id){
		$eventObj = new eventsModel();
		return $eventObj->deactivateEvent($event_id);

	}
/*
 * 
 * public function getDivisionsByManagers($empID,$event_id){
		
		$eventsModel = new eventsModel();
		$divisions=$eventsModel->getDivisionsByManagers($empID,$event_id);
		return $divisions;
	}	
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