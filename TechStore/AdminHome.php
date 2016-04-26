<?php 
session_start();

if(!isset($_SESSION['emailAddress']) && !isset($_SESSION['firstName']) && !isset($_SESSION['lastName']))
	header('Location: http://localhost/TechStore/Login.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="./css/index.css">
<title>Home</title>
</head>
<body>
	<?php include 'AdminLeftNav.php'; ?>

	<div id="section" style="height: 500px !important">
		<h2>Welcome Admin</h2>
		<p> Welcome to Tech Store Admin View. </p>
	</div>

	<div id="footer">Copyright © techstore.com</div>

</body>
</html>