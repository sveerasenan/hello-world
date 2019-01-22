function confirmdelete(message)
{
	var answer = confirm(message)
	if (answer){
			document.messages.submit();
	}
	return false;  
} 