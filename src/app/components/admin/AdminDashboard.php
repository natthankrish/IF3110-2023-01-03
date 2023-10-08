<!DOCTYPE html>
<html>
    <head>
        <title>Manage Admins</title>
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
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/admin/admin-dashboard.js" defer></script>

    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Admin</h1>
                <div class="title-container">
                    <button class="button2" onclick="openAddAdmin(this)">Add Admin</button>
                    <div class="popup-container">
                        <div class="popup">
                            <div class="popup-info-container">
                                <div class="photo-popup-close">
                                    <img src="<?= BASE_URL ?>/assets/icons/close.png" class="photo-popup-close" onclick="closeAddAdmin(this)" />
                                </div>
                                <form class="registration-form">
                                    <div class="form-group">
                                        <input type="text" id="fullname" name="fullname" class="textfield" placeholder="Full Name">
                                        <p id="fullname-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="username" name="username" class="textfield" placeholder="Username">
                                        <p id="username-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="textfield" placeholder="Email">
                                        <p id="email-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="textfield" placeholder="Password" autocomplete="on">
                                        <p id="password-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="confirm-password" name="confirm-password" class="textfield" placeholder="Confirm Password" autocomplete="on">
                                        <p id="confirm-password-alert" class="alert-hide"></p>
                                    </div>
                                    
                                    <div class="form-button">
                                        <button type="submit" class="button2">Add Admin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="form">
                        <img src="<?= BASE_URL ?>/assets/icons/search.png"/>
                        <input type="text" id="search" name="search" class="textfield" placeholder="Search"><br>    
                    </div>
                </div>
            </div>

            <?php if (!$this->data['admins']) : ?>
                <p class="info">There are no admins yet available on Moments!</p>
            <?php else : ?>
                <br>
                <table style="width:100%">
                    <thead class="table-header">
                        <tr>
                            <th style="width: 30px">No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody">
                        <div class="admins-list">
                            <?php $i = 1; foreach ($this->data['admins'] as $admin) : ?>
                                <?php include(dirname(__DIR__) . '/object/AdminItem.php') ?>
                            <?php $i++; endforeach; ?>
                        </div>
                    </tbody>
                </table>

                <?php include(dirname(__DIR__) . '/object/Pagination.php') ?>

            <?php endif; ?>
        </div>
    </body>
</html>