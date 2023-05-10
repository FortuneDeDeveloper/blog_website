<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
   <!-- Font Awesome CSS link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-ozL6mFgtSBZGnVnpD5Rn/IMz/v1GRTlF7Vx71Nqkm25lV5NqlJ1ELXrn2Wapb07caoy+q3gGJw8NYtEuxRt0Kw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- Custom CSS link -->
   <link rel="stylesheet" href="css/style.css">
   <style>
    .image-container {
  position: relative;
  display: flex;
  flex-wrap: wrap;
}

.thumbnail-wrapper {
  width: 200px;
  height: 200px;
  margin: 10px;
}

.thumbnail {
  width: 100%;
  height: 100%;
}

.expanded-image {
  display: none;
  position: fixed;
  z-index: 999;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%;
  max-width: 800px;
  height: auto;
  max-height: 80%;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
  padding: 20px;
  box-sizing: border-box;
  overflow: auto;
}

.expanded-image img {
  width: 100%;
  height: auto;
  object-fit: contain;
  margin-bottom: 20px;
}

.close {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 30px;
  cursor: pointer;
}
thumbnail-wrapper figcaption {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  padding: 10px;
  box-sizing: border-box;
  font-size: 14px;
  text-align: center;
}

   </style>
   

</head>
<body>
<?php include 'components/user_header.php'; ?>
    <h1>OUR PROJECTS</h1>
<div class="image-container">

  <div class="thumbnail-wrapper">
    <img src="ph1.jpg" alt="Image 1" class="thumbnail">
    <figcaption>Caption for Image 1</figcaption>
  </div>
  <div class="thumbnail-wrapper">
    <img src="ph2.jpg" alt="Image 2" class="thumbnail">
    <figcaption>Caption for Image 1</figcaption>
  </div>
  <div class="thumbnail-wrapper">
    <img src="ph3.jpg" alt="Image 3" class="thumbnail">
    <figcaption>Caption for Image 1</figcaption>
  </div>
  <div class="thumbnail-wrapper">
    <img src="ph4.jpg" alt="Image 4" class="thumbnail">
  </div>
  <div class="thumbnail-wrapper">
    <img src="ph5.jpg" alt="Image 5" class="thumbnail">
    <figcaption>Caption for Image 1</figcaption>
  </div>
  
</div>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>