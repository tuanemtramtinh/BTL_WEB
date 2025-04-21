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

//Add to bag Form

const productDetailForm = document.querySelector(".product-detail__form");

if (productDetailForm) {
  const button = productDetailForm.querySelector("button");
  const wrapper = document.querySelector(".wrapper");
  const header = document.querySelector(".header");
  productDetailForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const oldButton = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';

    const formData = new FormData(productDetailForm);
    const queryString = new URLSearchParams(formData).toString();
    const url = productDetailForm.getAttribute("action") + "?" + queryString;
    try {
      const response = await axios.get(url);
      if (response.status === 200) {
        button.disabled = false;
        button.innerHTML = oldButton;
        const alert = document.createElement("div");
        alert.classList.add("alert");
        alert.classList.add("success");
        alert.innerHTML = `
        <span class="closebtn">&times;</span>
        ${response.data.msg}
        `;
        wrapper.insertBefore(alert, header);
        const closeBtn = alert.querySelector(".closebtn");
        if (closeBtn) {
          const alertDiv = closeBtn.parentElement;
          function hideAlert() {
            if (alertDiv) {
              alertDiv.style.opacity = "0";
              alertDiv.style.display = "none";
              alertDiv.remove();
            }
          }
          if (closeBtn) {
            closeBtn.addEventListener("click", function () {
              hideAlert();
            });
          }
          setTimeout(hideAlert, 3000);
        }
      }
    } catch (error) {
      button.disabled = false;
      button.innerHTML = oldButton;
      const alert = document.createElement("div");
      alert.classList.add("alert");
      alert.classList.add("error");
      alert.innerHTML = `
        <span class="closebtn">&times;</span>
        ${error.data.msg}
        `;
      wrapper.insertBefore(alert, header);
      const closeBtn = alert.querySelector(".closebtn");
      if (closeBtn) {
        const alertDiv = closeBtn.parentElement;
        function hideAlert() {
          if (alertDiv) {
            alertDiv.style.opacity = "0";
            alertDiv.style.display = "none";
            alertDiv.remove();
          }
        }
        if (closeBtn) {
          closeBtn.addEventListener("click", function () {
            hideAlert();
          });
        }
        setTimeout(hideAlert, 3000);
      }
    }
  });
}

//End Add to bag Form
