function initSliders()
	{
		$('.single-item').unslick();
		// Begin Slick
		$('.single-item').slick({
			arrows:	false,
			infinite: false,
			speed: 500,
			onAfterChange: 
				function(slide,index){
					if(index==0)
					{
						$(slide.$slides.get(1)).find('.fa').addClass('pull-left');
					}
					else {
						$(slide.$slides.get(1)).find('.fa').removeClass('pull-left');
					}
					
					
					
					genBorder();
				}
		});	
		// End Slick
		
		$('.slide-border').remove();
		$('.single-item').prepend('<hr class="slide-border"/>');
		$('.single-item').slickSetOption('speed',300);
		
		
	}

function updateStatus(){
		$('.emp_status').click(function(){
			var sub=$(this);
			var status=$(this).attr('status');
			var cstatus=$(this).attr('cstatus');
			var empid= $(this).attr('empid');
			var eventid= $('#eventId').attr('value');
			
			if(eventid==0)
			{
			  //show the read only popup
				$('#readonlyModal').modal();
				
				return false;
			}
			
			if(cstatus==status){
					updateEmpstatus(empid,'',eventid,sub);
			}
			else if(cstatus=="M" && status=="O"){
				$('#missingEntityId').text("person's");
				$('#miss2outModal').modal();
				$('#miss2outbtn').click(function(){
					updateEmpstatus(empid,status,eventid,sub);
				})
			}
			else if(cstatus=="M" && status=="I"){
				$('#missingEntityId').text("person's");
				$('#miss2inModal').modal();
				$('#miss2inbtn').click(function(){
					updateEmpstatus(empid,status,eventid,sub);
				})
			}
			else if( status=="M")
			{
				$('#missingEntityId').text("person's");
				$('#update2missModal').modal();
				$('#update2missbtn').click(function(){
					updateEmpstatus(empid,status,eventid,sub);
				})
			}
			else
			{
				updateEmpstatus(empid,status,eventid,sub);
			}
			
		});
		$('.newpagebug').click(function(){
			
			console.log("newpage clicked");
			window.location=this.getAttribute("href");
	        return false
			
		});
		
		
		$('.unit_status').click(function(){
			var sub=$(this);
			var status=$(this).attr('status');
			var cstatus=$(this).attr('cstatus');
			var empid= $(this).attr('empid');
			var eventid= $('#eventId').attr('value');
			
			if(eventid==0)
			{
			  //show the read only popup
				$('#readonlyModal').modal();
				
				return false;
			}
			if(cstatus==status)
			{
				updateUnitStatus(sub);
			}
			else if(cstatus=="M" && status=="O"){
				
				$('#miss2outUModal').modal();
				$('#miss2outUbtn').click(function(){
					updateUnitStatus(sub);
				})
			}
			else if(cstatus=="M" && status=="I"){
				
				$('#miss2inUModal').modal();
				$('#miss2inUbtn').click(function(){
					updateUnitStatus(sub);
				})
			}
			else if(status=="M"){
				
				$('#update2missUModal').modal();
				$('#update2missUbtn').click(function(){
					updateUnitStatus(sub);
				})
			 }
			else	{
				   updateUnitStatus(sub);
				}
			
		});
	}

  function updateUnitStatus(sub)
  {
	//$(this).unbind();
		//var sub=$(this);
		var status=sub.attr('status');
		var cstatus=sub.attr('cstatus');
		var empid= sub.attr('empid');
		var eventid= $('#eventId').attr('value');
		
		
		
		var unittotal = $('#unitstatus'+empid).attr('total');
		var statusstr = "";
		var status_class=''; 
		if(cstatus == status){
				
			statusstr ="0/"+unittotal+" ( 0 | 0 | 0 )";
			status='';
			status_class='unit';
		}else if(status=="I")
			{
			 status_class='ucheckin'; 
			statusstr =unittotal+"/"+unittotal+" ( "+unittotal+" | 0 | 0 )";
		}else if(status=="O")
			{
			 status_class='ucheckout';
			statusstr =unittotal+"/"+unittotal+" ( 0 | "+unittotal+" | 0 )";
		}else if(status=="M")
			{
			 status_class='ucheckmissing';
			statusstr =unittotal+"/"+unittotal+" ( 0 | 0 | "+unittotal+" )";
		    
			}
		
		
		in_percentage = out_percentage = missing_percentage =0;
		inCount = outCount = missingCount =0;
		$.ajax({
				type: "get",
				url: homeurl+'&FWAction=updateUnitStatus&id='+empid+'&status='+status+'&eventid='+eventid,
				dataType:'json',
				beforeSend:function(html){
                    $('.loader').show();
                },
				success: function(data){
					$('.loader').hide();
					var missingCount=0;
					var inCount=0;
					var outCount=0;
					
					sub.parent('.control').children('.unit_status').removeClass('active');
					sub.parent('.control').children('.unit_status').removeClass('inactive');
					sub.parent('.control').children('.unit_status').addClass('inactive');
					sub.removeClass('inactive');
					if(status)
					sub.addClass('active');
					else
					sub.addClass('inactive');
					if(typeof data.INCNT !='undefined'){
						inCount = data.INCNT;
					}
					if(typeof data.OUTCNT !='undefined'){
						outCount = data.OUTCNT;
					}
					if(typeof data.MISS !='undefined'){
						missingCount = data.MISS;
					} 
					
					if(typeof data.total !='undefined'){
						total = data.total;
					} 
					if(typeof data.status_count !='undefined'){
						statusCount = data.status_count;
						status_percentage = (data.status_count/data.total)*100;
					} 
					$('#checkin').html(inCount);
					$('#checkout').html(outCount);
					$('#missing').html(missingCount);
					$('#status_count').html(statusCount);
					sub.parent('.control').children('.unit_status').attr('cstatus',status);
					$('.progress-bar').css('width',status_percentage+'%');
					
					//set the unit status
					$('#unitstatus'+empid).html(statusstr);
					
					//update progress bar
					if((+inCount+(+outCount)+(+missingCount))==(+total))
					{
						$('#progressrow').addClass("green");
					}
					else
					{
						$('#progressrow').removeClass("green");
					}
					
					//set unit level css
					console.log(sub.parent('.control').siblings('.emp_unit'));
					sub.parent('.control').siblings('.emp_unit').removeClass('checkmissing');
					sub.parent('.control').siblings('.emp_unit').removeClass('checkin');
					sub.parent('.control').siblings('.emp_unit').removeClass('checkout');
					
					sub.parent('.control').siblings('.emp_unit').removeClass('ucheckmissing');
					sub.parent('.control').siblings('.emp_unit').removeClass('ucheckin');
					sub.parent('.control').siblings('.emp_unit').removeClass('ucheckout');
					sub.parent('.control').siblings('.emp_unit').removeClass('unit');
					//if even one member missing in unit will be marked as missing.
					
					sub.parent('.control').siblings('.emp_unit').addClass(status_class);
					
					
					
					
					sub.parents('.slider').slickGoTo(0);
					// location.reload();
				}
				});
		
  }
  
  function animationDown(){
		var floater = document.getElementById("fixed-footer");

		if(floater.classList.contains("footer-float-animation-up")){

			//go down
			floater.classList.remove("footer-float-animation-up");
			floater.classList.add("footer-float-animation-down");
			floater.addEventListener('webkitAnimationEnd',function( event ) { 
				floater.style.display = 'none'; }, false);
			//floater.style.display = 'none';
		}

		
	}
  
  function animationUp(){
		var floater = document.getElementById("fixed-footer");

		if(!floater.classList.contains("footer-float-animation-up")){

			//go up
			floater.style.display = 'block';
			floater.addEventListener('webkitAnimationEnd',function( event ) { 
				floater.style.display = 'block'; }, false);
			floater.classList.remove("footer-float-animation-down");
			floater.classList.add("footer-float-animation-up");
		}

		
	}



	$(document).ready(function() {		
		initSliders();
		genBorder();
		updateStatus();	
		$('.subunit').unslick();
		$('.subunit').slick({
			dots: false,
			infinite: false,
			cssEase: 'linear'
		});	
		var users = [];
		var units = [];
		var unitcount=0;
		var usercount=0;
		
   //hammer.js touch events start
	//$(element).hammer(options).bind("pan", myPanHandler);
		//.hammer({domEvents:true}).on
	$('#parent').hammer({taps:1,domEvents:true}).on("tap",".empname",function(ev) {
	   console.log( ev.type +" gesture detected.");
	   var user_id=$(this).parent().attr('userid');
		var eventId=$('#eventId').attr('value');
		showEmpDetails(eventId,user_id,'emp')
	});
		
	$('#parent').hammer({time:2000}).on("press",'.selectuser',function(ev) {
          ev.preventDefault();
          
          console.log( " press gesture detected.");
          
          //return false;
		
		var utype=$(this).children('.udetails').attr('utype');
		var uid=$(this).children('.udetails').attr('uid');
		var sel=$(this).children('.udetails').attr('select');
		if(utype=='unit'){
			if(sel=='selected')
			{	 var index = $.inArray(uid, units);
				if (index >= 0) {
					units.splice(index, 1);
				}
				unitcount=unitcount-1;
			}	
			else {
			units.push(uid);
			unitcount=unitcount+1;
			}
		}
		if(utype=='user'){
			if(sel=='selected')
			{	 var index = $.inArray(uid, users);
				if (index >= 0) {
					users.splice(index, 1);
				}
				usercount=usercount-1;
			}
			else{
			users.push(uid);
			usercount=usercount+1;
			}
		}
		
		if(sel=='selected')
		{	$(this).removeClass('multiadd');
			$(this).children('.udetails').attr('select','');}
		else {$(this).addClass('multiadd');
			$(this).children('.udetails').attr('select','selected');}
		if((usercount+unitcount)>0);
		{
			animationUp();
			//$('.status').addClass('hidden');
			//$('.group_status').removeClass('hidden');
		}
		
		if((usercount+unitcount)<=0){
			animationDown();
		}
		
		});
		
	//hammer.js touch events end
	
	$( "#empimg").click(function(e) {

		  e.preventDefault();

		  $('#imgzoom-modal').modal('toggle');

		  $('#imgclose').show();

		});



		$( "#imgclose").click(function(e) {

		  e.preventDefault();

		  $('#imgzoom-modal').modal('toggle');

		  $('#imgclose').hide();

		});

		$("#imgzoom-modal").on('hidden.bs.modal',function()

		{

		$('#imgclose').hide();

		});
	/*	
	$('.selectuser').dblclick(function(e) {
		e.preventDefault();
		
		var utype=$(this).children('.udetails').attr('utype');
		var uid=$(this).children('.udetails').attr('uid');
		var sel=$(this).children('.udetails').attr('select');
		if(utype=='unit'){
			if(sel=='selected')
			{	 var index = $.inArray(uid, units);
				if (index >= 0) {
					units.splice(index, 1);
				}
				unitcount=unitcount-1;
			}	
			else {
			units.push(uid);
			unitcount=unitcount+1;
			}
		}
		if(utype=='user'){
			if(sel=='selected')
			{	 var index = $.inArray(uid, users);
				if (index >= 0) {
					users.splice(index, 1);
				}
				usercount=usercount-1;
			}
			else{
			users.push(uid);
			usercount=usercount+1;
			}
		}
		
		if(sel=='selected')
		{	$(this).removeClass('multiadd');
			$(this).children('.udetails').attr('select','');}
		else {$(this).addClass('multiadd');
			$(this).children('.udetails').attr('select','selected');}
		if((usercount+unitcount)>0);
		{
			$('.status').addClass('hidden');
			$('.group_status').removeClass('hidden');
		}
		if((usercount+unitcount)<=0){
			$('.status').removeClass('hidden');
			$('.group_status').addClass('hidden');
		}
		
		
	});
	
	*/
	$("#footerCancelConfirmYesBtn").click(function() {
		
		unitcount=0;
		usercount=0;
		$('.udetails').attr('select','');
		$('.selectuser').removeClass('multiadd');
		animationDown();
		
	});
	$('.footer-cancel').click(function(){
		$("#footerCancelConfirm").modal();
		//$('.status').removeClass('hidden');
		//$('.group_status').addClass('hidden');
		
	});
	$('.group_change_status').click(function(){
		var update_status=$(this).attr('status');
		var eventid= $('#eventId').attr('value');
		if(update_status=="I") var status_msg='In';
		if(update_status=="O") var status_msg='Out';
		if(update_status=="M") var status_msg='Missing';
		$('#groupstatusModal').modal();
		var usrcntmsg =usercount+" person ";
		if(usercount>1)
		{
			usrcntmsg=usercount+" persons ";
		}
		var unitcntmsg =unitcount+" unit ";
		if(unitcount>1)
		{
			unitcntmsg=unitcount+" units ";
		}
		$('#groupstatusModal #usercount').html(usrcntmsg);
		$('#groupstatusModal #unitcount').html(unitcntmsg);
		$('#groupstatusModal #u_status').html(status_msg);
				$('#groupstatusbtn').click(function(){
					$.ajax({
					type: "get",
					url: homeurl+'&FWAction=updateGroupStatus&user='+users+'&unit='+units+'&status='+update_status+'&eventid='+eventid,
					success: function(data){
							 location.reload();
					}
					});
				})
		
		
		
		
	});
	 $('.expander').click(function(){
			var unit_mgr=$(this). siblings('span').attr('empid');
			var event_id=$(this). siblings('span').attr('eventid');
			var div_id=$(this). siblings('span').attr('divid');
			window.location=homeurl+"&id="+unit_mgr;
			
		});
	$( "#profileright").click(function(e) {
		
		var mgr_id=$(this).attr('loginempid');
		var eventId=$('#eventId').attr('value');
		showEmpDetails(eventId,mgr_id,'mgr')
		
	});	
	/*
	$('.emp_person .empname').click(function(e) {
		var user_id=$(this).parent().attr('userid');
		var eventId=$('#eventId').attr('value');
		showEmpDetails(eventId,user_id,'emp')
		
	});	
	*/
	$( "#empbck").click(function() {
		$("#empdetail").css("display", "none"); 
		$("#empbck").css("display", "none"); 
		$("#parent").css("display", "block"); 
	
	});
	$( "#em_empdetail #empbck").click(function() {
		$("#em_empdetail").css("display", "none"); 
		$("#em_empdetail #empbck").css("display", "none"); 
		$("#parent").css("display", "block"); 
	
	});
	
	$("#allstaff").click(function() {
		$("#empdetail").css("display", "none"); 
		$("#allstaff").css("display", "none"); 
		$("#parent").css("display", "block"); 
	
	});
	$(".eme_contact").click(function() {
		var user_id=$(this).parent().attr('userid'); 
		showEmeEmpDetails(user_id)
	
	});
	
	$("#declareEvntBtn").click(function() {
		$("#newEventModal").modal();
	
	});
	$("#allclearEvntBtn").click(function() {
		$("#allclearEventModal").modal();
		
	});
	$("#closeEvntBtn").click(function() {
		
		$("#closeEventModal").modal();
	});
	
    $("#allclearEvntYesBtn").click(function() {
		
		allClearEvent();
	});
$("#closeEvntYesBtn").click(function() {
		
		closeEvent();
	});
$("#declareEvntYesBtn").click(function() {
	
	addEvent();
});
	
	
	
	 $('.loaderlink').click(function() {
	    	$('.loader').toggle();
	        //return true;
	      });
	 
	 setInterval(updateMenuMsg,30000);
});
function updateEmpstatus(empid,status,eventid,sub){
			if(status=="I")
				var status_class='checkin'; 
			else if(status=="O")
				var status_class='checkout';
			else if(status=="M")
				var status_class='checkmissing';
			else var status_class='';
			in_percentage = out_percentage = missing_percentage =0;
			inCount = outCount = missingCount =0;
			$.ajax({
					type: "get",
					url: homeurl+'&FWAction=updateEmpStatus&id='+empid+'&status='+status+'&eventid='+eventid,
					dataType:'json',
					beforeSend:function(html){
	                    $('.loader').show();
	                },
					success: function(data){
						 $('.loader').hide();
						var inCount=0;
						var outCount=0;
						var missingCount=0;
						
						
						
						if(sub.attr("empstatuspgInd"))
						{
							sub.closest('.single-item').remove();
							
							return;
						    // location.reload();
						}
						sub.parent('.control').children('.emp_status').removeClass('active');
						sub.parent('.control').children('.emp_status').removeClass('inactive');
						sub.parent('.control').children('.emp_status').addClass('inactive');
						sub.removeClass('inactive');
						if(status){
						sub.addClass('active');
						}else{
							sub.addClass('inactive');
						}
						sub.parent().siblings('.slick-slide').removeClass('checkout');
						sub.parent().siblings('.slick-slide').removeClass('checkin');
						sub.parent().siblings('.slick-slide').removeClass('checkmissing');
						sub.parent().siblings('.slick-slide').addClass(status_class);
						if(status){
							sub.parent().siblings('.slick-slide').children('.img-circle').addClass('hidden');
						}
						else{
							sub.parent().siblings('.slick-slide').children('.img-circle').removeClass('hidden');
						}
						if(typeof data.INCNT !='undefined'){
							inCount = data.INCNT;
						}
						if(typeof data.OUTCNT !='undefined'){
							outCount = data.OUTCNT;
						}
						if(typeof data.MISS !='undefined'){
							missingCount = data.MISS;
						}
						
						if(typeof data.total !='undefined'){
							total = data.total;
						} 
						if(typeof data.status_count !='undefined'){
							statusCount = data.status_count;
							status_percentage = (data.status_count/data.total)*100;
						} 
						
						$('#checkin').html(inCount);
						$('#checkout').html(outCount);
						$('#missing').html(missingCount);
						$('#status_count').html(statusCount);
						$('.progress-bar').css('width',status_percentage+'%');
						
						//update progress bar
						if((+inCount+(+outCount)+(+missingCount))==(+total))
						{
							$('#progressrow').addClass("green");
						}
						else
						{
							$('#progressrow').removeClass("green");
						}
						
						
						sub.parent('.control').children('.emp_status').attr('cstatus',status);
						sub.parents('.slider').slickGoTo(0);
					}
					});
} 
function showEmpDetails(eventId,emp_id,pos){
	$.ajax({
					type: "get",
					url: homeurl+'&FWAction=getEmpDetails&id='+emp_id+'&eventid='+eventId,
					dataType:'json',
					beforeSend:function(html){
	                    $('.loader').show();
	                },
					success: function(data){
						$('.loader').hide();
						$("#parent").css("display", "none"); 
						$("#navsubmitbtn").css("display", "none"); 
						$("#empdetail").css("display", "block"); 
						if(pos=='mgr')
						{
							$("#empbck").css("display", "block"); 
							$("#allstaff").css("display", "none"); 
						}
						if(pos=='emp')
						{
							$("#empbck").css("display", "none"); 
							$("#allstaff").css("display", "block"); 
						}
						$('#empdetail #empname').html(data.ORG_EMPL_FNAME+' '+data.ORG_EMPL_LNAME);
						
						$('#empdetail #empunitshort').html(data.ORG_UNIT_NAME);
						$('#empdetail #empimg').attr("src",photosurl+data.ORG_EMPL_HR_ID+".png");
						$('#empdetail #imgzoom-modal').attr("src",photosurl+data.ORG_EMPL_HR_ID+".png");
						
						
						$('#empdetail #empwrkph').html(data.ORG_EMPL_WORK_PHONE);
						if(data.ORG_EMPL_WORK_PHONE!=undefined && data.ORG_EMPL_WORK_PHONE!="")
						{
							$('#empdetail #empwrkphlink').attr("href",'tel:'+data.ORG_EMPL_WORK_PHONE);
						}
						
						
						$('#empdetail #empcellph').html(data.ORG_EMPL_MOBILE_PHONE);
						if(data.ORG_EMPL_MOBILE_PHONE!=undefined && data.ORG_EMPL_MOBILE_PHONE!="")
						{
							$('#empdetail #empcellphlink').attr("href",'tel:'+data.ORG_EMPL_MOBILE_PHONE);
						}
						$('#empdetail #empemail').html(data.ORG_EMPL_EMAIL);
						
						if(data.ORG_EMPL_EMAIL!=undefined && data.ORG_EMPL_EMAIL!="")
						{
							$('#empdetail #empemaillink').attr("href",'mailto:'+data.ORG_EMPL_EMAIL);
						}
						
						//update division/unit
						$divunit ="";
						if(data.ORG_DIV_NAME!=null)
						{
							$divunit=data.ORG_DIV_NAME+"/";
						}
						
						$divunit = $divunit+data.ORG_UNIT_NAME;
						
						$('#empdetail #divunit').html($divunit);
						$('#empdetail #mgrname').html(data.MGR_NAME);
						
						//update status image
						
						$('#empdetail #empstatus').html("");
						$("#empstatusclass").attr('class', '');
						console.log(data);
						if(data.CHANGE_USER != null && data.CHANGE_USER!=0 && data.EOC_EVENT_EMP_STATUS!='')
						{
						
							$('#empdetail #empstatus').html(data.CHANGE_DATE+"<br/>"+data.CHANGE_USER);
							
							$status = data.EOC_EVENT_EMP_STATUS;
	
							if($status=='M')
	
					       	{
	
					       	$("#empstatusclass").attr('class', 'fa fa-exclamation-circle fa-2x');
	
					       	}
	
					       	else if($status=='O')
	
					       	{
	
					       	$("#empstatusclass").attr('class', 'fa fa-times-circle fa-2x');
	
					            }
	
					       	else if($status=='I')
	
					       	{
	
					       	$("#empstatusclass").attr('class', 'fa fa-check-circle fa-2x');
	
					            }
	
					       	else 
	
					       	{
	
					       	$("#empstatusclass").attr('class', 'fa fa-2x');
	
					            }
						}
						
					}
					});
} 

