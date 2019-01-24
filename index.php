<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


?>

<!---->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-4">-->
<!--            <div class="card">-->
<!--                <a href="--><?php //echo $userLoggedIn; ?><!--">-->
<!--                    <h3 class="card-title text-center" style="margin-top: 0.75rem;">--><?php //echo $user['first_name'] . " " . $user['last_name']; ?><!--</h3>-->
<!--                    <img class="card-img-top" src="--><?php //echo $user['profile_pic']; ?><!--" alt="Card image cap"></a>-->
<!--                <div class="card-body">-->
<!--                    <div class="caption text-center">Posts: --><?php //echo $user['num_posts']; ?><!-- Likes: --><?php //echo $user['num_likes']; ?><!--</div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->

    <?php


    $post = new Post($con, $userLoggedIn);
    $post->loadPosts();

    ?>
</div>



</div>


</body>
</html>