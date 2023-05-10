<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include "view_post.php";
include 'components/like_post.php';

$get_id = $_GET['post_id'];
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
<body>
<form class="box" method="post">
         <input type="hidden" name="post_id" value="<?= $post_id; ?>">
         <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
         
<div class="sub-images">
  <?php
  for ($i=2; $i<=6; $i++) {
    $image_column = 'image_0' . $i;
    if (!empty($fetch_posts[$image_column]) && file_exists('uploaded_img/' . $fetch_posts[$image_column])) {
      $image_path = 'uploaded_img/' . $fetch_posts[$image_column];
      $image_alt = 'Image ' . $i . ' for post ' . $fetch_posts['post_title'];
  ?>
      <img src="<?= $image_path ?>" class="post-image" alt="<?= $image_alt ?>">
  <?php
    }
  }
  ?>
</div>
    </form>
    <?php include 'components/footer.php'; ?>
    <!-- Script to toggle the display of the hidden div on button click -->


<!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>
</html>