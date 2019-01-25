<?php
require '../../config/config.php';

if(isset($_GET['delete_button'])){
    $post_id = $_GET['delete_button'];
    $query = mysqli_query($con, "UPDATE posts SET deleted='yes' WHERE id='$post_id'");
    header("Location: ../../../index.php");
    exit();
}

