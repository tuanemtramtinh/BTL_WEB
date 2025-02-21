// Swiper

var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
  loop: true,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});
var swiper3 = new Swiper(".mySwiper3", {
  loop:true,
  slidesPerView: 4,
  spaceBetween: 45,
});

// End Swiper 

const quantityAdjustDecrease = document.querySelector(".quantity-adjust .fa-minus");
const quantityAdjustIncrease = document.querySelector(".quantity-adjust .fa-plus");
const quanityNum = document.querySelector(".quantity-adjust input");

if (quanityNum) {
  quantityAdjustIncrease.addEventListener("click", () => {
    quanityNum.value = +quanityNum.value + 1;
  })
  quantityAdjustDecrease.addEventListener("click", () => {
    if (+quanityNum.value > 1)
    quanityNum.value = +quanityNum.value - 1;
  })
}


