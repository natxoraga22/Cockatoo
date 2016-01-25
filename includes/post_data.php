<?php
    $post_content = $post['content'];
    $post_excerpt = substr($post_content, 0, 500);
    if (strlen($post_content) > 500) $post_excerpt .= "...";
?>

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

<p class="lead">by <a href="index.php"><?php echo $post['author'] ?></a></p>

<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['date']?></p>
<hr>

<?php
if (isset($post['image']) && trim($post['image']) != "") {
?>
    <img class="img-responsive center-block" src="images/<?php echo $post['image'] ?>" alt="">
    <hr>
<?php
}
?>

<p><?php echo $post_excerpt ?></p>
<a class="btn btn-primary" href="post.php?id=<?php echo $post['id'] ?>">
    Read More <span class="glyphicon glyphicon-chevron-right"></span>
</a>