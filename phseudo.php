#!/usr/bin/php
<?php
	if(isset($argv[1])) {
		$httpsock = @socket_create_listen($argv[1]);
	} else {
		$httpsock = @socket_create_listen("1234");
	}
  if (!$httpsock) {
    print "Socket creation failed!\n";
    exit;
  }
  while (1) {
    $client = socket_accept($httpsock);
    $input = trim(socket_read ($client, 4096));
    $input = explode(" ", $input);
    $input = $input[1];
    if ($input == "/") { $input = "/index.php"; }
		$input = explode("?", $input);
		if(isset($input[1])){
			$params = $params= explode("&", $input[1]);
		} else {
			$params=array();
			$params[0]=''; $params[1]='';  $params[2]='';
		}
		$input = '.'.$input[0];
    if (file_exists($input) && is_readable($input)) {
//      echo "Serving $input\n";
//      $contents = file_get_contents($input);
				$contents = "/usr/bin/php -f $input $params[0] $params[1] $params[2]";
				$contents = `$contents`;
      $output = "HTTP/1.0 200 OK\r\nServer: PseudoServer\r\nConnection: close\r\nContent-Type: text/html\r\n\r\n$contents";
    } else {
      $contents = "The file you requested doesn't exist.  Sorry!";
      $output = "HTTP/1.0 404 OBJECT NOT FOUND\r\nServer: PseudoServer\r\nConnection: close\r\nContent-Type: text/html\r\n\r\n$contents";
    }
    socket_write($client, $output);
    socket_close ($client);
  }
  socket_close ($httpsock);
?>
