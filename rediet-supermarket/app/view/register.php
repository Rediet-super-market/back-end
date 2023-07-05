<?php
// Include database connection
$db = require_once 'database.php';

// Include the User Model
require_once 'UserModel.php';

// Include the User Controller
require_once 'UserController.php';

// Create a new User Model
$model = new UserModel($db);

// Create a new User Controller
$controller = new UserController($model);

// Call the register method
$controller->register();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form action="http://localhost/PHP%20Projects/back-end/rediet-supermarket/app/view/register.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="profile_image" placeholder="Profile Image">
        <input type="submit" value="Register">
    </form>
</body>
</html>
