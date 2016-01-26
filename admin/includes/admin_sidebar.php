<?php
$page = basename($_SERVER['PHP_SELF']);
?>

<?php
/** LOGOUT **/
if (isset($_POST['submit_logout'])) {
    session_unset();
    header("Location: ../index.php");
} 
?>

<div class="container">

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse" id="sidebar-navigation">

        <!-- SIDEBAR LINKS -->
        <ul class="nav navbar-nav side-nav">

            <!-- DASHBOARD -->
            <li <?php if ($page == "index.php") echo "class='active'" ?>>
                <a href="index.php"><i class="fa fa-fw fa-tachometer"></i> Dashboard</a>
            </li>

            <!-- POSTS -->   
            <li <?php if ($page == "posts.php" || $page == "new_post.php") echo "class='active'" ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown">
                    <i class="fa fa-fw fa-file-text"></i> Posts <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="posts_dropdown" class="collapse <?php if ($page == "posts.php" || $page == "new_post.php") echo "in" ?>">
                    <li <?php if ($page == "posts.php") echo "class='active'" ?>>
                        <a href="posts.php"><i class="fa fa-fw fa-list-ul"></i> All posts</a>
                    </li>
                    <li <?php if ($page == "new_post.php") echo "class='active'" ?>>
                        <a href="new_post.php"><i class="fa fa-fw fa-file"></i> New post</a>
                    </li>
                </ul>
            </li>

            <!-- CATEGORIES -->
            <li <?php if ($page == "categories.php") echo "class='active'" ?>>
                <a href="categories.php"><i class="fa fa-fw fa-tags"></i> Categories</a>
            </li>

            <!-- COMMENTS -->
            <li <?php if ($page == "comments.php") echo "class='active'" ?>>
                <a href="comments.php"><i class="fa fa-fw fa-comments"></i> Comments</a>
            </li>

            <!-- USERS -->
            <li <?php if ($page == "users.php" || $page == "new_user.php") echo "class='active'" ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown">
                    <i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="users_dropdown" class="collapse <?php if ($page == "users.php" || $page == "new_user.php") echo "in" ?>">
                    <li <?php if ($page == "users.php") echo "class='active'" ?>>
                        <a href="users.php"><i class="fa fa-fw fa-users"></i> All users</a>
                    </li>
                    <li <?php if ($page == "new_user.php") echo "class='active'" ?>>
                        <a href="new_user.php"><i class="fa fa-fw fa-user-plus"></i> New user</a>
                    </li>
                </ul>
            </li>

            <!-- PROFILE -->
            <li <?php if ($page == "profile.php") echo "class='active'" ?>>
                <a href="edit_user.php"><i class="fa fa-fw fa-user"></i> My profile</a>
            </li>
        </ul>

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

    </div>
</div>