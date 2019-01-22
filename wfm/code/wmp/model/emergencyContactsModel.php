<?php 
 require_once FRAMEWORK_DIR . DS.'core'.DS. 'BasePDOMySQLModel.php';

class emergencyContactsModel extends BasePDOMySQLModel {
	
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
	
    public function getEmergencyContactsByCatId($catId){
		
		$input = array();
		
		$contacts = array(); 
		
		try
		{
			$sql="SELECT EMR_CONTACT_ID,EMP_TYPE,TITLE,SEAT_NO,SEAT,EXT_CONTACT_NAME,EE.ORG_EMPL_FNAME,ORG_EMPL_LNAME,ORG_EMPL_EMAIL,ORG_EMPL_WORK_PHONE,
				ORG_EMPL_MOBILE_PHONE,ORG_EMPL_HR_ID,ORG_UNIT_NAME FROM EOC_EMERGENCY_CONTACTS EEC 
				LEFT JOIN EOC_EMPLOYEE EE ON EE.ORG_EMPL_ID=EEC.ORG_EMPL_ID WHERE EMR_CAT_ID=:catId ORDER BY SEQUENCE ASC";
				$input[':catId'] = $catId;
				$q=$this->SQL($sql,(array)$input);
				
		               foreach ($q as $row) {
		               	
		                $NAME = $row["ORG_EMPL_FNAME"].' '.$row["ORG_EMPL_LNAME"];
		               	  if(strcasecmp($row["EMP_TYPE"], 'INT')!=0)
		               	  {
		               	  	$NAME =$row["EXT_CONTACT_NAME"];
		               	  }
							$contacts[]= array(
							        "EMR_CONTACT_ID" =>$row["EMR_CONTACT_ID"],
									"TITLE" =>$row["TITLE"],
									"SEAT_NO" =>$row["SEAT_NO"],
									"SEAT" =>$row["SEAT"],
									"EXT_CONTACT_NAME" =>$row["EXT_CONTACT_NAME"],
									"ORG_EMPL_FNAME" =>$row["ORG_EMPL_FNAME"],
									"ORG_EMPL_LNAME" =>$row["ORG_EMPL_LNAME"],
									"ORG_EMPL_EMAIL" =>$row["ORG_EMPL_EMAIL"],
									"ORG_EMPL_WORK_PHONE" =>$row["ORG_EMPL_WORK_PHONE"],
									"ORG_EMPL_MOBILE_PHONE" =>$row["ORG_EMPL_MOBILE_PHONE"],
									"ORG_EMPL_HR_ID" =>$row["ORG_EMPL_HR_ID"],
									"ORG_UNIT_NAME" =>$row["ORG_UNIT_NAME"],
							         "NAME" =>$NAME
				
				
							);
						}
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $contacts;
	}
	
	public function getEmergencyContactById($id){
		
		$input = array();
		
		$contact = array(); 
		
		try
		{
			$sql="SELECT WORK_PHONE,OTHER_PHONE,MOBILE_PHONE,ORG_DIV_NAME,EMR_CONTACT_ID,EMP_TYPE,TITLE,SEAT_NO,SEAT,EXT_CONTACT_NAME,EE.ORG_EMPL_FNAME,EE.ORG_EMPL_LNAME,ORG_EMPL_EMAIL,ORG_EMPL_WORK_PHONE,
					ORG_EMPL_MOBILE_PHONE,ORG_EMPL_HR_ID,ORG_UNIT_NAME FROM EOC_EMERGENCY_CONTACTS EEC 
					LEFT JOIN EOC_EMPLOYEE EE ON EE.ORG_EMPL_ID=EEC.ORG_EMPL_ID WHERE EMR_CONTACT_ID=:id";
				$input[':id'] = $id;
				$q=$this->SQL($sql,(array)$input);
					
					$row = $q[0];
					
					
		               
		               	  $NAME = $row["ORG_EMPL_FNAME"].' '.$row["ORG_EMPL_LNAME"];
		               	  if(strcasecmp($row["EMP_TYPE"], 'INT')!=0)
		               	  {
		               	  	$NAME =$row["EXT_CONTACT_NAME"];
		               	  }
							$contact= array(
							        "EMR_CONTACT_ID" =>$row["EMR_CONTACT_ID"],
									"TITLE" =>$row["TITLE"],
									"SEAT_NO" =>$row["SEAT_NO"],
									"SEAT" =>$row["SEAT"],
									"EXT_CONTACT_NAME" =>$row["EXT_CONTACT_NAME"],
							        "WORK_PHONE" =>$row["WORK_PHONE"],
							        "ORG_DIV_NAME" =>$row["ORG_DIV_NAME"],
							        "OTHER_PHONE" =>$row["OTHER_PHONE"],
									"MOBILE_PHONE" =>$row["MOBILE_PHONE"],
									"ORG_EMPL_FNAME" =>$row["ORG_EMPL_FNAME"],
									"ORG_EMPL_LNAME" =>$row["ORG_EMPL_LNAME"],
									"ORG_EMPL_EMAIL" =>$row["ORG_EMPL_EMAIL"],
									"ORG_EMPL_WORK_PHONE" =>$row["ORG_EMPL_WORK_PHONE"],
									"ORG_EMPL_MOBILE_PHONE" =>$row["ORG_EMPL_MOBILE_PHONE"],
									"ORG_EMPL_HR_ID" =>$row["ORG_EMPL_HR_ID"],
									"ORG_UNIT_NAME" =>$row["ORG_UNIT_NAME"],
							         "NAME" =>$NAME,
							         "EMP_TYPE" =>$row["EMP_TYPE"],
							
				
				
							);
						
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $contact;
	}
	
public function getEmergencyCategoryById($id){
		
		$input = array();
		
		
		
		try
		{
			$sql="SELECT * from EMERGENCY_CONTACT_CATEGORY WHERE EME_CAT_ID=:id";
				$input[':id'] = $id;
				$q=$this->SQL($sql,(array)$input);
				
		               
		}
		catch (\Exception $e)
		{
			//var_dump($e->getMessage());
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $q[0];
	}
	

}
?>