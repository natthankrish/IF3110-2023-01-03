<!DOCTYPE html>
<html>
    <head>
        <title>Manage Users</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/DashboardStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">User</h1>
                <form action="/action_page.php" class="form">
                    <img src="<?= BASE_URL ?>/assets/icons/search.png"/>
                    <input type="text" id="fname" name="fname" class="textfield" placeholder="Type Username, ID, Name"><br>    
                </form>
            </div>
            <br>

            <table style="width:100%">
                <tr class="table-header">
                  <th style="width: 30px">ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Storage Usage</th>
                  <th></th>
                </tr>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
              </table>
              <?php include(dirname(__DIR__) . '/object/Pagination.php') ?>
        </div>
    </body>
</html>