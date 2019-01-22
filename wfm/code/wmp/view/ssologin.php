<!DOCTYPE html>
<html lang="en">
<head>
 <base href="https://dev.admin.calpers.ca.gov">
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-startup-image" href="/apps/wmp/resources/images/splash_map.png" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<title>Peeps</title>

<!-- css -->
<link href="/apps/wmp/resources/css/bootstrap.min.css" rel="stylesheet" />
<link href="/apps/wmp/resources/css/jasny-bootstrap.min.css" rel="stylesheet" />
<link href="/apps/wmp/resources/slick/slick/slick.css" rel="stylesheet" />

<link href="/apps/wmp/resources/css/style.css" rel="stylesheet" />

<link rel="apple-touch-icon" href="/apps/wmp/resources/images/Wheres_My_Peeps.png"/>

<style>
	.login-logo-container {
		padding: 50px 0;
	}
	
	.container {}
	
	.centerContainer {
		width: 100%;
	}
	
	body { margin: 0; }
</style>

</head>
<body>
<!-- #include file="inc/header.asp" --> 

<!-- content -->
<div class="container">
<div class="centerContainer">

<form method="Post" id="loginform">
<input type="hidden" name="FWAction" value="process"/>
 <input type="hidden" name="_csrf" value="<?php echo $csrftoken;?>" />
	<div class="row login-logo-container">
		<div class="col-xs-12 text-center"> <img src="/apps/wmp/resources/images/login_logo.png" /> </div>
	</div>
	<hr/>
	<?php  if(!empty($errorMsg))
	{
	?>
	

<div class="row">

 

  <div class="col-xs-12 text-center">

    <div class="alert alert-danger" role="alert"><?php echo $errorMsg;?></div>

  </div>
  <?php
	}
	?>

 

</div>
	
	<div class="row">	
		<div class="col-xs-3 text-center"> <img src="/apps/wmp/resources/images/username_icon.png" width="26" height="26"/> </div>
		<div class="col-xs-9"> <input id="username" type="text" class="form-control" placeholder="username" name="username" value=""/> </div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-xs-3 text-center"> <img src="/apps/wmp/resources/images/password_icon.png" width="23" height="27"/> </div>
		<div class="col-xs-9"> <input id="pwd" type="password" class="form-control" placeholder="password" name="password" value=""/> </div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-xs-12 text-center">
			<button id="loginbtn" type="submit" class="btn btn-default navbar-btn" >Login</button>
		</div>
	</div>
</form>

<div class="row legal-warning">
 
          <p><small>SSO Pge WARNING: You have accessed a private computer system. Use of this system is restricted to authorized users. User activity is monitored and recorded by system personnel. Anyone using this system expressly consents to such monitoring and recording. BE ADVISED: If possible criminal activity is detected, system records, along with certain personal information, may be provided to law enforcement officials.</small></p>
 
  </div>

</div>



</div>


<?php require_once("loader.php"); ?>


<!-- #include file="inc/footer.asp" --> 


<!-- javascript --> 


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	
<script src="/apps/wmp/resources/slick/slick/slick.min.js"></script> 


<script>


$('.loader').hide();

function validate(){
    if($('#username').val() !== '' && $('#pwd').val() !== '')
    	$("#loginbtn").removeAttr('disabled');
    else
    	$("#loginbtn").attr('disabled', 'disabled');
}

$(document).ready(function() {
	
	

	//console.log("after show");
	
	$("#loginbtn").attr('disabled', 'disabled');
	
	 // Validate after user input
    $('#username, #pwd').on('keyup change', validate);

    // Validate on mouse enter of body and login form
    // to catch auto-fills from roboform/1password etc...
    $('body, #loginform').on('mouseenter', validate);

    // Validate onload incase of autocomplete/autofill
    validate();
    
    $(' #username, #pwd').focus(function(){
    	   $(this).data('placeholder',$(this).attr('placeholder'))
    	          .attr('placeholder','');
    	}).blur(function(){
    	   $(this).attr('placeholder',$(this).data('placeholder'));
    	});
    
    $('#loginform').submit(function() {
    	$('.loader').show();
        return true;
      });
    
	
	
	});

</script>
	


<!-- custom javascript -->
</body>
</html>