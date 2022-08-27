<?php
if (!defined('WORKBASE')){DEFINE("WORKBASE","0.1");}
DEFINE("BASE_DIR",$_SERVER['REQUEST_URI']);
error_reporting(E_ALL);

$logged_in = false;

if(isset($_COOKIE['WORKBASE']))
{
	$logged_in = true;
}

$title="Workbase";
$site_name="Pankaj's workbase";

include("../include/utils.php");
include("../include/head.php");
if(isset(($_GET['do'])))
{
echo '<body><div class="wrapper '.$_GET['do'].'">';
}
else{
echo '<body><div class="wrapper">';}


include("../include/navbar.php");
include("../include/body.php");
include("../include/footer.php");
echo <<<END
</div>
</body>
</html>
END;