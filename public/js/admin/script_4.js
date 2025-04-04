function previewImage(event) {
    var output = document.getElementById('cover_image_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.display = 'block';
}


FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType
  );
// FilePond.parse(document.body);

//const existingImageUrl = (typeof existingImage !== 'undefined') ? existingImage : "";
//console.log('Image URL:', existingImage);

FilePond.create(document.getElementById('images'), {
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


