<?php
session_start(); // Start the session to access user data

include "../../config/database.php";

// Check if ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No product specified.";
    exit;
}

$inventory_id = trim($_GET['id']); // Clean the input

try {
    // Prepare and execute query
    $stmt = $con->prepare("SELECT * FROM inventory_tbl WHERE inventory_id = :inventory_id");
    $stmt->bindParam(':inventory_id', $inventory_id);
    $stmt->execute();

    // Fetch result
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit;
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// Role-based check
$isEditor = isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['admin', 'editor']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="mb-4">Product Details</h1>

            <?php if ($isEditor): ?>
                <form action="../../controller/update-product.php" method="post" enctype="multipart/form-data">
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

                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="../inventory/index.php" class="btn btn-secondary">Cancel</a>
                </form>
            <?php else: ?>
                <!-- Read-Only Version -->
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

                    <a href="../inventory/index.php" class="btn btn-secondary">Back to Inventory</a>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
