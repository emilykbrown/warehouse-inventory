<?php

include "../../config/database.php";
include "../../config/variables.php";
include "../../config/uuid.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-product'])) {
    $valid_check = 0;
    $inventory_id = UUID::v4(); 
    
    $inventory_name = htmlspecialchars($_POST['inventory_name']);
    $inventory_upc = htmlspecialchars($_POST['inventory_upc']);
    $inventory_category = htmlspecialchars($_POST['inventory_category']);
    $unit_price = htmlspecialchars($_POST['unit_price']);   

    if (empty($inventory_name)) {
        $inventory_name_error = "Enter product name";
    } else if (!preg_match($text_regex, $inventory_name)) {
        $inventory_name_error = "Invalid product name";
    } else {
        $valid_check += 1;
    }
 
    if (empty($inventory_upc)) { 
        $upc_error = "Enter UPC";
    } else if (!preg_match($upc_regex, $inventory_upc)) {
        $upc_error = "Invalid UPC";
    } else {
        $valid_check += 1;
    }

    if (empty($inventory_category)) {
        $category_error = "Enter category";
    } else if (!preg_match($text_regex, $inventory_category)) {
        $category_error = "Invalid category";
    } else {
        $valid_check += 1;
    }

    if (empty($unit_price)) {
        $unit_price_error = "Enter unit price";
    } else if (!preg_match($price_regex, $unit_price)) {
        $unit_price_error = "Invalid unit price";
    } else {
        $valid_check += 1;
    }
    
    if (isset($_FILES['inventory_img']) && $_FILES['inventory_img']['error'] !== UPLOAD_ERR_NO_FILE) {
    $img_file = $_FILES['inventory_img']['name'];
    $ext = pathinfo($img_file, PATHINFO_EXTENSION);

    $img_file = $_FILES['inventory_img']['name'];
    $ext = pathinfo($img_file, PATHINFO_EXTENSION);


    // Convert product name to lowercase, replace spaces with -, remove unsafe characters
    $inventory_name_slug = strtolower(trim($inventory_name));
    $inventory_name_slug = preg_replace('/[^a-z0-9\s\-]/', '', $inventory_name_slug); // remove special chars
    $inventory_name_slug = preg_replace('/[\s]+/', '-', $inventory_name_slug);       // replace spaces with -

    $file_name = $inventory_name_slug . '.' . $ext;
    
    $tmp_name = $_FILES['inventory_img']['tmp_name'];
    $file_size = $_FILES['inventory_img']['size'];

    // Upload path
    $upload_dir = 'upload/';
    $server_path = '../view/' . $upload_dir . $file_name;  // used to move file
    $db_path = $upload_dir . $file_name;                   // stored in DB
   
    // Validate file
    if (!preg_match($img_regex, $img_file)) {
        $inventory_img_error = "Unsupported file type (only JPG, PNG, GIF allowed)";
    } elseif ($file_size > 2 * 1024 * 1024) { // 2MB
        $inventory_img_error = "Image too big (max 2MB)";
    } else {
        if (move_uploaded_file($tmp_name, $server_path)) {
            // Success – set value for DB insert
            $inventory_img_path = $db_path;
            $valid_check += 1;
        } else {
            $inventory_img_error = "Failed to upload image";
        }
    }
} else {
    $inventory_img_error = "Please select an image to upload";
}


    if ($valid_check == 5) {
        $query = "INSERT INTO inventory_tbl 
            (inventory_id, inventory_name, inventory_upc, inventory_category, unit_price, inventory_img_path)
            VALUES 
            (:inventory_id, :inventory_name, :inventory_upc, :inventory_category, :unit_price, :inventory_img_path)";
        
        $stmt = $con->prepare($query);
    
        $stmt->bindParam(':inventory_id', $inventory_id);
        $stmt->bindParam(':inventory_name', $inventory_name);
        $stmt->bindParam(':inventory_upc', $inventory_upc);
        $stmt->bindParam(':inventory_category', $inventory_category);
        $stmt->bindParam(':unit_price', $unit_price);
        $stmt->bindParam(':inventory_img_path', $db_path); // Corrected

        session_start();

        if ($stmt->execute()) {
            header("Location: ../view/inventory.php");
            $_SESSION['success_message'] = "Product added successfully.";
            exit;
        } else {
            $_SESSION['error_message'] = "Failed to add product. Please try again.";
            exit;
        }

        
    }

}

?>