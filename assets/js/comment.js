$(document).ready(function(){
    $('#comment_form').on('submit', function(event){
	 	event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url:"http://localhost/G7/aleksandar_kurta/Singidunum/Project/api/comment/add/",
			method:"POST",
			data:form_data,
			dataType:"JSON",
			success:function(data){
	   			if(data.error != ''){
					$('#comment_form')[0].reset();
					$('#comment_message').html(data.error);
					load_comment();
	   			}
	  		}
	 	})
	});
   
	load_comment();
   
	function load_comment(){
	 	$.ajax({
			url:"http://localhost/G7/aleksandar_kurta/Singidunum/Project/api/comment/show/",
			method:"POST",
	  		success:function(data){
	   			$('#display_comment').html(data);
	  		}
	 	})
	}
   
	
});
	