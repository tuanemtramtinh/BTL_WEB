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
  })
}
// End Header Search