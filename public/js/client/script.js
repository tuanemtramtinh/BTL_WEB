// AOS
AOS.init();
// End AOS

// Header Search
const headerSearch = document.querySelector(".header__utility i");
const search = document.querySelector(".search");

if (headerSearch) {
  headerSearch.addEventListener("click", () => {
    search.classList.toggle("active");
  });
}

if (search) {
  const closeButton = search.querySelector(".search__text .close");
  console.log(closeButton);
  closeButton.addEventListener("click", () => {
    search.classList.toggle("active");
  });
}
// End Header Search

//Alert
const closeBtn = document.querySelector(".closebtn");
const alertDiv = closeBtn.parentElement;

function hideAlert() {
  if (alertDiv) {
    alertDiv.style.opacity = "0";
    setTimeout(() => {
      alertDiv.style.display = "none";
    }, 600);
  }
}

if (closeBtn) {
  closeBtn.addEventListener("click", function () {
    hideAlert();
  });
}

setTimeout(hideAlert, 3000);

//End Alert
