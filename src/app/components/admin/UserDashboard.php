<!DOCTYPE html>
<html>
    <head>
        <title>Manage Users</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/DashboardStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">User</h1>
                <form action="/action_page.php" class="form">
                    <img src="assets/search.png"/>
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
                <tr>
                  <td>1</td>
                  <td>Maria Anders</td>
                  <td>Germany</td>
                  <td>Alfreds Futterkiste</td>
                  <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Francisco Chang</td>
                  <td>Alfreds Futterkiste</td>
                  <td>Mexico</td>
                  <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Francisco Chang</td>
                    <td>Alfreds Futterkiste</td>
                    <td>Mexico</td>
                    <td class="button-column"><button class="button">Manage Account</button></td>
                </tr>
              </table>
        </div>
    </body>
</html>