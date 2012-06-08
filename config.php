<?
// ADD PATH TO YOUR AUDIO/VIDEO CONTENT HERE!!! //
$rootDir = '/x/playlists';

// ADD TYPE OF CONTENT - IS IT FILES OR PLAYLISTS? AVAILIBLE PARAMETERS IS "file" AND "list"
$cont_type = 'list';

// MyWebPlayer SKIN
$skin = 'custom_1';
$background_color="white";
$buttons_type="images"; // also available "buttons" - for old mobile cells

//Define events for pushed-buttons-effect :)
//For iPhone-users i recommend to use "ontouch"-events.
//For other devices try "OnMouseDown" and "OnMouseUp"
$event_start="OnTouchStart";
$event_stop="OnTouchEnd";
//$event_start="OnMouseDown";
//$event_stop="OnMouseUp";

// AND HERE IS SCREEN AND BUTTONS SIZE (320=320px)
$screen_width='320';

//$button_width='64';
//$button_height='64';
$button_width=$screen_width/5.69;
$button_height=$button_width;

$small_button=$button_width/2;

$debug_frame='1'; // 1 for yes, 0 for no
// Please note: if you want some debug info, you need to set background_color to 'white'

// FILES TO PLAY
$mask = array(
	'.avi',
	'.mpg',
	'.mkv',
	'.mp4',
	'.mov',
	'.wmv',
	'.vob',
	'.aif',
	'.amr',
	'.mpeg',
	'.divx',
	'.gvi',
	'.dat',
	'.mpv',
	'.asf',
	'.wm',
	'.mp1',
	'.mp2',
	'.flv',
    '.m3u'
);

?>
