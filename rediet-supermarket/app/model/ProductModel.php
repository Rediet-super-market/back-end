<?php
class ProductModel {
    protected $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function addProduct($name, $categoryId, $entryDate, $expiryDate, $price, $amount, $rating, $imageUrl) {
        $query = "INSERT INTO Product (name, category_id, entry_date, expiry_date, price, amount, rating, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sisssdis", $name, $categoryId, $entryDate, $expiryDate, $price, $amount, $rating, $imageUrl);
        return $stmt->execute();
    }

    public function getProduct($productId) {
        $query = "SELECT * FROM Product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function deleteProduct($productId) {
        $query = "DELETE FROM Product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $productId);
        return $stmt->execute();
    }
}
?>
