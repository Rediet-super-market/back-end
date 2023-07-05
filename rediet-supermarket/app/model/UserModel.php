<?php
class UserModel {
    protected $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function register($username, $email, $password, $profile_image) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO User (username, email, password, profile_image) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $username, $email, $password, $profile_image);
        return $stmt->execute();
    }

    public function getUser($username) {
        $query = "SELECT * FROM User WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($username, $email, $profile_image, $id) {
        $query = "UPDATE User SET username = ?, email = ?, profile_image = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", $username, $email, $profile_image, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM User WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
