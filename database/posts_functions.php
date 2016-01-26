<?php
require_once "db_connection.php";

// UTILITY FUNCTION
function getPostsWithQuery($query) {
    global $connection;
        
    $posts = mysqli_query($connection, $query);
    if (!$posts) die("QUERY FAILED: " . mysqli_error($connection));

    $posts_array = [];
    while ($post = mysqli_fetch_assoc($posts)) {
        $posts_array[] = $post; 
    }
    return $posts_array;
}

function getAllPosts() {
    $query = "SELECT * FROM posts ORDER BY date DESC";
    return getPostsWithQuery($query);
}

function getPublishedPosts() {
    $query = "SELECT * FROM posts WHERE status = 'Published' ORDER BY date DESC";
    return getPostsWithQuery($query);
}

function getDraftPosts() {
    $query = "SELECT * FROM posts WHERE status = 'Draft' ORDER BY date DESC";
    return getPostsWithQuery($query);
}

function getPublishedPostsWithCategory($category_id) {
    $query = "SELECT * FROM posts WHERE status = 'Published' AND category_id = $category_id ORDER BY date DESC";
    return getPostsWithQuery($query);
}

function getPublishedPostsByAuthor($author) {
    $query = "SELECT * FROM posts WHERE status = 'Published' AND author = '$author' ORDER BY date DESC";
    return getPostsWithQuery($query);
}

function searchPublishedPostsByTags($search_query) {
    $query = "SELECT * FROM posts WHERE status = 'Published' AND tags LIKE '%$search_query%' ORDER BY date DESC";
    return getPostsWithQuery($query);
}

function findPostById($id) {
    $query = "SELECT * FROM posts WHERE id = $id";
    return getPostsWithQuery($query)[0];
}

function insertPost($title, $author, $date, $image, $content, $tags, $comment_count, $status, $category_id) {
    global $connection;
    
    $title = mysqli_real_escape_string($connection, trim($title));
    $image = mysqli_real_escape_string($connection, $image);
    $content = mysqli_real_escape_string($connection, trim($content));
    $tags = mysqli_real_escape_string($connection, trim($tags));
    
    $query = "INSERT INTO posts(category_id, title, author, date, image, content, tags, comment_count, status) ";
    $query .= "VALUES($category_id, '$title', '$author', '$date', '$image', '$content', '$tags', $comment_count, '$status')";

    $insert_result = mysqli_query($connection, $query);
    if (!$insert_result) die("QUERY FAILED: " . mysqli_error($connection));
    return mysqli_insert_id($connection);
}

function updatePost($id, $new_title, $new_author, $new_date, $new_image, $new_content, 
                    $new_tags, $new_comment_count, $new_status, $new_category_id) {
    global $connection;
    
    $new_title = mysqli_real_escape_string($connection, trim($new_title));
    $new_image = mysqli_real_escape_string($connection, $new_image);
    $new_content = mysqli_real_escape_string($connection, trim($new_content));
    $new_tags = mysqli_real_escape_string($connection, trim($new_tags));
    
    $query = "UPDATE posts SET category_id = $new_category_id, title = '$new_title', author = '$new_author', ";
    $query .= "date = '$new_date', image = '$new_image', content = '$new_content', tags = '$new_tags', ";
    $query .= "comment_count = $new_comment_count, status = '$new_status' ";
    $query .= "WHERE id = $id";

    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function incrementPostCommentCount($id) {
    global $connection;
    
    $query = "UPDATE posts SET comment_count = comment_count + 1 WHERE id = $id";
    
    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function decrementPostCommentCount($id) {
    global $connection;
    
    $query = "UPDATE posts SET comment_count = GREATEST(comment_count - 1, 0) WHERE id = $id";
    
    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function publishPost($id) {
    global $connection;
    
    $query = "UPDATE posts SET status = 'Published' WHERE id = $id";
    
    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function deletePost($id) {
    global $connection;
  
    $query = "DELETE FROM posts WHERE id = $id";

    $delete_result = mysqli_query($connection, $query);
    if (!$delete_result) die("QUERY FAILED: " . mysqli_error($connection));
}
?>