function addEvent(){
	$.ajax({
					type: "get",
					url: appurl+'/manageevent&FWAction=addEvent',
					success: function(data){
						console.log(data);
						refreshPage();
						
						
					}
					});
} 
function allClearEvent(){
	$.ajax({
					type: "get",
					url: appurl+'/manageevent&FWAction=changeEventStatus&changeId=2',
					success: function(data){
						console.log(data);
						refreshPage();
						
						
					}
					});
} 
function closeEvent(){
	$.ajax({
					type: "get",
					url: appurl+'/manageevent&FWAction=changeEventStatus&changeId=3',
					success: function(data){
						console.log(data);
						refreshPage();
						
						
					}
					});
} 
/*
function updateMenuMsg(){
	$.ajax({
					type: "get",
					url: '/page/wmp/dash-board&FWAction=getMenuStatusMsg',
					success: function(data){
						console.log(data);
						$('#menuMsg').html(data.menuMsg);
						
						
					}
					});
} 
*/

function updateMenuMsg(){
	
	   
        var req = $.ajax({
            type:"get",
            url: homeurl+'&FWAction=getMenuStatusMsg'
           
        });

        req.done(function(data){
            console.log("Request successful!");
            var jsondata = JSON.parse(data);
            var menuMsg = jsondata.menuMsg;
            
            
            $("#menuiconId").attr('class', 'fa fa-lock');
            
            if(menuMsg.indexOf('Evac')!==-1)
        	{
            	
        	   $("#menuiconId").attr('class', 'fa fa-exclamation-triangle');
        	}
            else if(menuMsg.indexOf('Clear')!==-1)
        	{
            	 $("#menuiconId").attr('class', 'fa fa-smile-o');
        	}
            $('#menuMsg').text(jsondata.menuMsg);
            // This makes it able to send new request on the next interval
           
        });
    

    
}


