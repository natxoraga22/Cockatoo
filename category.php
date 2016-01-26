<?php require "includes/header.php" ?>

<?php require_once "database/category_functions.php" ?>    
<?php require_once "database/posts_functions.php" ?>    

<?php require "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Category
                <?php
                if (isset($_GET['id'])) {
                    $category_id = $_GET['id'];
                    $category = findCategoryById($category_id);
                    echo "<small>" . $category['title'] . "</small>";
                }
                ?>
            </h1>
           
            <!-- Blog posts -->
            <?php
            if (isset($_GET['id'])) {
                $category_id = $_GET['id'];
                $posts = getPublishedPostsWithCategory($category_id);
                if (count($posts) == 0) {
                    echo "<h3>No posts for this category</h3>";
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
