<?php

$con =  new mysqli('localhost','root','','test');

if(!$con){
    die(mysqli_errno($con));
}

?>
