window.addEventListener("load", function () {
  var $recaptcha = document.querySelector("#g-recaptcha-response");

  if ($recaptcha) {
    $recaptcha.setAttribute("required", "required");
  }
  var details = document.getElementsByClassName("formRegister");
  for (var i = 0; i < details.length; i++) {
    details[i].firstElementChild.onclick = function () {
      this.parentElement.classList.toggle("close");
    };
  }
});

var filterEmail, filterPassword;
filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})$/;
filterPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,15}$/;

function validateRegister(theForm) {
  //Verifies if name is null, client side has this field required.
  if (theForm.username.value === "") {
    alert("You must enter a VALID name.");
    document.getElementById("username").focus();
    return false;
  }
  if (!filterPassword.test(theForm.password.value)) {
    alert("Please provide a password with the correct format.");
    document.getElementById("password").focus();
    return false;
  }
  if (!filterEmail.test(theForm.email.value)) {
    alert("Please provide a valid e-mail address");
    document.getElementById("email").focus();
    return false;
  }
  if (theForm.password.value != theForm.cpassword.value) {
    alert("Both passwords must be the same.");
    document.getElementById("cpassword").focus();
    return false;
  }
  if (theForm.email.value != theForm.cemail.value) {
    alert("Both emails must be the same.");
    document.getElementById("cemail").focus();
    return false;
  }
  console.log("true")
  return true;
}
