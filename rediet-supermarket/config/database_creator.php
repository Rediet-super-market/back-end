<?php

require_once 'credentials.php';


// Create a connection
$conn = new mysqli($servername, $username, $password, null, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
    exit;
}

// Select the database
$conn->select_db($database);

// SQL statements for table creation
$sql = "
CREATE TABLE IF NOT EXISTS Category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Supplier (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    contact_person VARCHAR(255),
    phone VARCHAR(20),
    email VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    category_id INT,
    entry_date DATE,
    expiry_date DATE,
    price DECIMAL(10, 2),
    amount INT,
    rating FLOAT,
    image_url VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES Category(category_id)
    
);

CREATE TABLE IF NOT EXISTS SupplierProduct (
    supplier_product_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    product_id INT,
    FOREIGN KEY (supplier_id) REFERENCES Supplier(supplier_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

CREATE TABLE IF NOT EXISTS User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    profile_image VARCHAR(255),
    date_of_birth DATE,
    last_login DATETIME,
    is_superuser TINYINT(1),
    is_staff TINYINT(1),
    is_active TINYINT(1),
    date_joined DATETIME
);

CREATE TABLE IF NOT EXISTS AccessList (
    access_id INT AUTO_INCREMENT PRIMARY KEY,
    access_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Permission (
    permission_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    codename VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS UserAccess (
    user_access_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    access_id INT,
    permission_id INT,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (access_id) REFERENCES AccessList(access_id),
    FOREIGN KEY (permission_id) REFERENCES Permission(permission_id)
);

CREATE TABLE IF NOT EXISTS Promotion (
    promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255),
    discount DECIMAL(10, 2),
    start_date DATE,
    end_date DATE
);

CREATE TABLE IF NOT EXISTS `Order` (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_date DATE,
    total_price DECIMAL(10, 2),
    status VARCHAR(255),
    promotion_id INT,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (promotion_id) REFERENCES Promotion(promotion_id)
);
CREATE TABLE IF NOT EXISTS Delivery (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    customer_id INT,
    delivery_boy_id INT,
    order_date DATE,
    location VARCHAR(255),
    price DECIMAL(10, 2),
    is_delivered TINYINT(1),
    FOREIGN KEY (order_id) REFERENCES `Order`(order_id),
    FOREIGN KEY (customer_id) REFERENCES User(user_id),
    FOREIGN KEY (delivery_boy_id) REFERENCES User(user_id)
);

CREATE TABLE IF NOT EXISTS Tracking (
    tracking_id INT AUTO_INCREMENT PRIMARY KEY,
    delivery_id INT,
    latitude FLOAT,
    longitude FLOAT,
    timestamp TIMESTAMP,
    FOREIGN KEY (delivery_id) REFERENCES Delivery(delivery_id)
);

CREATE TABLE IF NOT EXISTS Address (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    address_line1 VARCHAR(255),
    address_line2 VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    country VARCHAR(255),
    postal_code VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

CREATE TABLE IF NOT EXISTS Review (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    rating FLOAT,
    comment TEXT,
    review_date DATE,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

CREATE TABLE IF NOT EXISTS OrderItem (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES `Order`(order_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

CREATE TABLE IF NOT EXISTS Payment (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_id INT,
    payment_date DATE,
    amount DECIMAL(10, 2),
    status VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (order_id) REFERENCES `Order`(order_id)
);

CREATE TABLE IF NOT EXISTS Coupon (
    coupon_id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255),
    discount DECIMAL(10, 2),
    start_date DATE,
    end_date DATE,
    conditions TEXT
);

CREATE TABLE IF NOT EXISTS Wishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

CREATE TABLE IF NOT EXISTS ProductPromotion (
    product_promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    promotion_id INT,
    FOREIGN KEY (product_id) REFERENCES Product(product_id),
    FOREIGN KEY (promotion_id) REFERENCES Promotion(promotion_id)
);
";

// Execute the SQL statements
if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

// Close the connection
$conn->close();
?>
