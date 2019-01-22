<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'wmpConstants.php';?>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-startup-image" href="<?php ECHO APP_RESOURCE_PATH ;?>/images/splash_map.png" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<title>Peeps</title>

<!-- css -->
<link href="<?php ECHO APP_RESOURCE_PATH ;?>/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php ECHO APP_RESOURCE_PATH ;?>/css/jasny-bootstrap.min.css" rel="stylesheet" />
<link href="<?php ECHO APP_RESOURCE_PATH ;?>/slick/slick/slick.css" rel="stylesheet" />

<link href="<?php ECHO APP_RESOURCE_PATH ;?>/css/style.css" rel="stylesheet" />

<link rel="apple-touch-icon" href="<?php ECHO APP_RESOURCE_PATH ;?>/images/Wheres_My_Peeps.png"/>

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
		<div class="col-xs-12 text-center"> <img src="<?php ECHO APP_RESOURCE_PATH ;?>/images/login_logo.png" /> </div>
	</div>
	<hr/>

	
<div class="row" id="invaliduserpwd">

 

  <div class="col-xs-12 text-center">

    <div class="alert alert-danger" role="alert">You have entered an incorrect username and password combination. Try again. If you exceed 3 failed attempts,your account will be locked.</div>

  </div>
</div>

<div class="row" id="notmgr">

 

  <div class="col-xs-12 text-center">

    <div class="alert alert-danger" role="alert">User access to this system is restricted. Please contact the system administrator for access.</div>

  </div>
</div>
	
	<div class="row">	
		<div class="col-xs-3 text-center"> <img src="<?php ECHO APP_RESOURCE_PATH ;?>/images/username_icon.png" width="26" height="26"/> </div>
		<div class="col-xs-9"> <input id="username" type="text" class="form-control" placeholder="username" name="username" value=""/> </div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-xs-3 text-center"> <img src="<?php ECHO APP_RESOURCE_PATH ;?>/images/password_icon.png" width="23" height="27"/> </div>
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
 
          <p><small>WARNING: You have accessed a private computer system. Use of this system is restricted to authorized users. User activity is monitored and recorded by system personnel. Anyone using this system expressly consents to such monitoring and recording. BE ADVISED: If possible criminal activity is detected, system records, along with certain personal information, may be provided to law enforcement officials.</small></p>
 
  </div>

</div>



</div>


<?php require_once("loader.php"); ?>


<!-- #include file="inc/footer.asp" --> 


<!-- javascript --> 


<!-- javascript --> 


<script src="<?php ECHO APP_RESOURCE_PATH ;?>/js/jquery.min.js" > </script>
<script src="<?php ECHO APP_RESOURCE_PATH ;?>/js/bootstrap.min.js"></script>
<script src="<?php ECHO APP_RESOURCE_PATH ;?>/js/jasny-bootstrap.min.js"></script> 	
<script src="<?php ECHO APP_RESOURCE_PATH ;?>/slick/slick/slick.min.js"></script> 


<script>



function validate(){
    if($('#username').val() !== '' && $('#pwd').val() !== '')
    	$("#loginbtn").removeAttr('disabled');
    else
    	$("#loginbtn").attr('disabled', 'disabled');
}

$(document).ready(function() {
	
	$('.loader').hide();

	$('#invaliduserpwd').hide();

	$('#notmgr').hide();


    //if invalid user password error show 
	if(window.location.href.indexOf("OAM-") > -1) {
		$('#invaliduserpwd').show();
	}
	if(window.location.href.indexOf("peeps101") > -1) {
		$('#invaliduserpwd').show();
	}

    //unauthorized user
	if(window.location.href.indexOf("peeps102") > -1) {
		$('#notmgr').show();
	}

	

	


	//

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