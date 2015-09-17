<?php 

session_start();

include('db.php');
include('functions.php');

header('Content-Type: text/html; charset=utf-8');

$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

for ($i= 0; $i < sizeof($scriptName); $i++)
{
    if ($requestURI[$i] == $scriptName[$i])
    {
        unset($requestURI[$i]);
    }
}

$command = array_values($requestURI);

switch($command[0])
{
    case 'api':
    	require_once("api.php");
        // We run the profile function from the profile.php file.
        get_name($command[1]);
        break;
    case 'api2':
    	require_once("api2.php");
        // We run the profile function from the profile.php file.
        get_name_api2($command[1]);
        break;
    case 'lastname': default:
    	require_once("name.php");

    	if (count($command) >= 2) {
    		if ($command[1] != "") {
    			get_page_lastname($command[1]);
    		} else {
    			get_page();
    		}
    		
    	} else {
    		get_page();
    	}
        // We run the myProfile function from the profile.php file.
        
        break;
    case 'clean':
		$lastname = urldecode($command[1]);
    	$lastname = clean_string($lastname);
    	echo $lastname;
    	break;
    
}


?>