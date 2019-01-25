<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


?>

    <?php


    $post = new Post($con, $userLoggedIn);
    $post->loadPosts();

    ?>


</body>
</html>