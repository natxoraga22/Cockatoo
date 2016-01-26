<?php  include "includes/header.php" ?>

<?php require_once "database/users_functions.php" ?>  

<?php
if (isset($_POST['submit_register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];
    
    //Error handling
    if (empty(trim($username))) {
        $username_error = "Username can not be empty";
    }
    $userWithUsername = findUserByUsername($username);
    if (isset($userWithUsername)) {
        $username_error = "Username already taken";
    }
    if (empty(trim($email))) {
        $email_error = "Email can not be empty";
    }
    $password_errors = [];
    if (empty(trim($password))) {
        $password_errors[] = "Password can not be empty";
    }
    if ($password != $password_check) {
        $password_errors[] = "Password and password confirmation don't match";
    }
    
    if (!isset($username_error) && !isset($email_error) && count($password_errors) == 0) {
        insertUser($username, $password, "", "", $email, "", "Subscriber");
        
        $success_message = "Registration complete! Try to log in with your new user";
        $username = $email = NULL;
    }
}
?>

<?php  include "includes/navigation.php" ?>
    
<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                
                <br>
               
                <div class="form-wrap panel panel-info">
                    
                    <div class="panel-heading"><h2 class="register-heading">Register</h2></div>
                    <div class="panel-body">
                       
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
                       
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <?php
                            if (isset($username_error)) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <?php echo $username_error ?>
                                </div>
                            <?php
                            }
                            ?>   
                            <div class="form-group <?php if (isset($username_error)) echo "has-error" ?>">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" 
                                       value="<?php if (isset($username)) echo $username ?>">
                            </div>
                            <?php
                            if (isset($email_error)) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <?php echo $email_error ?>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group <?php if (isset($email_error)) echo "has-error" ?>">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" 
                                       value="<?php if (isset($email)) echo $email ?>">
                            </div>
                            <?php
                            if (isset($password_errors)) {
                                foreach ($password_errors as $password_error) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <?php echo $password_error ?>
                                </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="form-group <?php if (isset($password_error)) echo "has-error" ?>">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group <?php if (isset($password_error)) echo "has-error" ?>">
                                <label for="password_check" class="sr-only">Confirm password</label>
                                <input type="password" name="password_check" class="form-control" placeholder="Confirm password">
                            </div>

                            <input type="submit" name="submit_register" id="btn-login" class="btn btn-primary btn-block" value="Register">
                        </form>
                    </div>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php" ?>
