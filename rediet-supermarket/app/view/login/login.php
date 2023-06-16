<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
 
<body>
    <header>
        <h1 class="heading">Login to your account</h1>
        
    </header>

    <!-- container div -->
    <div class="container">
 
        <!-- upper button section to select
             the login or signup form -->
        <div class="slider"></div>
        <div class="btn">
            <button class="login">Login</button>
            <a href="signup.php"><button class="signup">Signup</button></a>
        </div>
 
        <!-- Form section that contains the
             login and the signup form -->
        <div class="form-section">

 
            <!-- login form -->
            <div class="login-box">
            <form method="post">
                <input type="email" name="email"
                       class="email ele"
                       placeholder="youremail@email.com">
                <input type="password" name="password"
                       class="password ele"
                       placeholder="password">
                <button type="submit" class="clkbtn">Login</button>
            </form>
            </div>
 
            <!-- signup form -->
            <div class="signup-box">
    
            <form method="post">
                <input type="text"
                       class="name ele"
                       placeholder="Enter your name">
                <input type="email"
                       class="email ele"
                       placeholder="youremail@email.com">
                <input type="password"
                       class="password ele"
                       placeholder="password">
                <input type="password"
                       class="password ele"
                       placeholder="Confirm password">
                <button class="clkbtn">Signup</button>
            </form>
            </div>
        </div>
    </div>
     
    <script src="login.js"></script>
</body>
</html>