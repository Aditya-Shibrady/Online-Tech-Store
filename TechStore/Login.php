<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="./css/index.css">
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/validateUser.js"></script>
<title>Login</title>
</head>
<body>
	<div id="header">
		<h1>Find My Gadget</h1>
	</div>
	<div align="center" style="height: 500px !important">
		<div id="error" style="display: block; padding-top: 100px !important">
			<font color="red"><?php if( isset($_GET['msg'])) { print "Username or Password do not match";} ?> </font>
		</div>

		<form id="loginForm" name="loginForm" method="post" action="Authenticate.php">
			<fieldset style="width: 400px">
				<legend>Log in:</legend>
				<table>
					<tbody>
						<tr>
							<td>Email Id</td>
							<td><input type="text" name="email" id="email">
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="password" id="password">
						</tr>
						<tr>
							<td><input type="button" value="Login" onclick="validateLoginForm()" />
							</td>
							<td><input type="button" value="Signup" onclick="redirectToSignup()" />
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
	</div>
	<div id="footer">Copyright © techstore.com</div>
</body>
</html>
