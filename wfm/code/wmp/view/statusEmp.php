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


	<div class="navbar navbar-default navbar-fixed-top">
		<a href="<?php ECHO APP_PATH ;?>/report" onclick="OpenLink(this); return false;"> <button type="button" class="navbar-toggle navbar-back"  >		
			<i class="fa fa-angle-left fa-2x pull-left"></i>		
			<span>Reports</span>			
		</button></a>
		 <a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
	   <a href="<?php ECHO APP_PATH ;?>/home&switch=Y" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
	  
	</div>

<!-- content -->
<div class="container" id="parent" >
<form id="saveeventform" action="saveEventDetailsAjax" method="post">
	<input type="hidden" name="eventId" value="<?php echo $event_id ; ?>" id="eventId"/>
	<input type="hidden" name="userId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="userId"/>
	<input type="hidden" name="ManagerId" value="<?php echo $user->ORG_EMPL_ID ; ?>" id="ManagerId"/>
	<input type="hidden" name="pageId" value="rpt" id="pageId"/>
	
	
	
	<!-- fixed top dashboard start-->
	<div class="page-header">
		<h1><?php
        $empCnt = 0;
        if(!empty($employees_count))
        {
        	$empCnt=$employees_count;
        }
		echo $type.' - '.$empCnt; ?></h1>	
		
		
	</div>
	
	
		    



	
	
	
	
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

    <div class="alert alert-danger" role="alert">There are currently no staff that are <?php echo strtolower($type);?>.</div>

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
							<img userid="<?php echo $user['ORG_EMPL_ID'] ; ?>" src="<?php echo $user['ORG_EMPL_HR_ID']?APP_PHOTOS_PATH.$user['ORG_EMPL_HR_ID'].'.png':$placeholder; ?>" class="img-circle emp_person">
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

    	 if($('#empdetail').css('display') == 'block')
         {
             return false;
         }
        var pageno = $('.load-more').attr('pageno');
        if ($(window).scrollTop() == $(document).height() - $(window).height() && pageno != 0){
            $.ajax({
                type:'GET',
                url:'<?php ECHO APP_PATH ;?>/home&FWAction=showEmps&pageno='+pageno,
                beforeSend:function(html){
                    $('.loader').show();
                },
                success:function(html){
                    $('.load-more').remove();
                    $('.loader').hide();
                    $('#parent').append(html);
                }
            });
        }
    });
});
</script>



</html>