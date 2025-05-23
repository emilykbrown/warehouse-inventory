<?php
require_once '../../rbac.php';
checkAccess(['inventory_manager']);

include "../../config/database.php";

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
            <h1 class="mb-4">Product Details</h1>
            <form>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" readonly class="form-control-plaintext" value="<?= htmlspecialchars($product['inventory_name']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">UPC</label>
                    <input type="text" readonly class="form-control-plaintext" value="<?= htmlspecialchars($product['inventory_upc']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" readonly class="form-control-plaintext" value="<?= htmlspecialchars($product['inventory_category']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Unit Price</label>
                    <input type="text" readonly class="form-control-plaintext" value="<?= htmlspecialchars($product['unit_price']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    <img src="../<?= htmlspecialchars($product['inventory_img_path']) ?>" width="150" class="img-thumbnail">
                </div>

                <a href="../inventory.php" class="btn btn-secondary">Back to Inventory</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
