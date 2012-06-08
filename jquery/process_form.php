<?php
$email_check = '';
$return_arr = array();

ob_start(); print_r( $_REQUEST );$output = ob_get_clean();
file_put_contents( "/tmp/log_jquery.txt", file_get_contents( "/tmp/log_jquery.txt" ) . $output );

if(filter_var($_POST['email_ajax'], FILTER_VALIDATE_EMAIL) || filter_var($_POST['email_post'], FILTER_VALIDATE_EMAIL)) {
   $email_check = 'valid';
}
else {
    $email_check = 'invalid';
}

$return_arr["email_check"] = $email_check;
$return_arr["email_check"] = 'valid';

if (isset($_POST['email_ajax'])){
    $return_arr["name"] = $_POST['name_ajax'];
    $return_arr["email"] = $_POST['email_ajax'];
} else {
    $return_arr["name"] = $_POST['name_post'];
    $return_arr["email"] = $_POST['email_post'];

}

echo json_encode($return_arr);
