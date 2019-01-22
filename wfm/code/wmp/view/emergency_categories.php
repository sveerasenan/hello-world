<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'wmpConstants.php';?>
<?php include 'meta_inc.php';?>


<!-- css -->


<?php include 'css_inc.php';?>
	

</head>
<body class="home" id="body">

<?php include 'wmpConstants.php';?>
<?php include 'top_nav.php';?>

<!-- content -->
<div class="container" id="parent">
	<div class="blockHeader text-center">
			<h3>EMERGENCY CONTACTS</h3>		
		</div>
		 <?php 
		   if($showExecs)
		   {
		 ?>
			<div class="block">	
				<hr>
				<div>				
					<a href="<?php ECHO APP_PATH ;?>/emergency_contacts&FWAction=getStaffByCat&catId=1" onclick="OpenLink(this); return false;"><span>Executive Team</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
				</div> 
			</div>
			
			 <?php 
		   }
		 ?>
	
		<div class="block">
			<hr>
			<div>				
				<a href="<?php ECHO APP_PATH ;?>/emergency_contacts&FWAction=getStaffByCat&catId=2" onclick="OpenLink(this); return false;"><span>Emergency Operations <br>Team:&nbsp;Room 106</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
		</div>
		<div class="block">
			<hr>
			<div>				
				<a href="<?php ECHO APP_PATH ;?>/emergency_contacts&FWAction=getStaffByCat&catId=3" onclick="OpenLink(this); return false;"><span>External Contacts</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>			
			</div> 
		</div>
		
		<div class="block">
			<hr>
			<div>				
				<a href="<?php ECHO APP_PATH ;?>/emergency_contacts&FWAction=getStaffByCat&catId=4" onclick="OpenLink(this); return false;"><span>Colliers International</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
			<hr>
		</div>
		
	</div>  

</body>


<!-- javascript --> 


<?php require_once("js_inc.php"); ?>
</html>