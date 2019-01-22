<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'wmpConstants.php';?>
<?php include 'meta_inc.php';?>


<!-- css -->

<?php include 'css_inc.php';?>

</head>
<body class="home" id="body">

	<div class="navbar navbar-default navbar-fixed-top">
		<a href="<?php ECHO APP_PATH ;?>/emergency_contacts" onclick="OpenLink(this); return false;"> <button type="button" class="navbar-toggle navbar-back" id="emergency" >		
			<i class="fa fa-angle-left fa-2x pull-left"></i>		
			<span>Emergency Contacts</span>			
		</button></a>
		<a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
		<?php
     //if non EMT manager use below top nav else use EMT non manager top nav         
  if(!$_SESSION['IS_EM_USER_NON_MGR']){ ?>
	   <a href="<?php ECHO APP_PATH ;?>/home&switch=Y" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
	<?php 
  }else {

  ?>  <a href="<?php ECHO APP_PATH ;?>/emuserhome" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
	<?php 
  }
  ?>
	</div>

<!-- content -->
<div class="container" id="parent">
	<div class="blockHeader text-center">
			<h3><?php echo $teamName; ?></h3>		
		</div>
		<?php 
		
		
		foreach ($teamDetails as $val) { ?>
			<div class="block">	
				<hr>
				<div>				
					<a userid="<?php echo $val['EMR_CONTACT_ID']; ?>"><span><?php echo $val['NAME']; ?></span><i class="fa fa-angle-right fa-3x pull-right eme_contact"></i></a>				
				</div>
				<?php 
				if($val==end($teamDetails)) 
				{
				?>
				    <hr>
				<?php 
				 } ?>
			</div>
		<?php } ?>	
	</div>  
<!-- emp details model-->
<div id="em_empdetail" style="display:none" class="employee">
<div class="navbar navbar-default navbar-fixed-top">
	<button type="button" class="navbar-toggle navbar-back" id="empbck" style="display:none;">		
			<i class="fa fa-angle-left fa-2x pull-left"></i>		
			<span>Back</span>			
		</button>
		<a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
	   <a href="<?php ECHO APP_PATH ;?>/home&switch=Y" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
	  
	</div>

     
     
	<!-- content -->
	<div class="container">
	    
		<div class="page-header"> 
		
		<img src="<?php ECHO APP_PHOTOS_PATH ;?>profile.jpg" class="profile-img-circle" id="empimg" />
			<h1 id="empname" ></h1>	
		</div>		
		
		<div style="position: relative" >
		<img class="modal fade" id="imgzoom-modal" src="<?php ECHO APP_PHOTOS_PATH ;?>profile.jpg" style="width: 70%;">
		  
		</div>
		<div class="text-center"><p id="empunit" ></p></div>
		 
		
		<!-- 
		<div class="text-center" id="empstatus"></div>
		-->
		
		<hr>
		<div class="row">
			<div class="col-xs-3">
				<label>Work</label>
			</div>			
			<div class="col-xs-8"> 
			     <span id="empwrkph"></span>
				
			</div>
			<div class="col-xs-1"> <a href="#" id="empwrkphlink" ><i class="fa fa-phone fa-active fa-2x pull-right"></i></a> </div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-3">
				<label>Cell</label>
			</div>
			<div class="col-xs-8"> <span id="empcellph"></span> </div>
			<div class="col-xs-1"> <a href="#" id="empcellphlink" ><i class="fa fa-phone fa-active fa-2x pull-right"></i></a> </div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-3">
				<label>Email</label>
			</div>
			<div class="col-xs-8 email-elipsis"> <span id="empemail"></span> </div>
			<div class="col-xs-1"> <a href="#" id="empemaillink"><i class="fa fa-envelope fa-active fa-2x pull-right"></i></a> </div>
		</div>
		<hr>

	</div>
</div>
<!-- end of emp details model -->
</body>

<!-- javascript --> 

	<?php require_once("js_inc.php"); ?>
</html>