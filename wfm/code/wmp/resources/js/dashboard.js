$(document).ready(function(){
	function updateStatus(){
		$('.emp_status').click(function(){
			$(this).unbind();
			var sub=$(this);
			var status=$(this).attr('status');
			var empid= $(this).attr('empid');
			var eventid= $('.empid').attr('id');
			if(status==1)
				var status_class='#5cb85c'; 
			else if(status==2)
				var status_class='#f0ad4e';
			else if(status==3)
				var status_class='#d9534f';
			in_percentage = out_percentage = missing_percentage =0;
			inCount = outCount = missingCount =0;
			$.ajax({
					type: "get",
					url: '/page/wmp/dash-board&FWAction=updateEmpStatus&id='+empid+'&status='+status+'&eventid='+eventid,
					dataType:'json',
					success: function(data){
						
						if(typeof data.In !='undefined'){
							in_percentage = (data.In/data.total)*100;
							inCount = data.In;
						}
						if(typeof data.Out !='undefined'){
							out_percentage = (data.Out/data.total)*100;
							outCount = data.Out;
						}
						if(typeof data.Missing !='undefined'){
							missing_percentage = (data.Missing/data.total)*100;
							missingCount = data.Missing;
						} 
						if(typeof data.status_count !='undefined'){
							statusCount = data.status_count;
						} 
						$('#total-In').html(inCount);
						$('#total-Out').html(outCount);
						$('#total-Missing').html(missingCount);
						$('#status_count').html(statusCount);
						$('#in-percentage').css('width',in_percentage+'%');
						$('#out-percentage').css('width',out_percentage+'%');
						$('#missing-percentage').css('width',missing_percentage+'%');
						sub.parents('.light_grey').css("background",status_class);
					}
					});
			
		});
		$('.unit_status').click(function(){
			$(this).unbind();
			var sub=$(this);
			var status=$(this).attr('status');
			var empid= $(this).attr('empid');
			var eventid= $('.empid').attr('id');
			if(status==1)
				var status_class='#5cb85c'; 
			else if(status==2)
				var status_class='#f0ad4e';
			else if(status==3)
				var status_class='#d9534f';
			in_percentage = out_percentage = missing_percentage =0;
			inCount = outCount = missingCount =0;
			$.ajax({
					type: "get",
					url: '/page/wmp/dash-board&FWAction=updateUnitStatus&id='+empid+'&status='+status+'&eventid='+eventid,
					dataType:'json',
					success: function(data){
						
						if(typeof data.In !='undefined'){
							in_percentage = (data.In/data.total)*100;
							inCount = data.In;
						}
						if(typeof data.Out !='undefined'){
							out_percentage = (data.Out/data.total)*100;
							outCount = data.Out;
						}
						if(typeof data.Missing !='undefined'){
							missing_percentage = (data.Missing/data.total)*100;
							missingCount = data.Missing;
						} 
						if(typeof data.status_count !='undefined'){
							statusCount = data.status_count;
						} 
						$('#total-In').html(inCount);
						$('#total-Out').html(outCount);
						$('#total-Missing').html(missingCount);
						$('#status_count').html(statusCount);
						$('#in-percentage').css('width',in_percentage+'%');
						$('#out-percentage').css('width',out_percentage+'%');
						$('#missing-percentage').css('width',missing_percentage+'%');
						sub.parents('.flexbile_box').siblings('.subunit').children('.wrapper').children('.subunit_emp').css("background",status_class);
					}
					});
			
		});
	}	
	function subunits(){
		$(this).unbind();
			$('.expand_box .plus').click(function(){
				if ($(this).parents('.expand_box').siblings('.subunit').text().trim().length > 0) {
					$(this).parents('.expand_box').siblings('.subunit').children('.wrapper').remove();				
				   } 
				else{   
					var sub=$(this);
					var division_id=$(this).parents('.expand_box').siblings('.user_block').children('span').attr('id');
					var emp_id=$(this).parents('.expand_box').siblings('.user_block').children('span').attr('empid');
					var event_id=$(this).parents('.expand_box').siblings('.user_block').children('span').attr('eventid');
					$.ajax({
							type: "get",
							url: '/page/wmp/dash-board&FWAction=getSubunit&id='+emp_id+'&divisionid='+division_id+'&eventid='+event_id,
							success: function(data){
									sub.parents('.expand_box').siblings('.subunit').html(data);
									sub.unbind();
									slide();
									subunits();
									updateStatus();
									empDetails();
								}
							});
				}
			});
	}	
	function slide(){	
			$('.slidebox').slick({
					  dots: false,
					  infinite: false,
					  speed: 300,
					  slidesToShow: 1,
					  slidesToScroll: 1,
					  arrows: false,
					  fade: true
			 });
	} 
	function empDetails(){
		$(this).unbind();
		$('.light_grey .user_block .user img').click(function(){
			var emp_details=$(this).siblings('.emp_container').html();
			$('#empModal').removeClass('hide');
			$('#empModal').modal('show');			
			$('#empModal .modal-body').html(emp_details);
		});
	}
	subunits();
	slide();
	updateStatus();	
	empDetails();
	$('.remove_event').click(function(){
		var thisobj = $(this);
		var event_id = $(this).attr('id');
		$.ajax({
						type: "get",
						url: '/page/wmp/dash-board&FWAction=removeEvent&eventid='+event_id,
						success: function(data){
								thisobj.parents('.list-group').remove();
							}
						});
	});
	
});