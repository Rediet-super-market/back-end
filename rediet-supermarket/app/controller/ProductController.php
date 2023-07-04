<?php
class ProductController {
    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function add() {
        // Gather data from request (POST, in this case)
        $name = $_POST['name'];
        $categoryId = $_POST['category_id'];
        $entryDate = $_POST['entry_date'];
        $expiryDate = $_POST['expiry_date'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $rating = $_POST['rating'];
        $imageUrl = $_POST['image_url'];

        // Call the model
        $result = $this->model->addProduct($name, $categoryId, $entryDate, $expiryDate, $price, $amount, $rating, $imageUrl);

        // Redirect or show a view
        if($result) {
            header("Location: /product_list.php");
        } else {
            require 'views/error.php';
        }
    }

    public function view() {
        $productId = $_GET['id'];
        $product = $this->model->getProduct($productId);
        require 'views/product_view.php';
    }

    public function delete() {
        $productId = $_GET['id'];
        $result = $this->model->deleteProduct($productId);
        
        if($result) {
            header("Location: /product_list.php");
        } else {
            require 'views/error.php';
        }
    }
}
?>
