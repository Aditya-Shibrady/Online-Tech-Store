<?php
session_start();


include 'dbconnect.php';
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
    $('#orderHistoryTable').DataTable();
});

</script>
</head>
<body>
	<?php include 'LeftNav.php'; ?>

	<div id="section" style="height: 500px !important">
		<table id="orderHistoryTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Product Price</th>
				<th>Quantity</th>
				<th>Checkout Date</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$email = $_SESSION['emailAddress'];
				
				$query = "select * from  user_history, product, product_category where emailAddress='$email' and product.productId = user_history.productId and product_category.productCategoryId = product.productCategoryId";
				
				$result = mysql_query($query, $conn);
				mysql_query($query);
				while($row = mysql_fetch_assoc($result))
				{
					//echo $row['productId'];
					echo "<tr align='center'><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['buyQuantity']."</td><td>".$row['totalCost']."</td><td>".$row['checkoutDate']."</td></tr>";
				}
				mysql_close($conn);
			?>
			</tbody>
		</table>
	</div>

	<div id="footer">Copyright © techstore.com</div>

</body>
</html>