//start medicine
function addProduct() {
  document.getElementById("medicine_acknowledgement").innerHTML = "";
  var name = document.getElementById("item_name");
  var item_expires = document.getElementById("item_expires");
  var item_price = document.getElementById("item_price");
  var item_catg = document.getElementById("item_cat");
  //var product_category = document.getElementById("product_category");
  if(!notNull(name.value, "item_name_error"))
    name.focus();
    else if(!notNull(item_catg.value, "item_cat_error"))
    item_catg.focus();
    else if(!notNull(item_price.value, "item_price_error"))
    item_price.focus();
    
  else if(!notNull(item_catg.value, "item_cat_error"))
    item_catg.focus();
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState = 4 && xhttp.status == 200)
  			document.getElementById("medicine_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_medicine.php?name=" + name.value +"&price=" + item_price.value +"&category=" + item_catg.value +  "&expires=" + item_expires.value, true);
  	xhttp.send();
  }
}