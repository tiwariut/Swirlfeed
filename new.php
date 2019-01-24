<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<div class="container">

    <h1 class="heading">New Post</h1>

    <div class="container form">
        <form action="new.php" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="image">Image Url</label>
                <input type="text" class="form-control" id="image" name="image" placeholder="Image Url">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="6"></textarea>
            </div>
            <button type="submit" name="post_button" class="btn btn-outline-success">Post</button>
        </form>
    </div>

</div>

<?php

//To save post in db
if(isset($_POST['post_button'])) {
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST["title"], $_POST["image"], $_POST["body"]);
    header("Location: index.php");
    exit();
}

?>




</div>

</body>
</html>



