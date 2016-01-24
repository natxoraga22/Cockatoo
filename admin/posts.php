<?php require_once "../database/posts_functions.php" ?>  
<?php require_once "../database/category_functions.php" ?>      

<?php require "includes/admin_header.php" ?>

<?php
/** PUBLISH POST **/
if (isset($_GET['publish'])) {
    $post_id = $_GET['publish'];
    publishPost($post_id);
    $success_message = "Post published successfully";
}
    
/** DELETE POST **/
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    deletePost($post_id);
    $success_message = "Post deleted successfully";
}    
?>

<div id="wrapper">

<?php require "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Posts
                        <a class="btn btn-default" href="../new_post.php">Add new</a>
                    </h1>

                    <?php
                    if (isset($success_message)) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <?php echo $success_message ?>
                        </div>
                    <?php
                    }
                    ?>
                   
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="hide">ID</th>
                                <th class="col-xs-3">Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th class="col-xs-1">Status</th>
                                <th>Image</th>
                                <th class="col-xs-1">Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php
                            $posts = getAllPosts();
                            foreach ($posts as $post) {
                                $post_category = findCategoryById($post['category_id']);
                            ?>
                                <tr>
                                    <td class="hide"><?php echo $post['id'] ?></td>
                                    <td>
                                        <strong><a href="../post.php?id=<?php echo $post['id']?>">
                                            <?php echo $post['title'] ?>
                                        </a></strong>
                                        <br>
                                        <small><a href="edit_post.php?post_id=<?php echo $post['id'] ?>">Edit</a></small>
                                        <small><a href="posts.php?delete=<?php echo $post['id'] ?>">Delete</a></small>
                                    </td>
                                    <td><?php echo $post['author'] ?></td>
                                    <td><?php echo $post_category['title'] ?></td>
                                    <td>
                                        <?php 
                                        echo $post['status'];
                                        if ($post['status'] == "Draft") {
                                        ?>
                                            <small><a href="posts.php?publish=<?php echo $post['id'] ?>">Publish</a></small>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($post['image']) && trim($post['image']) != "") {
                                        ?>
                                            <div class="thumbnail-image">
                                                <img class="img-responsive img-thumbnail" src="../images/<?php echo $post['image'] ?>" alt="">                                             </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $post['tags'] ?></td>
                                    <td><?php echo $post['comment_count'] ?></td>
                                    <td><?php echo $post['date'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php require "includes/admin_footer.php" ?>