<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/UserDetailStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <div class="left">
                    <div class="left1">
                        <h1 class="title">Manage Account</h1>
                        <h2>User #ID</h2>
                    </div>
                    <button class="button2">Delete Account</button>
                </div>
                <button class="button">Back</button>
            </div>
            <br>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Username</h2>
                    <h3>Current Username: natthankrish</h3>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname" name="fname" class="textfield" placeholder="Username"><br>    
                    <input type="submit" value="Confirm" class="button">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Name</h2>
                    <h3>Current Name: Natthan</h3>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname2" name="fname" class="textfield" placeholder="Name"><br>    
                    <input type="submit" value="Confirm" class="button">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Password</h2>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname3" name="fname" class="textfield" placeholder="New Password"><br>  
                    <input type="text" id="fname4" name="fname" class="textfield" placeholder="Confirm Password"><br>    
                    <input type="submit" value="Confirm" class="button">
                </form>
            </div>
            <div class="item-setting-container1">
                <div class="item-setting-label"> 
                    <h2>Storage Usage</h2>
                    <p class="usage">78GB/123GB</p>
                </div>
                <form action="/action_page.php" class="form1">
                    <input type="text" id="fname5" name="fname" class="textfield1" placeholder="100">
                    <h2>GB</h2>
                    <input type="submit" value="Upgrade" class="button3">
                </form>
            </div>
        </div>
    </body>
</html>