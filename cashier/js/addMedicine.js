//start medicine
function addProduct() {
  document.getElementById("medicine_acknowledgement").innerHTML = "";
  var name = document.getElementById("medicine_name");
  var packing = document.getElementById("packing");
  //var buying_price = document.getElementById("buying_price");
  //var selling_price = document.getElementById("selling_price");
  //var product_category = document.getElementById("product_category");
  
  var supplier_name = document.getElementById("supplier_name");
  
  if(!notNull(name.value, "medicine_name_error"))
    name.focus();
    else if(!notNull(packing.value, "supplier_name_error"))
    supplier_name.focus();
  else if(!notNull(packing.value, "pack_error"))
    packing.focus();
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState = 4 && xhttp.status == 200)
  			document.getElementById("medicine_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_medicine.php?name=" + name.value +"&packing=" + packing.value +  "&suppliers_name=" + supplier_name.value, true);
  	xhttp.send();
  }
}