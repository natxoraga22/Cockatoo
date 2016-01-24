<!-- Blog Categories Well -->
<div class="well">
    <h4>Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php
                $categories = getAllCategories();
                foreach ($categories as $category) {
                    $category_id = $category['id'];
                    $category_title = $category['title'];
                    echo "<li><a href='category.php?id=$category_id'>$category_title</a></li>";
                }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>