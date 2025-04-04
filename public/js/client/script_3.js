// Swiper

var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 4,
  // freeMode: true,
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
  loop: true,
  slidesPerView: 4,
  spaceBetween: 45,
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 25,
    },
    767.98: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
    // >= 1199.98
    1199.98: {
      slidesPerView: 4,
      spaceBetween: 40,
    },
  },
});

// End Swiper

// ViewerJs
if (document.getElementById("image")) {
  const viewer = new Viewer(document.getElementById("image"));
}
// End ViewerJs

// Quantity Adjust

const quantityAdjust = document.querySelectorAll(".quantity-adjust");
if (quantityAdjust.length > 0) {
  quantityAdjust.forEach((item) => {
    const decreaseButton = item.querySelector(".fa-minus");
    const increaseButton = item.querySelector(".fa-plus");
    const input = item.querySelector("input");

    increaseButton.addEventListener("click", () => {
      input.value = +input.value + 1;
    });

    decreaseButton.addEventListener("click", () => {
      if (+input.value > 1) input.value = +input.value - 1;
    });
  });
}

// End Quantity Adjust
