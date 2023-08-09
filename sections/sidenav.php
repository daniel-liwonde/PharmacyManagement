<script type="text/javascript">
  var pid = "none";
  function showhide(id) {
    var elements = document.getElementById(id).childNodes;
    var menu = elements[3];
    var arrow = ((elements[1].childNodes)[4].childNodes)[1];
    if(menu.style.display == 'block') {
      menu.style.display = "none";
      arrow.style.transform = "rotate(0deg)";
      elements[1].style.color = "#eeeeee";
    }
    else {
      menu.style.display = "block";
      arrow.style.transform = "rotate(180deg)";
      elements[1].style.color = "#ff5252";
    }
    if(pid == id)
      pid = "none";
    if(pid != "none") {
      elements = document.getElementById(pid).childNodes;
      menu = (document.getElementById(pid).childNodes)[3];
      arrow = ((elements[1].childNodes)[4].childNodes)[1];
      if(menu.style.display == 'block') {
        menu.style.display = "none";
        arrow.style.transform = "rotate(0deg)";
        elements[1].style.color = "#eeeeee";
      }
    }
    pid = id;
  }

  function showOptions() {
    var flag = document.getElementById('options');
    if(flag.style.display == 'block') {
      flag.style.display = "none";
      document.getElementById('mark').style.display = "none";
    }
    else {
      flag.style.display = "block";
      document.getElementById('mark').style.display = "block";
    }
  }
</script>
<style>
.treeview-menu .treeview a{background-color:inherit;}
  </style>
<?php
	if(isset($_GET['menu'])) $menu= $_GET['menu']; else $menu = 0;
    function makeActive($menu)
    {
      if($_GET['menu']==$menu) echo "style='background-color: #2C3B41; color:rgb(103,243,108); border-top-left-radius:15px;
      border-bottom-left-radius:15px; border-top-right-radius:15px; height: auto; width: 110.5%; border-right: 3px solid #ff5252;border-bottom:1px solid rgb(103,243,108)'";
    }
    ?>
    <style>
      .sidenav{
        background-color: #ee6a00;
      }
    .main-menu-item > * >.fa{
      color:rgb(103,243,108);
    }
    .main-menu-item:hover{
      color:#ff5252;
    }

        </style>
    <div class="sidenav" style="width:18%; background-color:#ffffff;">
  <div class="card">
    <div class="card-body">
      <div class="logo">
        <img src="images/ccap2.png" class="profile" width="100" height="100"/>
        
        <h1 class="logo-caption text-strong"><span style="color:rgb(103,243,108); font-weight: bolder;">A</span>dmin</h1>
        
      </div> <!-- logo class -->
      <!-- dashboard start -->
      
      <div class="main-menu-item"  <?php  makeActive(0) ?>>
        <a href="home.php?menu=0"><i class="fa fa-dashboard"></i><span>Dashboard
          <i class="fa fa-angle-right pull-right" style="margin-left:36% ;position:absolute; margin-top:5px"></i>
        </span></a>
      </div>

      <!-- dashboard end -->
