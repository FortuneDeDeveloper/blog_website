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

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>



<section id="overview">
		<h2>Overview</h2>
		<p>Example Company is a leading provider of high-quality products and services for customers around the world. Our mission is to help our customers achieve their goals by providing them with innovative solutions and exceptional customer service.</p>
	</section>

	<section id="team">
		<h2>Our Team</h2>
		<ul>
			<li>
				<img src="ph5.jpg" alt="Jane Doe">
				<h3>Jane Doe</h3>
				<p>CEO</p>
			</li>
			<li>
				<img src="john-doe.jpg" alt="John Doe">
				<h3>John Doe</h3>
				<p>COO</p>
			</li>
			<li>
				<img src="jane-smith.jpg" alt="Jane Smith">
				<h3>Jane Smith</h3>
				<p>CFO</p>
			</li>
		</ul>
	</section>

	<section id="history">
		<h2>Our History</h2>
		<p>Example Company was founded in 2005 by Jane and John Doe. Since then, we have grown into a global leader in our industry, with customers in over 100 countries around the world. Our commitment to innovation and customer service has helped us achieve many milestones, including winning several industry awards and being named one of the fastest-growing companies in the world.</p>
	</section>

	<section id="subsidiaries">
	<h2>Subsidiary Companies and Projects</h2>
    <div class="slideshow-container">
       <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>

        <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>

        <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>

        <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>

        <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>

        <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>

        <div class="mySlides fade">
          <img src="img/img1.jpg" style="width:100%">
          <div class="caption">Caption Text 1</div>
        </div>


           <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
      




		<!--div class="subsidiary">
			<img src="subsidiary1.jpg" alt="Subsidiary 1">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis efficitur commodo dui, nec maximus arcu euismod vel. Nullam sed semper tortor, et molestie dolor. Praesent commodo, enim ut dignissim imperdiet, libero purus tristique lectus, vel dignissim quam mi vitae justo.</p>
		</div>
		<div class="subsidiary">
			<img src="subsidiary2.jpg" alt="Subsidiary 2">
			<p>Ut quis lacus vestibulum, posuere est quis, auctor ipsum. Cras tincidunt hendrerit justo, id euismod felis bibendum eget. Nunc consequat, augue id scelerisque pulvinar, lorem metus semper tortor, ac tincidunt dolor quam vel magna. </p>
		</div>
		<div class="subsidiary">
			<img src="subsidiary3.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="subsidiary3.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="ph1.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="ph2.jpg" alt="Subsidiary 3">
            <h3>HARUNA TOWERS</h3>
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="subsidiary3.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="subsidiary3.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="subsidiary3.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div>

		<div class="subsidiary">
			<img src="subsidiary3.jpg" alt="Subsidiary 3">
			<p>Mauris quis tincidunt orci, a rhoncus elit. Curabitur fermentum feugiat eros, eu rhoncus est gravida nec. Nunc congue nisi quis mi blandit, a auctor lacus auctor. Sed pellentesque elementum tortor, a finibus nibh mollis sed.</p>
		</div -->
	</section>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>