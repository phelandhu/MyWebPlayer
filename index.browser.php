<?php
/***********************************************
* Created:            Thu 20 Sep 2012 04:32:35 PM PDT 
* Last Modified:      Thu 20 Sep 2012 04:32:35 PM PDT
*
* [LEFT BLANK FOR PROGRAM DISCRIPTION]
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
$port = 5912;
// iPhone Version:
if(strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'],'iPod') !== FALSE)
{
  header("Location: http://www.scoundrel-for-hire.com:" . $port . "/m.index.php");
  exit();
}
// Android Version:
if(strpos($_SERVER['HTTP_USER_AGENT'],'Android') !== FALSE)
{
  header("Location: http://www.scoundrel-for-hire.com:" . $port . "/m.index.php");
  exit();
}
?>

