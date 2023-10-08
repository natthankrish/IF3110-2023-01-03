<!DOCTYPE html>
<html>
    <head>
        <title>Manage Users</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/Dashboard.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
            const PAGES = parseInt("<?= $this->data['pages'] ?? 0 ?>");
            const ROWS_PER_PAGE = parseInt("<?= ROWS_PER_PAGE ?>");
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/admin/user-dashboard.js" defer></script>

    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">User</h1>
                <div class="form">
                    <img src="<?= BASE_URL ?>/assets/icons/search.png"/>
                    <input type="text" id="search" name="search" class="textfield" placeholder="Search"><br>    
                </div>
            </div>

            <?php if (!$this->data['users']) : ?>
                <p class="info">There are no users yet available on Moments!</p>
            <?php else : ?>
                <br>
                <table style="width:100%">
                    <thead class="table-header">
                        <tr>
                            <th style="width: 30px">No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Storage Usage</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <div class="users-list">
                            <?php $i = 1; foreach ($this->data['users'] as $user) : ?>
                                <?php include(dirname(__DIR__) . '/object/UserItem.php') ?>
                            <?php $i++; endforeach; ?>
                        </div>
                    </tbody>
                </table>

                <?php include(dirname(__DIR__) . '/object/Pagination.php') ?>

            <?php endif; ?>
        </div>
    </body>
</html>