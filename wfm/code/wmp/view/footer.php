<!-- back to top -->

<a href="#" class="back-to-top hidden-print" style="display: none;"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a> 

<!-- footer -->
<div class="footer">
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="navbar-text list-inline">
				<li>Made with <a class="red-roses" href="#" onclick="return false;" tabindex="0"  data-toggle="popover" data-trigger="focus" data-placement="top" data-content=" Roses are red,
          Violets are blue,
          ESDD made this app,
          Just for you!"><i style="color:#881818;" class="fa fa-heart"></i></a> by ESDD.</li>
			</ul>
            <ul class="navbar-text list-inline pull-right">
				<a class="version-details" href="#" onclick="return false;"><li><i  class="fa fa-info-circle"></i></a> Version <?php echo WORKFORCE_VERSION; ?></li>
			</ul>
		</div>
	</nav>
</div>


<!-- Footer Version Details -->

<div class="modal fade" id="version-details" tabindex="-1" role="dialog" aria-labelledby="version-details">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h2 class="modal-title" id="myModalLabel">Version Details</h2>
      </div>
      <div class="modal-body">
      
      
      
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
        </div>
      
    </div>
  </div>
</div>


<!-- Footer Version Details -->

<div class="modal fade" id="red-roses" tabindex="-1" role="dialog" aria-labelledby="red-roses">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h2 class="modal-title" id="myModalLabel">Red Roses</h2>
      </div>
      <div class="modal-body">
      
          <h4>Roses are red,<br />
          Violets are blue,<br />
          ESDD made this app,<br />
          Just for you!</h4>
      
      
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> I <i style="color:#881818;" class="fa fa-heart"></i> ESDD</button>
        </div>
      
    </div>
  </div>
</div>


<!-- javascript --> 
<script src="/apps/wmp/resources/js/jquery.min.js"></script> 
<script src="/apps/wmp/resources/js/bootstrap.min.js"></script> 
<script src="/apps/wmp/resources/js/jquery.dataTables.min.js"></script> 
<script src="/apps/wmp/resources/js/dataTables.bootstrap.js"></script> 
<script src="/apps/wmp/resources/js/jasny-bootstrap.min.js"></script> 
<script src="/apps/wmp/resources/js/confirm-delete.js"></script> 
<script src="/apps/wmp/resources/js/back-to-top.js"></script>  
<script src="/apps/wmp/resources/js/bootstrap-typeahead.min.js"></script> 
<script src="/apps/wmp/resources/js/select2.min.js"></script> 
<script src="/apps/wmp/resources/js/main.js"></script> 
<script src="/apps/wmp/resources/js/Chart.js"></script> 


<script>

$(document).ready(function() {

		$('body').delegate('a.version-details', 'click', function(ev) {

			ev.preventDefault();
			$.get('/page/workforce/version-history', function(html) {
				$('#version-details .modal-body').css('overflow-y', 'auto');
				$('#version-details .modal-body').css('max-height', $(window).height() * 0.7);
				$('#version-details .modal-body').html(html);
				$('#version-details').modal('show', {backdrop: 'static'});
			});
		});
		
	//	$('body').delegate('a.red-roses', 'click', function(ev) {
//
//			ev.preventDefault();
//			$('#red-roses').modal('show', {backdrop: 'static'});
//		
//		});
		
		$('a.red-roses').popover();
		
});


</script> 
