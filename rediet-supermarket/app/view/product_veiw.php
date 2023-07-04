<!DOCTYPE html>
<html>
<head>
    <title>Product View</title>
</head>
<body>
    <h2><?php echo $product['name']; ?></h2>
    <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
    <p>Price: <?php echo $product['price']; ?></p>
    <p>Amount: <?php echo $product['amount']; ?></p>
    <p>Rating: <?php echo $product['rating']; ?></p>
    <!-- Other product information -->
</body>
</html>
