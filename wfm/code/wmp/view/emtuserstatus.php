<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'wmpConstants.php';?>
<?php include 'meta_inc.php';?>


<!-- css -->


<?php include 'css_inc.php';?>

</head>



<body class="home" id="body">

<?php include 'loader.php';?>

 <?php
              
			if($_SESSION['IS_EM_USER_NON_MGR']){ ?> 
	<?php include 'top_nav.php';?>
	
	<?php 
	}else { 
	
	?>
	<div class="navbar navbar-default navbar-fixed-top">
		<a href="<?php ECHO APP_PATH ;?>/report" onclick="OpenLink(this); return false;"> <button type="button" class="navbar-toggle navbar-back"  >		
			<i class="fa fa-angle-left fa-2x pull-left"></i>		
			<span>Reports</span>			
		</button></a>
		 <a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
	   <a href="<?php ECHO APP_PATH ;?>/home&switch=Y" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
	  
	</div>
	<?php 
	}
	
	?>

<!--  
	<div class="navbar navbar-default navbar-fixed-top">
		
		 <a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
		 <?php
              
			if($_SESSION['IS_EM_USER_NON_MGR']){ ?> 
	   <a href="signout" onclick="OpenLink(this); return false;"><i class="fa fa-sign-out fa-lg pull-right"></i></a>
	  <?php } ?>
		 <?php
              
			if(!$_SESSION['IS_EM_USER_NON_MGR']){ ?> 
	   <a href="/page/wmp/home&switch=Y" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
	  <?php } ?>
	</div>
