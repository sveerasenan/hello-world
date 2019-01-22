


	
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
 
<script>

$('.single-item').slick({
	arrows:	false,
	infinite: false,
	speed: 0
});	

$('.slide-border').remove();
$('.single-item').prepend('<hr class="slide-border"/>');
$('.single-item').slickSetOption('speed',300);



</script>

