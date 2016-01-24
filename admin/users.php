<?php require_once "../database/users_functions.php" ?>  

<?php require "includes/admin_header.php" ?>

<?php  
/** DELETE USER **/
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    deleteUser($user_id);
    $success_message = "User deleted successfully";
}    
?>

<div id="wrapper">

<?php require "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                   
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
                                <th>Username</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php
                            $users = getAllUsers();
                            foreach ($users as $user) {
                            ?>
                                <tr>
                                    <td class="hide"><?php echo $user['id'] ?></td>
                                    <td>
                                        <strong><?php echo $user['username'] ?></strong>
                                        <br>
                                        <small><a href="edit_user.php?user_id=<?php echo $user['id'] ?>">Edit</a></small>
                                        <small><a href="users.php?delete=<?php echo $user['id'] ?>">Delete</a></small>
                                    </td>
                                    <td><?php echo $user['first_name'] ?></td>
                                    <td><?php echo $user['last_name'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['role'] ?></td>
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