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
<style>

#event_description {
    border: 1px solid #bbbdc0;
}

input.eventstartdate {
    border: 1px solid #bbbdc0;
    margin: 0px;
    height: 44px;
}


element {

}
#createeventform label {
    margin: 0px 0px 10px 0px !important;
    padding: 0px !important;
}

#createeventform select {
    border: 1px solid #bbbdc0;
    border-radius: 4px;
    height: 44px;
    margin-left: -12px;
}

.input-group.date {
    margin-left: -12px;
}

</style>

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
<div class="container" id="parent" >
	 <div class="page-header">
<h2>Create Event</h2>
	</div>
	<?php if($activeevent) {  ?> 
	<P> Event is Active  Please Colse current  Active event </p>
	<?php } else { ?>
  <form  method="POST" name="createeventform" id="createeventform" class="col-xs-12" action="/page/wmp/dash-board&FWAction=createEvent">
 
   <div class="form-group col-xs-12">
		<label class="col-xs-6"> Event Type :</label> 
		<select  class="select2" id="event_type" name="event_type">
		<?php foreach ($eventTypes as $key=>$val){ ?>
		  <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
		  <?php } ?>
		</select>
		<hr>
	</div>
	
	<div class="form-group col-xs-12">

		<label class="col-xs-12"> Event Description : </label>
		
		<textarea class="form-control" id="event_description" rows="3" name="event_desc" placeholder="Enter Description"></textarea> 
	<hr>	
	</div>
	
	<!--<div class="form-group col-xs-12">

		<label class="col-xs-6"> Location : </label>
		<select  class="select2" id="location" name="location">
		<?php foreach ($locations as $key=>$val){ ?>
		  <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
		  <?php } ?>
		</select>
	<hr>	
	</div>-->
	
	<div class="form-group col-xs-12">

		<label style="font-weight:bold; margin-bottom:10px; padding-left:0">Start Date </label>
		<div class="input-group date"> <input id="start" class="form-control eventstartdate" name="event_start" type="text"  >
			<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
		</div>
	<hr>	
	</div>
	
	<div class="form-group col-xs-12 text-center">
	<button id="create_event" class="btn btn-primary">Submit</button>
	</div>
	
	</form>
	<?php } ?>
</div>  

</body>


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	
<script src="/apps/wmp/resources/slick/slick/slick.min.js"></script> 
<script src="/apps/wmp/resources/js/app.js"></script>   
<script src="/apps/wmp/resources/js/bootstrap-datepicker.min.js"></script>




<!--[if lt IE 9]>
      <script src="/RollCall/resources/js/html5shiv.min.js"></script>
      <script src="/RollCall/resources/js/respond.min.js"></script>
<![endif]--> 

	

<script type="text/javascript">

$('.date').each(function() {
            $(this).datepicker({
        autoclose: true
    });
        });
</script>



</html>