<?php
include_once "common/includes/Browser.php";
$browser = new Browser();

switch ($browser->getBrowser()) {
	case Browser::BROWSER_OPERA_MINI:
	case Browser::BROWSER_IPAD:
	case Browser::BROWSER_IPOD:
	case Browser::BROWSER_IPHONE:
	case Browser::BROWSER_ANDROID:
		header( 'Location: index.m.php' ) ;
		break;
	case Browser::BROWSER_FIREFOX:
	default:
		echo "unknown?";
//		header( 'Location: index.d.php' ) ;
		break;
		
}

echo $browser->getBrowser();
