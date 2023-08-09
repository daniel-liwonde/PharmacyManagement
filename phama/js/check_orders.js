  setInterval(function() {
    // Use AJAX to fetch new content and update the div
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("display_orders").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "php/refresh_content.php", true);
    xhttp.send();
  }, 5000); // 5 seconds in milliseconds
