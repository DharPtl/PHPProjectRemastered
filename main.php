
<?php
  
    $bg_color = ' rgba(17, 107, 143, 0.877)'; // Change the background color
    echo "<body style='background-color: $bg_color;'>";

    function setupDatabase()
    {
      $servername = "localhost"; 
      $username = "drose"; 
      $password = "cp476dhar"; 
      $dbname = "cp476"; 
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    
      return $conn;
    }
    include 'update_data.php'; 
    
    
    function getSupplierData($conn) {
      $stmt = $conn->prepare("SELECT * FROM Supplier");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }
    
    function getProductData($conn) {
      $stmt = $conn->prepare("SELECT * FROM Product");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }

    function getInventoryOutputData($conn) {
      $stmt = $conn->prepare("SELECT * FROM inventoryoutput");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }

    $conn = SetupDatabase();
    ?>
      <h1>Home Page</h1>
      <div class="tables-container" style="overflow: scroll">
        <div>
          <h2>Product Table</h2>
            <div id="name-table-error-message"></div>
            <table id="product">
              <tr>
                <th>ProductID</th>
                <th>ProductName</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Supplier ID</th>
                <th>Delete Row</th>
              </tr>
              <?php
              $data = GetProductData($conn);
              foreach ($data as $row) {
              ?>
                <tr> <!-- Product Table -->
                  <td><?php print $row["ProductID"]; ?></td>
                  <td><?php print $row["ProductName"]; ?></td>
                  <td><?php print $row["Description"]; ?></td>
                  <td><?php print $row["Price"]; ?></td>
                  <td><?php print $row["Quantity"]; ?></td>
                  <td><?php print $row["Status"]; ?></td>
                  <td><?php print $row["SupplierID"]; ?></td>
                  <td><?php
                      $id = "s" . (string) $row["ProductID"];
                      $result = '<button id=' . $id . '>Delete</button>';
                      echo $result;
                      ?></td>
                </tr>
              <?php
              }
              ?>
            </table>
            <table>
              <tr> <!--For product table -->
                <form id="name-table-form" method="POST">
                  <div>
                    <td>
                      <label for="ProductID">Product ID</label>
                      <input id="ProductID" name="ProductID" type="number" required>
                    </td>
                    <td>
                      <label for="ProductName">ProductName</label>
                      <input id="ProductName" name="ProductName" type="text" required>
                    </td>
                    <td>
                      <label for="Description">Description</label>
                      <input id="Description" name="Description" type="text" required>
                    </td>
                    <td>
                      <label for="Price">Price</label>
                      <input id="Price" name="Price" type="number" required>
                    </td>
                    <td>
                      <label for="Quantity">Quantity</label>
                      <input id="Quantity" name="Quantity" type="number" required>
                    </td>
                    <td>
                      <label for="Status">Status</label>
                      <input id="Status" name="Status" type="text" required>
                    </td>
                    <td>
                      <label for="SupplierID">SupplierID</label>
                      <input id="SupplierID" name="SupplierID" type="number" required>
                    </td>
                    <td>
                      <input id="submit-name" value="Add" type="submit">
                    </td>
                  </div>
                </form>
              </tr>
            </table>
        </div>
        <?php
        ?>
        <div>
          <!--Supplier Table -->
          <h2>Supplier Table</h2>
          <div id="course-table-error-message"></div>
          <table id="supplier">
            <tr>
              <th>SupplierID</th>
              <th>SupplierName</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Email</th>
            </tr>
            <tr>
              <?php
              $data = GetSupplierData($conn);
              foreach ($data as $row) {
              ?>
            <tr>
              <td><?php print $row["SupplierID"]; ?></td>
              <td><?php print $row["SupplierName"]; ?></td>
              <td><?php print $row["Address"]; ?></td>
              <td><?php print $row["Phone"]; ?></td>
              <td><?php print $row["Email"]; ?></td>
              <td><?php
                  $id = "c" . (string) $row["SupplierID"];
                  $result = '<button id=' . $id . '>Delete</button>';
                  echo $result;
                  ?></td>
            </tr>
          <?php
              }
          ?>
          <tr>
          </tr>
          </table>
          <table>
            <tr>
              <form id="course-table-form" method="POST">
                <div>
                  <td>
                    <label for="SupplierID">Supplier ID</label>
                    <input id="SupplierID" name="SupplierID" type="number" required>
                  </td>
                  <td>
                    <label for="SupplierName">SupplierName</label>
                    <input id="SupplierName" name="SupplierName" type="text" required>
                  </td>
                  <td>
                    <label for="Address">Address</label>
                    <input id="Address" name="Address" type="text" required>
                  </td>
                  <td>
                    <label for="Phone">Phone</label>
                    <input id="Phone" name="Phone" type="number" required>
                  </td>
                  <td>
                    <label for="Email">Email</label>
                    <input id="Email" name="Email" type="email" required>
                  </td>
                  <td>
                    <input id="submit-course" value="Add" type="submit">
                  </td>
                </div>
              </form>
            </tr>
          </table>
        </div>
      </div>
      <?php
      ?>
      <div>
        <h2>Inventory Output</h2>
        <table id="inventoryoutput">
          <tr>
            <th>ProductID</th>
            <th>ProductName</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>SupplierName</th>
          </tr>
          <tr>
            <?php
            $data = GetInventoryOutputData($conn);
            foreach ($data as $row) {
            ?>
          <tr>
            <td><?php print $row["ProductID"]; ?></td>
            <td><?php print $row["ProductName"]; ?></td>
            <td><?php print $row["Quantity"]; ?></td>
            <td><?php print $row["Price"]; ?></td>
            <td><?php print $row["Status"]; ?></td>
            <td><?php print $row["SupplierName"]; ?></td>
          </tr>
        <?php
            }
        ?>
        </table>
      </div>
      </div>
    <?php
    # Close the database connection after use
    $conn->close();
?>
