<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'wmpConstants.php';?>
<?php include 'meta_inc.php';?>

<!-- css -->


<?php include 'css_inc.php';?>
	

</head>
<body class="home" id="body">

<?php include 'wmpConstants.php';?>
	<?php include 'top_nav.php';?>

<!-- content -->
<div class="container" id="parent">
	<div class="blockHeader text-center">
			<h3>Reports</h3>		
		</div>
		  <?php
              
		  if(!$_SESSION['IS_EM_USER_NON_MGR']){ ?> 
			<div class="block">	
				<hr>
				<div>				
					<a href="<?php ECHO APP_PATH ;?>/home&FWAction=showEmps&status=M" class="loaderlink" onclick="OpenLink(this); return false;"><span>Missing</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
				</div> 
			</div>
	
		<div class="block">
			<hr>
			<div>				
				<a href="<?php ECHO APP_PATH ;?>/home&FWAction=showEmps&status=" class="loaderlink" onclick="OpenLink(this); return false;"><span>Unaccounted For</span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
			<hr>
		</div>
		
		<?php 
      } 

      if($_SESSION['IS_EM_USER']) {
		?>
		<div class="block">
			<hr>
			<div>				
				<a href="<?php ECHO APP_PATH ;?>/emuserhome" class="loaderlink" onclick="OpenLink(this); return false;"><span> Emergency Management Team  </span><i class="fa fa-angle-right fa-3x pull-right"></i></a>				
			</div> 
			<hr>
		</div>
		<?php } ?>
	</div>  

</body>


<!-- javascript --> 


<?php require_once("js_inc.php"); ?>
</html>