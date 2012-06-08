<?php

ob_start(); print_r( $_POST );$output = ob_get_clean();
file_put_contents( "/tmp/log_jquery.txt", file_get_contents( "/tmp/log_jquery.txt" ) . $output );
$datetime = new DateTime();

echo "Hello world " . $datetime->format('Y/m/d H:i:s');