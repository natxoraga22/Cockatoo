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
if (isset($error_message)) {
?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $error_message ?>
    </div>
<?php
}
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <!-- TITLE -->
    <div class="form-group">
        <label class="control-label col-sm-1" for="post_title">Title</label>   
        <div class="col-sm-11">
            <input type="text" name="post_title" class="form-control" value="<?php if (isset($post['title'])) echo $post['title'] ?>">
        </div>
    </div>
    <!-- CATEGORY -->
    <div class="form-group">
        <label class="control-label col-sm-1" for="post_category">Category</label>   
        <div class="col-sm-11">
            <select name="post_category" class="form-control">
                <?php
                $categories = getAllCategories();
                foreach ($categories as $category) {
                ?>
                    <option value="<?php echo $category['id'] ?>" 
                    <?php if (isset($post['category_id']) && $category['id'] == $post['category_id']) echo "selected"?>>
                        <?php echo $category['title'] ?>
                    </option>
                <?php
                }
                ?> 
            </select>
        </div>
    </div>
    <!-- IMAGE -->
    <div class="form-group">
        <label class="control-label col-sm-1" for="post_image">Image</label>   
        <div class="col-sm-11">
            <?php
            if (isset($post['image']) && trim($post['image']) != "") {
            ?>
                <div class="thumbnail-image">
                    <img class="img-responsive img-thumbnail" src="../images/<?php echo $post['image'] ?>" alt="">                 
                </div>
            <?php
            }
            ?>
            <input type="file" name="post_image">
            <?php 
            if ($page == "edit_post.php" && isset($post['image']) && trim($post['image']) != "") {
            ?>
                <p class="help-block">Leave empty to maintain <?php echo $post['image'] ?></p>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- TAGS -->
    <div class="form-group">
        <label class="control-label col-sm-1" for="post_tags">Tags</label>   
        <div class="col-sm-11">
            <input type="text" name="post_tags" class="form-control" value="<?php if (isset($post['tags'])) echo $post['tags'] ?>">
        </div>
    </div>
    <!-- CONTENT -->
    <div class="form-group">
        <label class="control-label col-sm-1" for="post_content">Content</label>   
        <div class="col-sm-11">
            <textarea name="post_content" class="form-control post-content" rows="15"
                ><?php if (isset($post['content'])) echo $post['content'] ?></textarea>
        </div>
    </div>
    <!-- SUBMIT -->
    <?php 
    if ($page == "new_post.php") { 
    ?>
        <div class="form-group"><div class="col-sm-offset-1 col-sm-11">
            <input type="submit" name="submit_publish" class="btn btn-primary" value="Publish">
            <input type="submit" name="submit_save_draft" class="btn btn-default" value="Save draft">
        </div></div>
    <?php
    }
    else if ($page == "edit_post.php") {
    ?>
        <div class="form-group"><div class="col-sm-offset-1 col-sm-11">
            <input type="submit" name="submit_edit" class="btn btn-primary" value="Edit post">
        </div></div>
    <?php
    }
    ?>
</form>