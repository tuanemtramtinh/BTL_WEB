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
  ...themeOptions,
});
// End TinyMCE
