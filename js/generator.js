// password-generator.js

// Espera a que se cargue el DOM antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {
  // Obtiene referencias a elementos del DOM
  const uppercaseCheckbox = document.getElementById("uppercase");
  const lowercaseCheckbox = document.getElementById("lowercase");
  const numbersCheckbox = document.getElementById("numbers");
  const symbolsCheckbox = document.getElementById("symbols");
  const passwordInput = document.getElementById("password");
  const lengthInput = document.getElementById("range");
  const lengthDisplay = document.getElementById("number__lenght");
  const generateButton = document.getElementById("generate");
  const copyButton = document.getElementById("copy");

  // Define conjuntos de caracteres para construir la contraseña
  const uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const lowercaseLetters = "abcdefghijklmnopqrstuvwxyz";
  const numbers = "0123456789";
  const symbols = "!@#$%^&*()_+-=[]{}|;':,.<>?";

  // Agrega event listener para generar contraseña al hacer clic en el botón "Generate"
  generateButton.addEventListener("click", function (e) {
    e.preventDefault(); // Evita el envío del formulario
    generatePassword();
  });

  // Agrega event listener para copiar la contraseña al hacer clic en el botón "Copy"
  copyButton.addEventListener("click", copyPasswordToClipboard);
  // Agrega event listener para actualizar la visualización de la longitud al cambiar el valor del rango
  lengthInput.addEventListener("input", updateLengthDisplay);

  // Función para generar la contraseña
  function generatePassword() {
    // Verifica que al menos una opción esté seleccionada
    if (
      !uppercaseCheckbox.checked &&
      !lowercaseCheckbox.checked &&
      !numbersCheckbox.checked &&
      !symbolsCheckbox.checked
    ) {
      alert("Por favor selecciona al menos una opción");
      return;
    }

    // Concatena los conjuntos de caracteres seleccionados
    const allChars = [
      uppercaseCheckbox.checked ? uppercaseLetters : "",
      lowercaseCheckbox.checked ? lowercaseLetters : "",
      numbersCheckbox.checked ? numbers : "",
      symbolsCheckbox.checked ? symbols : "",
    ].join("");

    let generatedPassword = "";
    const length = lengthInput.value;

    // Genera la contraseña seleccionando caracteres aleatorios del conjunto combinado
    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * allChars.length);
      generatedPassword += allChars.charAt(randomIndex);
    }

    // Muestra la contraseña generada en el campo de entrada
    passwordInput.value = generatedPassword;
  }

  // Función para copiar la contraseña al portapapeles
  function copyPasswordToClipboard() {
    passwordInput.select();
    document.execCommand("copy");
    alert("Password copied to clipboard!");
  }

  // Función para actualizar la visualización de la longitud
  function updateLengthDisplay() {
    lengthDisplay.textContent = lengthInput.value;
  }
});
