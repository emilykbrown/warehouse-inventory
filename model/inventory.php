<?php
class Inventory {
    private $conn;

    public function __construct($db) {
        require "../config/database.php"; // sets $conn
        $this->conn = $db;
    }

    // Add product
    public function addProduct($data) {
        $stmt = $this->conn->prepare("INSERT INTO inventory_tbl (inventory_name, inventory_upc, inventory_category, unit_price, qty_stocked, inventory_img_path) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'], $data['upc'], $data['category'], $data['price'], $data['quantity'], $data['img']
        ]);
    }

    // Update product
    public function updateProduct($id, $data) {
        $stmt = $this->conn->prepare("UPDATE inventory_tbl SET inventory_name = ?, inventory_upc = ?, inventory_category = ?, unit_price = ?, qty_stocked = ?, inventory_img_path = ? WHERE inventory_id = ?");
        return $stmt->execute([
            $data['name'], $data['upc'], $data['category'], $data['price'], $data['quantity'], $data['img'], $id
        ]);
    }

    // Delete product
    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM inventory_tbl WHERE inventory_id = ?");
        return $stmt->execute([$id]);
    }

    // Get single product
    public function getProductById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM inventory_tbl WHERE inventory_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all products
    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM inventory_tbl");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
