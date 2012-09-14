<?php
/***********************************************
* Created:            Thu 06 Sep 2012 10:10:28 AM PDT 
* Last Modified:      Thu 06 Sep 2012 10:10:28 AM PDT
*
* The Index page of my hom emusic player, trying to implement AJAX and not have it make the round trip back to the server
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
include "config.php";
include "functions.php";
$submit='id=submit type=submit name="action"';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>MyWebPlayer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.4; maximum-scale=1.4; user-scalable=1.4;" />
<link rel="apple-touch-icon" href="icon.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<style type="text/css">
	body { background-color: <? echo $background_color; ?>; margin:0; padding:0; overflow:hidden; }
	table#buttons { width: <? echo $screen_width; ?>px; margin:0 auto; padding:0; }
	select { width: <? echo $screen_width; ?>px; }
	#submit { background-color: transparent; border: 0px; }
</style>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		var tid;
		var timeRunning = false;
/*
		$.post("test.php", function(data) {
//			   alert("Data Loaded: " + data);
			alert("Data Loaded: Nothing");
			 });
*/		
		$("#slider").slider();
		$( ".selector" ).slider({ max: 7 });
		var request = $("a").click(function(event){
	     	$.ajax({
				url: "test.php",
				type: "POST"
	 	  	});
	
			request.done(function(msg) {
				alert("Data Loaded: " + msg );
			});
			$.post("test.php", function(data) {
				alert("Data Loaded: " + data);
			})
			 
		});
		/*
		$(document).everyTime(1000, function() {
			ajax_update();
		});	
		*/
		$("#btnBackOne").click(function() {
			//handleClick(1);
			ajax_updateUI();
		});

		$("#btnBackJump").click(function() {
			handleClick(2);
		});

		$("#btnForeJump").click(function() {
			handleClick(3);
		});

		$("#btnForeOne").click(function() {
			handleClick(4);
		});
		$("#btnPause").click(function() {
			// if running stop 

			handleClick(5);
		});
		$("#btnPlay").click(function() {
			//start
			handleClick(6);
		});
		$("#btnStop").click(function() {
			// stop
			handleClick(7);
		});
		$("#btnVolUp").click(function() {
			handleClick(8);
		});
		$("#btnVolDn").click(function() {
			handleClick(9);
		});	
	 });

	addEventListener('load', function() {
		setTimeout(hideAddressBar, 0);
	}, false);

	function restartTimer() { // to be called when you want to restart the timer
		tid = setInterval(ajaxUpdateUI, 2000);
	}

	function abortTimer() { // to be called when you want to stop the timer
		  clearInterval(tid);
	}

	function handleClick(btnNumber) {
		var strText = "";
		var file = $("#fileSelection").val();
		switch(btnNumber) {
			case 1:
				ajaxUpdatePlayer("pt_step -1", file);
				break;
			case 2:
				ajaxUpdatePlayer("seek -15", file);
				break;
			case 3:
				ajaxUpdatePlayer("seek -15", file);
				break;
			case 4:
				ajaxUpdatePlayer("pt_step +1", file);
				break;
			case 5:
				/*
				if(timerRunning = true) {
					abortTimer();
				} else {
					restartTimer();
				}
				*/
				ajaxUpdatePlayer("pause", file);
				break;
			case 6:
				restartTimer();
				ajaxUpdatePlayer("loadlist", file);
				break;
			case 7:
				abortTimer();
				ajaxUpdatePlayer("quit", file);
				break;
			case 8:
				ajaxUpdatePlayer("volume -1", file);
				break;
			case 9:
				ajaxUpdatePlayer("volume +1", file);
				break;
			default:
				strText = "Default";
				break;
		}
		
		//alert(strText);
	}

	function ajaxUpdateUI(){ 
		$("#update_user").show(); 
		var search_val=$("#search_term").val(); 
		$.post("./ajax.php?method=updateUI", {search_term : search_val}, function(data){
			if (data.length>0){ 
				$("#update_user").html(data); 
			}
		})
	} 

	function ajaxUpdatePlayer(action, file){ 
		$("#update_user").show();
		var toPost = "./ajax.php?method=updatePlayer&action=" + action +"&file=" + file;
		$.post(toPost, function(data){
			if (data.length>0){ 
				$("#update_user").html(data); 
			}
		})
	} 

	function hideAddressBar() {
		window.scrollTo(0, 1);
	}

