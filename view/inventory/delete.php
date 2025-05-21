<?php
include "../../config/database.php"; // adjust the path if needed

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    // Optional: Validate the ID format if you're using UUIDs
    if (!preg_match('/^[a-f0-9\-]{36}$/', $inventory_id)) {
        die("Invalid ID format.");
    }

    // Fetch to confirm the product exists (optional but useful for error handling/logging)
    $stmt_check = $con->prepare("SELECT inventory_img_path FROM inventory_tbl WHERE inventory_id = :inventory_id");
    $stmt_check->bindParam(':inventory_id', $inventory_id);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        $product = $stmt_check->fetch(PDO::FETCH_ASSOC);

        // Optionally delete the image file
        $img_path = $product['inventory_img_path'];
        if (file_exists($img_path)) {
            unlink($img_path); // delete image file
        }

        // Now delete the product from the DB
        $stmt_delete = $con->prepare("DELETE FROM inventory_tbl WHERE inventory_id = :inventory_id");
        $stmt_delete->bindParam(':inventory_id', $inventory_id);
        $stmt_delete->execute();

        header("Location: ../inventory.php?deleted=1"); // redirect with confirmation
        exit;
    } else {
        die("Product not found.");
    }
} else {
    die("No product ID provided.");
}