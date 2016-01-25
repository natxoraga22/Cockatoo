<?php require "includes/admin_header.php" ?>

<?php require_once "../database/category_functions.php" ?>    

<?php
/** INSERT CATEGORY **/
if (isset($_POST['submit_add_category'])) {
    $category_title = $_POST['category_title'];
    if (empty(trim($category_title))) {
        $insert_error_message = "Category title can not be empty";
    }
    else {
        insertCategory($category_title);
        $insert_success_message = "Category created successfully";
    }
}

/** UPDATE CATEGORY **/
if (isset($_POST['submit_edit_category'])) {
    $category_id = $_POST['category_id'];
    $new_category_title = $_POST['category_title'];
    if (empty(trim($new_category_title))) {
        $update_error_message = "Category title can not be empty";
    }
    else {
        updateCategory($category_id, $new_category_title);
        $update_success_message = "Category updated successfully";
    }
} 
    
/** DELETE CATEGORY **/
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    deleteCategory($category_id);
}    
?>

<div id="wrapper">

<?php require "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>

                    <div class="col-xs-6">
                        <!-- FORM USED TO INSERT CATEGORIES -->
                        <?php
                        if (isset($insert_success_message)) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                <?php echo $insert_success_message ?>
                            </div>
                        <?php
                        }
                        if (isset($insert_error_message)) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <?php echo $insert_error_message ?>
                            </div>
                        <?php
                        }
                        ?>
                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="category_title">Add category</label>   
                                <input type="text" name="category_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit_add_category" class="btn btn-primary" value="Add Category">
                            </div>
                        </form>

                        <!-- FORM USED TO UPDATE CATEGORIES -->
                        <?php
                        if (isset($update_error_message)) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                <?php echo $update_error_message ?>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_GET['edit']) || isset($update_error_message)) {
                            $category_id;
                            if (isset($_GET['edit'])) $category_id = $_GET['edit'];
                            else /*if (isset($update_error_message))*/ $category_id = $_POST['category_id'];
                            $category = findCategoryById($category_id);
                        ?>
                            <form action="categories.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="category_id" class="form-control" value="<?php echo $category_id ?>">
                                    <label for="category_title">Edit category</label>   
                                    <input type="text" name="category_title" class="form-control" 
                                           value="<?php echo $category['title'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit_edit_category" class="btn btn-primary" value="Edit Category">
                                </div>
                            </form>
                        <?php 
                        } 
                        ?>
                    </div>

                    <!-- TABLE WITH ALL THE CATEGORIES -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="hide">ID</th>
                                    <th>Title</th>
                                    <th colspan="2" class="col-xs-2"><small>Actions</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $categories = getAllCategories();
                                foreach ($categories as $category) {
                                ?>
                                    <tr>
                                        <td class="hide"><?php echo $category['id'] ?></td>
                                        <td><?php echo $category['title'] ?></td>
                                        <td><a href="categories.php?edit=<?php echo $category['id'] ?>">Edit</a></td>
                                        <td><a href="categories.php?delete=<?php echo $category['id'] ?>">Delete</a></td>
                                    </tr>
                                <?php
                                }
                                ?>   
                            </tbody>
                        </table>
                    </div>
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