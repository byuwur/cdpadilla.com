<?php
require("./header.php");
session_start();
if (isset($_GET['ref_payco'])) {
  $ref_payco = trim($_GET['ref_payco']);
  $ref_payco = strip_tags($ref_payco);
  $ref_payco = htmlspecialchars($ref_payco);
  $response = json_decode(file_get_contents("https://secure.epayco.co/validation/v1/reference/$ref_payco"));
?>
  <link rel="stylesheet" href="plugin/css/login.css">
  <!-- Main Content -->
  <div class="main-bg">
    <!-- title -->
    <h1>Comercializadora de Padilla<br>[Transacciones]</h1>
    <!-- //title -->
    <div class="sub-main row">
      <div class="image-style col-12 col-lg-3"></div>
      <!-- vertical tabs -->
      <div class="row col-12 col-lg-9 vertical-tab">
        <div id="section-finish" class="section">
          <input type="radio" name="sections" id="option-finish" checked>
          <label for="option-finish" class="icon-left col-12 col-lg-2 col-xl-1"><span class="icon fas fa-check-circle" aria-hidden="true"></span>FINALIZAR</label>
          <article class="col-12 col-lg-9 form">
            <h3 class="legend">La transacción <strong><?= $response->{"data"}->{"x_id_invoice"}; ?></strong> ha finalizado.</h3>
            <p class="para-style">Muchas gracias por comprar con nosotros. Si recibe este mensaje, es porque la transacción se completó de manera exitosa.<br>Pronto recibirá una confirmación a su correo electrónico.<br><strong>¿Necesita algo más?</strong> <a href="#">Comuníquese con nosotros.</a></p>
            <a href="./" class="btn submit">TERMINAR</a>
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
} else {
  echo "You're not permitted to do that. Sorry.";
  exit;
}
?>