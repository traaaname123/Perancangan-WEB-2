<?php
// MySQLi Procedural
$conn = mysqli_connect("localhost", "root", "", "PAGINATION"); 
 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 
}
?>