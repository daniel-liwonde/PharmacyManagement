function deleteCustomer(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_customer.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editCustomer(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_customer.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateCustomer(id) {
  var customer_name = document.getElementById("customer_name");
  var contact_number = document.getElementById("customer_contact_number");
  var customer_gender = document.getElementById("customer_gender");
  var customer_village = document.getElementById("customer_village");
  var b_date = document.getElementById("b_date");
  var customer_TA = document.getElementById("customer_TA");
  var customer_district = document.getElementById("customer_district");
  alert(b_date.value,customer_TA.value,id,customer_gender.value);
  if(!validateName(customer_name.value, "name_error"))
    customer_name.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateAddress(customer_gender.value, "customer_gender_error"))
    customer_gender.focus();
  else if(!validateName(customer_village.value, 'village_error'))
    customer_village.focus();
  else if(!checkDate(b_date.value, 'b_date_error'))
    b_date.focus();
    else if(!validateName(customer_TA.value, 'customer_TA_error'))
   customer_TA.focus();
   else if(!validateName(customer_district.value, 'district_error'))
   customer_district.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_customer.php?action=update&id=" + id + "&name=" + customer_name.value + "&district=" + customer_district.value + "&contact_number=" + contact_number.value + "&village=" + customer_village.value + "&bdate=" + b_date.value + "&TA=" + customer_TA.value, true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_customer.php?action=cancel", true);
  xhttp.send();
}

function searchCustomer(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('customers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_customer.php?action=search&text=" + text, true);
  xhttp.send();
}
