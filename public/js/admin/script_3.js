FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginFileValidateSize,
  FilePondPluginFileValidateType
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
        // Do custom type detection here and return with promise
        resolve(type);
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
    acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "image/webp"],
    fileValidateTypeDetectType: (source, type) =>
      new Promise((resolve, reject) => {
        // Do custom type detection here and return with promise
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
