<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'wmpConstants.php';?>
<?php include 'meta_inc.php';?>
<!-- css -->


<?php include 'css_inc.php';?>

</head>



<body class="home" id="body">


	<?php include 'top_nav.php';?>

	

<!-- content -->
<div class="container" id="parent" >
<form id="saveeventform" action="saveEventDetailsAjax" method="post">
	<input type="hidden" name="eventId" value="<?php echo $event_id ; ?>" id="eventId"/>
	<input type="hidden" name="userId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="userId"/>
	<input type="hidden" name="ManagerId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="ManagerId"/>
	<input type="hidden" name="pageId" value="rpt" id="pageId"/>
	
	
	
	<!-- fixed top dashboard start-->
	<div class="page-header">
		<h1>Manage Events</h1>	
		
		
	</div>
	
	<hr>
	<?php
	
	   
	  $eventMsg = "There are currently no active events.";
	  $showCreateEventBtn = TRUE;
	  $showAllClearBtn = FALSE;
	  $showCloseEventBtn = FALSE;
		if(!empty($currEvnt))	
		{
			$eventMsg = $currEvnt['EVENT_MSG'];
			
			if($currEvnt['LOV_EVENT_STATUS_ID']==EVACUATION_STATUS)
			{
				  $showCreateEventBtn = FALSE;
				  $showAllClearBtn = TRUE;
				  $showCloseEventBtn = FALSE;
				
			}
			else if($currEvnt['LOV_EVENT_STATUS_ID']==ALL_CLEAR_STATUS)
			{
				 $showCreateEventBtn = FALSE;
				  $showAllClearBtn = FALSE;
				  $showCloseEventBtn = TRUE;
				
			}
			
		}
		?>
		<div class="row">
			<div class="col-xs-12" style="display:block";>
			 
				<label><?php echo $eventMsg; ?></label>
			</div>			
			
		</div>
		<?php 
				$eventStatusMsgPrefix ="";
					foreach ($currEvntStatuses as $key=>$evntStatus){ 
						
						if($evntStatus['LOV_EVENT_STATUS_ID']==EVACUATION_STATUS)
						{
							$eventStatusMsgPrefix ="Event Declared ";
						}
						else if($evntStatus['LOV_EVENT_STATUS_ID']==ALL_CLEAR_STATUS)
						{
							$eventStatusMsgPrefix ="All Clear issued ";
						}
						else if($evntStatus['LOV_EVENT_STATUS_ID']==CLOSED_STATUS)
						{
							$eventStatusMsgPrefix ="Event Closed ";
						}
			?>	    
		<div class="row">
			<div class="col-xs-12" style='display:block;padding:10px 15px;'>
				<label><?php echo $eventStatusMsgPrefix.' at '.$evntStatus['CHANGE_TIME']; ?> </label><br/>
				<label><?php echo $eventStatusMsgPrefix.' by '.$evntStatus['ORG_EMPL_FNAME'].' '.$evntStatus['ORG_EMPL_LNAME']; ?></label>
			</div>			
			
		</div>
		<?php
		}
		?>
		
		<?php
	     //SHOW CREATE EVENT BUTTON
		if(($showCreateEventBtn))	
		{
		?>
			<div class="row">
			<div class="col-sm-12">
   				 <div class="text-center">
			<a class="dt-button btn btn-default" href="#" id="declareEvntBtn"><span>Declare New Event</span></a>
			</div>
			</div>
			</div>
		<?php
		}
		
	       //SHOW ALL CLEAR BUTTON  
		if(($showAllClearBtn))	
		{
		?>
			<div class="row"">
			<div class="col-sm-12">
   				 <div class="text-center">
			<a class="dt-button btn btn-default" href="#" id="allclearEvntBtn"><span>Issue All Clear</span></a>
			</div>
			</div>
			</div>
		<?php
		}
		
	       //SHOW CLOSE EVENT BUTTON  
		if(($showCloseEventBtn))	
		{
		?>
			<div class="row" >
			<div class="col-sm-12">
   				 <div class="text-center">
			<a class="dt-button btn btn-default" href="#" id="closeEvntBtn"><span>Close Event</span></a>
			</div>
			</div>
			</div>
		<?php
		}
		?>
		<hr>
	
	
		    



	
	
	
	
	
		
  </form>
	</div>  
		<!-- modals -->
	<?php require_once("common_modals.php"); ?>
<!-- end of modals -->
</body>


<!-- javascript --> 


<?php require_once("js_inc.php"); ?>  




<!--[if lt IE 9]>
      <script src="/wmp/resources/js/html5shiv.min.js"></script>
      <script src="/wmp/resources/js/respond.min.js"></script>
<![endif]--> 

	




</html>