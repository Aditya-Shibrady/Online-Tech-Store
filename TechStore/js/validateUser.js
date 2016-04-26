function validateForm() {
	var email = $("#email").val();
	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var gender = $("#gender").val();
	$("#genderval").val($('#gender').find(":selected").val())
	var phnumber = $("#phnumber").val();
	var address = $("#address").val();
	var city = $("#city").val();
	var state = $("#state").val();
	var zipcode = $("#zipcode").val();
	var password = $("#password").val();
	var cpassword = $("#cpassword").val();

	if($("#email").val() == "" ){
		$("#email").focus();
		$("#error").html("<font color=\"red\"> Please enter email address. </font>");
		return false;

	} else if(!isValidEmail($("#email").val())) {
		$("#email").focus();
		$("#error").html("<font color=\"red\"> Please enter valid email address. </font>");
		return false;

	} else if($("#fname").val() == "") {
		$("#fname").focus();
		$("#error").html("<font color=\"red\"> Please enter first name. </font>");
		return false;

	} else if($("#lname").val() == "") {
		$("#lname").focus();
		$("#error").html("<font color=\"red\"> Please enter last name </font>");
		return false;

	} else if($("#phnumber").val() == "") {
		$("#phnumber").focus();
		$("#error").html("<font color=\"red\"> Please enter phone number </font>");
		return false;

	} else if(!$("#phnumber").val().match(/\d/g)) {
		$("#phnumber").focus();
		$("#error").html("<font color=\"red\"> Please enter correct phone number. </font>");
		return false;

	} /*else if($("#phnumber").val().match(/\d/g)) {
		if($("#phnumber").val().length != 10) {
			$("#phnumber").focus();
			$("#error").html("<font color=\"red\"> Phone number should be 10 digits long. </font>");
			return false;
		}
	}*/ else if($("#address").val() == "") {
		$("#address").focus();
		$("#error").html("<font color=\"red\"> Please enter address </font>");
		return false;
		
	} else if($("#city").val() == "") {
		$("#city").focus();
		$("#error").html("<font color=\"red\"> Please enter city </font>");
		return false;

	} else if($("#state").val() == "") {
		$("#state").focus();
		$("#error").html("<font color=\"red\"> Please enter state </font>");
		return false;

	} else if($("#zipcode").val() == "") {
		$("#zipcode").focus();
		$("#error").html("<font color=\"red\"> Please enter zipcode </font>");
		return false;

	} else if(!$("#zipcode").val().match(/\d/g)) {
		$("#zipcode").focus();
		$("#error").html("<font color=\"red\"> Please enter correct zip code. </font>");
		return false;

	} else if($("#password").val() == "") {
		$("#password").focus();
		$("#error").html("<font color=\"red\"> Please enter password </font>");
		return false;

	} else if($("#cpassword").val() == "") {
		$("#cpassword").focus();
		$("#error").html("<font color=\"red\"> Please enter password again </font>");
		return false;
		
	} else if(!isStrongPassword(password)) {
		$("#password").focus();
		$("#error").html("<font color=\"red\"> Password <ul><li>Password length should be 8.</li> <li>Password should contains lower and upper case character</li> " +
		"<li>Password should contain alphanumeric characters</li> <li>Password should contains atleast one special character(e.g. ! @ # $ % ^ etc.)</li></ul> </font>");
		return false;
		
	} else if($("#password").val() != $("#cpassword").val()) {
		$("#password").focus();
		$("#error").html("<font color=\"red\"> Password does not match! </font>");
		return false;

	} else {
		isUserNameExists(email);
		return false;
	}
}

function isUserNameExists(email) {
	$.ajax({

		url : "http://localhost/TechStore/checkUser.php",
		type: 'POST',
		async: false,
        data: { "email": email} ,
		success : function(data) {
			if(data.isexists) {
				$("#email").focus();
				$("#error").html("<font color=\"red\"> User Already Exists! </font>");
				return false;
			} else {
				$("#registerform").submit();
			}
		},
		error : function() {
			alert("error while sending request please try again after some tine");
			return "false";
		}
	});
}

