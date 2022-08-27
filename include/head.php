<?php
if (!defined('WORKBASE')) exit();
#To ensure that this script runs only inside the Workbase
echo<<< END
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>$title</title>
	<link rel="stylesheet" href="lib/css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="workbase.css"></link>
	<link rel="stylesheet" href="lib/css/jquery.dataTables.min.css"></link>
	<script type="text/javascript" src="lib/js/jquery.min.js"></script>
	<script type="text/javascript" src="lib/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="lib/js/papaparse.min.js"></script>
	<script type="text/javascript" src="lib/js/jquery.dataTables.min.js"></script>
</head>
END;