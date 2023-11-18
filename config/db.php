<?php
 
 $con =mysqli_connect("localhost","root","","mydatabase");
 if(!$con){
   die("Connection failed: " . mysqli_connect_error());
}
?>