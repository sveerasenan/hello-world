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

	<div class="navbar navbar-default navbar-fixed-top">
		<a href="/page/wmp/emergency_contacts"> <button type="button" class="navbar-toggle navbar-back" id="emergency" >		
			<i class="fa fa-angle-left fa-2x pull-left"></i>		
			<span>Emergency Contacts</span>			
		</button></a>
	</div>

<!-- content -->
<div class="container" id="parent">
	<div class="blockHeader text-center">
			<h3><?php echo $teamName; ?></h3>		
		</div>
		<?php foreach ($teamDetails as $key =>$val) { ?>
			<div class="block">	
				<hr>
				<div>				
					<a userid="<?php echo $val->ORG_EMPL_ID; ?>"><span><?php echo $val->ORG_EMPL_NAME; ?></span><i class="fa fa-angle-right fa-3x pull-right eme_contact"></i></a>				
				</div> 
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
	</div>

     
     
	<!-- content -->
	<div class="container">
	    
		<div class="page-header"> 
		
		<img src="/apps/wmp/resources/images/profile.jpg" class="profile-img-circle" id="empimg" />
			<h1 id="empname" ></h1>	
		</div>		
		
		<div style="position: relative" >
		<img class="modal fade" id="imgzoom-modal" src="/apps/wmp/resources/images/profile.jpg" style="width: 70%;">
		  
		</div>
		<div class="text-center"><p id="empunit" ></p></div>
		 
		
		<!-- 
		<div class="text-center" id="empstatus"></div>
		-->
		
		<hr>
		<div class="row">
			<div class="col-xs-2">
				<label>Work</label>
			</div>			
			<div class="col-xs-8"> 
			     <span id="empwrkph"></span>
				
			</div>
			<div class="col-xs-2"> <a href="#" id="empwrkphlink" ><i class="fa fa-phone fa-active fa-2x pull-right"></i></a> </div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-2">
				<label>Cell</label>
			</div>
			<div class="col-xs-8"> <span id="empcellph"></span> </div>
			<div class="col-xs-2"> <a href="#" id="empcellphlink" ><i class="fa fa-phone fa-active fa-2x pull-right"></i></a> </div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-2">
				<label>Email</label>
			</div>
			<div class="col-xs-8 email-elipsis"> <span id="empemail"></span> </div>
			<div class="col-xs-2"> <a href="#" id=empemaillink"><i class="fa fa-envelope fa-active fa-2x pull-right"></i></a> </div>
		</div>
		<hr>

	</div>
</div>
<!-- end of emp details model -->
</body>


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	
<script src="/apps/wmp/resources/slick/slick/slick.min.js"></script> 
<script src="/apps/wmp/resources/js/app.js"></script>   
</html>