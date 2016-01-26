<?php require "includes/header.php" ?>

<?php require_once "database/posts_functions.php" ?>    

<?php require "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Search results
                <?php
                if (isset($_POST['submit_search'])) {
                    echo "<small>\"" . $_POST['search_query'] . "\"</small>";
                }
                ?>
            </h1>

            <!-- Blog posts -->
            <?php
            if (isset($_POST['submit_search'])) {
                $posts = searchPublishedPostsByTags($_POST['search_query']);

                if (count($posts) == 0) {
                    echo "<h3>No results found</h3>";
                }
                else {
                    foreach ($posts as $post) {
                        require "includes/post_data.php"; 
                        echo "<br><br><br>";
                    }
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
