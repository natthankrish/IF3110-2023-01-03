<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/profile.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/UserStyles.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
                <div class="left">
                    <img src="<?= BASE_URL ?>/assets/images/login-page.png" alt="Login Page">   
                </div>
                <div class="right">
                    <div class="right-content">
                        <h1 class="title">Login</h1>
                        <div class="card">
                            <h2>Input Your Credentials</h2>
                            <form action="/action_page.php" class="form">
                                <input type="text" id="fname" name="fname" class="textfield" placeholder="Username"><br>    
                                <input type="text" id="lname" name="lname" class="textfield" placeholder="Password">
                                <p>Do not have an account? <span><a href="/public/user/register" class="link">REGISTER</a></span></p>
                                <input type="submit" value="LOGIN" class="button-black">
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>