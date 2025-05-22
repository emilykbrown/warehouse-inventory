<?php
session_start();
include "../../config/database.php";
include "../../controller/edit-product.php";

// if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'editor'])) {
//     header("Location: view-product.php?id=" . urlencode($_GET['id']));
//     exit;
// }

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No product specified.";
    exit;
}

$inventory_id = trim($_GET['id']);

try {
    $stmt = $con->prepare("SELECT * FROM inventory_tbl WHERE inventory_id = :inventory_id");
    $stmt->bindParam(':inventory_id', $inventory_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php

include "../../view/components/css-links.php";

?>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="mb-4">Edit Product</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="inventory_id" value="<?= $product['inventory_id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="inventory_name" value="<?= htmlspecialchars($product['inventory_name']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">UPC</label>
                    <input type="text" class="form-control" name="inventory_upc" value="<?= htmlspecialchars($product['inventory_upc']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="inventory_category" value="<?= htmlspecialchars($product['inventory_category']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Unit Price</label>
                    <input type="text" class="form-control" name="unit_price" value="<?= htmlspecialchars($product['unit_price']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="../<?= htmlspecialchars($product['inventory_img_path']) ?>" width="150" class="img-thumbnail mb-2"><br>
                    <label for="inventory_img">Upload New Image</label>
                    <input type="file" name="inventory_img" class="form-control">
                </div>

                <button type="submit" name="edit-product" class="btn btn-primary">Update Product</button>
                <a href="../inventory.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
