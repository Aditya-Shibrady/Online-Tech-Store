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
<title>Search Product</title>
<script type="text/javascript">
$(document).ready(function() {
    $('#searchTable').DataTable();
});
</script>
</head>
<body>
	<?php include 'LeftNav.php'; ?>

	<div id="section" style="height: auto !important">
		<h2> Search Product </h2>
		<form id="SearchProductForm" name="form" method="post" action="Search.php">
			<div id="error"></div>
			<fieldset style="width: 500px">
				<legend>Search Product in the Inventory:</legend>
				<table>
					<tbody>
						<tr>
							<td>Enter Product Name: </td>
							<td><input type="text" name="productName"
								id="productName"></td>
						</tr>
						
						<tr>
							<td>Price: </td>
							<td>$<input type="text" name="productPriceLower"
								id="productPriceLower"> to $<input type="text" name="productPriceHigher"
								id="productPriceHigher"></td>
						</tr>
						
						<tr>
							<td>Select Product Category:</td>
							<td>
								<select id="productCategory" name="productCategory">
									<option value="-1">Select a Category</option>
									<?php 
										$query = "select * from  product_category where categoryActive='true'";
										$result = mysql_query($query, $conn);
										while($row = mysql_fetch_assoc($result))
										{
											echo "<option value='".$row['productCategoryId']."'>".$row['productCategoryName']."</option>";
										}
										mysql_close($conn);
									?>
								</select>
								<input type="hidden" id="categoryValue" name="categoryValue" value="-1"/>
							</td>
						</tr>
						
						<tr>
							<td colspan="1" align="center"><input type="button" value="Search"
								onclick="validateSearchProductForm()" /></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
		
		<?php 
		if(isset($_POST['productName']) && isset($_POST['productPriceLower']) && isset($_POST['productPriceHigher']) && isset($_POST['categoryValue'])) {
			$productName = 	$_POST['productName'];
			$productPriceLower = intval($_POST['productPriceLower']);
			$productPriceHigher = intval($_POST['productPriceHigher']);
			$categoryValue = intval($_POST['categoryValue']);
		?>
		
		<div id="searchResult">
			<h2> Search Results </h2>
			<table id="searchTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Product Price</th>
				<th>Available Quantity</th>
				<th>Add to Cart</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				include 'dbconnect.php';
				
				$email = $_SESSION['emailAddress'];
				$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId and active='true' ";
				if($productName != "")
					$query = $query."and product.productName like '%".$productName."%'";
				else if($categoryValue != -1 && $categoryValue != 0)
					$query = $query."and product.productCategoryId=".$categoryValue." ";
				else if($productPriceLower != 0)
					$query = $query."and product.productPrice >=".$productPriceLower." ";
				else if($productPriceHigher != 0)
					$query = $query."and product.productPrice <=".$productPriceHigher." ";
				
				//echo $query;
				//$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					$tableRow = "<tr align='center'><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td>";
					$pId = intval($row['productId']);
					
					$checkProductInCartQuery = "select productId from user_history where user_history.emailAddress = '$email' and user_history.isCheckedOut = 'false' and productId=".$pId."";
					$checkResult = mysql_query($checkProductInCartQuery, $conn);
					
					$num_rows = mysql_num_rows($checkResult);
					$tableUpdateButton = "";
					if($num_rows == 0) {
						$tableUpdateButton = "<td><input type='button' name='addToCart'  id='addToCart".$row['productId']."' value='addToCart' onclick='addProductToCart(\"".$row['productId']."\",\"".$email."\")'/></td></tr>";
					}
					else {
						$tableUpdateButton = "<td>Item Already added to cart</td></tr>";
					}
					
					$tableFinalRow = $tableRow.$tableUpdateButton;
					echo $tableFinalRow;
				}
				mysql_close($conn);
			?>
			
			</tbody>
		</table>
		
		
		</div>
		<?php } ?>
	</div>

	<div id="footer">Copyright © techstore.com</div>

</body>
</html>