<?php
include "../../config/database.php";
include "../../config/variables.php";
include "../../config/uuid.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};

$inventory_id = $_GET['id'] ?? $_POST['inventory_id'] ?? null;

// Redirect if no ID is present
if (!$inventory_id) {
    $_SESSION['error_message'] = "Missing product ID.";
    header("Location: ../view/inventory.php");
    exit;
}

// Fetch existing data (for form prefilling)
$query = "SELECT * FROM inventory_tbl WHERE inventory_id = :inventory_id";
$stmt = $con->prepare($query);
$stmt->bindParam(':inventory_id', $inventory_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    $_SESSION['error_message'] = "Product not found.";
    header("Location: ../view/inventory.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-product'])) {
    $valid_check = 0;

    $inventory_name = htmlspecialchars($_POST['inventory_name']);
    $inventory_upc = htmlspecialchars($_POST['inventory_upc']);
    $inventory_category = htmlspecialchars($_POST['inventory_category']);
    $unit_price = htmlspecialchars($_POST['unit_price']);

    // Validate fields
    if (empty($inventory_name)) {
        $inventory_name_error = "Enter product name";
    } else if (!preg_match($text_regex, $inventory_name)) {
        $inventory_name_error = "Invalid product name";
    } else {
        $valid_check++;
    }

    if (empty($inventory_upc)) {
        $upc_error = "Enter UPC";
    } else if (!preg_match($upc_regex, $inventory_upc)) {
        $upc_error = "Invalid UPC";
    } else {
        $valid_check++;
    }

    if (empty($inventory_category)) {
        $category_error = "Enter category";
    } else if (!preg_match($text_regex, $inventory_category)) {
        $category_error = "Invalid category";
    } else {
        $valid_check++;
    }

    if (empty($unit_price)) {
        $unit_price_error = "Enter unit price";
    } else if (!preg_match($price_regex, $unit_price)) {
        $unit_price_error = "Invalid unit price";
    } else {
        $valid_check++;
    }

    $db_path = $product['inventory_img_path']; // Default to existing image

    if (isset($_FILES['inventory_img']) && $_FILES['inventory_img']['error'] !== UPLOAD_ERR_NO_FILE) {
        $img_file = $_FILES['inventory_img']['name'];
        $ext = pathinfo($img_file, PATHINFO_EXTENSION);

        $inventory_name_slug = strtolower(trim($inventory_name));
        $inventory_name_slug = preg_replace('/[^a-z0-9\s\-]/', '', $inventory_name_slug);
        $inventory_name_slug = preg_replace('/[\s]+/', '-', $inventory_name_slug);

        $file_name = $inventory_name_slug . '.' . $ext;
        $tmp_name = $_FILES['inventory_img']['tmp_name'];
        $file_size = $_FILES['inventory_img']['size'];

        $upload_dir = 'upload/';
        $server_path = __DIR__ . '/../view/upload/' . $file_name;
        $db_path = $upload_dir . $file_name;

        if (!preg_match($img_regex, $img_file)) {
            $inventory_img_error = "Unsupported file type (JPG, PNG, GIF)";
        } elseif ($file_size > 2 * 1024 * 1024) {
            $inventory_img_error = "Image too big (max 2MB)";
        } else {
            if (move_uploaded_file($tmp_name, $server_path)) {
                $valid_check++;
            } else {
                $inventory_img_error = "Failed to upload image";
            }
        }
    } else {
        // No new file uploaded — still valid
        $valid_check++;
    }

    // Update record if all checks passed
    if ($valid_check === 5) {
        $query = "UPDATE inventory_tbl 
                  SET inventory_name = :inventory_name,
                      inventory_upc = :inventory_upc,
                      inventory_category = :inventory_category,
                      unit_price = :unit_price,
                      inventory_img_path = :inventory_img_path
                  WHERE inventory_id = :inventory_id";

        $stmt = $con->prepare($query);
        $stmt->bindParam(':inventory_name', $inventory_name);
        $stmt->bindParam(':inventory_upc', $inventory_upc);
        $stmt->bindParam(':inventory_category', $inventory_category);
        $stmt->bindParam(':unit_price', $unit_price);
        $stmt->bindParam(':inventory_img_path', $db_path);
        $stmt->bindParam(':inventory_id', $inventory_id);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Product updated successfully.";
            header("Location: ../inventory.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Failed to update product.";
        }
    }
}
?>
