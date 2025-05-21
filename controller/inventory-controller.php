<?php

include "../config/database.php";
include "../config/variables.php";
include "../config/uuid.php";

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
        $inventory_upc_error = "Enter UPC";
    } else if (!preg_match($upc_regex, $inventory_upc)) {
        $inventory_upc_error = "Invalid UPC";
    } else {
        $valid_check += 1;
    }

    if (empty($inventory_category)) {
        $inventory_category_error = "Enter category";
    } else if (!preg_match($text_regex, $inventory_category)) {
        $inventory_category_error = "Invalid category";
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

    $img_file = $_FILES['inventory_img']['name'];
    $ext = pathinfo($img_file, PATHINFO_EXTENSION);
    $file_name = $inventory_name . '.' . $ext;
    $tmp_name = $_FILES['inventory_img']['tmp_name'];
    $file_size = $_FILES['inventory_img']['size'];
    $file_path = '../view/upload/' . $file_name;

    if (empty($_FILES['inventory_img'])) {
        $inventory_img_error = "Enter product image";
    } elseif (!preg_match($img_regex, $file_path)) {
        $inventory_img_error = "Unsupported file type";
    } elseif ($file_size > 2000000) {
        $inventory_img_error = "Image too big";
    } else {
        if (move_uploaded_file($tmp_name, $file_path)) {
           $valid_check += 1;  
        } else {
            $inventory_img_error = "Failed to upload image";
        }
    }

    if ($valid_check == 6) {
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
        $stmt->bindParam(':inventory_img_path', $file_name); // Corrected
    
        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error inserting into database.";
        }
        echo 'test';
        
        echo isset($inventory_name_error) ? "<br>$inventory_name_error" : "";
        echo isset($inventory_upc_error) ? "<br>$inventory_upc_error" : "";
        echo isset($inventory_category_error) ? "<br>$inventory_category_error" : "";
        echo isset($unit_price_error) ? "<br>$unit_price_error" : "";
        echo isset($inventory_img_error) ? "<br>$inventory_img_error" : "";
    }
    

}

?>