function isValidEmail(email) {
	var emailregex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return email.match(emailregex);
}

function isStrongPassword(password) {
	if (password.length < 7) 
		return false;

	if (!password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  
		return false;

	if (!password.match(/([a-zA-Z])/) && !password.match(/([0-9])/))
		return false;

	if (!password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
		return false;
	return true;

}

function redirectToSignup() {
	window.location.href="http://localhost/TechStore/Signup.html";
}

function redirectToLogin() {
	window.location.href="http://localhost/TechStore/Login.php";
}

function validateLoginForm() {
	var email = $("#email").val();
	var password = $("#password").val();
	
	if($("#email").val() == "" ){
		$("#email").focus();
		$("#error").html("<font color=\"red\"> Please enter email address. </font>");
		return false;

	} else if(!isValidEmail($("#email").val())) {
		$("#email").focus();
		$("#error").html("<font color=\"red\"> Please enter valid email address. </font>");
		return false;

	} else if($("#password").val() == "") {
		$("#password").focus();
		$("#error").html("<font color=\"red\"> Please enter password </font>");
		return false;

	} else {
		$("#loginForm").submit();
	}
}


function validateSearchProductForm() {
	document.getElementById("categoryValue").value = document.getElementById("productCategory").options[document.getElementById("productCategory").selectedIndex].value;
	/*if($("#productName").val() == "" && $("#categoryValue").val() == -1 && $("#productPriceLower").val() != "" && $("#productPriceHigher").val() != ""){
		$("#productName").focus();
		$("#error").html("<font color=\"red\"> Please enter atleast one search parameter. </font>");
		return false;

	} else*/ if($("#productPriceLower").val() != "" && !$("#productPriceLower").val().match(/\d/g)) {
		$("#productPriceLower").focus();
		$("#error").html("<font color=\"red\"> Please enter correct price value. </font>");
		return false;

	} else if($("#productPriceHigher").val() != "" && !$("#productPriceHigher").val().match(/\d/g)) {
		$("#productPriceLower").focus();
		$("#error").html("<font color=\"red\"> Please enter correct price value. </font>");
		return false;
	} else {
		$("#SearchProductForm").submit();
	}
}

function addProductToCart(id,email) {
	
	//document.getElementbyId('addToCart'+id)
	$.ajax({

		url : "http://localhost/TechStore/updateCart.php",
		type: 'POST',
		async: false,
        data: { "email": email, "productId":id} ,
		success : function(data) {
			if(data.isSuccessful) {
				document.getElementById('addToCart'+id).parentNode.innerHTML = "Item added to cart"
				
			} else {
				alert("There was an error while sending request Please try again.")
				return false;
				
			}
		},
		error : function() {
			alert("error while sending request please try again after some tine");
			return "false";
		}
	});
	
	
}

function validateCheckOutForm(id, email, historyId, availablequantity) {
	if($("#quantity"+id).val() == "" || $("#quantity"+id).val() == "0") {
		$("#quantity"+id).focus();
		alert("Please enter quantity");
		return false;

	}
	else if(!$("#quantity"+id).val().match(/\d/g)) {
		$("#quantity"+id).focus();
		alert("Please enter correct digit");
		return false;

	} else if($("#quantity"+id).val() > availablequantity){
		$("#quantity"+id).focus();
		alert("Total "+$("#quantity"+id).val()+ " products are not available at this moment!");
		return false;
	} else {
		//alert(document.getElementById("quantity"+id).value);
		//alert(document.getElementById("quantity").value+"......"+document.getElementById("productId").value);
		document.getElementById("quantity").value = document.getElementById("quantity"+id).value;
		document.getElementById("productId").value = id;
		document.getElementById("historyId").value = historyId;
		document.getElementById("checkoutForm").submit();
	}
}



