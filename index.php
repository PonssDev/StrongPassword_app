<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- SEO = Básico -->
  <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
  <title>Strong Password</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- Etiquetas Open Graph y Twitter Card, para crear el SEO de Redes Sociales -->
  <meta property="og:title" content="Título de tu página" />
  <meta property="og:description" content="Descripción de tu página" />
  <meta property="og:image" content="URL de la imagen que quieres mostrar en las redes sociales" />
  <meta property="og:url" content="URL de tu página" />
  <meta property="og:type" content="website" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Título de tu página" />
  <meta name="twitter:description" content="Descripción de tu página" />
  <meta name="twitter:image" content="URL de la imagen que quieres mostrar en Twitter" />

  <!-- App Web, inidicar al navegador que elementos mostrar en un JSON -->
  <link rel="manifest" href="site.webmanifest" />
  <!-- icono de acceso para IOS -->
  <link rel="apple-touch-icon" href="icon.png" />
  <!-- Recordar que favicon.ico tiene que estar en el directorio inicial -->

  <!-- links de estilos -->
  <link rel="stylesheet" href="css/style.css" />

  <!-- Se cambia el tema de algunos navegadores -->
  <meta name="theme-color" content="#fafafa" />
  <!-- Código de las plataformas de Análisis -->
  <script></script>
  <!-- Scripts a cargar antes de la renderización -->
  <script src="preloader.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>

<body>
  <div id="container">
    <header>
      <div class="logo">
        <img src="img/desktop/Strong Password •••_white.webp" alt="" class="logo">
      </div>
      <?php
      session_start();
      ?>
      <nav>
        <div class="left__nav">
          <li><a href="#">Por qué Strong Password?</a></li>
          <li><a href="#">Asistencia</a></li>
          <li><a href="#">Precios</a></li>
        </div>
        <div class="right__nav">
          <?php
          // Comprobar si el usuario ha iniciado sesión
          if (isset($_SESSION["email"])) {
            // Mostrar el nombre del usuario y un enlace de cerrar sesión
            echo '<li><a href="dashboard.php">Bienvenido, ' . $_SESSION["email"] . '</a></li>
              <li><a href="logout.php">Cerrar sesión</a></li>';
          } else {
            // Si no ha iniciado sesión, mostrar enlace de inicio de sesión
            echo '<li><a href="login.html">Iniciar sesión</a></li>';
          }
          ?>
          <li><a href="#">Contacto</a></li>
        </div>

      </nav>
    </header>
    <section class="landing__page">
      <div class="landing__interior">
        <div class="left__landing">
          <h3>Siempre con protección</h3>
          <p>Prepárate para tener las contraseñas mas seguras y almacenarlas con la mayor seguridad posible.</p>
          <?php
          if (isset($_SESSION["email"])) {
            echo '<a href="register.php" class="registrar">Planes</a>';
          } else {
            echo '<a href="register.php" class="registrar">Regístrate</a>';
          }
          ?>
        </div>
        <img src="img/desktop/vector copntrasenya.webp" alt="" class="vector">
      </div>
    </section>
    <section class="create__password">
      <div class="create__interior">
        <div class="sub__form">
          <h1 class="strongpassword">Strong Password</h1>
          <div class="generator">
            <form action="" id="form" class="form">
              <div class="wrapper__input">
                <input type="text" id="password">
                <div class="wrapper__btn">
                  <button id="copy">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                      <path fill="#f2f2f2"
                        d="M208 0H332.1c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9V336c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V48c0-26.5 21.5-48 48-48zM48 128h80v64H64V448H256V416h64v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48z" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="wrapper__lenght">
                <p id="number__lenght" class="number__lenght">14</p>
                <input type="range" id="range" class="range" min="8" max="28">
              </div>
              <div class="options">
                <div class="wrapper__option">
                  <label for="uppercase">Uppercase letters</label>
                  <div class="wrapper__checkbox">
                    <input type="checkbox" id="uppercase">
                  </div>
                </div>
                <div class="wrapper__option">
                  <label for="lowercase">Lowercase letters</label>
                  <div class="wrapper__checkbox">
                    <input type="checkbox" id="lowercase">
                  </div>
                </div>
                <div class="wrapper__option">
                  <label for="numbers">Numbers</label>
                  <div class="wrapper__checkbox">
                    <input type="checkbox" id="numbers">
                  </div>
                </div>
                <div class="wrapper__option">
                  <label for="symbols">Symbols</label>
                  <div class="wrapper__checkbox">
                    <input type="checkbox" id="symbols">
                  </div>
                </div>
              </div>
              <button id="generate">GENERATE</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <section class="quienes__somos">
      <div class="quienes__interior">
        <h2>Nosotros</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vestibulum, lorem vel malesuada
          tincidunt, justo turpis fermentum dolor, vel fringilla libero odio id elit. Nullam vestibulum dolor
          ac magna feugiat, ut aliquet quam fermentum. Proin vehicula tincidunt justo, non dictum elit
          tincidunt id. Fusce et varius eros. Nullam nec metus ut purus suscipit suscipit. Aliquam ut justo
          eu mauris sagittis ullamcorper vel ac libero. Suspendisse potenti. Curabitur vitae leo nec orci
          tristique scelerisque. Sed sollicitudin, odio id aliquet tempor, tellus leo eleifend mi, vel
          sollicitudin urna mi vel sem.</p>
        <p>Phasellus non risus ut ligula vulputate fermentum vel ut justo. Curabitur vitae sapien vel nunc
          fermentum bibendum. Aliquam erat volutpat. Ut in ante nec elit ultricies fringilla non eu justo.
          Suspendisse id mi elit. Duis tincidunt tellus nec lectus tristique, nec malesuada arcu suscipit.
          Vivamus non nisi erat. Nunc ut turpis nec mauris accumsan suscipit. Pellentesque habitant morbi
          tristique senectus et netus et malesuada fames ac turpis egestas.</p>
      </div>
    </section>
    <section class="opiniones__gente">
      <div class="opiniones__interior">
        <h2>Opiniones de la gente</h2>
        <div class="opinion">
          <p>"¡Increíble! Strong Password me ha ayudado a mantener mis contraseñas seguras y organizadas. ¡Altamente
            recomendado!"</p>
          <span>- Usuario1</span>
        </div>
        <div class="opinion">
          <p>"Nunca pensé que proteger mis contraseñas sería tan fácil. La interfaz es intuitiva y la generación de
            contraseñas es genial."</p>
          <span>- Usuario2</span>
        </div>
        <div class="opinion">
          <p>"Strong Password me da la tranquilidad de saber que mis contraseñas están a salvo. ¡La mejor aplicación que
            he usado!"</p>
          <span>- Usuario3</span>
        </div>
      </div>
    </section>

    <footer>
      <p>Made with ❤️ by Alan</p>
    </footer>
  </div>
  <script src="js/generator.js"></script>
</body>

</html>