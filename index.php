<?php require "includes/header.php" ?>

<?php require_once "database/posts_functions.php" ?>    

<?php require "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- Blog posts -->
            <?php
            $posts = getPublishedPosts();
            if (count($posts) == 0) {
                echo "<h3>There aren't any published posts</h3>";
            }
            else {
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
