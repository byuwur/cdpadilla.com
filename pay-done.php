<?php
require("./header.php");
session_start();

/*function curl_get_contents($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}*/

if (isset($_GET['ref_payco'])) {
  $ref_payco = trim($_GET['ref_payco']);
  $ref_payco = strip_tags($ref_payco);
  $ref_payco = htmlspecialchars($ref_payco);

  $response = json_decode(file_get_contents("https://secure.epayco.co/validation/v1/reference/$ref_payco"));

  /*$response = json_decode(curl_get_contents("https://secure.epayco.co/validation/v1/reference/$ref_payco"));
  
  $mail_asunto = "Mail subject.";
  $mail_header = "From: mateus@mnm.team\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\n";
  $mail_message = ' <html><body>Mail text.</body></html> ';
  mail($email, $mail_asunto, $mail_message, $mail_header);*/

  if ($response->{"data"}->{"x_test_request"} == "TRUE") {
    echo "<script>console.log('Esta joda fue pasada por test. No la reciba.');</script>";
    echo "<script>console.log('" . $response->{"data"}->{"x_test_request"} . "');</script>";
    echo "La referencia <strong>" . $response->{"data"}->{"x_ref_payco"} . "</strong> <small>(" . $ref_payco . ")</small> fue realizada como un pago de PRUEBA y no como un pago REAL. Por favor, contacte al administrador de la página si cree que esto es un error.";
    exit;
  } else if ($response->{"data"}->{"x_test_request"} == "FALSE") {
    echo "<script>console.log('Esta joda NO fue pasada por test. Recíbala.');</script>";
    echo "<script>console.log('" . $response->{"data"}->{"x_test_request"} . "');</script>";

    $sqlPay = $conn->query("UPDATE cdp_pagos SET REFEPAYCO = '" . $response->{"data"}->{"x_ref_payco"} . "', APIEPAYCO = '" . $ref_payco . "'  WHERE cdp_facturas_IDFACTURA = '" . $response->{"data"}->{"x_id_invoice"} . "';");
    if ($sqlPay) echo "<script>console.log('Actualización de datos de PAGO exitosa.');</script>";
    else echo '<script>console.log("Error en datos de PAGO: ' . $conn->error . '.");</script>';

    $alert_message = "ID factura: <strong>" . $response->{"data"}->{"x_id_invoice"} . "</strong><br>";
    $alert_message .= "Ref. ePayco: <strong>" . $response->{"data"}->{"x_ref_payco"} . "</strong><hr>";
    $alert_message .= "Estado: <strong>0" . $response->{"data"}->{"x_cod_transaction_state"} . " - " . $response->{"data"}->{"x_transaction_state"} . "</strong><hr>";
    $alert_message .= "Monto facturado: <strong>" . $response->{"data"}->{"x_currency_code"} . "$" . $response->{"data"}->{"x_amount_ok"} . "</strong><br>";
    $alert_message .= "Fecha facturación: <strong>" . $response->{"data"}->{"x_transaction_date"} . "</strong><br>";

    switch ((int) $response->{"data"}->{"x_cod_transaction_state"}) {
      case 1:
        //Aceptada
        $alert_state = "alert-success";
        $sqlStatePay = $conn->query("UPDATE cdp_pagos SET ESTADOPAGO = '1'  WHERE cdp_facturas_IDFACTURA = '" . $response->{"data"}->{"x_id_invoice"} . "';");
        if ($sqlStatePay) echo "<script>console.log('Actualización de estado de PAGO exitosa.');</script>";
        else echo '<script>console.log("Error en estado de PAGO: ' . $conn->error . '.");</script>';
        break;
      case 2:
        //Rechazada
      case 4:
        //Fallida
      case 9:
        //Expirada
      case 10:
        //Abandonada
      case 11:
        //Cancelada
      case 12:
        //Antifraude
        $alert_state = "alert-danger";
        $sqlStatePay = $conn->query("UPDATE cdp_pagos SET ESTADOPAGO = '0'  WHERE cdp_facturas_IDFACTURA = '" . $response->{"data"}->{"x_id_invoice"} . "';");
        if ($sqlStatePay) echo "<script>console.log('Actualización de estado de PAGO exitosa.');</script>";
        else echo '<script>console.log("Error en estado de PAGO: ' . $conn->error . '.");</script>';
        break;
      case 3:
        //Pendiente
      case 6:
        //Reversada
      case 7:
        //Retenida
        $alert_state = "alert-warning";
        $sqlStatePay = $conn->query("UPDATE cdp_pagos SET ESTADOPAGO = '0'  WHERE cdp_facturas_IDFACTURA = '" . $response->{"data"}->{"x_id_invoice"} . "';");
        if ($sqlStatePay) echo "<script>console.log('Actualización de estado de PAGO exitosa.');</script>";
        else echo '<script>console.log("Error en estado de PAGO: ' . $conn->error . '.");</script>';
        break;
      case 8:
        //Iniciada
        $alert_state = "alert-success";
        $sqlStatePay = $conn->query("UPDATE cdp_pagos SET ESTADOPAGO = '0'  WHERE cdp_facturas_IDFACTURA = '" . $response->{"data"}->{"x_id_invoice"} . "';");
        if ($sqlStatePay) echo "<script>console.log('Actualización de estado de PAGO exitosa.');</script>";
        else echo '<script>console.log("Error en estado de PAGO: ' . $conn->error . '.");</script>';
        break;
      default:
        $alert_state = "alert-danger";
        $alert_message = "Algo salió mal. Por favor, intente de nuevo...";
        break;
    }
  }
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
            <p class="para-style">Muchas gracias por comprar con nosotros. Si recibe este mensaje, es porque la transacción se completó de manera exitosa.<br>Pronto recibirá una confirmación a su correo electrónico.<br>Recuerde que puede guardar la siguiente información como comprobante.</p>
            <div class="alert <?= $alert_state; ?>">
              <?= $alert_message; ?>
            </div>
            <p class="para-style"><strong>¿No ve el estado de su transacción?</strong> Considere <a href="javascript:location.reload();">recargar la página.</a><br><strong>¿Necesita algo más?</strong> <a href="#">Comuníquese con nosotros.</a></p>
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