<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/profile.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/UserStyles.css">
    </head>
    <body>
        <div class="content">
            <div class="left">
                <img src="<?= BASE_URL ?>/assets/images/register-page.png" alt="Register Page">  
            </div>
            <div class="right">
                <div class="right-content">
                    <h1 class="title">Register</h1>
                    <div class="card">
                        <h2>Fill details</h2>
                        <form action="/action_page.php" class="form">
                            <input type="text" id="fname" name="fname" class="textfield" placeholder="Username">   
                            <input type="text" id="lname" name="lname" class="textfield" placeholder="Password">
                            <input type="text" id="lname" name="lname" class="textfield" placeholder="Confirm Password">
                            <p>Have an account? <span><a href="/public/user/login" class="link">LOGIN</a></span></p>
                            <input type="submit" value="REGISTER" class="button-black">
                        </form>
                    </div>
                </div>   
            </div>
        </div>
    </body>
</html>