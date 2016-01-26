<?php require "includes/admin_header.php" ?>

<?php require_once "../database/posts_functions.php" ?>  
<?php require_once "../database/category_functions.php" ?>      

<?php
/** INSERT POST **/
if (isset($_POST['submit_publish']) || isset($_POST['submit_save_draft'])) {
    $post['title'] = $_POST['post_title'];
    $post['category_id'] = $_POST['post_category'];
    $post['tags'] = $_POST['post_tags'];
    $post['content'] = $_POST['post_content'];
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_tmp, "../images/$post_image");
    
    if (isset($_POST['submit_publish'])) $post['status'] = "Published";
    else /*if (isset($_POST['submit_save_draft']))*/ $post['status'] = "Draft";
    
    // Error handling
    if (empty(trim($post['title']))) {
        $error_message = "Post title can not be empty";
    }
    else {
        $id = insertPost($post['title'], $_SESSION['user']['username'], date("Y-m-d H:i:s"), $post_image, 
                         $post['content'], $post['tags'], 0, $post['status'], $post['category_id']);

        $common_success_message = "Click <a class='alert-link' href='../post.php?id=$id'>here</a> to view the post";
        if ($post['status'] == "Published") $success_message = "Post published successfully. " . $common_success_message;
        else /*if ($post['status'] == "Draft")*/ $success_message = "Draft added successfully. " . $common_success_message;
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
                    <h1 class="page-header">New post</h1> 
                    
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