<div id="eigth" class="main-menu-item" onclick="showhide(this.id);" <?php  makeActive(8) ?>>
      	<a href="settings.php?menu=8">
      		<i class="fa fa-gear"></i><span>Settings
            <i class="fa fa-angle-right pull-right" style="margin-left:44% ;position:absolute; margin-top:5px"></i>
          </span>
      		
      	</a>
      
      </div>
      <!-- invoice strat -->
      <div id="first" class="main-menu-item" onclick="showhide(this.id);" <?php  makeActive(1) ?>>
      	<a  href="#">
      		<i class="fa fa-balance-scale"></i><span>Invoice</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-down pull-right" style="margin-left:100px ;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="new_invoice.php?menu=1"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;New Invoice</a></li>
      		<li class="treeview"><a href="manage_invoice.php?menu=1"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Manage Invoice </a></li>
      	</ul>
      </div>
      <!-- invoice end -->

      <!-- customer end -->
      <div id="second" class="main-menu-item" onclick="showhide(this.id);"<?php makeActive(2) ?>>
      	<a>
      		<i class="fa fa-hand-holding-medical"></i><span>Customer</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-down pull-right" style="margin-left:82px;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_customer.php?menu=2"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Add Customer</a></li>
      		<li class="treeview"><a href="manage_customer.php?menu=2"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Manage Customers</a></li>
      	</ul>
      </div>
      <!-- customer end -->
        
      <!-- medicine strat -->
      <div id="third" class="main-menu-item" onclick="showhide(this.id);" <?php makeActive(3) ?>>
      	<a href="#">
      		<i class="fa fa-shopping-bag"></i><span>Product </span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-down pull-right" style="margin-left:100px;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_medicine.php?menu=3"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Add Product</a></li>
      		<li class="treeview"><a href="manage_medicine.php?menu=3"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Manage Products</a></li>
          <li class="treeview"><a href="manage_medicine_stock.php?menu=3"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Manage Product Stock</a></li>
      	</ul>
      </div>
      <!-- medicine end -->

      <!-- manufacturer start -->
      <div id="fourth" class="main-menu-item" onclick="showhide(this.id);" <?php makeActive(4)  ?>>
      	<a href="#">
      		<i class="fa fa-people-group"></i><span>Supplier</span>
      		<span class="pull-right-container">
      		<i class="fa fa-angle-down pull-right" style="margin-left:90px;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_supplier.php?menu=4"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Add Supplier</a></li>
      		<li class="treeview"><a href="manage_supplier.php?menu=4"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Manage Supplier</a></li>
      	</ul>
      </div>
      <!-- manufacturer end -->

      <!-- purchase start -->
      <div id="fifth" class="main-menu-item" onclick="showhide(this.id);" <?php  makeActive(5) ?>>
      	<a href="#">
      		<i class="fa fa-shopping-cart"></i><span>Purchase</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-down pull-right" style="margin-left:90px ;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
      		<li class="treeview"><a href="add_purchase.php?menu=5"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Add Purchase</a></li>
      		<li class="treeview"><a href="manage_purchase.php?menu=5"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Manage Purchase</a></li>
      	</ul>
      </div>
      
      <!-- purchase end -->

      <!-- report start -->
      <div id="sixth" class="main-menu-item" onclick="showhide(this.id);" <?php  makeActive(6)  ?>>
      	<a href="#">
      		<i class="fa fa-book"></i><span>Report</span>
      		<span class="pull-right-container">
      			<i class="fa fa-angle-down pull-right" style="margin-left:105px;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
          <li class="treeview"><a href="sales_report.php?menu=6"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;General Sales Report</a></li>
      		<li class="treeview"><a href="detailed_sales_report.php?menu=6"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Product Sales Report</a></li>
          <li class="treeview"><a href="cashier_report.php?menu=6"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Cashier Sales Report</a></li>
          <li class="treeview"><a href="purchase_report.php?menu=6"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Purchase Report</a></li>
      	</ul>
      </div>
      <!-- report end -->

      <!-- search start -->
      <div id="seventh" class="main-menu-item" onclick="showhide(this.id);" <?php makeActive(7) ?>>
      	<a href="#">
      		<i class="fa fa-search"></i><span>Search</span>
      		<span class="pull-right-container">
      		<i class="fa fa-angle-down pull-right" style="margin-left:105px;position:absolute; margin-top:5px"></i>
      		</span>
      	</a>
      	<ul class="treeview-menu" style="display: none;">
          <li class="treeview"><a href="manage_invoice.php?menu=7"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Invoice</a></li>
          <li class="treeview"><a href="manage_customer.php?menu=7"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Customer</a></li>
      		<li class="treeview"><a href="manage_medicine.php?menu=7"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Medicine</a></li>
          <li class="treeview"><a href="manage_supplier.php?menu=7"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Supplier</a></li>
      		<li class="treeview"><a href="manage_purchase.php?menu=7"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Purchase</a></li>
      	</ul>
      </div>
      <!-- search end -->

    </div> <!-- card-body class -->
  </div> <!-- card  -->
</div>
