<?php
require_once "db_connection.php";

// UTILITY FUNCTION
function getCategoriesWithQuery($query) {
    global $connection;
        
    $categories = mysqli_query($connection, $query);
    if (!$categories) die("QUERY FAILED: " . mysqli_error($connection));

    $categories_array = [];
    while ($category = mysqli_fetch_assoc($categories)) {
        $categories_array[] = $category; 
    }
    return $categories_array;
}

function getAllCategories() {
    $query = "SELECT * FROM categories";
    return getCategoriesWithQuery($query);
}

function findCategoryById($id) {
    $query = "SELECT * FROM categories WHERE id = $id";
    return getCategoriesWithQuery($query)[0];
}

function insertCategory($title) {
    global $connection;
    
    $title = mysqli_real_escape_string($connection, trim($title));
    
    $query = "INSERT INTO categories(title) ";
    $query .= "VALUES('$title')";

    $insert_result = mysqli_query($connection, $query);
    if (!$insert_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function updateCategory($id, $new_title) {
    global $connection;
    
    $new_title = mysqli_real_escape_string($connection, trim($new_title));
    
    $query = "UPDATE categories SET title = '$new_title' WHERE id = $id";

    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function deleteCategory($id) {
    global $connection;
  
    $query = "DELETE FROM categories WHERE id = $id";

    $delete_result = mysqli_query($connection, $query);
    if (!$delete_result) die("QUERY FAILED: " . mysqli_error($connection));
}
?>