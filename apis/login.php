<?php
/**
 * Login API
 *
 * @category  Login
 * @author    Ankit Gupta <agupta_92@yahoo.co.in>
 * @param Username, Password
 */
error_reporting(E_ALL);
include_once(__DIR__.'/../config.php');
include_once(__DIR__.'/../helper/utils.php');


$user_name = $_GET['username'];
$user_password = $_GET['password'];

$sql_query = "select user_id,user_type,user_email,user_name from pe_user_details where user_name = '$user_name' AND user_password = '$user_password'";
try{
	$user_details = $db->rawQueryOne($sql_query);
	if(isset($user_details['user_id'])){
		createUserSession($user_details);
		returnSuccess('User Successfully Login',$user_details);
	} else {
		returnSuccess('Incorrect username/password');
	}
} catch (Exception $e){
	returnFailure('Some Error Occured: ' . $e->getMessage());
}

?>