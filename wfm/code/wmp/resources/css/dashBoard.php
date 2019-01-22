<!DOCTYPE html>
<html lang="en">
<head>

<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-startup-image" href="/apps/wmp/resources/images/splash_map.png" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
<title>Peeps</title>

<script>
var empdataurl = '/page/wmp/getempdetails';
var divreporsturl ='/page/wmp/getdivemps';
var unitreportsurl ='/page/wmp/getunitdirectreports';
var closeeventurl= '/page/wmp/closeEvent';
var homeurl ='/page/wmp/dash-board';

</script>


<!-- css -->

<?php include 'css_inc.php';?>

</head>



<body class="home" id="body">
<?php include 'wmpConstants.php';?>
	<?php include 'top_nav.php';?>
	
	
	

<!-- content -->
<div class="container" id="parent" >
<form id="saveeventform" action="saveEventDetailsAjax" method="post">
	<input type="hidden" name="eventId" value="<?php echo $event_id ; ?>" id="eventId"/>
	<input type="hidden" name="userId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="userId"/>
	<input type="hidden" name="ManagerId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="ManagerId"/>
	
	
	
	<!-- fixed top dashboard start-->
	<div style="border-bottom: 2px solid #d1d2d4;position:fixed; top:50px;left: 0;width: 100%;padding: 0 15px;background: white;z-index: 99;">
	<div class="page-header">
	     <?php
		if($loggedinmgrId != $managerId && $managerId==CEO_EMP_ID)	
		{
			?>
			<h1 class="delegatedviewheader" >Delegated CEO View</h1>	
			<?php
		}
		else {
		?>
			<h1 id="profileright" loginempid="<?php echo $loggedinmgrId; ?>"><?php echo $manager_name; ?></h1>	
			<p><?php echo $user_unit_name; ?></p>
		 <?php
		}
		?>
		<!--  
		<i class="fa fa-angle-right fa-3x" id="profileright" loginempid="<?php echo $loggedinmgrId; ?>"></i>	
		-->	
	</div>
	
	
		    

	<div class="row ">
		<div class="col-xs-9">
		
			<div class="progress">
				<div class="progress-bar " role="progressbar" aria-valuenow="<?php echo $status_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $status_percent; ?>%;"> <span class="sr-only"><?php echo $status_percent; ?>% Complete</span> </div>
			</div>
		</div>
		<div class="col-xs-3" style="padding-left: 0;" id="topdashboardTotal">
			<span id="status_count"> <?php echo empty($status_count)? '0':$status_count; ?> </span>/ <?php echo $unit_count; ?>
		</div>
	</div>
	<div class="status text-center">
		<div class="row">
			<div class="col-xs-4">
						<label>In</label> <span class="value" id="checkin_a"><a href="#" id="checkin" class="newpagebug"><?php echo $groupStatus['INCNT']?$groupStatus['INCNT']:0; ?></a></span>
					</div>
					<div class="col-xs-4">
						<label>Out</label> <span class="value" id="checkout_a"><a href="#" id="checkout" class="newpagebug"><?php echo $groupStatus['OUTCNT']?$groupStatus['OUTCNT']:0; ?></a></span>
					</div>
					
					<div class="col-xs-4">
						<label>Missing</label> 
						<span class="value" id="missing_a"><a href="#" id="missing" class="newpagebug"><?php echo $groupStatus['MISS']?$groupStatus['MISS']:0; ?></a></span> 
	
					</div>
		</div>
	</div>
	<div class="group_status text-center hidden">
		<div class="row">
			<div class="col-xs-4">

				<span class="group_change_status fa fa-check fa-3x inactive" status="I"><div class="command-divider"></div></span>
			</div>
			<div class="col-xs-4 st_out">
		
				<span class="group_change_status fa fa-times fa-3x inactive" status="O"><div class="command-divider"></div></span>
			</div>
			<div class="col-xs-4">	
	
				<span class="group_change_status fa fa-ban fa-3x inactive" status="M" ><div class="command-divider"></div></span>
			</div>	
		</div>
		<div class="group_cancel">
			<div style="float:left;" class="cancel_select"> Cancel </div>
			<div style="float:right;"> Select one or more</div>
		</div>
	</div>
	</div>
	
	<div style="margin-top:200px;"></div>
	<!-- fixed top dashboard end-->
	<!-- back to parent unit -->
	<?php if($subunit) { ?> 
	
	<!-- fixed icon nav bar start -->
	<div style="border-bottom: 2px solid #d1d2d4;position:fixed; top:250px;left: 0;width: 100%;padding: 0 15px;background: white;z-index: 99;">
	
		<div class="singledivision topdivslider single-item slider subunit" >
				<div>
				
				<a href="/page/wmp/dash-board<?php echo '&id='.$subunitmgrid; ?>" class="newpagebug"><span class="sumanager"><?php echo $unit_parents[$subunitmgrid]['name'];?></span><img src="<?php echo $unit_parents[$subunitmgrid]['image']?'/apps/wmp/resources/images/'.$unit_parents[$subunitmgrid]['image'].'.png':$placeholder; ?>" class="img-circle"></a>
				
				<?php 
				
					foreach ($first_parentarray as $key=>$value){ 
				    
						 if($value>0)
						 {
					?>
						<i class="fa fa-angle-double-right" id="nav-angel-right"></i>
						<a  href="/page/wmp/dash-board<?php if($value != $loggedinmgrId) echo '&id='.$value; ?>" class="newpagebug">
						<span class="sumanager">
						<?php echo $unit_parents[$value]['name'];?></span>
						<img src="<?php echo $unit_parents[$value]['image']?'/apps/wmp/resources/images/'.$unit_parents[$value]['image'].'.png':$placeholder; ?>" class="img-circle">
						</a>
						
				<?php
						 }
                  } ?>	
				</div>
				
		</div>
		
		</div><!-- end icon nav bar -->
		
		<div style="margin-top:270px;"></div>
	<?php } ?> 	
	<!-- end back to parent unit -->
	<!-- direct report employees--->

					<?php foreach($my_unit as $key=>$user ) 
                
					{ 
						
						if($division_count)
						{
						$unit_name=$user['ORG_DIV_NAME'];
						}
						else
						{
							$unit_name=$user['ORG_UNIT_NAME'];
						}
					
					
					
					
					    
						?>
					<div class="slider single-item<?php if($event_id) echo ' selectuser';?>">	
						<input class="hidden udetails" utype="user" uid="<?php echo $user['ORG_EMPL_ID'] ; ?>" select="">
						
						<div userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_person whiteseperator <?php if($user['EOC_EVENT_EMP_STATUS']=='M') echo "checkmissing"; else if ($user['EOC_EVENT_EMP_STATUS']=='I') echo "checkin"; else if($user['EOC_EVENT_EMP_STATUS']=='O') echo "checkout"; ?>">				
					<?php 
					$empImghiddenclass ="hidden";
					if($user[EOC_EVENT_EMP_STATUS]=='') { 
						$empImghiddenclass ="";
					}
					?>
						<img src="<?php echo $user['ORG_EMPL_HR_ID']?'/apps/wmp/resources/images/'.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle <?php echo $empImghiddenclass ; ?>">
					
					<span class="empname">  <?php echo $user['ORG_EMPL_FNAME'] ." ".$user['ORG_EMPL_LNAME'] ; ?><br/><?php echo $user['ORG_UNIT_NAME'] ; ?></span>				

						</div> 
						
						<div class="control" style="width: 320px;">
							<img userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" src="<?php echo $user['ORG_EMPL_HR_ID']?'/apps/wmp/resources/images/'.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle emp_person">
							<i cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="I" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-check fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='I') echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="O" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-times fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='O') echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="M" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-ban fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='M') echo 'active'; else echo 'inactive'; ?> "><div class="command-divider"></div></i>
						</div>	
						
					</div>
					<?php if($user['ORG_EMPL_ISMGR']==1){ 
						
						$unitlevelstyle="unit";
						
						if($user['unit_current_status']=='I') 
						{
							$unitlevelstyle="checkin";
						}
						else if($user['unit_current_status']=='M') 
						{
							$unitlevelstyle="checkmissing";
						}
					    else if($user['unit_current_status']=='O') 
						{
							$unitlevelstyle="checkout";
						}
					
					?>
					
						<div class="division slider single-item<?php if($event_id) echo ' selectuser';?>" >
							<input class="hidden udetails" utype="unit" uid="<?php echo $user['ORG_EMPL_ID'] ; ?>" select="">						
							<div class="emp_unit whiteseperator <?php echo $unitlevelstyle;?>">
							  
							<span class="value" divid="" empid = "<?php echo $user['ORG_EMPL_ID'] ; ?>" eventid="<?php echo $event_id ; ?>"><?php echo $unit_name ; ?> <br/> </span>
							<span class="units-stats" id="unitstatus<?php echo $user['ORG_EMPL_ID']; ?>" total="<?php echo $user['unit_total'];?>"><?php echo $user['unit_status'] ; ?>/<?php echo $user['unit_total']?$user['unit_total']:0 ; ?>&nbsp;(&nbsp;<?php echo $user['unit_in']?$user['unit_in']:0 ; ?>&nbsp;|&nbsp;<?php echo $user['unit_out']?$user['unit_out']:0 ; ?>&nbsp;|&nbsp;<?php echo $user['unit_miss']?$user['unit_miss']:0 ; ?>&nbsp;)</span>
							<i class="fa fa-angle-right fa-3x expander"></i>
							
							</div>
							
							<div class="control" >
								<span class="unit_name value"><?php echo $user['ORG_UNIT_NAME'] ; ?>  </span>
								<i class="unit_status fa fa-check fa-3x command pull-left<?php if($user['unit_current_status']=='I') echo ' active'; else echo ' inactive'; ?>" cstatus="<?php echo $user['unit_current_status']?>" status="I" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>"><div class="command-divider"></div></i>
								<i class="unit_status fa fa-times fa-3x command pull-left <?php if($user['unit_current_status']=='O') echo ' active'; else echo ' inactive'; ?>" cstatus="<?php echo $user['unit_current_status']?>" status="O" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>"><div class="command-divider"></div></i>
								<i class="unit_status fa fa-ban fa-3x command pull-left <?php if($user['unit_current_status']=='M') echo ' active'; else echo ' inactive'; ?>" cstatus="<?php echo $user['unit_current_status']?>" status="M" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>"><div class="command-divider"></div></i>
							</div>
													
						</div>
					<?php }  } ?>
		<!-- end direct report employees---> 
		
		
		<!-- consultants -->
		<?php foreach($consultants as $key=>$user )  { ?>
					<div class="slider single-item<?php if($event_id) echo ' selectuser';?>">	
<input class="hidden udetails" utype="user" uid="<?php echo $user['ORG_EMPL_ID'] ; ?>" select="">					
						<div userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_person whiteseperator <?php if($user['EOC_EVENT_EMP_STATUS']=='M') echo "checkmissing"; else if ($user['EOC_EVENT_EMP_STATUS']=='I') echo "checkin"; else if($user['EOC_EVENT_EMP_STATUS']=='O') echo "checkout"; ?>">	
						
						<?php 
					$consImghiddenclass ="hidden";
					if($user[EOC_EVENT_EMP_STATUS]=='') { 
						$consImghiddenclass ="";
					}
					?>
									
					<img src="<?php echo $user['ORG_EMPL_HR_ID']?'/apps/wmp/resources/images/'.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle <?php echo $consImghiddenclass ; ?>">
					<span class="empname">  <?php echo $user['ORG_EMPL_FNAME'] ." ".$user['ORG_EMPL_LNAME'] ; ?><br/>Consultant</span>				
							<!-- employee information-->
						
						<!-- end of employee information-->
						</div> 
						
						<div class="control" style="width: 320px;">
							<img userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" src="<?php echo $user['ORG_EMPL_HR_ID']?'/apps/wmp/resources/images/'.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle emp_person">
							<i cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="I" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-check fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='I') echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="O" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-times fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='O') echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="M" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-ban fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='M') echo 'active'; else echo 'inactive'; ?> "><div class="command-divider"></div></i>
						</div>	
						
					</div>
				<?php } ?>	
		<!-- End of consultants display -->
  </form>
	</div>  
	<!-- modals -->
	<?php require_once("common_modals.php"); ?>
<!-- end of modals -->
</body>

	<?php require_once("js_inc.php"); ?>
<!-- javascript --> 





<!--[if lt IE 9]>
      <script src="/wmp/resources/js/html5shiv.min.js"></script>
      <script src="/wmp/resources/js/respond.min.js"></script>
<![endif]--> 

	

<script type="text/javascript">
$('.single-item').slick({
		arrows:	false,
		infinite: false,
		speed: 0
	});	




</script>



</html>