<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['publish'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $title= isset($_POST['title']) ? $_POST['title'] : '';
   $title = filter_var($title, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $content = isset($_POST['content']) ? $_POST['content'] : '';
   $content = filter_var($content, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;
   
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;
   
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;
   
   $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = '../uploaded_img/'.$image_04;
   
   $image_05 = $_FILES['image_05']['name'];
   $image_05 = filter_var($image_05, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_05 = $_FILES['image_05']['size'];
   $image_tmp_name_05 = $_FILES['image_05']['tmp_name'];
   $image_folder_05 = '../uploaded_img/'.$image_05;
   
   $image_06 = $_FILES['image_06']['name'];
   $image_06 = filter_var($image_06, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_06 = $_FILES['image_06']['size'];
   $image_tmp_name_06 = $_FILES['image_06']['tmp_name'];
   $image_folder_06 = '../uploaded_img/'.$image_06;
   
   //checking for already existing posts
   $select_post = $conn->prepare("SELECT * FROM `posts` WHERE title = ?");
   $select_post->execute([$title]);

   if($select_post->rowCount() > 0){
      $message[] = 'post already exist!';
   }else{
    // Insert post data into database
    $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, title, content, image_01, image_02, image_03, image_04, image_05, image_06) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_post->execute([$admin_id, $title, $content, $image_01, $image_02, $image_03, $image_04, $image_05, $image_06]);

      /*
      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);
      */
      /*
      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            move_uploaded_file($image_tmp_name_03, $image_folder_04);
            move_uploaded_file($image_tmp_name_03, $image_folder_05);
            move_uploaded_file($image_tmp_name_03, $image_folder_06);
            $message[] = 'new product added!';
         }

      }*/
      $insert_post = true; // example value, replace with your own logic
      $image_sizes = array($image_size_01, $image_size_02, $image_size_03, $image_size_04, $image_size_05, $image_size_06);
      $large_images = array_filter($image_sizes, function($size) {
    return $size > 2000000;
     });

    if ($insert_post) {
      if (!empty($large_images)) {
        $message[] = 'image size is too large!';
       } else {
        for ($i = 1; $i <= 6; $i++) {
            $image_tmp_name = ${'image_tmp_name_0' . $i};
            $image_folder = ${'image_folder_0' . $i};
            if (isset($image_tmp_name) && !empty($image_tmp_name)) {
                if (move_uploaded_file($image_tmp_name, $image_folder)) {
                    $message[] = 'File uploaded successfully';
                } else {
                    $message[] = 'Error uploading file: ' . error_get_last()['message'];
                }
            }
        }
        $message[] = 'Post Published';
    }
}


   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_post_image = $conn->prepare("SELECT * FROM `postss` WHERE id = ?");
   $delete_post_image->execute([$delete_id]);
   $fetch_delete_image = $delete_post_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_04']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_05']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_06']);
   $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
   $delete_post->execute([$delete_id]);
   /*
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   */
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php 
'../components/admin_header.php';
include '../components/admin_header.php'; ?>

<section class="post-editor">

   <h1 class="heading">ADD POST</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="admin_id" value="<?= $fetch_profile['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
      <div class="flex">
         <div class="inputBox">
            <span>Post title (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter post title" name="title">
         </div>
         <div class="inputBox">
            <span>Content (required)</span>
            <textarea name="content" placeholder="enter post content" class="box" required maxlength="10000" cols="30" rows="10"></textarea>
         </div>
         <!--div class="inputBox">
            <span>product price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div --->
        <div class="inputBox">
            <span>image 01 (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 02 (required)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 03 (required)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 04 (required)</span>
            <input type="file" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 05 (required)</span>
            <input type="file" name="image_05" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 06 (required)</span>
            <input type="file" name="image_06" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         
      </div>
      
      <input type="submit" value="publish" class="btn" name="publish">
   </form>

</section>

<!-- section class="show-products">

   <h1 class="heading">products added</h1>

   <div class="box-container">

   <?php
      /*$select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ */
   ?>
   <div class="box">
      <img src="../uploaded_img/<?//= $fetch_products['image_01']; ?>" alt="">
      <div class="name"><?//= $fetch_products['name']; ?></div>
      <div class="price">$<span><?//= $fetch_products['price']; ?></span>/-</div>
      <div class="details"><span><?//= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?//= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?//= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
        /* }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }*/
   ?>
   
   </div>

</section -->








<script src="../js/admin_script.js"></script>
   
</body>
</html>