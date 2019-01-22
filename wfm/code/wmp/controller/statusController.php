<?php
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BaseController.php';
require_once FRAMEWORK_DIR . DS.'core'.DS. 'View.php';
require_once WMP_APP_DIR .DS. 'service'. DS .'eventsService.php';


class statusController extends BaseController
{
	function __construct(){
		
		if (session_id() == "")
		{
			session_start();
		}
		
	}
	
	public function index(){
	$params = $this->getSanizitedParams();
	$user_name=$params['name'];
	$eventsServiceObj= new eventsService();
	$emp_details=$eventsServiceObj->getEmpDetailsByName($user_name);
	$emp_id=$emp_details->ORG_EMPL_ID;
	$emp_loction=$emp_details->ORG_LOC_ID;
	$event_id = $eventsServiceObj->getActiveEventByDivision($emp_loction);
	if($event_id){
		$eventsServiceObj->updateStatusByUrl($emp_id,$event_id);
		$sttus=array('name'=>$user_name, 'status'=>'Marked as IN');
	}
	else{
		$sttus=array('name'=>$user_name, 'status'=>'No Active event found');
	}

		echo json_encode($sttus);
	}
	
		
}
	