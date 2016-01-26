<?php
    $post_content = $post['content'];
    $post_excerpt = substr($post_content, 0, 500);
    if (strlen($post_content) > 500) $post_excerpt .= "...";
?>

<!-- Title -->
<h2>
    <a href="post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a>
    <?php
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Administrator") { 
    ?>
        <a class="btn btn-xs btn-primary" href="admin/edit_post.php?post_id=<?php echo $post['id'] ?>">Edit</a>
    <?php
    }
    ?>
</h2>

<!-- Author -->
<p class="lead">by <a href="author.php?username=<?php echo $post['author'] ?>"><?php echo $post['author'] ?></a></p>

<!-- Date -->
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['date']?></p>
<hr>

<!-- Image -->
<?php
if (isset($post['image']) && trim($post['image']) != "") {
?>
    <img class="img-responsive center-block" src="images/<?php echo $post['image'] ?>" alt="">
    <hr>
<?php
}
?>

<!-- Excerpt -->
<p><?php echo $post_excerpt ?></p>
<a class="btn btn-primary" href="post.php?id=<?php echo $post['id'] ?>">
    Read More <span class="glyphicon glyphicon-chevron-right"></span>
</a>