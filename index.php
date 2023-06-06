
<?php







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form  id="sign-up" >
                <h1>Create Account</h1>
                <input type="hidden" name="form" value="sign-in">
                <input type="text" placeholder="Name" name="name" />
                <div class="error" id="name">
                </div>
                <input type="text" placeholder="Email" name="email"  />
                <div class="error" id="email">
                </div>
                <input type="text" placeholder="Password" name="password" />
                <div class="error" id="password">
                </div>
                <input type="text" placeholder="Confirm Password" name="secpassword" />
                <div class="error" id="secpassword">
                </div>
                <input type="submit" name="submit" value="Sign Up">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form id="sign-in">
                <h1>Sign in</h1>
                <input type="hidden" name="form" value="sign-in">
                <input type="text" placeholder="Email" name="email" />
                <div class="error" id="in-email">
                </div>
                <input type="text" placeholder="Password" name="password"/>
                <div class="error" id="in-password">
                </div>
              <input type="submit" name="submit" value="Sign In">  
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; ?>


    <?php echo '    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
'; ?>

  <?php echo '<script src="script.js"></script>'; ?>
    
</body>
</html>