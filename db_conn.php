<?php
$servername= "localhost";

$username= "root";

$password= "buburine";

$dbname= "log_db";

$conn = new mysqli($servername,$username,$password,$dbname);

// if($conn->connect_error){
//     exit('connection failed: '.$conn->connect_error)
// }
if(!$conn){
    echo("connection failed");
}
?>