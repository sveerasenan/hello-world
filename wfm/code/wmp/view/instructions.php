<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'wmpConstants.php';?>
<?php include 'meta_inc.php';?>


<!-- css -->


	<?php include 'css_inc.php';?>
	

</head>
<style>
.instruction {
	background-color: #070;
}

.center-block {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.instruction .item {
	margin-bottom: 60px;
}

body {
	margin: 0;
}

.container {
	margin-top: 60px;
}
</style>
<body class="instruction" id="body">

<?php include 'wmpConstants.php';?>
	<?php include 'top_nav.php';?>
	

<div class="container" >
	  
	<div class="row" >

		<div lass="col-md-12">
	
			<div id="instruction-carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#instruction-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#instruction-carousel" data-slide-to="1"></li>
					<li data-target="#instruction-carousel" data-slide-to="2"></li>
					<li data-target="#instruction-carousel" data-slide-to="3"></li>
					<li data-target="#instruction-carousel" data-slide-to="4"></li>
					<li data-target="#instruction-carousel" data-slide-to="5"></li>	
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div id="instruction0" class="item active">
					  <img src="/apps/wmp/resources/images/instructions/walkthrough_1.png" alt="..." class="center-block">
					  <div class="carousel-caption">
					  </div>
					</div>
					<div id="instruction1" class="item">
					  <img src="/apps/wmp/resources/images/instructions/walkthrough_2.png" alt="..." class="center-block">
					  <div class="carousel-caption">
					  </div>
					</div>
					<div id="instruction2" class="item">
					  <img src="/apps/wmp/resources/images/instructions/walkthrough_3.png" alt="..." class="center-block">
					  <div class="carousel-caption">
					  </div>
					</div>
					<div id="instruction3" class="item">
					  <img src="/apps/wmp/resources/images/instructions/walkthrough_4.png" alt="..." class="center-block">
					  <div class="carousel-caption">
					  </div>
					</div>	
					<div id="instruction4" class="item">
					  <img src="/apps/wmp/resources/images/instructions/walkthrough_5.png" alt="..." class="center-block">
					  <div class="carousel-caption">
					  </div>
					</div>
					<div id="instruction5" class="item">
					  <img src="/apps/wmp/resources/images/instructions/walkthrough_6.png" alt="..." class="center-block">
					  <div class="carousel-caption">
					  </div>
					</div>
		
				</div>
				 <a class="left carousel-control" href="#instruction-carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#instruction-carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
			</div>
		</div>
	</div>
</div>


</body>


<!-- javascript --> 


<script src="/apps/wmp/resources/js/jquery.min.js" > </script>
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script>
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 	 
<script>


	
$(document).ready(function() {
   var height = $(window).height();
   height -= 120;
   
   $(".item img").height( height);
});
</script>
</html>