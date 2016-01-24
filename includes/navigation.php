<?php require_once "database/category_functions.php" ?>
<?php require_once "database/users_functions.php" ?>

<?php
/** LOGIN **/
if (isset($_POST['submit_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (checkUserPasswordByUsername($username, $password)) {
        $_SESSION['user'] = findUserByUsername($username);
    }
    else $loginFailed = true;
} 
/** LOGOUT **/
if (isset($_POST['submit_logout'])) {
    session_unset();
} 
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
       
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-bar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Cockatoo</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-bar">
            <ul class="nav navbar-nav">
                <?php
                if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Administrator") {
                ?>
                    <li><a href='admin'><span class="label label-default">ADMIN</span></a></li>      
                <?php
                }
                $categories = getAllCategories();
                foreach ($categories as $category) {
                    $category_id = $category['id'];
                    $category_title = $category['title'];
                    echo "<li><a href='category.php?id=$category_id'>$category_title</a></li>";
                }
                ?>
            </ul>
            
            <?php
            if (!isset($_SESSION['user'])) {
            ?>
                <!-- LOGIN FORM -->
                <form class="navbar-form navbar-right login-form" action="" method="post" enctype="multipart/form-data">
                    <!-- Username -->
                    <div class="form-group <?php if (isset($loginFailed)) echo "has-error has-feedback" ?>">
                        <label class="sr-only" for="username">Username:</label>
                        <input type="text" name="username" class="form-control input-sm" placeholder="Username">
                        <?php 
                        if (isset($loginFailed)) { 
                        ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Password -->
                    <div class="form-group <?php if (isset($loginFailed)) echo "has-error has-feedback"?>">
                        <label class="sr-only" for="password">Password:</label>
                        <input type="password" name="password" class="form-control input-sm" placeholder="Password">
                        <?php 
                        if (isset($loginFailed)) {
                        ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <?php
                        }
                        ?>
                    </div>
                    <button type="submit" name="submit_login" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login
                    </button>
                </form>
            <?php
            }
            else {
            ?>
                <!-- USERNAME AND LOGOUT -->
                <form class="navbar-form navbar-right logout-form" action="" method="post">
                    <label class="control-label user-label" for="submit_logout">
                        <span class="label label-primary">
                            <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['username'] ?>
                        </span>
                    </label>
                    <button type="submit" name="submit_logout" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
                    </button>
                </form>
            <?php
            }
            ?>
            
        </div>
    </div>
</nav>