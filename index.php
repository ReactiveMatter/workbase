<?php
//Defining constant which will be later used
if (!defined('WORKBASE')){DEFINE("WORKBASE","0.1");}

DEFINE("BASE_DIR",$_SERVER['REQUEST_URI']);
DEFINE("HOST", $_SERVER['DOCUMENT_ROOT']);

//Check whether the workbase is setup or not
if(file_exists('settings.php'))
{
	include('settings.php');
	$title=$settings['site-title'];
	$site_name=$settings['site-title'];
}
else
{
	header("Location: setup.php");
}

$logged_in = false;

if(isset($_COOKIE['WORKBASE']))
{
	$logged_in = true;
}

include("include/utils.php");
include("include/head.php");
if(isset(($_GET['do'])))
{
echo '<body><div class="wrapper '.$_GET['do'].'">';
}
else{
echo '<body><div class="wrapper">';}


include("include/navbar.php");
include("include/body.php");
include("include/footer.php");
echo <<<END
</div>
</body>
</html>
END;