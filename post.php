<?php require "includes/header.php" ?>

<?php require_once "database/posts_functions.php" ?>    
<?php require_once "database/comments_functions.php" ?>    

<?php
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
}
    
/** INSERT COMMENT **/
if (isset($_POST['submit_comment'])) {
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    
    //Error handling
    $error_messages = [];
    if (empty(trim($comment_author))) {
        $error_messages[] = "Author can not be empty";
    }
    if (empty(trim($comment_email))) {
        $error_messages[] = "Email can not be empty";
    }
    if (empty(trim($comment_content))) {
        $error_messages[] = "Comment can not be empty";
    }
    
    if (count($error_messages) == 0) {
        insertComment($comment_author, $comment_email, date("Y-m-d H:i:s"), $comment_content, "Pending", $post_id);
        $success_message = "Comment waiting for approval";
        $comment_author = $comment_email = $comment_content = "";
    }
}    
?>

<?php require "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <?php
            $post = findPostById($post_id);
            ?>
            <!-- Title -->
            <h1>
                <?php 
                echo $post['title'];
                if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Administrator") { 
                ?>
                    <a class="btn btn-xs btn-primary" href="admin/edit_post.php?post_id=<?php echo $post['id'] ?>">Edit</a>
                <?php
                }
                ?>
            </h1>

            <!-- Author -->
            <p class="lead">
                by <a href="author.php?username=<?php echo $post['author'] ?>"><?php echo $post['author'] ?></a>
            </p>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['date']?></p>

            <hr>

            <!-- Preview Image -->
            <?php
            if (isset($post['image']) && trim($post['image']) != "") {
            ?>
                <img class="img-responsive center-block" src="images/<?php echo $post['image'] ?>" alt="">
                <hr>
            <?php
            }
            ?>
            
            <!-- Post Content -->
            <p class="lead"><?php echo $post['content'] ?></p>

            <hr>
        
           
            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a comment:</h4>
                
                <!-- Success/Error messages -->
                <?php
                if (isset($success_message)) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <?php echo $success_message ?>
                    </div>
                <?php
                }
                if (isset($error_messages)) {
                    foreach ($error_messages as $error_message) {
                ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <?php echo $error_message ?>
                        </div>
                <?php
                    }
                }
                ?>
                
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <!-- AUTHOR -->
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="comment_author">Author</label>   
                        <div class="col-sm-11">
                            <input type="text" name="comment_author" class="form-control" 
                                   value="<?php if (isset($comment_author)) echo $comment_author ?>">
                        </div>
                    </div>
                    <!-- EMAIL -->
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="comment_email">Email</label>   
                        <div class="col-sm-11">
                            <input type="email" name="comment_email" class="form-control" 
                                   value="<?php if (isset($comment_email)) echo $comment_email ?>">
                        </div>
                    </div>
                    <!-- CONTENT -->
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="comment_content">Comment</label>   
                        <div class="col-sm-12">
                            <textarea name="comment_content" class="form-control" rows="3"
                                ><?php if (isset($comment_content)) echo $comment_content ?></textarea>
                        </div>
                    </div>
                    <div class="form-group"><div class="col-sm-11">
                        <input type="submit" name="submit_comment" class="btn btn-primary" value="Submit">
                    </div></div>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            $comments = getApprovedCommentsForPost($post_id);
                      
            if (count($comments) == 0) {
                echo "<h3>Still no comments. Be the first one!</h3>";
            }
            foreach ($comments as $comment) {
            ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment['author'] ?>
                            <small><?php echo $comment['date'] ?></small>
                        </h4>
                        <?php echo $comment['content'] ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

<?php require "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php require "includes/footer.php" ?>

