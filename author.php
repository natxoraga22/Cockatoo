<?php require "includes/header.php" ?>

<?php require_once "database/users_functions.php" ?>    
<?php require_once "database/posts_functions.php" ?>    

<?php require "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Author
                <?php
                if (isset($_GET['username'])) {
                    $username = $_GET['username'];
                    $user = findUserByUsername($username);
                    echo "<small>" . $user['username'] . "</small>";
                }
                ?>
            </h1>
           
            <!-- Blog posts -->
            <?php
            if (isset($_GET['username'])) {
                $username = $_GET['username'];
                $posts = getPublishedPostsByAuthor($username);
                if (count($posts) == 0) {
                    echo "<h3>No posts for this author</h3>";
                }
                foreach ($posts as $post) {
                    require "includes/post_data.php"; 
                    echo "<br><br><br>";
                }
            } 
            ?>               

            <hr>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

<?php require "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php require "includes/footer.php" ?>
