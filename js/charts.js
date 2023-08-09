function dowork() {
  var start_date = document.getElementById('start_date').value;
  var end_date = document.getElementById('end_date').value;
  var cashier_id = document.getElementById('cashier_id').value;
  
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
	{
		//alert(start_date + " " + end_date);
    console.log(xhttp.responseText);
      document.getElementById("chartContainer2").innerHTML=xhttp.responseText;
	}
 };
  xhttp.open("GET", "anoter.php?start_date=" + start_date + "&end_date=" + end_date+"&cashier_id="+ cashier_id, true);
  xhttp.send();
}