<?php
$host='localhost';
$username='root';
$password='';
$db='users_db';



$connection=new mysqli($host,$username,$password,$db);
if($connection->connect_errno){
    echo "Not Connected".$connection->connect_error;
}
else{
    echo "Connected";
}


