//Toastify
const sessionMessageSuccess = document.querySelector(".sessionMessageSuccess");
if (sessionMessageSuccess) {
  Toastify({
    text: sessionMessageSuccess.value,
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    backgroundColor: "#4fbe87",
  }).showToast();
}

const sessionMessageError = document.querySelector(".sessionMessageError");
if (sessionMessageError) {
  Toastify({
    text: sessionMessageError.value,
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    backgroundColor: "#F3616D",
  }).showToast();
}
//End Toastify

// TinyMCE
const themeOptions = document.body.classList.contains("dark")
  ? {
      skin: "oxide-dark",
      content_css: "dark",
    }
  : {
      skin: "oxide",
      content_css: "default",
    };

tinymce.init({
  selector: "#content",
  plugins: "advlist autolink lists link image charmap preview anchor",
  toolbar:
    "undo redo | styles | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat",
  images_upload_url: "admin/upload/image",
  images_upload_handler: function (blobInfo, success, failure) {
    const xhr = new XMLHttpRequest();

    // Prepare form data
    const formData = new FormData();
    formData.append("file", blobInfo.blob(), blobInfo.filename());

    // Define the request method and URL
    xhr.open("POST", "admin/upload/image", true);

    // Handle the response
    xhr.onload = function () {
      if (xhr.status === 200) {
        try {
          // Assuming the server returns JSON with an image URL
          const response = xhr.responseText;
          // console.log("Image upload successful:", response); // Log the server response

          // If the server returns a location (URL), call success with the image URL
          if (response.location) {
            success(response.location);
          } else {
            failure("No location found in server response.");
          }
        } catch (error) {
          console.error("Error parsing server response:", error);
          failure("Error uploading image.");
        }
      } else {
        console.error("Error during image upload:", xhr.statusText);
        failure("Failed to upload image.");
      }
    };

    // Handle the error if the XHR request fails
    xhr.onerror = function () {
      console.error("Request failed:", xhr.statusText);
      failure("Failed to upload image.");
    };

    // Send the form data
    xhr.send(formData);
  },
  ...themeOptions,
});
// End TinyMCE
