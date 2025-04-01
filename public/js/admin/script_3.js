FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginImageCrop,
  FilePondPluginImageExifOrientation,
  FilePondPluginImageFilter,
  FilePondPluginImageResize,
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
