function previewImage(event) {
    var output = document.getElementById('cover_image_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.display = 'block';
}


FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.parse(document.body);

const existingImageUrl = (typeof existingImage !== 'undefined') ? existingImage : "";
//console.log('Image URL:', existingImage);

if (existingImageUrl){
    const pond = FilePond.create(document.getElementById('cover_image'), {
        files: existingImage && existingImage.trim() !== "" ? [
            {
                source: existingImage,
                options: {
                    type: 'remote'
                }
            }
        ] : []
    });
}

