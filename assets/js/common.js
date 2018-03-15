/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){

	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "index.php/deleteUser",
			currentRow = $(this);

		var confirmation = confirm("Are you sure to delete this user ?");

		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId }
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteportfolio", function(){
		var id = $(this).data("id"),
			hitURL1 = baseURL + "index.php/portfolio/deleteportfolio",
			currentRow = $(this);

		var confirmation = confirm("Are you sure to delete this portfolio ?");

		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL1,
			data : { id : id }
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Portfolio successfully deleted"); }
				else if(data.status = false) { alert("Portfolio deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});


	



});
