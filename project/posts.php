<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>posts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="posts-container">

   <h1 class="heading">latest posts</h1>

   <div class="box-container">
    <!--Selecting posts frm the database -->
      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts`");
         $select_posts->execute();
         if($select_posts->rowCount() > 0){
            while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
               
               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount(); 

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

               $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
               $confirm_likes->execute([$user_id, $post_id]);
      ?>
      <form class="box" method="post">
   <input type="hidden" name="post_id" value="<?= $post_id; ?>">
   <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
   <div class="post-admin">
      <div><?= $fetch_posts['date']; ?></div>
   </div>
   
   <?php
         if (!empty($fetch_posts['image']) && file_exists('uploaded_img/' . $fetch_posts['image'])) {
          $image_path = 'uploaded_img/' . $fetch_posts['image'];
          $image_alt = 'Image for post ' . $fetch_posts['post_title'];
        ?>
        <img src="<?= $image_path ?>" class="post-image" alt="<?= $image_alt ?>">
    <?php
       } else {
        echo 'Image not found';
        }
       ?>
   <div class="post-title"><?= $fetch_posts['title']; ?></div>
   <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
   <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">read more</a>
   <div class="icons">
      <a href="view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
      <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>  "></i><span>(<?= $total_post_likes; ?>)</span></button>
   </div>
</form>

      <?php
         }
      }else{
         echo '<p class="empty">no posts added yet!</p>';
      }
      ?>
   </div>

</section>



















<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>