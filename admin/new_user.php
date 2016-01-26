<?php require "includes/admin_header.php" ?>

<?php require_once "../database/users_functions.php" ?>  

<?php
/** INSERT USER **/
if (isset($_POST['submit_add_user'])) {
    $user['username'] = $_POST['user_username'];
    $user['email'] = $_POST['user_email'];
    $user['first_name'] = $_POST['user_first_name'];
    $user['last_name'] = $_POST['user_last_name'];
    $user['role'] = $_POST['user_role'];
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp, "../images/" . $user_image);
    
    $user_password = $_POST['user_password'];
    $user_password_check = $_POST['user_password_check'];
    
    //Error handling
    $error_messages = [];
    if (empty(trim($user['username']))) {
        $error_messages[] = "Username can not be empty";
    }
    $userWithUsername = findUserByUsername($user['username']);
    if (isset($userWithUsername)) {
        $error_messages[] = "Username already taken";
    }
    if (empty(trim($user['email']))) {
        $error_messages[] = "Email can not be empty";
    }
    /*if (empty(trim($user['first_name']))) {
        $error_messages[] = "First name can not be empty";
    }
    if (empty(trim($user['last_name']))) {
        $error_messages[] = "Last name can not be empty";
    }*/
    if (empty(trim($user_password))) {
        $error_messages[] = "Password can not be empty";
    }
    if ($user_password != $user_password_check) {
        $error_messages[] = "Password and password confirmation don't match";
    }
    
    if (count($error_messages) == 0) {
        insertUser($user['username'], $user_password, $user['first_name'], $user['last_name'], 
                   $user['email'], $user_image, $user['role']);
        
        $success_message = "User created successfully. Click <a class='alert-link' href='users.php'>here</a> to view all the users";
        unset($user);
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
                    <h1 class="page-header">New user</h1> 
                    
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