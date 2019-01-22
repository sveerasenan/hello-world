<div class="navmenu navmenu-default navmenu-fixed-left offcanvas" id="eocnav" >
<?php
     //if non EMT manager use below top nav else use EMT non manager top nav         
  if(!$_SESSION['IS_EM_USER_NON_MGR']){ ?>
		<ul class="nav navmenu-nav">
		       <li><a href="<?php ECHO APP_PATH ;?>/home" onclick="OpenLink(this); return false;">Home <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			
			<li><a href="<?php ECHO APP_PATH ;?>/report" onclick="OpenLink(this); return false;">Reports <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<li><a href="<?php ECHO APP_PATH ;?>/emergency_contacts" onclick="OpenLink(this); return false;">Emergency Contacts <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<li><a href="<?php ECHO APP_PATH ;?>/instructions" onclick="OpenLink(this); return false;">Instructions <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<?php
              
			if($_SESSION['IS_ADMIN']) { ?> 
			<li><a href="<?php ECHO APP_PATH ;?>/manageevent" onclick="OpenLink(this); return false;">Manage Events<i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			
			<?php } ?>
			
			<li><a href="<?php ECHO APP_PATH ;?>/signout" onclick="OpenLink(this); return false;" >Sign Off <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
		</ul>
	
<?php 
  }else {

  ?><ul class="nav navmenu-nav">
		       <li><a href="<?php ECHO APP_PATH ;?>/emuserhome" onclick="OpenLink(this); return false;">Home <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			
			<li><a href="<?php ECHO APP_PATH ;?>/emergency_contacts" onclick="OpenLink(this); return false;">Emergency Contacts <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			<li><a href="<?php ECHO APP_RESOURCE_PATH ;?>/docs/wmp_instructions.pdf" onclick="OpenLink(this); return false;">Instructions <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
			
			<li><a href="<?php ECHO APP_PATH ;?>/signout" onclick="OpenLink(this); return false;" >Sign Off <i class="fa fa-angle-right fa-2x pull-right"></i></a></li>
		</ul>
		<?php } ?>
</div>	
	<div class="navbar navbar-default navbar-fixed-top">
	
	   <div class='header-status'>
    <span>
    <?php 
    $iconstyle = "fa fa-lock";
    
    if (stripos ($menuStatusMsg, 'Evac') !== false)
    {
      $iconstyle = "fa fa-exclamation-triangle";
    }
    else if (stripos ($menuStatusMsg, 'Clear') !== false)
    {
      $iconstyle = "fa fa-smile-o";
    }
    
    
    ?>
    <i class="<?php echo $iconstyle; ?>" aria-hidden="true" id=="menuiconId" style="margin:0px 0px"></i>
<h1 id="menuMsg" class="header-title" style="font-size: 2.7vh">
<?php echo $menuStatusMsg; ?></h1>
    </span>
    </div>
	   
	  
	  
	  <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <?php
     //if non EMT manager use below top nav else use EMT non manager top nav         
  if(!$_SESSION['IS_EM_USER_NON_MGR']){ ?>
	  <a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
	   <a href="<?php ECHO APP_PATH ;?>/home&switch=Y" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
  <?php 
  }else {

  ?>
   <a href="#" onclick="refreshPage(); return false;"><i class="fa fa-refresh fa-lg pull-right"></i></a>
   <a href="<?php ECHO APP_PATH ;?>/emuserhome" onclick="OpenLink(this); return false;"><i class="fa fa-home fa-lg pull-right"></i></a>
<?php } ?>	  
	</div>