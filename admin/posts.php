<?php require "includes/admin_header.php" ?>

<?php require_once "../database/posts_functions.php" ?>  
<?php require_once "../database/category_functions.php" ?>      

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

/** BULK ACTIONS **/
if (isset($_POST['submit_bulk']) && isset($_POST['bulk_posts'])) {
    $bulk_posts = $_POST['bulk_posts'];
    foreach ($bulk_posts as $post_id) {
        if ($_POST['bulk_action'] == "Publish") {
            publishPost($post_id);
            $success_message = "Posts published successfully";
        }
        else if ($_POST['bulk_action'] == "Delete") {
            deletePost($post_id);
            $success_message = "Posts deleted successfully";
        }
    }
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
                        <a class="btn btn-default" href="new_post.php">Add new</a>
                    </h1>

                    <!-- SUCCESS MESSAGE -->
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
                    
                    <!-- BULK ACTIONS -->
                    <form class="form-inline" action="posts.php" method="post">
                        <div class="form-group">
                            <label class="sr-only" for="bulk_action">Bulk action</label>
                            <select name="bulk_action" class="form-control bulk-actions">
                                <option value="">Bulk options</option>
                                <option value="Publish">Publish</option>
                                <option value="Delete">Delete</option>
                            </select>
                        </div>
                        <input type="submit" name="submit_bulk" class="btn btn-default" value="Apply">
                   
                        <br><br>

                        <!-- POSTS TABLE -->                   
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
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
                                        <!-- Checkbox -->
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="bulk_posts[]" class="bulk-checkbox"
                                                           value="<?php echo $post['id'] ?>">
                                                </label>
                                            </div>
                                        </td>
                                        
                                        <!-- ID -->
                                        <td class="hide"><?php echo $post['id'] ?></td>
                                        
                                        <!-- Title -->
                                        <td>
                                            <strong><a href="../post.php?id=<?php echo $post['id']?>">
                                                <?php echo $post['title'] ?>
                                            </a></strong>
                                            <br>
                                            <small><a href="edit_post.php?post_id=<?php echo $post['id'] ?>">Edit</a></small>
                                            <small><a onClick="javascript: return confirm('Are you sure you want to delete the post?')" 
                                                      href="posts.php?delete=<?php echo $post['id'] ?>">Delete</a></small>
                                        </td>
                                        
                                        <!-- Author -->
                                        <td><a href="../author.php?username=<?php echo $post['author'] ?>">
                                            <?php echo $post['author'] ?>
                                        </a></td>
                                        
                                        <!-- Category -->
                                        <td><a href="../category.php?id=<?php echo $post['category_id'] ?>">
                                            <?php echo $post_category['title'] ?>
                                        </a></td>
                                        
                                        <!-- Status -->
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
                                        
                                        <!-- Image -->
                                        <td>
                                            <?php
                                            if (isset($post['image']) && trim($post['image']) != "") {
                                            ?>
                                                <div class="thumbnail-image">
                                                    <img class="img-responsive img-thumbnail" 
                                                         src="../images/<?php echo $post['image'] ?>" alt="">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        
                                        <!-- Tags -->
                                        <td><?php echo $post['tags'] ?></td>
                                        
                                        <!-- Comment count -->
                                        <td><?php echo $post['comment_count'] ?></td>
                                        
                                        <!-- Date -->
                                        <td><?php echo $post['date'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    
                    </form>

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