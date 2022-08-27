<?php 
if (!defined('WORKBASE')) exit();
#To ensure that this script runs only inside the Workbase

$nav_options = array(
 	0 => 'login',
 	1 => 'settings');

function display_text_options($text)
{
	return ucfirst(strtolower($text));
}

function if_active($option)
{	if(isset($_GET['do']))
	{
	if(strtolower(trim($option)) === strtolower(trim($_GET['do'])))
	{
		return "active";
	}
	}
	return "";
}

function create_navbar_options()
{	global $logged_in, $nav_options;
	$option_html = "";
	if($logged_in)
	{	echo $nav_options[0];
	}
	else
	{
		for ($i=sizeof($nav_options)-1; $i>=0 ; $i--) {
			$option_html = $option_html."<div class='nav-option ".if_active($nav_options[$i])."'><a href='?do=".$nav_options[$i]."'>".display_text_options($nav_options[$i])."</a></div>";
		}
	
		
	}

	return $option_html;
}

?>

<div id="navbar">
<div id="site-name"><a href="."><?=$site_name?></a></div>
<div id="options"><?=create_navbar_options()?></div>
</div>
