function closeForm() {
    document.getElementById("profile-popup").style.display = "none";
  }

  function toggleForm() {
    var loginForm = document.getElementById("login-form");
    var registrationForm = document.getElementById("registration-form");
    var formTitle = document.getElementById("form-title");
    var signupLink = document.getElementById("signup-link");

    if (loginForm.style.display === "none") {
      loginForm.style.display = "block";
      registrationForm.style.display = "none";
      formTitle.innerHTML = "User Login";
      signupLink.innerHTML = "Don't Have an Account? <a href='#' onclick='toggleForm()'>Create Now</a>";
    } else {
      loginForm.style.display = "none";
      registrationForm.style.display = "block";
      formTitle.innerHTML = "User Registration";
      signupLink.innerHTML = "Already have an account? <a href='#' onclick='toggleForm()'>Login Now</a>";
    }
  }