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
<div class="container" id="parent">
	<div class="blockHeader text-center">
			<h3>EMERGENCY CONTACTS</h3>		
		</div>
			<div class="block">	
				<hr>
				<div>				
					<a href="/page/wmp/emergency_contacts&FWAction=getStaffByTeam&team=execstaff"><span>Executive Staff</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
				</div> 
			</div>
		
		<div class="block">
			<hr>
			<div>				
				<a href="/page/wmp/emergency_contacts&FWAction=getStaffByTeam&team=eotsupport"><span>Emergency Operations <br>Team:&nbsp;Support</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
		</div>
		<div class="block">
			<hr>
			<div>				
				<a href="/page/wmp/emergency_contacts&FWAction=getStaffByTeam&team=eot106"><span>Emergency Operations <br>Team:&nbsp;Room 106</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
		</div>
		<div class="block">
			<hr>
			<div>				
				<a href="/page/wmp/emergency_contacts&FWAction=getStaffByTeam&team=externalcontacts"><span>External Contacts</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>			
			</div> 
		</div>
		
		<div class="block">
			<hr>
			<div>				
				<a href="/page/wmp/emergency_contacts&FWAction=getStaffByTeam&team=colliers"><span>Colliers International</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
			<hr>
		</div>
		
	</div>  

</body>


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	
<script src="/apps/wmp/resources/slick/slick/slick.min.js"></script> 
<script src="/apps/wmp/resources/js/app.js"></script>   
</html>