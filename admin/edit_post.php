<?php require "includes/admin_header.php" ?>

<?php require_once "../database/posts_functions.php" ?>  
<?php require_once "../database/category_functions.php" ?>      

<?php    
/** GET POST INFORMATION **/
// Used to fill all the camps with the current data
if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];
    $post = findPostById($id);
}
    
/** UPDATE POST **/
if (isset($_POST['submit_edit'])) {
    $post['title'] = $_POST['post_title'];
    $post['category_id'] = $_POST['post_category'];
    $post['tags'] = $_POST['post_tags'];
    $post['content'] = $_POST['post_content'];
    
    $new_post_image = $_FILES['post_image']['name'];
    $new_post_image_tmp = $_FILES['post_image']['tmp_name'];
    if (!empty($new_post_image)) {
        move_uploaded_file($new_post_image_tmp, "../images/$new_post_image");
    }
    else $new_post_image = $post['image'];
      
    // Error handling
    if (empty(trim($post['title']))) {
        $error_message = "Post title can not be empty";
    }
    else {
        updatePost($id, $post['title'], $post['author'], $post['date'], $new_post_image, $post['content'], 
                   $post['tags'], $post['comment_count'], $post['status'], $post['category_id']);
        
        $success_message = "Post edited successfully. Click <a class='alert-link' href='../post.php?id=$id'>here</a> to view the post";
        $post['image'] = $new_post_image;
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
                        Edit post
                        <a class="pull-right btn btn-default" href="../post.php?id=<?php echo $id ?>">
                            View post <i class="fa fa-chevron-right"></i>
                        </a>
                    </h1> 
                   
                    <?php require "includes/post_form.php" ?>
                    
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