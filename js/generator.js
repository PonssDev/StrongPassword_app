// password-generator.js

document.addEventListener("DOMContentLoaded", function () {
  const uppercaseCheckbox = document.getElementById("uppercase");
  const lowercaseCheckbox = document.getElementById("lowercase");
  const numbersCheckbox = document.getElementById("numbers");
  const symbolsCheckbox = document.getElementById("symbols");
  const passwordInput = document.getElementById("password");
  const lengthInput = document.getElementById("range");
  const lengthDisplay = document.getElementById("number__lenght");
  const generateButton = document.getElementById("generate");
  const copyButton = document.getElementById("copy");

  const uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const lowercaseLetters = "abcdefghijklmnopqrstuvwxyz";
  const numbers = "0123456789";
  const symbols = "!@#$%^&*()_+-=[]{}|;':,.<>?";

  generateButton.addEventListener("click", function (e) {
    e.preventDefault(); // Evita el envío del formulario
    generatePassword();
  });

  copyButton.addEventListener("click", copyPasswordToClipboard);
  lengthInput.addEventListener("input", updateLengthDisplay);

  function generatePassword() {
    if (
      !uppercaseCheckbox.checked &&
      !lowercaseCheckbox.checked &&
      !numbersCheckbox.checked &&
      !symbolsCheckbox.checked
    ) {
      alert("Please select at least one option");
      return;
    }

    const allChars = [
      uppercaseCheckbox.checked ? uppercaseLetters : "",
      lowercaseCheckbox.checked ? lowercaseLetters : "",
      numbersCheckbox.checked ? numbers : "",
      symbolsCheckbox.checked ? symbols : "",
    ].join("");

    let generatedPassword = "";
    const length = lengthInput.value;

    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * allChars.length);
      generatedPassword += allChars.charAt(randomIndex);
    }

    passwordInput.value = generatedPassword;
  }

  function copyPasswordToClipboard() {
    passwordInput.select();
    document.execCommand("copy");
    alert("Password copied to clipboard!");
  }

  function updateLengthDisplay() {
    lengthDisplay.textContent = lengthInput.value;
  }
});
