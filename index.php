<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

//To save post in db
//if(isset($_POST['post'])){
//    $post = new Post($con, $userLoggedIn);
//    $post->submitPost($_POST['post_text'], 'none');
//}

?>


<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <a href="<?php echo $userLoggedIn; ?>">
                    <h3 class="card-title text-center" style="margin-top: 0.75rem;"><?php echo $user['first_name'] . " " . $user['last_name']; ?></h3>
                    <img class="card-img-top" src="<?php echo $user['profile_pic']; ?>" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="caption text-center">Posts: <?php echo $user['num_posts']; ?> Likes: <?php echo $user['num_likes']; ?></div>
                </div>
            </div>

        </div>

        <?php

        $post = new Post($con, $userLoggedIn);
        $post->loadPosts();

        ?>





<!--        <div class="col-md-8">-->
<!--            <div class="card">-->
<!--                <h2 class="text-center" style="padding: 20px;"><%= user.username %>'s Posts</h2>-->
<!--                <% posts.forEach(function(post){ %>-->
<!--                <div class="rounded mx-auto d-block card border-secondary bg-light mb-3" style="width: 90%;">-->
<!--                    <img class="card-img-top" src="<%= post.image %>">-->
<!--                    <div class="card-body">-->
<!--                        <h5 class="card-title"><%= post.title %></h5>-->
<!--                        <p class="card-text"><%- post.body.substring(0, 200) %>...</p>-->
<!--                        <p class="card-text"><small class="text-muted"><%= moment(post.createdAt).fromNow() %></small></p>-->
<!--                        <a href="/posts/<%= post._id %>" class="btn btn-sm btn-outline-dark">Read</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <% }) %>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

</div>


</body>
</html>