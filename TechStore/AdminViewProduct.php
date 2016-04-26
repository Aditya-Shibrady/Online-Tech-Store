<?php
session_start();

include 'dbconnect.php';

if(!isset($_SESSION['emailAddress']) && !isset($_SESSION['firstName']) && !isset($_SESSION['lastName']))
	header('Location: http://localhost/TechStore/Login.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="./css/index.css">
<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">
<title>My Order History</title>
<script type="text/javascript">

$(document).ready(function() {
    $('#productsTable').DataTable();
});

</script>
</head>
<body>
	<?php include 'AdminLeftNav.php'; ?>
	
	<div id="section" style="height: auto; !important">
		<h4>All Products in Inventory</h4>
		<table id="productsTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Id</th>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Product Price</th>
				<th>Quantity</th>
				<th>Is Product Active</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					echo "<tr align='center'><td>".$row['productId']."</td><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td><td>".$row['active']."</td></tr>";
				}
				mysql_close($conn);
			?>
			</tbody>
		</table>
	</div>

	<div id="footer">Copyright © techstore.com</div>

</body>
</html>