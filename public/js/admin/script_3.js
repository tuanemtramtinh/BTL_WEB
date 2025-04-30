FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginFileValidateSize,
  FilePondPluginFileValidateType,
  FilePondPluginImageExifOrientation
);

const imagePreview = document.querySelector(".image-preview-filepond");

if (imagePreview) {
  FilePond.create(imagePreview, {
    credits: null,
    allowImagePreview: true,
    allowImageFilter: false,
    allowImageExifOrientation: false,
    allowImageCrop: false,
    itemInsertLocation: "after",
    acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "image/webp"],
    fileValidateTypeDetectType: (source, type) =>
      new Promise((resolve, reject) => {
        // Check if it's a WebP file by extension
        if (source.name && source.name.toLowerCase().endsWith(".webp")) {
          resolve("image/webp");
        } else {
          resolve(type);
        }
      }),
    storeAsFile: true,
  });
}

const imagePreviewEdit = document.querySelector(".image-preview-filepond-edit");
const imageLink = document.querySelector(".image-link");
const base = document.querySelector("base");
if (imagePreviewEdit) {
  const imageLinkParse = JSON.parse(imageLink.value);
  const imageObject = imageLinkParse.map((item) => {
    return {
      source: base.href + item,
      options: {
        type: "remote",
      },
    };
  });

  FilePond.create(imagePreviewEdit, {
    credits: null,
    allowImagePreview: true,
    allowImageFilter: false,
    allowImageExifOrientation: false,
    allowImageCrop: false,
    acceptedFileTypes: ["image/webp", "image/png", "image/jpg", "image/jpeg"],
    fileValidateTypeDetectType: (source, type) =>
      new Promise((resolve, reject) => {
        // Check if it's a WebP file by extension
        if (source.name && source.name.toLowerCase().endsWith(".webp")) {
          resolve("image/webp");
        } else {
          resolve(type);
        }

        resolve(type);
      }),
    storeAsFile: true,
    files: imageObject,
  });
}

//Update Quantity
const productUpdate = document.querySelectorAll(".product-update");
if (productUpdate) {
  productUpdate.forEach((input) => {
    const oldValue = input.value;
    input.addEventListener("change", async (e) => {
      const newValue = input.value;
      const quantity = newValue - oldValue;
      const productId = input.getAttribute("product-id");
      const cartId = input.getAttribute("cart-id");
      const data = await axios.get(
        `admin/cart/updateQuantity/${productId}?quantity=${quantity}&cartId=${cartId}`
      );
      if (data.status === 200) {
        location.reload();
      }
    });
  });
}
//End Update Quantity

//Update Status
const orderSelects = document.querySelectorAll(".order-select");
if (orderSelects.length > 0) {
  orderSelects.forEach((select) => {
    select.addEventListener("change", async (e) => {
      const status = select.value;
      const orderId = select.getAttribute("order-id");
      const data = await axios.get(
        `admin/order/changeStatus/${orderId}/${status}`
      );
      if (data.status === 200) {
        location.reload();
      }
    });
  });
}
//End Update Status

//Product Filter
const brandFilter = document.querySelector("#filter-brand");
const categoryFilter = document.querySelector("#filter-category");

if (brandFilter) {
  brandFilter.addEventListener("change", (e) => {
    const selectedValue = e.target.value;
    const url = new URL(window.location.href);
    if (selectedValue === "") {
      url.searchParams.delete("brand");
    } else {
      url.searchParams.set("brand", selectedValue);
    }
    window.location.href = url.toString();
  });
}

if (categoryFilter) {
  categoryFilter.addEventListener("change", (e) => {
    const selectedValue = e.target.value;
    const url = new URL(window.location.href);
    if (selectedValue === "") {
      url.searchParams.delete("category");
    } else {
      url.searchParams.set("category", selectedValue);
    }
    window.location.href = url.toString();
  });
}
//End Product Filter