-->
<!-- content -->
<div class="container" id="parent" >
<form id="saveeventform" action="saveEventDetailsAjax" method="post">
	<input type="hidden" name="eventId" value="<?php echo $event_id ; ?>" id="eventId"/>
	<input type="hidden" name="userId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="userId"/>
	<input type="hidden" name="ManagerId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="ManagerId"/>
	<input type="hidden" name="pageId" value="rpt" id="pageId"/>
	
	
	<!-- fixed top dashboard start-->
	<div style="border-bottom: 2px solid #d1d2d4;position:fixed; top:50px;left: 0;width: 100%;padding: 0 15px;background: white;z-index: 99;">
	<div class="page-header">
	    
			<h1 class="delegatedviewheader" >EMT User View</h1>	
			
		
	</div>
	
	<?php 
	$green="";
	
	$status_count=empty($status_count)? '0':$status_count; 
	
	if($status_count>0 && $status_count==$unit_count)
	{
		$green="green";
	}
	
	?>
		    

	<div class="row <?php echo $green;?>" id="progressrow">
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
	
	</div>
	
	<div style="margin-top:200px;"></div>
	<!-- fixed top dashboard end-->
	<!-- back to parent unit -->
	<?php if($subunit) { ?> 
	<!-- fixed icon nav bar start -->
	<div style="border-bottom: 2px solid #d1d2d4;position:fixed; top:250px;left: 0;width: 100%;padding: 0 15px;background: white;z-index: 99;">
	
		<div class="singledivision topdivslider single-item slider subunit" >
				<div style="padding-left:0px">
				<?php if($cuser != $loggedinmgrId){?> 
				<a href="<?php ECHO APP_PATH ;?>/home<?php if($cuser != $loggedinmgrId) echo '&id='.$cuser; ?>"><img src="<?php echo $unit_parents[$cuser]['image']?APP_PHOTOS_PATH.$unit_parents[$cuser]['image'].'.png':$placeholder; ?>" class="img-circle"><span class="sumanager"><?php echo $unit_parents[$cuser]['name'];?></span></a>
				<?php } ?>
				<?php 
				
								foreach ($first_parentarray as $key=>$value){ 
				  // echo $unit_parents[$value]['image'];
				  
					//var_dump($unit_parents[$value]) ;
				   
					?>
						<i class="fa fa-angle-double-right" id="nav-angel-right"></i><a  href="<?php ECHO APP_PATH ;?>/home<?php if($value != $loggedinmgrId) echo '&id='.$value; ?>"><img src="<?php echo $unit_parents[$value]['image']?APP_PHOTOS_PATH.$unit_parents[$value]['image'].'.png':$placeholder; ?>" class="img-circle"><span class="sumanager"><?php echo $unit_parents[$value]['name'];?></span></a>
						<!--<span class="value" ><?php echo $subunit->ORG_UNIT_NAME; ?>  | <?php echo $mgr_Unit_status_count; ?> / <?php echo $total_mgr_unit_count; ?> </span>-->
				<?php } ?>	
				</div>
				<?php if($event_id) { ?>
				<div class="control" >
					<?php if($second_parentarray){foreach ($second_parentarray as $key=>$value){ ?>
					//var_dump($unit_parents[$value]) ;
						<i class="fa fa-angle-double-right nav-angel-right" id="nav-angel-right"><a  href="<?php ECHO APP_PATH ;?>/home<?php if($value != $loggedinmgrId) echo '&id='.$value; ?>"><img src="<?php echo $unit_parents[$value]['image']?APP_PHOTOS_PATH.$unit_parents[$value]['image'].'.png':$placeholder; ?>" class="img-circle"><span class="sumanager"><?php echo $unit_parents[$value]['name'];?></span></a>
						<!--<span class="value" ><?php echo $subunit->ORG_UNIT_NAME; ?>  | <?php echo $mgr_Unit_status_count; ?> / <?php echo $total_mgr_unit_count; ?> </span>-->
					<?php } } ?>
				</div>
				<?php } ?> 
		</div>
		
		</div><!-- end icon nav bar -->
		
		<div style="margin-top:270px;"></div>
	<?php } ?> 	
	<!-- end back to parent unit -->
	
	<!-- no records row start -->
	<?php  if(empty($employees))
	{
	?>
	<div class="row">

 

  <div class="col-xs-12 text-center">

    <div class="alert alert-danger" role="alert">There are currently no staff that are Missing.</div>

  </div>
    </div>
  <?php
	}
	?>
	<!-- no records row end -->
	
		<!-- employees -->
		<?php foreach($employees as $key=>$user )  { ?>
					<div class="staff slider single-item<?php if($event_id) echo ' selectuser';?>">	
<input class="hidden udetails" utype="user" uid="<?php echo $user['ORG_EMPL_ID'] ; ?>" select="">					
						<div userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_person whiteseperator <?php if($user['EOC_EVENT_EMP_STATUS']=='M') echo "checkmissing"; else if ($user['EOC_EVENT_EMP_STATUS']=='I') echo "checkin"; else if($user['EOC_EVENT_EMP_STATUS']=='O') echo "checkout"; ?>">	
						
						<?php 
					$consImghiddenclass ="hidden";
					if($user[EOC_EVENT_EMP_STATUS]=='') { 
						$consImghiddenclass ="";
					}
					?>
					<!--  			
					<img src="<?php echo $user['ORG_EMPL_HR_ID']?APP_PHOTOS_PATH.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle <?php echo $consImghiddenclass ; ?>">
					-->	
					<span class="empname">  <?php echo $user['ORG_EMPL_FNAME'] ." ".$user['ORG_EMPL_LNAME'] ; ?><br/>
					<?php 
					$empDesig = $user['ORG_UNIT_NAME'];
					if(strcasecmp($user['ORG_EMPL_DESIGNATION'],'Consultant')== 0)
					{
						$empDesig = 'Consultant';
					}
					echo $empDesig;
					?>
					</span>				
							<!-- employee information-->
						
						<!-- end of employee information-->
						</div> 
						<!--  
						<div class="control" style="width: 320px;">
							<img userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" src="<?php echo $user['ORG_EMPL_HR_ID']?'/apps/wmp/resources/images/'.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle emp_person">
							<i empstatuspgInd="1" cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="I" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-check fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='I') echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i empstatuspgInd="1" cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="O" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-times fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='O') echo 'active'; else echo 'inactive'; ?>"><div class="command-divider"></div></i>
							<i empstatuspgInd="1" cstatus="<?php echo $user['EOC_EVENT_EMP_STATUS']?>" status="M" empid="<?php echo $user['ORG_EMPL_ID'] ; ?>" class="emp_status fa fa-ban fa-3x command pull-left <?php if($user['EOC_EVENT_EMP_STATUS']=='M') echo 'active'; else echo 'inactive'; ?> "><div class="command-divider"></div></i>
						</div>	
						-->
					</div>
				<?php } 	
		
		
		if ($next_page==0) {
						
						?>
						
						<hr class="slide-border-lastrow"/>
						
						<?php 
        
                       }
													
						?>
		
		<span class="load-more" pageno="<?php echo $next_page; ?>"></span>
		
		<!-- End of consultants display -->
  </form>
	</div>  
	<!-- modals -->
	</div>
	<?php require_once("common_modals.php"); ?>
	
	

<!-- end of modals -->
</body>


<!-- javascript --> 


<?php require_once("js_inc.php"); ?>   




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

<script type="text/javascript">

//$(".loader").show();

$(window).load(function() {
	console.log("fader called");
	
	$(".loader").fadeOut("slow");
})


$(document).ready(function(){
    $(window).scroll(function(){
        var pageno = $('.load-more').attr('pageno');
        //do not send ajax request if 
        if($('#empdetail').css('display') == 'block')
        {
            return false;
        }
        if ($(window).scrollTop() == $(document).height() - $(window).height() && pageno != 0){
            $.ajax({
                type:'GET',
                url:'<?php ECHO APP_PATH ;?>/emuserhome&pageno='+pageno,
                beforeSend:function(html){
                    $('.loader').show();
                },
                success:function(html){
                    $('.load-more').remove();
                    $('.loader').hide();
                    $('#parent').append(html);
                }
            });
/*
            $('.empname').hammer({taps:1,domEvents:true}).on("tap",function(ev) {
         	   console.log( ev.type +" gesture detected.");
         	   var user_id=$(this).parent().attr('userid');
         		var eventId=$('#eventId').attr('value');
         		showEmpDetails(eventId,user_id,'emp')
         	});
         	*/
        }
    });
});
</script>



</html>