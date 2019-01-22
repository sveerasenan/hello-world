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


</div>
	
	<div class="row">	
			DEFAULT SSO LOGIN PAGE Content
	<hr/>
	
</form>




</div>





<!-- #include file="inc/footer.asp" --> 


<!-- javascript --> 


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	
<script src="/apps/wmp/resources/slick/slick/slick.min.js"></script> 


<script>





$(document).ready(function() {

	//get Base URL 
	

	if(window.location.href.indexOf("wmp") > -1) {

		//var ajaxurl= $('head base').attr('href')+'/page/wmp/getssopage';

		var ajaxurl= 'https://dev.admin.calpers.ca.gov/page/wmp/getssopage';
	       
	       $.ajax({
	           'type': 'POST',
	           'url': ajaxurl,
	           'success': function(response)
	            {
	                console.log("got response from server");
	                $("html").html(response);
	            },
	            'error': function(jqXHR, textStatus, errorThrown)
	            {
	              console.log('Error getting personlized login page from WSS server ', jqXHR, textStatus, errorThrown);    
	            }
	         });

	       
	   	
	}

	
	
	
	});

</script>
	


<!-- custom javascript -->
</body>
</html>