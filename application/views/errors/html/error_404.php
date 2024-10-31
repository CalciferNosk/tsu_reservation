<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body,html {
	background-image: linear-gradient(to bottom, #800000cf, #ffc6327a);
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    margin: 0;
    padding: 0;
	height: 100%;
    /* background-color: #ffc632 !important; */
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
	width: 40%;
	background-color: #f9f9f9 !important;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>

<body>
<center>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
		go back <a href="<?= BASE_URL?>">home</a>
		
	</div>
	</center>
</body>
</html>