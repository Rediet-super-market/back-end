<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2><?php echo $_SESSION['user']['username']; ?></h2>
    <img src="<?php echo $_SESSION['user']['profile_image']; ?>" alt="<?php echo $_SESSION['user']['username']; ?>">
    <form action="/profile.php" method="post">
        <input type="text" name="username" placeholder="Username" value="<?php echo $_SESSION['user']['username']; ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['user']['email']; ?>" required>
        <input type="text" name="profile_image" placeholder="Profile Image" value="<?php echo $_SESSION['user']['profile_image']; ?>">
        <input type="submit" value="Update">
    </form>
    <a href="/logout.php">Logout</a>
</body>
</html>
