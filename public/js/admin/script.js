//Toastify
const sessionMessage = document.querySelector(".sessionMessage");
if (sessionMessage) {
  Toastify({
    text: sessionMessage.value,
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    backgroundColor: "#4fbe87",
  }).showToast();
}
//End Toastify
