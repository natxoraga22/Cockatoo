<?php
require_once "db_connection.php";
require_once "posts_functions.php";

// UTILITY FUNCTION
function getCommentsWithQuery($query) {
    global $connection;
        
    $comments = mysqli_query($connection, $query);
    if (!$comments) die("QUERY FAILED: " . mysqli_error($connection));

    $comments_array = [];
    while ($comment = mysqli_fetch_assoc($comments)) {
        $comments_array[] = $comment; 
    }
    return $comments_array;
}

function getAllComments() {
    $query = "SELECT * FROM comments ORDER BY date DESC";
    return getCommentsWithQuery($query);
}

function getApprovedComments() {
    $query = "SELECT * FROM comments WHERE status = 'Approved' ORDER BY date DESC";
    return getCommentsWithQuery($query);
}

function getUnapprovedComments() {
    $query = "SELECT * FROM comments WHERE status = 'Unapproved' ORDER BY date DESC";
    return getCommentsWithQuery($query);
}

function getApprovedCommentsForPost($post_id) {
    $query = "SELECT * FROM comments WHERE status = 'Approved' AND post_id = $post_id ORDER BY date DESC";
    return getCommentsWithQuery($query);
}

function findCommentById($id) {
    $query = "SELECT * FROM comments WHERE id = $id";
    return getCommentsWithQuery($query)[0];
}

function insertComment($author, $email, $date, $content, $status, $post_id) {
    global $connection;
    
    $author = mysqli_real_escape_string($connection, trim($author));
    $email = mysqli_real_escape_string($connection, trim($email));
    $content = mysqli_real_escape_string($connection, trim($content));
    
    $query = "INSERT INTO comments(post_id, author, email, date, content, status) ";
    $query .= "VALUES($post_id, '$author', '$email', '$date', '$content', '$status')";

    $insert_result = mysqli_query($connection, $query);
    if (!$insert_result) die("QUERY FAILED: " . mysqli_error($connection));
    else incrementPostCommentCount($post_id);
}

function approveComment($id) {
    global $connection;
    
    $query = "UPDATE comments SET status = 'Approved' WHERE id = $id";
    
    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function unapproveComment($id) {
    global $connection;
    
    $query = "UPDATE comments SET status = 'Unapproved' WHERE id = $id";
    
    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function deleteComment($id) {
    global $connection;
  
    // We have to store the post_id in order to decrement the comment count of this post
    $comment = findCommentById($id);
    
    $query = "DELETE FROM comments WHERE id = $id";

    $delete_result = mysqli_query($connection, $query);
    if (!$delete_result) die("QUERY FAILED: " . mysqli_error($connection));
    else decrementPostCommentCount($comment['post_id']);
}
?>