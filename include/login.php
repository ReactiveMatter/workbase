<?php
if (!defined('WORKBASE')) exit();
#To ensure that this script runs only inside the Workbase

?>
<form id="login" action="auth.php" method="post">
<label for = "login-username" class="form-label">Username</label>
<input name="login-username" type="text" class="form-control"></input>
<label for="login-password" class="form-label">Password</label>
<input name="login-password" type="password" class="form-control"></input>
<input type="text" name="target" hidden value=""></input>
<input type="text" name="source" hidden value="form"></input>
<button type="submit" class="btn btn-success">Login</button>
</form>

