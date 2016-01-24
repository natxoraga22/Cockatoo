<?php
require_once "db_connection.php";

// UTILITY FUNCTION
function getUsersWithQuery($query) {
    global $connection;
        
    $users = mysqli_query($connection, $query);
    if (!$users) die("QUERY FAILED: " . mysqli_error($connection));

    $users_array = [];
    while ($user = mysqli_fetch_assoc($users)) {
        $users_array[] = $user; 
    }
    return $users_array;
}

function getAllUsers() {
    $query = "SELECT * FROM users";
    return getUsersWithQuery($query);
}

function getAdminUsers() {
    $query = "SELECT * FROM users WHERE role = 'Administrator'";
    return getUsersWithQuery($query);
}

function getNoAdminUsers() {
    $query = "SELECT * FROM users WHERE role != 'Administrator'";
    return getUsersWithQuery($query);
}

function findUserById($id) {
    $query = "SELECT * FROM users WHERE id = $id";
    return getUsersWithQuery($query)[0];
}

function findUserByUsername($username) {
    global $connection;
    $username = mysqli_real_escape_string($connection, $username);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $users = getUsersWithQuery($query);
    return isset($users[0]) ? $users[0] : NULL;
}

function checkUserPasswordById($id, $password) {
    $user = findUserById($id);
    return $user['password'] == $password;
}

function checkUserPasswordByUsername($username, $password) {
    $user = findUserByUsername($username);
    if (!isset($user)) return false; // User not found
    return $user['password'] == $password;
}

function insertUser($username, $password, $first_name, $last_name, $email, $image, $role) {
    global $connection;
    
    $username = mysqli_real_escape_string($connection, trim($username));
    $password = mysqli_real_escape_string($connection, trim($password));
    $first_name = mysqli_real_escape_string($connection, trim($first_name));
    $last_name = mysqli_real_escape_string($connection, trim($last_name));
    $email = mysqli_real_escape_string($connection, trim($email));
    $image = mysqli_real_escape_string($connection, $image);
    $role = mysqli_real_escape_string($connection, trim($role));
    
    $query = "INSERT INTO users(username, password, first_name, last_name, email, image, role) ";
    $query .= "VALUES('$username', '$password', '$first_name', '$last_name', '$email', '$image', '$role')";

    $insert_result = mysqli_query($connection, $query);
    if (!$insert_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function updateUser($id, $new_username, $new_password, $new_first_name, $new_last_name, $new_email, $new_image, $new_role) {
    global $connection;
    
    $new_username = mysqli_real_escape_string($connection, trim($new_username));
    $new_password = mysqli_real_escape_string($connection, trim($new_password));
    $new_first_name = mysqli_real_escape_string($connection, trim($new_first_name));
    $new_last_name = mysqli_real_escape_string($connection, trim($new_last_name));
    $new_email = mysqli_real_escape_string($connection, trim($new_email));
    $new_image = mysqli_real_escape_string($connection, $new_image);
    $new_role = mysqli_real_escape_string($connection, trim($new_role));
    
    $query = "UPDATE users SET username = '$new_username', password = '$new_password', first_name = '$new_first_name', ";
    $query .= "last_name = '$new_last_name', email = '$new_email', image = '$new_image', role = '$new_role' ";
    $query .= "WHERE id = $id";

    $update_result = mysqli_query($connection, $query);
    if (!$update_result) die("QUERY FAILED: " . mysqli_error($connection));
}

function deleteUser($id) {
    global $connection;
  
    $query = "DELETE FROM users WHERE id = $id";

    $delete_result = mysqli_query($connection, $query);
    if (!$delete_result) die("QUERY FAILED: " . mysqli_error($connection));
}
?>