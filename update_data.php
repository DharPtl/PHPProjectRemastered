<?php
function updateSupplierData($conn, $supplierID, $supplierName, $address, $phone, $email)
{
    $stmt = $conn->prepare("UPDATE Supplier SET SupplierName = ?, Address = ?, Phone = ?, Email = ? WHERE SupplierID = ?");
    $stmt->bind_param("ssssi", $supplierName, $address, $phone, $email, $supplierID);
    return $stmt->execute();
}

function updateProductData($conn, $productID, $productName, $description, $price, $quantity, $status, $supplierID)
{
    $stmt = $conn->prepare("UPDATE Product SET ProductName = ?, Description = ?, Price = ?, Quantity = ?, Status = ?, SupplierID = ? WHERE ProductID = ?");
    $stmt->bind_param("ssddisi", $productName, $description, $price, $quantity, $status, $supplierID, $productID);
    return $stmt->execute();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    include_once 'main.php';

    $conn = setupDatabase();

    
    if (isset($_POST["SupplierID"])) {
      
    }

    
    if (isset($_POST["ProductID"])) {
        
    }

    
    $conn->close();
}
?>