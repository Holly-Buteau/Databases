<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');


/*
 * create connection to database and check the connection.
 */
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'semea-db';
$dbuser = 'semea-db';
$dbpass = '2ILWfdJY8UBKJ1oB';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($connection->connect_errno){
    die("<span class='footer style='color:red'><b>Error</b></span> connecting to Database: (" . $connection->connect_errno . ")" . $connection->connect_error);
}
function checkDateFormats($date)
{
    if(preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
    {
        if(checkdate($parts[2],$parts[3],$parts[1]))
            return true;
        else
            return false;
    }
    else
        return false;
}
?>