 
function register()
{
	var username = $("#username").val();
	var password = $("#password").val();
	var confirm_password = $("#confirm_password").val();
	var sp_name = $("#sp_name").val();
	var cno = $("#cno").val();

	if(username == "")
	{
		alert("username field is required!");
	}
	else if (password == "")
	{
		alert("Password field is required!");
	}
	else if(confirm_password == "")
	{
		alert("Confirm Password field is required!");
	}
	else if(confirm_password != password)
	{
		alert("Invalid Confirm password!");
	}
		else if(sp_name == "" || cno == "")
	{
		alert("Missing Salesperson Information!");
	}

	else
	{
		$.post("ajax/register_user.php", {
			username: username,
			password: password,
			cno: cno,
			sp_name: sp_name
		}, function(data, status){
			alert(data);
			$(".form-control").val('');
		});
	}
}