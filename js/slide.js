let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
showSlides(slideIndex += n);
}

function currentSlide(n) {
showSlides(slideIndex = n);
}

function showSlides(n) {
let slides = document.getElementsByClassName("slide");
if (n > slides.length) {
 slideIndex = 1;
}
if (n < 1) {
 slideIndex = slides.length;
}
for (let i = 0; i < slides.length; i++) {
 slides[i].style.display = "none";
}
slides[slideIndex - 1].style.display = "block";
}

// Thêm đoạn mã tự động chuyển slide sau một khoảng thời gian
let slideInterval = setInterval(function () {
plusSlides(1);
}, 5000); // Tự động chuyển slide mỗi 3 giây (3000 milliseconds)

