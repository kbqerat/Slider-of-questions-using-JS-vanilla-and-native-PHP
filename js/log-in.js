"use strict";

let isRunning = true;

// selecting elements
let logupLink = document.querySelector(".log-in .left .logup-link");
let logupPage = document.querySelector(".log-up");
let loginPage = document.querySelector(".log-in");

let signupButton = document.querySelector("#signupBtn");
let cancelSignupButton = document.querySelector("#signupCancel");

let signupForm = document.getElementById("signup-form");

let successDiv = document.querySelector(".success");
let successDivCancelMark = document.querySelector(".success i");
let failedDiv = document.querySelector(".failed");
let failedDivCancelMark = document.querySelector(".failed i");

// when the user clicks the log-up button to create a new account
logupLink.addEventListener("click", () => {
  logupPage.classList.add("active");
  loginPage.classList.add("blur");
});

// a function that gets executed when the user is done with the log-up page
const logupClosed = function () {
  logupPage.classList.remove("active");
  loginPage.classList.remove("blur");
};

// if the user clicks on escape in the keyboard or cancel in the sign-page itself
logupPage.addEventListener("keydown", (ev) => {
  if (ev.key === "Escape") {
    logupClosed();
  }
});
cancelSignupButton.addEventListener("click", () => {
  logupClosed();
});

// a pattern to check if the phone number written by the user is matched
let phoneNumberPattern = /^\+212[67]\d{8}$/;

// log-up checking with ajax
signupForm.addEventListener("submit", (event) => {
  event.preventDefault(); // prevent page from reloading

  const firstName = document.getElementById("first-name").value;
  const lastName = document.getElementById("last-name").value;
  const email = document.getElementById("email").value;
  const phone = document.getElementById("phone").value;
  const signupUsername = document.getElementById("signup-username").value;
  const signupPassword = document.getElementById("signup-password").value;

  // Send data to server using XMLHttpRequest
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "log-in.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      let response = JSON.parse(xhr.responseText);
      if (response.success) {
        successDiv.classList.add("active");
        logupPage.classList.add("blur");
        successDivCancelMark.addEventListener("click", () => {
          successDivCancelMark.parentNode.classList.remove("active");
          logupPage.classList.remove("blur");
          logupClosed();
        });
      } else {
        failedDiv.classList.add("active");
        logupPage.classList.add("blur");
        failedDiv.insertAdjacentHTML("beforeend", response.message);
        let textNode = failedDiv.lastChild;
        failedDivCancelMark.addEventListener("click", () => {
          failedDivCancelMark.parentNode.classList.remove("active");
          logupPage.classList.remove("blur");
          failedDiv.removeChild(textNode);
        });
      }
    } else {
      alert("Une erreur s'est produite, veuillez réessayer!");
    }
  };
  xhr.send(
    `firstName=${firstName}&lastName=${lastName}&email=${email}&phone=${phone}&signupUsername=${signupUsername}&signupPassword=${signupPassword}`
  );
});
