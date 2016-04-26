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
<script type="text/javascript" src="./js/validateUser.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="./css/index.css">
<title>My Cart</title>
<script type="text/javascript">

$(document).ready(function() {
    $('#cart').DataTable();
});

</script>
</head>
<body>
	<?php include 'LeftNav.php'; ?>

	<div id="section" style="height: 500px !important">
		<h2> My Cart: </h2>
		<div id="searchResult">
			<table id="cart" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Available Quantity</th>
				<th>Product Price</th>
				<th>Enter Quantity</th>
				<th>Checkout</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				include 'dbconnect.php';
				
				$email = $_SESSION['emailAddress'];
				$query = "select * from  user_history, product, product_category where product_category.productCategoryId = product.productCategoryId and active='true' and user_history.emailAddress = '$email' and user_history.isCheckedOut = 'false' and user_history.productId = product.productId";
				#echo $query;
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					$tableRow = "<tr align='center'>";
					$tableData = "<td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td><td><input type='text' id='quantity".$row['productId']."' name='quantity".$row['productId']."' value='0' /></td>";
					$tableButton="<td><input type='button' name='addToCart".$row['productId']."' id='addToCart".$row['productId']."' value='Checkout' onclick='validateCheckOutForm(\"".$row['productId']."\",\"".$email."\",\"".$row['historyId']."\",\"".$row['quantity']."\")'/></td></tr>";
					$tableFinalRow = $tableRow.$tableData.$tableButton;
					echo $tableFinalRow;
				}
				mysql_close($conn);
			?>
			
			</tbody>
		</table>
		</div>
		
		<div>
		<form id="checkoutForm" method="post" action="checkoutItem.php">
			<input type="hidden" name="quantity" id="quantity" />
			<input type="hidden" name="productId" id="productId" />
			<input type="hidden" name="historyId" id="historyId" />
		</form>
		</div>
	</div>

	<div id="footer">Copyright © techstore.com</div>

</body>
</html>