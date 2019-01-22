function validateNumeric (fields, ids){
	var val;
	var iconID;	
	for (var i = 0; i < fields.length; i++){
		val = $(fields[i]).val(); 
		for (var j = 0; j < ids.length; j++){
			iconID = '#' +ids[j] + "a";
			if (isNaN(val)){
				$(fields[i]).popover({
				trigger: 'hover',
				placement: 'top',
				content:'This field must be a number.'
				});
				$(fields[i]).closest('.form-group').removeClass('has-success').addClass('has-error');
				$(iconID).removeClass('glyphicon-ok').addClass('glyphicon-exclamation-sign'); 
			}
			else{
				$(fields[i]).popover('destroy');
				validateRequired([$(fields[i])], [ids[j]]);
			}
		}
		
	}
}

function validateRequired(fields, ids){
	var iconID;
	for (var i = 0; i < fields.length; i++){
		iconID = '#' + $(fields[i]).attr('id') + 'a';
		if($(fields[i]).val() == ''){
				$(fields[i]).closest('.form-group').removeClass('has-success').addClass('has-error');
				$(iconID).removeClass('glyphicon-ok').addClass('glyphicon-exclamation-sign');         
				$(fields[i]).popover({
					trigger: 'hover',
					placement: 'top',
					content:'This field is required.'
				});
				
				}
				
		else {
				$(fields[i]).closest('.form-group').removeClass('has-error').addClass('has-success');
				$(iconID).removeClass('glyphicon-exclamation-sign').addClass('glyphicon-ok');         
				$(fields[i]).popover('destroy');
				}			
	}
}

function hasError(fields){
	for (var i = 0; i < fields.length; i++){
			//var id = $(fields[i]).attr('id');
			
			if($(fields[i]).closest('.form-group').hasClass('has-error')){
				return true;
				}
		}
	}
	
function clearForm (id){
	//#add-other-activity
	//console.log('testing:',id);
	
	var idChar = '#' + id;
	//$(idChar).find('form')[0].not('input[name="mode"]').reset();
	$(idChar).find('label').parent().removeClass('has-success').removeClass('has-error');
	$(idChar).find('.form-control-feedback').removeClass('glyphicon-exclamation-sign').removeClass('glyphicon-ok');
}	
	
function deleteAllocationsMessage(){
	confirm("Are you sure you wish to delete this allocation?");
}

function saveComment()
{

	  
	     
	   var postURL ="edit-metric&FWAction=saveComment";

	   var ajaxReturn = 0;

	   console.log($("#justifyform"));

	   var postData = $("#justifyform").serializeArray();

	  
	   
		

	   console.log(postData);
	   
		   
		    //alert(JSON.stringify(postdata));
		var saveCommentRequest = $.ajax(
		    {
		        url : postURL,
		        type: "Post",
			    data : postData
		    });

	    return saveCommentRequest;
		 
		
}

function saveEditComment()
{

	  
	     
	   var postURL ="edit-metric&FWAction=saveComment";

	   var ajaxReturn = 0;

	   console.log($("#justifyeditform"));

	   var postData = $("#justifyeditform").serializeArray();

	  
	   
		

	   console.log(postData);
	   
		   
		    //alert(JSON.stringify(postdata));
		var saveCommentRequest = $.ajax(
		    {
		        url : postURL,
		        type: "Post",
			    data : postData
		    });

	    return saveCommentRequest;
		 
		
}

