<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JQuery test</title>

<link rel="stylesheet" type="text/css" href="style.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script type="text/javascript">
//$.post("script.php", { name: "John", time: "2pm" } );

$(document).ready(function() {
	var menuId = $("ul.nav").first().attr("id");

	$('#link_trigger').bind('click', function() {
		  alert('User clicked on "foo."');
		  testMessage();
		});

	setInterval(function() {
	    //call $.ajax here
		testMessage();
	}, 5000); //5 seconds
	
});

function testMessage() {
	var request = $.ajax({
		  url: "script.php",
		  type: "POST",
		  data: {id : "2"},
		  dataType: "html"
		});

	request.done(function(msg) {
		  $("#log").html( msg );
//			alert( "Request success: " + msg );  
		});
		
		request.fail(function(jqXHR, textStatus) {
		  alert( "Request failed: " + textStatus );
		});
}
</script>

</head>

<body>
<a href="#" id="link_trigger">Test</a>
<div id="log">
</div>
<?php
?>
</body>