//	window.document.body.scroll = 'no';

	Array.prototype.next = function () {if (this.n == undefined || this.n >= this.length) this.n = 0; return this[this.n++]}
	button = ['mute 1', 'mute 0'];


</script>

</head>

<body>
<table id="buttons">
<?
switch($buttons_type) {
	case "images":
		echo "
		<tbody>
			<tr>
				<td width=\"25%\" align=\"left\">
					<button id='btnBackOne' " . $event_start . "=\"document.images[0].src='images/" . $skin . "/skip_bck_pshd.png';\" " . $event_stop . "=\"document.images[0].src='images/" . $skin . "/skip_bck.png';\"><img src=\"images/" . $skin . "/skip_bck.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
				<td width=\"25%\" align=\"left\">
					<button id='btnBackJump' " . $event_start . "=\"document.images[0].src='images/" . $skin . "/rr_pshd.png';\" " . $event_stop . "=\"document.images[0].src='images/" . $skin . "/rr.png';\"><img src=\"images/" . $skin . "/rr.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
				<td width=\"25%\" align=\"center\">
					<button id='btnForeJump' " . $event_start . "=\"document.images[2].src='images/" . $skin . "/ff_pshd.png';\" " . $event_stop . "=\"document.images[2].src='images/" . $skin . "/ff.png';\"><img src=\"images/" . $skin . "/ff.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
				<td width=\"25%\" align=\"center\">
					<button id='btnForeOne' " . $event_start . "=\"document.images[2].src='images/" . $skin . "/skip_fwd_pshd.png';\" " . $event_stop . "=\"document.images[2].src='images/" . $skin . "/skip_fwd.png';\"><img src=\"images/" . $skin . "/skip_fwd.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
			</tr>	
			<tr>
				<td width=\"25%\" align=\"left\">
					<button id='btnPause' " . $event_start . "=\"document.images[3].src='images/" . $skin . "/pause_pshd.png';\" " . $event_stop . "=\"document.images[3].src='images/" . $skin . "/pause.png';\"><img src=\"images/" . $skin . "/pause.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
				<td width=\"50%\" align=\"center\" colspan=2>
					<button id='btnPlay' " . $event_start . "=\"document.images[1].src='images/" . $skin . "/play_pshd.png';\" " . $event_stop . "=\"document.images[1].src='images/" . $skin . "/play.png';\"><img src=\"images/" . $skin . "/play.png\" width=" . $button_width . "*2 height=" . $button_height . "></button>
				</td>
				<td width=\"25%\" align=\"right\">
					<button id='btnStop' " . $event_start . "=\"document.images[4].src='images/" . $skin . "/stop_pshd.png';\" " . $event_stop . "=\"document.images[4].src='images/" . $skin . "/stop.png';\"><img src=\"images/" . $skin . "/stop.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
			</tr>
	
			<tr>
				<td width=\"25%\" align=\"center\">
					<button id='btnVolUp' " . $event_start . "=\"document.images[5].src='images/" . $skin . "/voldown_pshd.png';\" " . $event_stop . "=\"document.images[5].src='images/" . $skin . "/voldown.png';\"><img src=\"images/" . $skin . "/voldown.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
				<td width=\"50%\" align=\"center\" colspan=2>
					<button " . $submit . " value=\"mute 0\" onclick=\"if(this.value=='mute 1') { this.value='mute 0'; } else { this.value='mute 1'; };\" " . $event_start . "=\"document.images[6].src='images/" . $skin . "/mute_pshd.png';\" " . $event_stop . "=\"document.images[6].src='images/" . $skin . "/mute.png';\"><img src=\"images/" . $skin . "/mute.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
				<td width=\"25%\" align=\"right\">
					<button id='btnVolDn' " . $event_start . "=\"document.images[7].src='images/" . $skin . "/volup_pshd.png';\" " . $event_stop . "=\"document.images[7].src='images/" . $skin . "/volup.png';\"><img src=\"images/" . $skin . "/volup.png\" width=" . $button_width . " height=" . $button_height . "></button>
				</td>
			</tr>
	</tbody>";
	break;

	case "buttons":
	echo "
		<tbody>
			<tr>
				<td width=\"25%\" align=\"left\">
					<input " . $submit . " value=\"seek -15\">
				</td>
				<td width=\"25%\" align=\"center\">
					<input " . $submit . " value=\"load$cont_type\">
				</td>
					<td width=\"25%\" align=\"center\">
					<input " . $submit . " value=\"seek +15\">
				</td>
				<td width=\"25%\" align=\"right\">
					<input " . $submit . " value=\"pause\">
				</td>
			</tr>
			<tr>
				<td width=\"25%\" align=\"left\">
					<input " . $submit . " value=\"quit\">
				</td>
				<td width=\"25%\" align=\"center\">
					<input " . $submit . " value=\"volume -1\">
				</td>
				<td width=\"25%\" align=\"center\">
					<input " . $submit . " value=\"mute 1\">
				</td>
				<td width=\"25%\" align=\"right\">
					<input " . $submit . " value=\"volume +1\">
				</td>
			</tr>
		</tbody>";
	break;
}
?>
</table>
<table border="0"  align="center">
<tr><td>

