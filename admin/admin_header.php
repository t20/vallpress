<?php

include '../config.php';
include '../includes/database.php';
include '../models.php';
include '../includes/functions.php';

is_logged_in();

?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>{{Sitename}} Admin</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="no title" charset="utf-8">
</head>

<body>
<div id="wrapper">
    <div id="navwrap">
        <ul id="nav">
            <li class="">Home</li>
            <li class=""><a href="setting.php">Settings</a></li>
            <li class=""><a href="moods.php">Moods</a></li>
        </ul>
    </div>