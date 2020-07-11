<?php
require("./header.php");
//require("./_variables.php");
?>
<link rel="stylesheet" href="plugin/css/login.css">
<!-- Main Content -->
<div class="main-bg" style="background: linear-gradient(rgba(128, 64, 0, 0.33), rgba(0, 0, 0, 0.66)),url(img/bg.jpg) no-repeat center;
background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;background-size: cover;-ms-background-size: cover;min-height: 100vh;">
  <!-- title -->
  <h1>Comercializadora de Padilla<br>[Transacciones]</h1>
  <!-- //title -->
  <div class="sub-main">
    <div class="image-style" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(128, 64, 0, 0.25)),url(img/logo.jpg) no-repeat center;
    background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;background-size: cover;-ms-background-size: cover;min-height: 370px;">
    </div>
    <!-- vertical tabs -->
    <div class="vertical-tab">
      <div id="section1" class="section">
        <input type="radio" name="sections" id="option1" checked>
        <label for="option1" class="icon-left"><span class="icon fas fa-check-circle" aria-hidden="true"></span>FINALIZAR</label>
        <article>
          <form action="#" method="post">
            <h3 class="legend">Transacción finalizada</h3>
            <p class="para-style">Muchas gracias por comprar con nosotros. Si recibe este mensaje, es porque la transacción se completó de manera exitosa.<br>Pronto recibirá una confirmación a su correo electrónico.</p>
            <p class="para-style-2"><strong>¿Necesita algo más?</strong> <a href="#">Comuníquese con nosotros.</a></p>
            <!--div class="input">
              <span class="fas fa-envelope" aria-hidden="true"></span>
              <input type="email" placeholder="Correo electrónico" name="email" required />
            </div-->
            <a href="./" class="btn submit">TERMINAR</a>
          </form>
        </article>
      </div>
    </div>
    <!-- //vertical tabs -->
    <div class="clear"></div>
  </div>
  <!-- copyright -->
  <div class="copyright">
    <h2>
    &copy; <?= date("Y"); ?> <a href="https://somosmnm.co/mateus">Mateus [byUwUr]</a>
    &middot; <a href="./privacy_policy">Política de Privacidad</a> &middot; Para <?= $_nombreempresa; ?>
    &middot; Fondo: <a href='https://www.freepik.es/fotos/fondo'>kjpargeter de freepik.es</a>
    </h2>
  </div>
  <!-- //copyright -->
</div>
<?php
require("./footer.php");
?>