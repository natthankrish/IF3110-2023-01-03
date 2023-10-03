<!DOCTYPE html>
<html>
    <head>
        <title>Manage My Account</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/ManageMyAccountStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Manage My Account</h1>
                <a href="/public/user/profile">
                    <button class="button-black">Back</button>
                </a>
            </div>
            <br>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Username</h2>
                    <h3>Current Username: natthankrish</h3>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname" name="fname" class="textfield" placeholder="Username"><br>    
                    <input type="submit" value="Confirm" class="button-black">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Name</h2>
                    <h3>Current Name: Natthan</h3>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname2" name="fname" class="textfield" placeholder="Name"><br>    
                    <input type="submit" value="Confirm" class="button-black">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Password</h2>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname3" name="fname" class="textfield" placeholder="New Password"><br>  
                    <input type="text" id="fname4" name="fname" class="textfield" placeholder="Confirm Password"><br>    
                    <input type="submit" value="Confirm" class="button-black">
                </form>
            </div>

            <h2>Storage Usage</h2>
            <p class="usage">78GB/123GB</p>
        </div>
    </body>
</html>