<select id="fileSelection" name="file">
<?php
	$mass=scanDirectories($rootDir);
	$mass=show_all_masks($mass, $mask);
?>

</select>
</td></tr><tr><td align="center">
<?php
/*
if($buttons_type=="images") {
echo "
		<button $submit value=\"panscan -0.1\" " . $event_start . "=\"document.images[8].src='images/" . $skin . "/p-_pshd.png';\" " . $event_stop . "=\"document.images[8].src='images/" . $skin . "/p-.png';\"><img src=\"images/" . $skin . "/p-.png\" width=\"$small_button\" height=\"$small_button\"></button>
		<button $submit value=\"vo_fullscreen 0\" " . $event_start . "=\"document.images[9].src='images/" . $skin . "/screencon_pshd.png';\" " . $event_stop . "=\"document.images[9].src='images/" . $skin . "/screencon.png';\"><img src=\"images/" . $skin . "/screencon.png\" width=\"$small_button\" height=\"$small_button\"></button> &nbsp;
		<button $submit value=\"vo_fullscreen 1\" " . $event_start . "=\"document.images[10].src='images/" . $skin . "/screenexp_pshd.png';\" " . $event_stop . "=\"document.images[10].src='images/" . $skin . "/screenexp.png';\"><img src=\"images/" . $skin . "/screenexp.png\" width=\"$small_button\" height=\"$small_button\"></button>
		<button $submit value=\"panscan +0.1\" " . $event_start . "=\"document.images[11].src='images/" . $skin . "/p+_pshd.png';\" " . $event_stop . "=\"document.images[11].src='images/" . $skin . "/p+.png';\"><img src=\"images/" . $skin . "/p+.png\" width=\"$small_button\" height=\"$small_button\"></button>";
	}
else if ($buttons_type=="buttons") {
	echo "
		<input " . $submit . " value=\"vo_fullscreen 0\"> &nbsp; &nbsp; &nbsp;
		<input " . $submit . " value=\"vo_fullscreen 1\">";
	}
*/
?>
<div id="slider"></div>
<div id="update_user"></div>
<?
if ($debug_frame == '1') {
	$debug_width = $screen_width * 3;
	$debug_height='90px';
} else {
	$debug_width='0';
	$debug_height='0';
}
?>
</td></tr></table>
<iframe frameborder="<? echo $debug_frame; ?>" border="<? echo $debug_frame; ?>" name="nullframe" value="common.php" width="<? echo $debug_width ?>" height="<? echo $debug_height ?>">
</body>
</html>
