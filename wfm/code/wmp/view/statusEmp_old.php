<!DOCTYPE html>
<html lang="en">
<head>

<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-startup-image" href="/apps/wmp/resources/images/splash_map.png" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="initial-scale=1.0001, minimum-scale=1.0001, maximum-scale=1.0001, user-scalable=no"/>
<title>Peeps</title>

<script>
var empdataurl = '/page/wmp/getempdetails';
var divreporsturl ='/page/wmp/getdivemps';
var unitreportsurl ='/page/wmp/getunitdirectreports';
var closeeventurl= '/page/wmp/closeEvent';
var homeurl ='/page/wmp/dash-board';

</script>


<!-- css -->


<link href="/apps/wmp/resources/css/bootstrap.min.css" rel="stylesheet" />
<link href="/apps/wmp/resources/css/jasny-bootstrap.min.css" rel="stylesheet" />
<link href="/apps/wmp/resources/slick/slick/slick.css" rel="stylesheet" />
<link href="/apps/wmp/resources/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
<!--  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">-->
<link href="/apps/wmp/resources/css/style.css" rel="stylesheet" />
<style>
#empModal{
	background:#fff none repeat scroll 0 0;
	height:545px;
	margin:0 auto;
	top:-192px;
}
.modal-header{
	border-bottom:0px !important;
}
.modal-footer{
	border-top:0px !important;
}
</style>	

</head>
<body class="home" id="body">

	<div class="navmenu navmenu-default navmenu-fixed-left offcanvas" id="eocnav" >
		<ul class="nav navmenu-nav">
			<li><a href="/page/wmp/dash-board">Home <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<li><a href="/page/wmp/emergency_contacts">Emergency Contacts <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<li><a href="/page/wmp/instructions">Instructions <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<?php if($_SESSION['roleID']==1) { ?> 
			<li><a href="/page/wmp/dash-board&FWAction=addEvent">Add Event <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<li><a href="/page/wmp/dash-board&FWAction=closeEvent">Close Active Event <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<?php } ?>
			<li><a href="signout">Sign Off <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
		</ul>
	</div>
	<div class="navbar navbar-default navbar-fixed-top">
	  <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a href="/page/wmp/dash-board"><i class="fa fa-refresh fa-lg pull-right"></i></a>
	   <a href="/page/wmp/dash-board"><i class="fa fa-home fa-lg pull-right"></i></a>
		  <a href="getevents"><i class="fa fa-exclamation-triangle fa-lg pull-right"></i></a>
	  
	</div>

