<?php 
$page = basename($_SERVER['PHP_SELF']); 
?>

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
    <!-- USERNAME -->
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_username">Username</label>   
        <div class="col-sm-10">
            <?php
            if ($page == "new_user.php") {
            ?>
                <input type="text" name="user_username" class="form-control" 
                       value="<?php if (isset($user['username'])) echo $user['username'] ?>">
            <?php
            }
            else if ($page == "edit_user.php") {
            ?>
                <p class="form-control-static"><?php echo $user['username'] ?></p>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- EMAIL -->
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_email">Email</label>   
        <div class="col-sm-10">
            <input type="email" name="user_email" class="form-control" 
                   value="<?php if (isset($user['email'])) echo $user['email'] ?>">
        </div>
    </div>
    <!-- FIRST NAME -->
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_first_name">First name</label>   
        <div class="col-sm-10">
            <input type="text" name="user_first_name" class="form-control" 
                   value="<?php if (isset($user['first_name'])) echo $user['first_name'] ?>">
        </div>
    </div>
    <!-- LAST NAME -->
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_last_name">Last name</label>   
        <div class="col-sm-10">
            <input type="text" name="user_last_name" class="form-control" 
                   value="<?php if (isset($user['last_name'])) echo $user['last_name'] ?>">
        </div>
    </div>
    <!-- ROLE -->
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_role">Role</label>   
        <div class="col-sm-10">
            <select name="user_role" class="form-control">
                <option value="Administrator" <?php if (isset($user['role']) && $user['role'] == "Administrator") echo "selected"?>>
                    Administrator
                </option>
                <option value="Subscriber" <?php if (!isset($user['role']) || $user['role'] == "Subscriber") echo "selected"?>>
                    Subscriber
                </option>
            </select>
        </div>
    </div>
    <!-- IMAGE -->
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_image">Image</label>   
        <div class="col-sm-10">
            <?php
            if (isset($user['image']) && trim($user['image']) != "") {
            ?>
                <div class="thumbnail-image">
                    <img class="img-responsive img-thumbnail" src="../images/<?php echo $user['image'] ?>" alt="">                 
                </div>
            <?php
            }
            ?>
            <input type="file" name="user_image">
            <?php 
            if ($page == "edit_user.php" && isset($user['image']) && trim($user['image']) != "") {
            ?>    
                <p class="help-block">Leave empty to maintain <?php echo $user['image'] ?></p>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- PASSWORD -->
    <?php 
    if ($page == "edit_user.php") {
    ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="user_current_password">Current password</label>   
            <div class="col-sm-10">
                <input type="password" name="user_current_password" class="form-control" value="">
            </div>
        </div>
    <?php
    }
    if ($page == "edit_user.php") {
    ?>
        <small class='col-sm-offset-2 col-sm-10'><strong>Only fill if you want to change the password</strong></small>
    <?php
    }
    ?>
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_password">
            <?php
            if ($page == "new_user.php") echo "Password";
            else if ($page == "edit_user.php") echo "New password";
            ?>
        </label>   
        <div class="col-sm-10">
            <input type="password" name="user_password" class="form-control" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="user_password_check">
            <?php
            if ($page == "new_user.php") echo "Confirm password";
            else if ($page == "edit_user.php") echo "Confirm new password";
            ?>
        </label>   
        <div class="col-sm-10">
            <input type="password" name="user_password_check" class="form-control" value="">
        </div>
    </div>
    <!-- SUBMIT -->
    <?php 
    if ($page == "new_user.php") { 
    ?>
        <div class="form-group"><div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit_add_user" class="btn btn-primary" value="Add user">
        </div></div>
    <?php
    }
    else if ($page == "edit_user.php") {
    ?>
        <div class="form-group"><div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit_edit_user" class="btn btn-primary" value="Edit user">
        </div></div>
    <?php
    }
    ?>
</form>