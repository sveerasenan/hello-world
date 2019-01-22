<?php

require_once WMP_APP_DIR .DS. 'model'. DS .'emergencyContactsModel.php';

class emergencyService{
	

	
	public function getEmergencyContactsByCatId($catId)
	{
		
		$emeModel = new emergencyContactsModel();
		
		$emegencycontacts = $emeModel->getEmergencyContactsByCatId($catId);
		
		return $emegencycontacts;
		
		
		
	}
	
   public function getEmergencyContactById($Id)
	{
		
		$emeModel = new emergencyContactsModel();
		
		$emegencycontact = $emeModel->getEmergencyContactById($Id);
		
		return $emegencycontact;
		
	}
	
public function getEmergencyCategoryById($catId)
	{
		
		$emeModel = new emergencyContactsModel();
		
		$emegencyCat = $emeModel->getEmergencyCategoryById($catId);
		
		
		return $emegencyCat;
	}
	
	
}
?>