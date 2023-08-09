<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM medicines WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showMedicines(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showMedicines($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $category = $_GET["item_category"];
      $price = $_GET["item_price"];
      $item_expires = $_GET["expires"];
      updateMedicine($id, $name, $category, $price, $item_expires);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showMedicines(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchMedicine(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showMedicines($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM medicines";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showMedicineRow($seq_no, $row);
      }
    }
  }

  function showMedicineRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['NAME']; ?></td>
      <td><?php echo $row['CATEGORY']; ?></td>
      <td><?php echo $row['EXPIRES']?"YES":"NO"; ?></td>
      <td><?php echo $row['SELL_PRICE']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editMedicine(<?php echo $row['ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteMedicine(<?php echo $row['ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }
function findProduct()
              {
                require "db_connection.php";
              $data=mysqli_query($con,"SELECT * FROM product_categories") or die(mysqli_error($con));
              while($row=mysqli_fetch_assoc($data))
              {
              echo"<option> {$row['category']}</option>";
              }
              }
function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['NAME']; ?>" placeholder="Medicine Name" id="medicine_name" onblur="notNull(this.value, 'medicine_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="medicine_name_error" style="display: none;"></code>
    </td>
    <td>
      <select id="category_id" class="form-control">
        <option ><?php  echo $row['CATEGORY']  ?></option>
        <?php  
        findProduct()
        
        ?>
</select>
      <code class="text-danger small font-weight-bold float-right" id="category_error" style="display: none;"></code>
    </td>
    <td>
       <input type="checkbox" style="margin-left:50%" id="expires">
      <code class="text-danger small font-weight-bold float-right" id="expires_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['SELL_PRICE']; ?>" placeholder="Selling price" id="selling_price" onblur="notNull(this.value, 'selling_price_error');">
      
      <code class="text-danger small font-weight-bold float-right" id="selling_price_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicine(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateMedicine($id, $name, $category, $price, $item_expires) {
  require "db_connection.php";
  $query = "UPDATE medicines SET NAME = '$name', CATEGORY = '$category', EXPIRES='$item_expires',SELL_PRICE = '$price'  WHERE ID = $id";

  $result = mysqli_query($con, $query)or die(mysqli_error($con));
   $query2 = "UPDATE medicines_stock SET NAME = '$name', MRP = '$price'  WHERE MEDICINE_ID = $id";
$result2 = mysqli_query($con, $query2)or die(mysqli_error($con));
  if(!empty($result))
    showMedicines(0);
}

function searchMedicine($text, $tag) {
  require "db_connection.php";
  if($tag == "name")
    $column = "NAME";
  if($tag == "category")
    $column = "CATEGORY";
  if($tag == "expire_status")
    $column = "EXPIRES";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM medicines WHERE UPPER($column) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showMedicineRow($seq_no, $row);
    }
  }
}

?>
