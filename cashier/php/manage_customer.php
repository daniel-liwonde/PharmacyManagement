<?php
  require "db_connection.php";
require_once"functions.php";
  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM customers WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showCustomers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showCustomers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $contact_number = $_GET["contact_number"];
      $village = ucwords($_GET["village"]);
      $TA = ucwords($_GET["TA"]);
      $bdate = ucwords($_GET["bdate"]);
      $gender = ucwords($_GET["gender"]);
      $district =ucwords($_GET["district"]);
      updateCustomer($id, $name, $contact_number, $village, $bdate, $TA,$gender,$district);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showCustomers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchCustomer(strtoupper($_GET["text"]));
  }

  function showCustomers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM customers";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showCustomerRow($seq_no, $row);
      }
    }
  }

  function showCustomerRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['NAME']; ?></td>
      <td><?php echo $row['CONTACT_NUMBER']; ?></td>
       <td><?php echo $row['GENDER']; ?></td>
      <td><?php echo $row['VILLAGE']; ?></td>
      <td><?php formatDate($row['D_BIRTH']); ?></td>
      <td><?php echo $row['TA']; ?></td>
      <td><?php echo $row['DISTRICT']; ?></td>
      <td>
        <button href="javascript:void(0);"  class="btn btn-info btn-sm" onclick="editCustomer(<?php echo $row['ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteCustomer(<?php echo $row['ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['NAME']; ?>" placeholder="Name" id="customer_name" onkeyup="validateName(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['CONTACT_NUMBER']; ?>" placeholder="Contact Number" id="customer_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <select class="form-control"  id="customer_gender" onblur="validateName(this.value, 'customer_gender_error');">
      <option><?php echo $row['GENDER']; ?></option>
      <option>Male</option>
       <option>Female</option>
    </select>
      <code class="text-danger small font-weight-bold float-right" id="customer_gender_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['VILLAGE']; ?>" placeholder="Village" id="customer_village" onkeyup="validateName(this.value, 'village_error');">
      <code class="text-danger small font-weight-bold float-right" id="village_error" style="display: none;"></code>
    </td>
    <td>
      <input type="date" class="form-control"  placeholder="Date of birth" value="<?php echo $row['D_BIRTH']  ?>" id="b_date" onblur="checkDate(this.value, 'b_date_error');">
      <code class="text-danger small font-weight-bold float-right" id="b_date_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" placeholder="T/A" id="customer_TA" onblur="validateName(this.value, 'customer_TA_error');" value="<?php echo $row['TA']; ?>">
      <code class="text-danger small font-weight-bold float-right" id="customer_TA_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" placeholder="Customer district" id="customer_district" onblur="validateName(this.value, 'district_error');" value="<?php echo $row['DISTRICT']; ?>" >
      <code class="text-danger small font-weight-bold float-right" id="district_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateCustomer(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateCustomer($id, $name, $contact_number, $village, $bdate, $TA,$gender,$district) {
  require "db_connection.php";
  $query = "UPDATE customers SET NAME = '$name', CONTACT_NUMBER = '$contact_number', VILLAGE = '$village', D_BIRTH = '$bdate', TA = '$TA',GENDER='$gender', DISTRICT='$district' WHERE ID = $id";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  if(!empty($result))
    showCustomers(0);
}

function searchCustomer($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM customers WHERE UPPER(NAME) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showCustomerRow($seq_no, $row);
    }
  }
}

?>
