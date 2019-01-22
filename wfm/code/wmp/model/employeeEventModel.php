<?php 
require_once FRAMEWORK_DIR . DS.'core'.DS. 'BasePDOMySQLModel.php';

//Change Class name to match filename
class employeeEventModel extends BasePDOMySQLModel {
	
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

}
?>