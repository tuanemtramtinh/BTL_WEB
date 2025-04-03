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
    acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
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
const base = document.querySelector('base');
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
    acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
    fileValidateTypeDetectType: (source, type) =>
      new Promise((resolve, reject) => {
        // Do custom type detection here and return with promise
        resolve(type);
      }),
    storeAsFile: true,
    files: imageObject
  });
}
