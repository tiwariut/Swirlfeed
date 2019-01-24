<?php

include("includes/header.php");

if(isset($_GET['post_id'])){
    $id = $_GET['post_id'];
    $post_details_query = mysqli_query($con, "SELECT * FROM posts WHERE id='$id'");
    $post_array = mysqli_fetch_array($post_details_query);

    echo $userLoggedIn;

}

?>

<div class="container">
    <div class="card border-secondary bg-light mb-3">
        <h1 class="heading card-title" style="margin-top: 45px;"><?php echo $post_array['title']; ?></h1>
        <div class="card-body">
            <hr>
            <img class="card-img-top" src="<?php echo $post_array['image_url']; ?>" alt="Card image cap">
            <hr>
            <p class="card-text"><?php echo $post_array['body']; ?></p>
            <strong>By <?php echo $post_array['added_by'] ?></a></strong>

            <?php if($userLoggedIn == $post_array['added_by']){ ?>

                <form class="delete-form" action="/posts/<%= post._id%>?_method=DELETE" method="POST">
                    <button class="btn btn-outline-danger">Delete</button>
                </form>

            <?php } ?>



        </div>
    </div>
</div>

</div>
</body>
</html>
