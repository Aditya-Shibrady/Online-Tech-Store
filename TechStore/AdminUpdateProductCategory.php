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
		<div id="updateProductCategoryFormDiv" style="display: None;">
		<h2> Update Product </h2>
		<div id="error"></div>
		<form id="UpdateProductCategoryForm" name="form" method="post" action="UpdateProductCategory.php">
			<fieldset style="width: 500px">
				<legend>Product Category:</legend>
				<table>
					<tbody>
						<tr>
							<td>Enter Category Name: </td>
							<td><input type="text" name="productCategoryName"
								id="productCategoryName"><input type="hidden" name="productCategoryId"
								id="productCategoryId"><input type="hidden" name="productCategoryUpdateAction"
								id="productCategoryUpdateAction" value="update"></td>
						</tr>
						<tr>
							<td>Is Active (Active category will be diaplayed while Adding Product)</td>
							<td>
								<select id="categoryActive">
									<option value="true">true</option>
									<option value="false">false</option>
								</select>
								<input type="hidden" id="categoryActiveValue" name="categoryActiveValue"/>
							</td>
						</tr>
						<tr>
							<td colspan="1" align="center"><input type="button" value="Update Category"
								onclick="validateUpdateProductCategoryForm()" /></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
		</div>
		<div id="deleteProductCategoryDiv" style="display: none;">
			<form id="DeleteProductCategoryForm" name="form" method="post" action="UpdateProductCategory.php">
				<input type="hidden" name="productDeleteCategoryId" id="productDeleteCategoryId">
				<input type="hidden" name="productCategoryDeleteAction" id="productCategoryDeleteAction" value="delete">
			</form>
		</div>
		<h4>All Products in Inventory</h4>
		<table id="productsTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Category Id</th>
				<th>Product Category Name</th>
				<th>Is Product Category Active</th>
				<th>Update Product Category</th>
				<th>Delete Product Category</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from  product_category ";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					//echo $row['productId'];
					#".$row['productId']", ".$row['productName'].", ".$row['productDescription'].", ".$row['productCategoryName'].", ".$row['productPrice'].", ".$row['quantity'].", "$row['active']."
					$tableRow = "<tr align='center'><td>".$row['productCategoryId']."</td><td>".$row['productCategoryName']."</td><td>".$row['categoryActive']."</td>";
					$tableUpdateButton = "<td><input type='button' name='updateProductCategory'  id='updateProduct' value='Update' onclick='showUpdateProductCategoryForm(\"".$row['productCategoryId']."\",\"".$row["productCategoryName"]."\",\"".$row['categoryActive']."\")'/></td>";
					$tableDeleteButton = "<td><input type='button' name='deleteProductCategory'  id='deleteProduct' value='Delete' onclick='confirmDeleteProductCategoryForm(\"".$row['productCategoryId']."\")'/></td></tr>";
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