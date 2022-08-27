<?php
if (!defined('WORKBASE')){DEFINE("WORKBASE","0.1");}
$title="Workbase setup";
include("include/utils.php");
include("include/head.php");
echo '<body><div class="wrapper">';

if(file_exists('settings.php'))
{	
	echo alert_html("Setting file already exists. Use the <a href='./superuser'>superuser</a> page for managing site, and <a href='./?do=login'>login page</a> user login", "danger");
	exit();
}

if(isset($_POST['target']))
{	
	$message = array();
	$msg_type="success";
	if(isset($_POST['site-title']))
	{	if(strlen(trim($_POST['site-title']))==0)
		array_push($message, "Site title cannot be empty");
		$msg_type="info";
	}
	if(strlen(trim($_POST['superuser-password']))==0)
	{
		array_push($message, "Superuser password cannot be empty");
		$msg_type="info";
	}
	if(strlen(trim($_POST['sql-host']))==0)
	{
		array_push($message, "SQL host cannot be empty");
		$msg_type="info";
	}
	if(strlen(trim($_POST['db-username']))==0)
	{
		array_push($message, "MySQL username cannot be empty");
		$msg_type="info";
	}
	if(strlen(trim($_POST['db-password']))==0)
	{
		array_push($message, "MysQL password cannot be empty");
		$msg_type="info";
	}
	
	if(sizeof($message)==0)
	{	try{
		$conn = mysqli_init();
		$conn->options( MYSQLI_OPT_CONNECT_TIMEOUT, 3);
		$conn->real_connect(trim($_POST['sql-host']), trim($_POST['db-username']), trim($_POST['db-password']));
		}
		catch(Exception $ex){}
		// Check connection
		if ($conn->connect_error) {
		  array_push($message, "SQL connection failed: " . $conn->connect_error);
		  $msg_type="danger";
		}

		else
		{	$settings['site-title'] = 	trim($_POST['site-title']);
			$settings['superuser-password']= trim($_POST['superuser-password']);
			$settings['sql-host'] = trim($_POST['sql-host']);
			$settings['db-username'] = trim($_POST['db-username']);
			$settings['db-password'] = trim($_POST['db-password']);
			if(!file_exists("settings.php"))
			{	
				$settings_output = <<<EOT
				<?php
				#Settings file of workbase\n
				EOT;
				$settings_output.= "\$settings['site-title'] = '".addslashes($settings['site-title'])."';\n";
				$settings_output.= "\$settings['superuser-password'] = '".addslashes($settings['superuser-password'])."';\n";
				$settings_output.= "\$settings['sql-host'] = '".addslashes($settings['sql-host'])."';\n";
				$settings_output.= "\$settings['db-username'] = '".addslashes($settings['db-username'])."';\n";
				$settings_output.= "\$settings['db-password'] = '".password_hash($settings['db-password'], PASSWORD_DEFAULT)."';\n";


				$fp = fopen('settings.php', 'w');
				fwrite($fp, $settings_output);
				fclose($fp);
			}
			else
			{
				array_push($message, "Setting file already exists. Use the <a href='./superuser'>superuser</a> page for managing site, and <a href='./?do=login'>login page</a> user login");
				$msg_type="danger";
			}

			if(sizeof($message)==0)
			{
			array_push($message, "Workbase successfully installed. Use the <a href='./superuser'>superuser</a> page for managing site, and <a href='./?do=login'>login page</a> user login");
				$msg_type="success";
			}

		}
	}


	$msg_html = "";
	if(sizeof($message) > 1)
	{	$msg_html = $msg_html."<ol>";
		for ($i=0; $i < sizeof($message); $i++) {

			$msg_html =$msg_html."<li>".$message[$i]."</li>";
		}
		$msg_html = $msg_html."</ol>";
	}
	else
	{
		$msg_html = $message[0];
	}
	
	echo alert_html($msg_html, $msg_type);


}

?>
<form id="setup" method="post">
<h2 style="text-align: center;">Workbase setup</h2>
<label for = "site-title" class="form-label">Site title</label>
<div class="hint">Select a name for your site</div>
<input name="site-title" type="text" class="form-control" autocomplete="off"></input>
<label for="superuser-password" class="form-label">Superuser password</label>
<div class="hint">This password will be used for creating users, access control, managing tables, etc.</div>
<input name="superuser-password" type="password" class="form-control" autocomplete="off"></input>
<label for="sql-host" class="form-label">SQL host</label>
<div class="hint">Enter <code>localhost</code> or server IP address</div>
<input name="sql-host" type="text" class="form-control" value="localhost"></input>
<label for="db-username" class="form-label">MySQL username</label>
<div class="hint">This MySQL user should have right to create databases</div>
<input name="db-username" type="text" class="form-control" value="root"></input>
<label for="db-password" class="form-label">MySQL password</label>
<div class="hint">Password for MySQL user</div>
<input name="db-password" type="password" class="form-control"></input>
<input type="text" name="target" hidden value="setup"></input>
<input type="text" name="source" hidden value="form"></input>
<button type="submit" class="btn btn-outline-success">Set up</button>
</form>
</div>
</body>
</html>
<?php
