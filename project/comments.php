<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


include 'components/like_post.php';
$post_id = $fetch_posts['id'];
/* Adding comment */
if(isset($_POST['add_comment'])){
    // sanitize input variables
    $admin_id = filter_var($_POST['admin_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

 
    // validate comment
    if(empty($comment)){
       $message[] = 'comment cannot be empty!';
    }elseif(strlen($comment) > 1000){
       $message[] = 'comment is too long!';
    }else{
       // check if comment already exists in database
       $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ? AND admin_id = ? AND user_id = ? AND user_name = ? AND comment = ?");
       $verify_comment->execute([$get_id, $admin_id, $user_id, $user_name, $comment]);
 
       if($verify_comment->rowCount() > 0){
          $message[] = 'comment already added!';
       }else{
          // add comment to database
          if (!isset($get_id)) {
            $get_id = 1; // set a default post ID
        } else {
            $insert_comment = $conn->prepare("INSERT INTO `comments`(post_id, admin_id, user_id, user_name, comment) VALUES(?,?,?,?,?)");
            $insert_comment->execute([$get_id, $admin_id, $user_id, $user_name, $comment]);
            $message[] = 'new comment added!';
        }
        
       }
    }
 }
 /*editing comment*/
 if(isset($_POST['edit_comment'])){
    // sanitize input variables
    $comment_id = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
 
    // validate comment
    if(empty($comment)){
       $message[] = 'comment cannot be empty!';
    }elseif(strlen($comment) > 1000){
       $message[] = 'comment is too long!';
    }else{
       // update comment in database
       $update_comment = $conn->prepare("UPDATE `comments` SET comment = ? WHERE id = ?");
       $update_comment->execute([$comment, $comment_id]);
       $message[] = 'comment updated!';
    }
 
 /*Deleting Comment */
 if(isset($_POST['delete_comment'])){
    // sanitize input variables
    $comment_id = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
 
    // delete comment from database
    $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
    $delete_comment->execute([$comment_id]);
    $message[] = 'comment deleted!';
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view post</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<section class="comments-container">

   <p class="comment-title">add comment</p>
   <?php
      if($user_id != ''){  
         $select_admin_id = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
         $select_admin_id->execute([$get_id]);
         $fetch_admin_id = $select_admin_id->fetch(PDO::FETCH_ASSOC);
   ?>
   <form action="" method="post" class="add-comment">
      <input type="hidden" name="admin_id" value="<?= $fetch_admin_id['admin_id']; ?>">
      <input type="hidden" name="user_name" value="<?= $fetch_profile['name']; ?>">
      <?php
    // Check if $fetch_profile is set and not empty before using it
     if (isset($fetch_profile) && !empty($fetch_profile)) {
    echo '<p class="user"><i class="fas fa-user"></i><a href="update.php">' . $fetch_profile['name'] . '</a></p>';
    } else {
    echo '<p class="user"><i class="fas fa-user"></i>Unknown User</p>';
    }
       ?>
      <textarea name="comment" maxlength="1000" class="comment-box" cols="30" rows="10" placeholder="write your comment" required></textarea>
      <input type="submit" value="add comment" class="inline-btn" name="add_comment">
   </form>
   <?php
   }else{
   ?>
   <div class="add-comment">
      <p>please login to add or edit your comment</p>
      <a href="login.php" class="inline-btn">login now</a>
   </div>
   <?php
      }
   ?>
   
   <p class="comment-title">post comments</p>
   <div class="user-comments-container">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
         $select_comments->execute([$get_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="show-comments" style="<?php if($fetch_comments['user_id'] == $user_id){echo 'order:-1;'; } ?>">
         <div class="comment-user">
            <i class="fas fa-user"></i>
            <div>
               <span><?= $fetch_comments['user_name']; ?></span>
               <div><?= $fetch_comments['date']; ?></div>
            </div>
         </div>
         <div class="comment-box" style="<?php if($fetch_comments['user_id'] == $user_id){echo 'color:var(--white); background:var(--black);'; } ?>"><?= $fetch_comments['comment']; ?></div>
         <?php
            if($fetch_comments['user_id'] == $user_id){  
         ?>
         <form action="" method="POST">
            <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
            <button type="submit" class="inline-option-btn" name="open_edit_box">edit comment</button>
            <button type="submit" class="inline-delete-btn" name="delete_comment" onclick="return confirm('delete this comment?');">delete comment</button>
         </form>
         <?php
         }
         ?>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no comments added yet!</p>';
         }
      ?>
   </div>

</section>

</html>