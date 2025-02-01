// document.querySelectorAll('a[href^="#"]').forEach(anchor => {
//     anchor.addEventListener("click", function (e) {
//         e.preventDefault();
//         document.querySelector(this.getAttribute("href")).scrollIntoView({
//             behavior: "smooth"
//         });
//     });
// });

document.querySelector("#contactForm").addEventListener("click", function (e) {
  e.preventDefault(); // prevent the form default submission

  var formdata = new FormData(this); // get form data

  fetch("contact.php", {
    method: "post",
    body: formdata, // send form data to server
  })
    .then((response) => response.json()) //parse the response as JSON
    .then((data) => {
      var responseMessage = document.getElementById("responseMessage");
      if (data.status == "success") {
        console.log(data.message);
        // alert("message:"+ data.message)
        responseMessage.innertHTML =
          '<div class="alert alert-success" role="alert">' +
          data.message +
          "</div>";
      } else {
        // alert("message:" + data.message)
        console.log(data.message);
        responseMessage.innertHTML =
          '<div class="alert alert-success" role="alert">' +
          data.message +
          "</div>";
      }
    })
    .catch((error) => {
      // alert("error."+error.message)
    //   console.error("Error:", error); // Log error response
      var responseMessage = document.getElementById("responseMessage");
      // Ensure the element exists before modifying it
      if (responseMessage) {
        responseMessage.innerHTML =
          "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
      }
    });
});
