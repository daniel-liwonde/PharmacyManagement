function addUser() {
  document.getElementById("user_acknowledgement").innerHTML = "";
  var user_fname = document.getElementById("user_fname");
  var user_lname =document.getElementById("user_lname ");
  var user_email = document.getElementById("user_email");
  var contact_number = document.getElementById("user_contact_number");
  var username = document.getElementById("username");
  var user_section=document.getElementById("user_section");
  var user_role=document.getElementById("user_role");
  var user_password = document.getElementById("user_password");
  var confirm_password = document.getElementById("confirm_password");
  if(!validateName(user_fname.value, "fname_error"))
    user_fname.focus();
    if(!validateName(user_lname.value, "name_error"))
    user_lname.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateEmail(user_email.value, "email_error"))
    user_email.focus();
    else if(!notNull(user_section.value, "section_error"))
    user_section.focus();
     else if(!validateName(user_role.value, "role_error"))
    user_role.focus();
     else if(!notNull(username.value, "username_error"))
    username.focus();
    else if(!notNull(user_password.value, "password_error"))
    user_password.focus();
    else if(!notNull(confirm_password.value, "confirm_password_error"))
    confirm_password.focus();
    else if(confirmPassword(user_password.value,confirm_password.value,"confirm_password_error"))
    confirm_password.focus();
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState = 4 && xhttp.status == 200)
  			document.getElementById("supplier_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_user.php?fname=" + user_fname.value +"&lname="+user_lname.value + "&user_email=" + user_email.value + 
    "&contact_number=" +  contact_number.value +"&user_role="+ user_role.value +"&user_password="+user_password.value +
    "username="+username.value + "&user_section=" + user_section.value, true);
  	xhttp.send();
  }
}
//end add user


