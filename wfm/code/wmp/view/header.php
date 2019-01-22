<!-- header -->

<?php
$first_name = $_SESSION['ORG_EMPL_FNAME'];
$last_name = $_SESSION['ORG_EMPL_LNAME'];

 ?>

<!-- css -->
<link href="/apps/wmp/resources/css/bootstrap.min.css" rel="stylesheet">
<link href="/apps/wmp/resources/css/font-awesome.min.css" rel="stylesheet">
<link href="/apps/wmp/resources/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="/apps/wmp/resources/css/jasny-bootstrap.min.css" rel="stylesheet">
<link href="/apps/wmp/resources/css/select2.min.css" rel="stylesheet">
<link href="/apps/wmp/resources/css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->

<?php
if ($_SESSION['requestor'] != "management-dashboard"){ ?>

<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="/page/workforce/my-metrics-gateway"><?php echo WORKFORCE_APP_NAME; ?></a> </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i> 
        <?php 
       //if proxy and vacant show empl description
       
        $name = $last_name . ", " . $first_name;
        
       
        if (strtoupper($first_name) == "VACANT"  && isset($_SESSION["EMPL_POS_DESC"]))
        {
        	$name= $_SESSION["EMPL_POS_DESC"] ;
        }
        echo $name;
        
        ?> 
        
        
        
        <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if ($_SESSION["proxy"] != NULL){ ?>
            <li class="dropdown-submenu"><a data-toggle="modal" data-target="#proxy-modal" href="#"><i class="fa fa-user-secret fa-fw"></i>&nbsp; Proxy as...</a></li>
            <?php } ?>
            
             
            
            
            <li><a target="_blank" href="/apps/workforce/view/WAS-Guide.pdf"><i class="fa fa-info fa-fw"></i>&nbsp; User Guide</a></li>
            <li><a target="_blank" href="/apps/workforce/view/Reports-Guide.pdf"><i class="fa fa-book fa-fw"></i>&nbsp; Report Guide</a></li>
             <?php if ($_SESSION["orig_position_ID"] != NULL && $_SESSION["orig_position_ID"] != $_SESSION['position_ID'] ){ 
			 
			 ?>
             
            <li><a href="/page/workforce/change-user&FWAction=changeProxy&proxyPosn=<?php echo $_SESSION["orig_position_ID"] ; ?>"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Exit Proxy</a></li>
            
            <?php } ?>
             <li><a href="/page/workforce/logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Log Out</a></li>
             
          </ul>
        </li>
      </ul>
    </div>
  </div>
  
   <!--<div class="container pull-right">
  Proxy as... 
  </div>-->
 
</nav>


  
<?php if ($_SESSION["proxy"] != NULL ){ ?>

<!-- Proxy as modal -->

<div id="proxy-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Proxy as...</h4>
      </div>
      <div class="modal-body">
      
       <form method="POST" action="/page/workforce/change-user">
       
       <input name="FWAction" value="changeProxy" type="hidden">

        <?php foreach ($_SESSION['proxy'] as $proxy) { ?>
        
        <div class="radio">
          <label>
            <input type="radio"  value="<?php echo $proxy['proxy_posn']; ?>" name="proxyPosn">
            <?php echo $proxy["empl_first"] == "Vacant" ? "Vacant (" . $proxy["proxy_posn"] .") - " . $proxy["empl_posndescr"] : $proxy["empl_last"] . ", " . $proxy["empl_first"] . " - " .$proxy["empl_posndescr"] ?></label>
        </div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        
        </form>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->

<?php } ?>


<?php } else { ?>
<style>
.navbar-default .navbar-brand {
  position: relative;
  padding-left: 45px;
}
.navbar-default .navbar-brand .mdi {
  position: absolute;
  top: 5px;
  left: 10px;
}
.navbar-default .navbar-brand .mdi:before {
  font-size: 40px;
  line-height: 40px;
}
.navbar-static-top{
	margin-bottom:0px;
	
}
.navbar-brand {
    float: left;
    padding: 14px 15px;
    font-size: 20px;
    line-height: 22px;
    height: 50px;
}


</style>
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="/page/management-dashboard/home">CalPERS Management Dashboard</a> </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $last_name . ", " . $last_name ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/page/management-dashboard&FWAction=logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<nav class="navbar navbar-default" role="navigation">
  <div class="container"> <a class="navbar-brand" href="my-metrics-gateway"><i class="mdi mdi-sitemap"></i>&nbsp; Workforce Allocation System</a> </div>
</nav>
<?php } ?>
