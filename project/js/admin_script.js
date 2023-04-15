let header = document.querySelector('.header');

document.querySelector('#menu-btn').onclick = () =>{
   header.classList.toggle('active');
}

window.onscroll = () =>{
   header.classList.remove('active');
}

document.querySelectorAll('.posts-content').forEach(content => {
   if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
});
//This is the modification of uploading images 
function previewImages(event) {
   var preview = document.querySelector('#image-preview');
   preview.innerHTML = '';
   var files = event.target.files;
 
   for (var i = 0; i < files.length; i++) {
     var image = document.createElement('img');
     image.src = URL.createObjectURL(files[i]);
     image.classList.add('preview-image');
     preview.appendChild(image);
   }
 }