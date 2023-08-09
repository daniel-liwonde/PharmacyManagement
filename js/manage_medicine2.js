function deleteMedicine(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editMedicine(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_medicine.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateMedicine(id) {
  var medicine_name = document.getElementById("medicine_name");
  var item_category = document.getElementById("category_id");
  var item_price = document.getElementById("selling_price");
  var item_expires = document.getElementById("expires");
if (item_expires.checked) {
 item_expires=1;
  // Do something when the checkbox is checked
} else {
 item_expires=0
  // Do something when the checkbox is not checked
}
alert(item_expires);
  if(!notNull(medicine_name.value, "medicine_name_error"))
    medicine_name.focus();
  else if(!notNull(item_price.value, "selling_price_error"))
    selling_price.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=update&id=" + id + "&name=" + medicine_name.value + "&item_category=" + item_category.value + "&expires=" + item_expires + "&item_price=" + item_price.value, true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_medicine.php?action=cancel", true);
  xhttp.send();
}

function searchMedicine(text, tag) {
  if(tag == "name") {
    document.getElementById("by_category").value = "";
    document.getElementById("by_expires").value = "";
  }
  if(tag == "category") {
    document.getElementById("by_name").value = "";
    document.getElementById("by_expires").value = "";
  }
  if(tag == "expire_status") {
    document.getElementById("by_name").value = "";
    document.getElementById("by_category").value = "";
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_medicine.php?action=search&text=" + text + "&tag=" + tag, true);
  xhttp.send();
}
