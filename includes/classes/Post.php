<?php
class Post
{
    private $user_obj;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function submitPost($title, $image_url, $body)
    {
        $title = strip_tags($title);
        $title = mysqli_real_escape_string($this->con, $title);

        $image_url = strip_tags($image_url);
        $image_url = mysqli_real_escape_string($this->con, $image_url);

        $body = strip_tags($body); //removes html tags
        $body = mysqli_real_escape_string($this->con, $body);
        $check_empty = preg_replace('/\s+/', '', $body); //Deletes all spaces

        if ($check_empty != "") {


            //Current date and time
            $date_added = date("Y-m-d H:i:s");
            //Get username
            $added_by = $this->user_obj->getUsername();

            //insert post
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$title', '$image_url', '$body', '$added_by', '$date_added', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->con);

            //Insert notification

            //Update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

        }
    }

    public function loadPosts(){
        $str = ""; //String to return
        $data = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

        while($row = mysqli_fetch_array($data)){
            $id = $row['id'];
            $title = $row['title'];
            $image_url = $row['image_url'];
            $post_body = $row['body'];
            $body_preview = substr($post_body, 0, 200);
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];


            //Check if user who posted, has their account closed
            $added_by_obj = new User($this->con, $added_by);
            if($added_by_obj->isClosed()) {
                continue;
            }

            $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $body = $user_row['body']; //Testing
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];

            //Timeframe
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time); //Time of post
            $end_date = new DateTime($date_time_now); //Current time
            $interval = $start_date->diff($end_date); //Difference between dates
            if($interval->y >= 1) {
                if($interval == 1)
                    $time_message = $interval->y . " year ago"; //1 year ago
                else
                    $time_message = $interval->y . " years ago"; //1+ year ago
            }
            else if ($interval-> m >= 1) {
                if($interval->d == 0) {
                    $days = " ago";
                }
                else if($interval->d == 1) {
                    $days = $interval->d . " day ago";
                }
                else {
                    $days = $interval->d . " days ago";
                }


                if($interval->m == 1) {
                    $time_message = $interval->m . " month". $days;
                }
                else {
                    $time_message = $interval->m . " months". $days;
                }

            }
            else if($interval->d >= 1) {
                if($interval->d == 1) {
                    $time_message = "Yesterday";
                }
                else {
                    $time_message = $interval->d . " days ago";
                }
            }
            else if($interval->h >= 1) {
                if($interval->h == 1) {
                    $time_message = $interval->h . " hour ago";
                }
                else {
                    $time_message = $interval->h . " hours ago";
                }
            }
            else if($interval->i >= 1) {
                if($interval->i == 1) {
                    $time_message = $interval->i . " minute ago";
                }
                else {
                    $time_message = $interval->i . " minutes ago";
                }
            }
            else {
                if($interval->s < 30) {
                    $time_message = "Just now";
                }
                else {
                    $time_message = $interval->s . " seconds ago";
                }
            }


            $str .= " <?php include(\"includes/header.php\"); ?>
                      <html>
                         <head></head>
                             <body>
                             
                                <div class=\"container\">
  
                                    <div class=\"card border-secondary bg-light mb-3\">
                                    <img class=\"card-img-top\" src=\"$image_url\">
                                    <div class=\"card-body\">
                                         <h5 class=\"card-title\">$title</h5>
                                         By $first_name $last_name 
                                         <hr>
                                         <p class=\"card-text\">$body_preview...</p>
                                         <p class=\"card-text\"><small class=\"text-muted\">&nbsp;&nbsp;&nbsp;&nbsp;$time_message</small></p>
                                         <a href=\"$id\" class=\"btn btn-sm btn-outline-dark\">Read</a>
                                     </div>
                                     </div>
  
                                </div>
                             
                            
                             </div>
                        
                            </body>
                        </html>


                  ";


        }

        echo $str ;

    }

}

?>