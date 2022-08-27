<?php
if (!defined('WORKBASE')) exit();
#To ensure that this script runs only inside the Workbase

function alert_html($msg, $type)
{
	return '<div class="alert alert-'.$type.'" role="alert">'.$msg.'</div>';
}