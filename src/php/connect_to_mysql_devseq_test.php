<?php  
/* Created by CS based on Adam Khoury @ www.developphp.com */

// Place db host name. Sometimes "localhost" but  
// sometimes looks like this: >>      ???mysql??.someserver.net 
$db_host = "p:127.0.0.1"; 
// Place the username for the MySQL database here 
$db_username = "root";  
// Place the password for the MySQL database here 
$db_pass = "Tr21zMP26r";  
// Place the name for the MySQL database here 
$db_name = "devseq_test"; 

// Run the connection here   
$myConnection = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die ("could not connect to mysql");  
// Now you can use the variable $myConnection to connect in your queries      
?> 