<?php require "includes/admin_header.php" ?>

<?php require_once "../database/comments_functions.php" ?>  
<?php require_once "../database/posts_functions.php" ?>  

<?php
/** APPROVE COMMENT **/
if (isset($_GET['approve'])) {
    $comment_id = $_GET['approve'];
    approveComment($comment_id);
    $success_message = "Comment approved successfully";
}
    
/** UNAPPROVE COMMENT **/
if (isset($_GET['unapprove'])) {
    $comment_id = $_GET['unapprove'];
    unapproveComment($comment_id);
    $success_message = "Comment unapproved successfully";
}    

/** DELETE COMMENT **/
if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];
    deleteComment($comment_id);
    $success_message = "Comment deleted successfully";
} 
?>

<div id="wrapper">

<?php require "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comments</h1>
                   
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
                                <th>Author</th>
                                <th class="col-xs-3">Comment</th>
                                <th class="col-xs-1">Status</th>
                                <th class="col-xs-3">In response to</th>
                                <th>Email</th>
                                <th>Date</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php
                            $comments = getAllComments();
                            foreach ($comments as $comment) {
                                $comment_post = findPostById($comment['post_id']);
                            ?>
                                <tr>
                                    <td class="hide"><?php echo $comment['id'] ?></td>
                                    <td><?php echo $comment['author'] ?></td>
                                    <td>
                                        <?php echo $comment['content'] ?><br>
                                        <small><a href="comments.php?delete=<?php echo $comment['id'] ?>">Delete</a></small>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $comment['status'];
                                        if ($comment['status'] == "Pending" || $comment['status'] == "Unapproved") {
                                        ?>
                                            <small><a href="comments.php?approve=<?php echo $comment['id'] ?>">Approve</a></small>
                                        <?php
                                        }
                                        if ($comment['status'] == "Pending" || $comment['status'] == "Approved") {
                                        ?>
                                            <small><a href="comments.php?unapprove=<?php echo $comment['id'] ?>">Unapprove</a></small>
                                        <?php  
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="../post.php?id=<?php echo $comment['post_id'] ?>"><?php echo $comment_post['title'] ?></a>
                                    </td>
                                    <td><?php echo $comment['email'] ?></td>
                                    <td><?php echo $comment['date'] ?></td>
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