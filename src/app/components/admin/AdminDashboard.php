<!DOCTYPE html>
<html>
    <head>
        <title>Manage Admins</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/DashboardStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Admin</h1>
                <div class="title-container">
                    <button class="button2">Add Admin</button>
                    <form action="/action_page.php" class="form">
                        <img src="<?= BASE_URL ?>/assets/icons/search.png"/>
                        <input type="text" id="fname" name="fname" class="textfield" placeholder="Type Username, ID, Name"><br>    
                    </form>
                </div>
            </div>
            <br>

            <table style="width:100%">
                <tr class="table-header">
                  <th style="width: 30px">ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th></th>
                </tr>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
              </table>
        </div>
    </body>
</html>