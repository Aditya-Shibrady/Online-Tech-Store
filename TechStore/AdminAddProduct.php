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
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/validateAdmin.js"></script>
<link rel="stylesheet" type="text/css" href="./css/index.css">
<title>Add Product</title>
<script type="text/javascript">
</script>
</head>
<body>
	<?php include 'AdminLeftNav.php'; ?>

	<div id="section" style="height: 500px !important">
		<h2> Add Product : </h2>
		<form id="AddProductForm" name="form" method="post" action="AddProduct.php">
			<h6>Note * Is Active (Active products will be diaplayed to users for purchase.)</h6>
			<div id="error"></div>
			<fieldset style="width: 500px">
				<legend>Add Product to Inventory:</legend>
				<table>
					<tbody>
						<tr>
							<td>Enter Product Name: </td>
							<td><input type="text" name="productName"
								id="productName"></td>
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
										mysql_close($conn);
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
							<td colspan="1" align="center"><input type="button" value="Add Product"
								onclick="validateAddProductForm()" /></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
	</div>

	<div id="footer">Copyright © techstore.com</div>

</body>
</html>