<?php require_once "../database/users_functions.php" ?>  

<?php require "includes/admin_header.php" ?>

<?php    
/** GET USER INFORMATION **/
// Used to fill all the camps with the current data
if (isset($_GET['user_id'])) {
    $user = findUserById($_GET['user_id']);
}
else {
    $username = $_SESSION['user']['username'];
    $user = findUserByUsername($username);
}
    
/** UPDATE USER **/
if (isset($_POST['submit_edit_user'])) {
    $user['email'] = $_POST['user_email'];
    $user['first_name'] = $_POST['user_first_name'];
    $user['last_name'] = $_POST['user_last_name'];
    $user['role'] = $_POST['user_role'];
    
    $current_user_password = $_POST['user_current_password'];
    $new_user_password = $_POST['user_password'];
    $new_user_password_check = $_POST['user_password_check'];
    
    $new_user_image = $_FILES['user_image']['name'];
    $new_user_image_tmp = $_FILES['user_image']['tmp_name'];
    if (!empty($new_user_image)) {
        move_uploaded_file($new_user_image_tmp, "../images/$new_user_image");
    }
        
    //Error handling
    $error_messages = [];
    if (empty(trim($user['email']))) {
        $error_messages[] = "Email can not be empty";
    }
    if (empty(trim($user['first_name']))) {
        $error_messages[] = "First name can not be empty";
    }
    if (empty(trim($user['last_name']))) {
        $error_messages[] = "Last name can not be empty";
    }
    if (!checkUserPasswordById($user['id'], $current_user_password)) {
        $error_messages[] = "Wrong password";
    }
    if ($new_user_password != $new_user_password_check) {
        $error_messages[] = "New password and new password confirmation don't match";
    }
    
    if (count($error_messages) == 0) {
        if (empty(trim($new_user_password))) $new_user_password = $current_user_password;
        updateUser($user['id'], $user['username'], $new_user_password, $user['first_name'], $user['last_name'], 
                   $user['email'], $new_user_image, $user['role']);
        
        $success_message = "User edited successfully";
        $user['image'] = $new_user_image;
        
        // Update the user stored in the session if the edited user is the stored one
        if ($user['id'] == $_SESSION['user']['id']) {
            $_SESSION['user'] = $user;
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
                    <h1 class="page-header">Edit user</h1> 
                    
                    <?php require "includes/user_form.php" ?>
                    
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