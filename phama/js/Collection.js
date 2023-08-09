function setStatus(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('feedback_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_invoice.php?action=handle&id=" + id, true);
  xhttp.send();
}