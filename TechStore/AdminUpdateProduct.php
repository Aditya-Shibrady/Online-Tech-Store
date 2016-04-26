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
<script type="text/javascript" src="./js/validateAdmin.js"></script>
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
	
	<div id="section" style="height: auto !important">
		<div id="updateFormDiv" style="display: None;">
		<h2> Update Product </h2>
		<div id="error"></div>
		<form id="UpdateProductForm" name="form" method="post" action="UpdateProduct.php">
			<h6>Note * Is Active (Active products will be diaplayed to users for purchase.)</h6>
			<fieldset style="width: 500px">
				<legend>Add Product to Inventory:</legend>
				<table>
					<tbody>
						<tr>
							<td>Enter Product Name: </td>
							<td><input type="text" name="productName"
								id="productName"><input type="hidden" name="productId"
								id="productId"><input type="hidden" name="productUpdateAction" id="productUpdateAction" value="update"></td>
						</tr>
						
						<tr>
							<td>Enter Product Description: </td>
							<td><textarea rows="2" cols="10" name="productDescription" id="productDescription"> </textarea></td>
						</tr>
						
						<tr>
							<td>Enter Product Price: </td>
							<td><input type="text" name="productPrice"
								id="productPrice"></td>
						</tr>
						
						<tr>
							<td>Enter Product Quantity: </td>
							<td><input type="text" name="productQuantity"
								id="productQuantity"></td>
						</tr>
						
						<tr>
							<td>Select Product Category:</td>
							<td>
								<select id="productCategory" name="productCategory">
									<?php 
										$query = "select * from  product_category where categoryActive='true'";
										$result = mysql_query($query, $conn);
										while($row = mysql_fetch_assoc($result))
										{
											echo "<option value='".$row['productCategoryId']."'>".$row['productCategoryName']."</option>";
										}
									?>
								</select>
								<input type="hidden" id="categoryValue" name="categoryValue"/>
							</td>
						</tr>
						
						<tr>
							<td>Is Active</td>
							<td>
								<select id="productActive" name="productActive">
									<option value="true">true</option>
									<option value="false">false</option>
								</select>
								<input type="hidden" id="productActiveValue" name="productActiveValue"/>
							</td>
						</tr>
						<tr>
							<td colspan="1" align="center"><input type="button" value="Update Product"
								onclick="validateUpdateProductForm()" /></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
		</div>
		
		<div id="deleteProductDiv" style="display: none;">
			<form id="DeleteProductForm" name="form" method="post" action="UpdateProduct.php">
				<input type="hidden" name="productDeleteId" id="productDeleteId">
				<input type="hidden" name="productDeleteAction" id="productDeleteAction" value="delete">
			</form>
		</div>
		
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
				<th>Update Product</th>
				<th>Delete Product</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					//echo $row['productId'];
					#".$row['productId']", ".$row['productName'].", ".$row['productDescription'].", ".$row['productCategoryName'].", ".$row['productPrice'].", ".$row['quantity'].", "$row['active']."
					$tableRow = "<tr align='center'><td>".$row['productId']."</td><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td><td>".$row['active']."</td>";
					$tableUpdateButton = "<td><input type='button' name='updateProduct'  id='updateProduct' value='Update' onclick='showUpdateProductForm(\"".$row['productId']."\",\"".$row["productName"]."\",\"".$row['productDescription']."\",\"".$row['productCategoryId']."\",\"".$row['productPrice']."\",\"".$row['quantity']."\",\"".$row['active']."\")'/></td>";
					$tableDeleteButton = "<td><input type='button' name='deleteProduct'  id='deleteProduct' value='Delete' onclick='confirmDeleteProductForm(\"".$row['productId']."\")'/></td></tr>";
					$tableFinalRow = $tableRow.$tableUpdateButton.$tableDeleteButton;
					echo $tableFinalRow;
				}
				mysql_close($conn);
			?>
			
			</tbody>
		</table>
		
		
	</div>
	
	<div id="footer">Copyright © techstore.com</div>

</body>
</html>