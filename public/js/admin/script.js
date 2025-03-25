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
