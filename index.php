<?php
session_start();
require("./header.php");
?>
<link rel="stylesheet" href="plugin/css/login.css">
<style>
  .form-dropdown {
    background-color: #ccc;
    color: #000;
    border: 4px solid #aaa;
    border-radius: 8px;
    -webkit-appearance: menulist;
    -moz-appearance: menulist;
    -ms-appearance: menulist;
    appearance: menulist;
  }
</style>
<!-- Main Content -->
<div class="main-bg">
  <!-- title -->
  <h1>Comercializadora de Padilla<br>[Recaudos - Transacciones]</h1>
  <!-- //title -->
  <div class="sub-main row">
    <!-- vertical tabs -->
    <div class="row col-9 vertical-tab">
      <div id="section-verif" class="section">
        <input type="radio" name="sections" id="option-verif" checked />
        <label for="option-verif" class="icon-left col-sm-1 col-md-2"><span class="icon fas fa-file-invoice-dollar" aria-hidden="true"></span>DATOS DE FACTURA</label>
        <article class="col-9">
          <form id="verif-form" name="verif-form" method="POST">
            <h3 class="legend">VERIFICAR FACTURA</h3>
            <p class="para-style">Ingrese el número de factura de venta para comprobar la existencia de su factura.<br>Cuando compruebe su factura, <strong>diríjase a llenar los datos del pagador</strong>.<br>Si <strong>necesita ayuda,</strong> no dude en <a href="#">contactarnos</a>.</p>
            <div class="row group">
              <select class="input form-dropdown col-5" id="prefijo" name="prefijo" required>
                <?php
                $sqlprefijo = $conn->query("SELECT * FROM cdp_prefijos; ");
                /*echo "<option id='none' name='none' value=''>-Seleccionar prefijo de factura-</option>";*/
                while ($prefijoarray = mysqli_fetch_assoc($sqlprefijo)) {
                  echo "<option id=" . $prefijoarray["IDPREFIJO"] . " name=" . $prefijoarray["IDPREFIJO"] . " value=" . $prefijoarray["IDPREFIJO"] . ">" . $prefijoarray["IDPREFIJO"] . "</option>";
                }
                ?>
              </select>
              <div class="input col-7">
                <span class="fas fa-clipboard-check" aria-hidden="true"></span>
                <input type="text" placeholder="Factura de venta No." id="verif-factura" name="verif-factura" required />
              </div>
            </div>
            <div id="verif-response" name="verif-response" class="alert"></div>
            <a id="a-pagador" name="a-pagador" href="javascript:document.getElementById('option-pay').click();" class="btn submit" style="display: none; opacity: 0;">CONTINUAR</a>
          </form>
        </article>
      </div>
      <div id="section-pay" class="section">
        <input type="radio" name="sections" id="option-pay" disabled />
        <label for="option-pay" class="icon-left col-3"><span class="icon fas fa-user-circle" aria-hidden="true"></span>DATOS DEL PAGADOR</label>
        <article class="col-9">
          <form id="pay-form" name="pay-form" method="POST">
            <h3 class="legend last">INGRESAR DATOS DEL PAGADOR</h3>
            <p class="para-style">Ingrese <strong>todos</strong> los datos requeridos (*) a continuación.<br>Cuando esté listo, <strong>podrá pulsar el boton "Pagar con ePayco" para realizar la transacción</strong>.<br>Si <strong>necesita ayuda,</strong> no dude en <a href="#">contactarnos</a>.</p>
            <div class="row group">
              <div class="input col-12">
                <span class="fas fa-user" aria-hidden="true"></span>
                <input type="text" placeholder="Nombre completo *" id="pay-name" name="pay-name" required />
              </div>
              <select class="input form-dropdown col-5" id="pay-tipo-doc" name="pay-tipo-doc">
                <option id="CC" name="CC" value="CC">CC - Cédula de ciudadanía</option>
                <option id="CE" name="CE" value="CE">CE - Cédula de extranjería</option>
                <option id="PPN" name="PPN" value="PPN">PPN - Pasaporte</option>
                <option id="SSN" name="SSN" value="SSN">SSN - Número de seguridad social</option>
                <option id="LIC" name="LIC" value="LIC">LIC - Licencia de conducción</option>
                <option id="NIT" name="NIT" value="NIT">NIT - Número de identificación tributaria</option>
                <option id="TI" name="TI" value="TI">TI - Tarjeta de identidad</option>
                <option id="DNI" name="DNI" value="DNI">DNI - Documento nacional de identificación</option>
              </select>
              <div class="input col-7">
                <span class="fas fa-id-card" aria-hidden="true"></span>
                <input type="text" placeholder="Documento de identificación *" id="pay-nuip" name="pay-nuip" required />
              </div>
              <div class="input col-12">
                <span class="fas fa-envelope" aria-hidden="true"></span>
                <input type="email" placeholder="Correo electrónico *" id="pay-email" name="pay-email" required />
              </div>
              <div class="input col-12">
                <span class="fas fa-phone-alt" aria-hidden="true"></span>
                <input type="number" placeholder="Número telefónico" id="pay-phone" name="pay-phone" />
              </div>
              <div id="btn-pay" name="btn-pay" class="col-12" style="display: none; opacity: 0;"></div>
            </div>
          </form>
        </article>
      </div>
    </div>
    <!-- //vertical tabs -->
    <div class="image-style col-3"></div>
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
<script>
  function restoreResponse() {
    $("#verif-response").removeClass("alert-info");
    $("#verif-response").removeClass("alert-danger");
    $("#verif-response").removeClass("alert-success");
    $("#verif-response").removeClass("alert-warning");
    $("#verif-response").html("");
  }

  function verificarFactura() {
    restoreResponse();
    $("#verif-response").addClass("alert-info");
    $("#verif-response").html("<strong>Está verificándose la existencia de la factura \"" + $("#prefijo").val() + $("#verif-factura").val() + "\".</strong><hr><p>Espere un momento...</p>");
    $.ajax({
      url: "verif-factura.php",
      type: "POST",
      data: $("#verif-form").serialize(),
      dataType: 'json',
      success: function(response) {
        $.each(response, function(index, element) {
          console.log(element);
          restoreResponse();
          if (element.error) {
            $("#verif-response").addClass(element.status);
            $("#verif-response").html(element.message);
            $("#option-pay").prop('disabled', true);
            $("#a-pagador").css({
              "display": "none",
              "opacity": "0"
            });
          } else {
            $("#verif-response").addClass(element.status);
            $("#verif-response").html(element.message);
            $("#option-pay").prop('disabled', false);
            $("#a-pagador").css({
              "display": "block",
              "opacity": "1"
            });
          }
        })
      }
    });
  }

  function verificarDatosForm(element) {
    var $form = $(element),
      $required = $form.find("input:required"),
      $submit = $form.find("input[type='submit']");
    $submit.prop('disabled', true);
    $required.keyup(function() {
      $form.data("empty", "false");
      $required.each(function() {
        if ($(this).val() == "") $form.data("empty", "true");
      });
      /*if ($form.data("empty") == "true") $submit.prop('disabled', true);
      else if ($form.data("empty") == "false") $submit.prop('disabled', false);*/
    });
    if ($form.data("empty") == "true") return 0;
    else if ($form.data("empty") == "false") return 1;
  }

  $("#pay-form").keyup(function() {
    if (verificarDatosForm("#pay-form")) {
      console.log("form lleno");
    } else {
      console.log("form sin llenar");
    }
  });

  $("#verif-form").submit(function(e) {
    e.preventDefault();
  });
  $("#pay-form").submit(function(e) {
    e.preventDefault();
  });

  $("#verif-factura").keyup(verificarFactura);
  $("#prefijo").change(verificarFactura);
</script>
<?php
require("./footer.php");
?>