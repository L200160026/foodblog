<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$link = mysqli_connect('localhost','root','','foodblog');

	if($link === false){
    	die("ERROR: Could not connect. ". mysqli_connect_error());
	}
?>