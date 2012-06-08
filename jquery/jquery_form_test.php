
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jensbits.com: Form Submit jQuery PHP</title>

<link rel="stylesheet" type="text/css" href="style.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script type="text/javascript">

//jQuery.ajax example

$(function(){
	$("#JqAjaxForm").submit(function(e){
		e.preventDefault();
		dataString = $("#JqAjaxForm").serialize();
	alert(dataString);
		$.ajax({
			type: "POST",
			url: "process_form.php",
			data: dataString,
			dataType: "json",
			success: function(data) {
				if(data.email_check == "invalid"){ 
					$("#message_ajax").html("<div class='errorMessage'>Sorry " + data.name + ", " + data.email + " is NOT a valid e-mail address. Try again.</div>"); 
				} else {
					$("#message_ajax").html("<div class='successMessage'>" + data.email + " is a valid e-mail address. Thank you, " + data.name + ".</div>"); 
				}
			}
		});
	});

//jQuery.post example
	$("#JqPostForm").submit(function(e){	
		e.preventDefault();
		dataString = $("#JqPostForm").serialize();
		alert(dataString);
		$.post("process_form.php", $("#JqPostForm").serialize(), function(data){
			if(data.email_check == 'invalid'){ 
				$("#message_post").html("<div class='errorMessage'>Sorry " + data.name + ", " + data.email + " is NOT a valid e-mail address. Try again.</div>"); 
			} else {
				$("#message_post").html("<div class='successMessage'>" + data.email + " is a valid e-mail address. Thank you, " + data.name + ".</div>"); 
			}
		}, "json");
	});
});

</script>

</head>

<body>

<div class="container">
    <h1>Form Submit Demo:<br />jQuery.ajax and jQuery.post with PHP</h1>
</div>


<div class="container">
<h2>Form Submit jQuery.ajax</h2>
<form id="JqAjaxForm">
<fieldset>
<legend>jQuery.ajax Form Submit</legend>
<p><label for="name_ajax">Name:</label><br />
<input id="name_ajax" type="text" name="name_ajax" value="" /></p>
<p><label for="email_ajax">E-mail:</label><br />
<input id="email_ajax" type="text" name="email_ajax" value="" /></p>
<p><input type="submit" value="Submit" /></p>
</fieldset>
</form>
<div id="message_ajax"></div>
</div>

<div class="container">
<h2>Form Submit jQuery.post</h2>
<form id="JqPostForm">
<fieldset>
<legend>jQuery.post Form Submit</legend>
<p><label for="name_post">Name:</label><br />
<input id="name_post" type="text" name="name_post" value="" /></p>
<p><label for="email_post">E-mail:</label><br />
<input id="email_post" type="text" name="email_post" value="" /></p>
<p><input type="submit" value="Submit" /></p>
</fieldset>
</form>
<div id="message_post"></div>
</div>



<div class="container" style="margin-bottom: 2%;">
    <p><a href="/2009/10/04/jquery-ajax-and-jquery-post-form-submit-examples-with-php/">&lt;&lt; back to post on jensbits.com</a></p>
</div>


</body>
</html>