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

const searchInput = search.querySelector(".search__text input");
// console.log(searchInput);
if (searchInput) {
  searchInput.addEventListener("keyup", () => {
    const searchValue = searchInput.value.toLowerCase();
    const searchResult = document.querySelector(".search__result");
    const searchProductList = searchResult.querySelector(
      ".search__product-list"
    );

    if (searchValue === "") {
      searchProductList.innerHTML = "";
    } else {
      axios.get(`product/search?keyword=${searchValue}`).then((response) => {
        const productList = response.data;

        searchProductList.innerHTML = ""; // Clear previous results

        const htmls = productList.map((product) => {
          const image = JSON.parse(product.Image)[0];

          return `
            <a href="product/detail/${
              product.Slug
            }" class="search__product-item">
              <div class="search__product-wrapper">
                <img src="${image}" alt="${product.Name}" />
              </div>
              <div class="search__product-content">
                <h4>${product.Name}</h4>
                <p>${product.PriceUnit.toLocaleString()} VND</p>
              </div>
            </a>
          `;
        });
        searchProductList.innerHTML = htmls.join("");
      });
    }
  });
}
// End Header Search

//Alert
const closeBtn = document.querySelector(".closebtn");
if (closeBtn) {
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
}

//End Alert
