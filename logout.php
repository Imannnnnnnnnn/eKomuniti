<?php

session_start();

if(isset($_SESSION['ekomuniti_userID']))
	{
		$_SESSION['ekomuniti_userID']=NULL;
		unset($_SESSION['ekomuniti_userID']);

	}

header("Location: login.php");
die;