function showEmeEmpDetails(emp_id){
	$.ajax({
					type: "get",
					url: appurl+'/emergency_contacts&FWAction=getEmergencyEmpDetails&id='+emp_id,
					dataType:'json',
					success: function(data){
						console.log(data);
						$("#parent").css("display", "none"); 
						$("#em_empdetail").css("display", "block"); 
						$("#empbck").css("display", "block"); 
						$('#em_empdetail #empname').html(data.NAME);
						$('#em_empdetail #empunit').html(data.TITLE);
						$('#em_empdetail #empwrkph').html(data.ORG_EMPL_WORK_PHONE);
						$('#em_empdetail #empwrkphlink').attr("href",'tel:'+data.ORG_EMPL_WORK_PHONE);
						
						$('#em_empdetail #empcellph').html(data.MOBILE_PHONE);
						$('#em_empdetail #empcellphlink').attr("href",'tel:'+data.MOBILE_PHONE);
						
						//$('#em_empdetail #empemail').html(data.OTHER_PHONE);
						$('#em_empdetail #empemail').html(data.ORG_EMPL_EMAIL);
						$('#em_empdetail #empemaillink').attr("href",'mailto:'+data.ORG_EMPL_EMAIL);
						if(data.EMP_TYPE=='INT')
						{
						$('#em_empdetail #empimg').attr("src",photosurl+data.ORG_EMPL_HR_ID+".png");
						$('#em_empdetail #imgzoom-modal').attr("src",photosurl+data.ORG_EMPL_HR_ID+".png");
						}
						else
						{
							$('#em_empdetail #empwrkph').html(data.WORK_PHONE);
							$('#em_empdetail #empimg').attr("src",photosurl+"profile.png");
							$('#em_empdetail #imgzoom-modal').attr("src",photosurl+"profile.png");
						
							
						}
						
						
					}
					});
} 
	
	
		function OpenLink(theLink){
		    window.location.href = theLink.href;
		}
		
		function refreshPage(){
		    window.location.reload();
		}
	function genBorder()
	{

		
		$('.slick-slide').each(function() {
			if ( !$(this).hasClass('slick-active') )
			{
				$(this).removeClass('whiteseperator');
				$(this).removeClass('grayseperator');
			}
			else if ( $(this).hasClass('checkmissing') || $(this).hasClass('checkout') || $(this).hasClass('checkin') )
			{
				$(this).addClass('whiteseperator');
			}
			else {
				$(this).addClass('grayseperator');
			}
		});
	}
	

	
	

	
	





	
	

	