<!-- content -->
<div class="container" id="parent" >
<form id="saveeventform" action="saveEventDetailsAjax" method="post">
	<input type="hidden" name="eventId" value="<?php echo $event_id ; ?>" id="eventId"/>
	<input type="hidden" name="userId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="userId"/>
	<input type="hidden" name="ManagerId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="ManagerId"/>
	
	
	
	<!-- fixed top dashboard start-->
	<div style="border-bottom: 2px solid #d1d2d4;position:fixed; top:50px;left: 0;width: 100%;padding: 0 15px;background: white;z-index: 99;">
	<div class="page-header">
		<h1><?php echo $manager_name; ?></h1>	
		<p><?php echo $designation; ?></p>	
		<i class="fa fa-chevron-right fa-2x" id="profileright"></i>		
	</div>
	
	
		    

	<div class="row ">
		<div class="col-xs-10">
		
			<div class="progress">
				<div class="progress-bar " role="progressbar" aria-valuenow="<?php echo $status_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $status_percent; ?>%;"> <span class="sr-only"><?php echo $status_percent; ?>% Complete</span> </div>
			</div>
		</div>
		<div class="col-xs-2" style="padding-left: 0;" id="topdashboardTotal">
			<span id="status_count"> <?php echo $status_count; ?> </span>/ <?php echo $unit_count; ?>
		</div>
	</div>
	<div class="status text-center">
		<div class="row">
			<div class="col-xs-4">
						<label>In</label> <span class="value" id="checkin_a"><a href="/page/wmp/dash-board&FWAction=showEmps&status=I" id="checkin"><?php echo $groupStatus['In']?$groupStatus['In']:0; ?></a></span>
					</div>
					<div class="col-xs-4">
						<label>Out</label> <span class="value" id="checkout_a"><a href="/page/wmp/dash-board&FWAction=showEmps&status=O" id="checkout"><?php echo $groupStatus['Out']?$groupStatus['Out']:0; ?></a></span>
					</div>
					
					<div class="col-xs-4">
						<label>Missing</label> 
						<span class="value" id="missing_a"><a href="/page/wmp/dash-board&FWAction=showEmps&status=M" id="missing"><?php echo $groupStatus['Missing']?$groupStatus['Missing']:0; ?></a></span> 
	
					</div>
		</div>
	</div>
	
	</div>
	
	<div style="margin-top:199px;"></div>
	<!-- fixed top dashboard end-->

	<!-- direct report employees--->

					<?php foreach($my_unit as $key=>$user )  { ?>
					<div class="slider single-item">					 
						<div class="emp_person whiteseperator <?php if($user['EOC_DIV_EMP_STATUS']==3) echo "checkmissing"; else if ($user->EOC_DIV_EMP_STATUS==1) echo "checkin"; else if($user->EOC_DIV_EMP_STATUS==2) echo "checkout"; ?>">				
					<?php if(!$user[EOC_DIV_EMP_STATUS]) { ?><img src="<?php echo $user->ORG_EMPL_IMG_FILE_NAME?$user->ORG_EMPL_IMG_FILE_NAME:$placeholder; ?>" class="img-circle"><?php } ?><span>  <?php echo $user->ORG_EMPL_FNAME ." ".$user->ORG_EMPL_LNAME ; ?></span>				
							<!-- employee information-->
						<div class="emp_container hidden">
	    
							<div class="page-header"> 
							
							<img src="resources/images/06103.png" class="profile-img-circle" id="empimg">
								<h1 id="empname"><?php echo $user->ORG_EMPL_FNAME ." ".$user->ORG_EMPL_LNAME ; ?></h1>	
							</div>		
							
							<div style="position: relative">
							<img class="modal fade" id="imgzoom-modal" src="<?php echo $user->ORG_EMPL_IMG_FILE_NAME?$user->ORG_EMPL_IMG_FILE_NAME:$placeholder; ?>" style="width: 70%;">
							  
							</div>
							<div class="text-center"><p id="empunit"><?php echo $user->ORG_EMPL_DESIGNATION; ?></p></div>
							
							<hr>
							<div class="row">
								<div class="col-xs-2">
									<label>Work</label>
								</div>			
								<div class="col-xs-8"> 
									 <span id="empwrkph"><?php echo $user->ORG_EMPL_WORK_PHONE; ?></span>
									
								</div>
								<div class="col-xs-2"> <a href="tel:<?php echo $user->ORG_EMPL_WORK_PHONE; ?>" id="empwrkphlink"><i class="fa fa-phone fa-active fa-2x pull-right"></i></a> </div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-2">
									<label>Cell</label>
								</div>
								<div class="col-xs-8"> <span id="empcellph"><?php echo $user->ORG_EMPL_MOBILE_PHONE; ?></span> </div>
								<div class="col-xs-2"> <a href="tel:<?php echo $user->ORG_EMPL_MOBILE_PHONE; ?>" id="empcellphlink"><i class="fa fa-phone fa-active fa-2x pull-right"></i></a> </div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-2">
									<label>Email</label>
								</div>
								<div class="col-xs-8 email-elipsis"> <span id="empemail"><?php echo $user->ORG_EMPL_EMAIL; ?></span> </div>
								<div class="col-xs-2"> <a href="#" id="empemaillink&quot;"><i class="fa fa-envelope fa-active fa-2x pull-right"></i></a> </div>
							</div>
							<hr>
						</div>
						<!-- end of employee information-->
						</div> 
						<div class="control" style="width: 320px;">
							<img src="<?php echo $user->ORG_EMPL_IMG_FILE_NAME?$user->ORG_EMPL_IMG_FILE_NAME:$placeholder; ?>" class="img-circle">
							<i status="1" empid="<?php echo $user->ORG_EMPL_ID ; ?>" class="emp_status fa fa-check fa-3x command pull-left <?php if($user->EOC_DIV_EMP_STATUS==1) echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i status="2" empid="<?php echo $user->ORG_EMPL_ID ; ?>" class="emp_status fa fa-times fa-3x command pull-left <?php if($user->EOC_DIV_EMP_STATUS==2) echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i status="3" empid="<?php echo $user->ORG_EMPL_ID ; ?>" class="emp_status fa fa-ban fa-3x command pull-left <?php if($user->EOC_DIV_EMP_STATUS==3) echo 'active'; else echo 'inactive'; ?> "><div class="command-divider"></div></i>
						</div>	
					</div>
					<?php } ?>
		<!-- end direct report employees--->			


  </form>
	</div>  
	<!-- modal -->
<div id="empModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="empModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
    </div>
</div>

<!-- end of modal -->
</body>


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	
<script src="/apps/wmp/resources/slick/slick/slick.min.js"></script> 
<script src="/apps/wmp/resources/js/app.js"></script>   




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
$('.emp_person').click(function(){
			var emp_details=$(this).children('.emp_container').html();
			$('#empModal').removeClass('hide');
			$('#empModal').modal('show');			
			$('#empModal .modal-body').html(emp_details);
		});	

</script>



</html>