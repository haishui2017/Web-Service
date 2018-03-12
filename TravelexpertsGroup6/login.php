<!--Author: Kennard Stewart-->
<!--Created: Nov 10th, 2017-->

<?php
    session_start();
    if(isset($_SESSION["message"]))
    {
        $message = $_SESSION["message"];
        $_SESSION["message"] = "";
        unset($_SESSION["message"]);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
        <link rel="stylesheet" href="css/nav_styles.css" />
        <link rel="stylesheet" href="css/form_styles.css" />
        <link rel="stylesheet" href="css/main_styles.css" />
    </head>
    <body>
        <div class="body-container">
            <div class="body-border" id="login-body" >
                <?php
                    include("navigation.php");
                    if (isset($_SESSION["loggedin"]))
                    {
                        header("location: index.php");
                    }	
                    else
                    {
                        $user_status = "Login";
                        $go_to = "login.php";
                    }
                ?>
                <?php
                    (isset($message)) ? print("<script>alert('$message');</script>") : print(""); //ternary expression
                ?>
                <div class="login-container">
                    
                    <h1>Sign In</h1>
                    <form method="post" action="php/checkrequests.php">
                        <div class="profile-img-container">
                        </div>

                        <div class="login-inputs">
                            <input type="text" placeholder="Enter username or email address" name="CustUserName" class="login-inputs"/>

                            <input type="password" placeholder="Enter password" autocomplete="new-password" name="CustPassword" class="login-inputs"/>

                            <button type="submit" class="loginBtn"><span>Login</span></button>
                        </div>

                        <div class="cancel-container">
                            <span class="forgot">Don't have account yet? <a style="text-decoration" href="register.php">Sign Up</a></span>
                        </div>
                    </form>
                <script type="text/javascript" src="scripts/scripts.js"></script>
                </div>
                <?php
                    include("footer.php");  
                ?>
            </div>
        </div>
    </body>
</html>
