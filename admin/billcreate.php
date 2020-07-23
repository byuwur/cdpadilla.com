<?php
require("./header.php");
if (isset($_POST['crear'])) {
  $id = trim($_POST['prefijo'].$_POST['id']);
  $id = strip_tags($id);
  $id = htmlspecialchars($id);
  $nuip = trim($_POST['nuip']);
  $nuip = strip_tags($nuip);
  $nuip = htmlspecialchars($nuip);
  $nombre = trim($_POST['nombre']);
  $nombre = strip_tags($nombre);
  $nombre = htmlspecialchars($nombre);
  $concepto = trim($_POST['concepto']);
  $concepto = strip_tags($concepto);
  $concepto = htmlspecialchars($concepto);
  $valor = trim($_POST['valor']);
  $valor = strip_tags($valor);
  $valor = htmlspecialchars($valor);
  $fecha = trim(date("Y-m-d"));
  $fecha = strip_tags($fecha);
  $fecha = htmlspecialchars($fecha);
  $vencimiento = trim($_POST['vencimiento']);
  $vencimiento = strip_tags($vencimiento);
  $vencimiento = htmlspecialchars($vencimiento);

  $sql = $conn->query(" INSERT INTO cdp_facturas (IDFACTURA, NUIPFACTURA, NOMBREFACTURA, CONCEPTOFACTURA, VALORFACTURA, FECHAFACTURA, VENCIMIENTOFACTURA) VALUES ('$id', '$nuip', '$nombre', '$concepto', '$valor', '$fecha', '$vencimiento'); ");
  if ($sql) {
    $sqlPago = $conn->query(" INSERT INTO cdp_pagos (cdp_facturas_IDFACTURA, ESTADOPAGO, TIPODOCPAGO, NUIPPAGO, NOMBREPAGO, CORREOPAGO, TELEFONOPAGO) VALUES ('$id', '0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A'); ");
    if ($sqlPago) echo "<script>console.log('Registro exitoso en la tabla de pagos.');</script>"; else echo "<script>console.log('No fue posible hacer el registro en la tabla de pagos: $conn->error')</script>";
    messageModal("CREAR", "Factura creada.", "bill.php", "success");
    exit;
  } else {
    messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->error</small>", "", "danger");
    exit;
  }
}
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-user-plus"></i>CREAR NUEVA FACTURA</h1>
    <form method="POST" action="">
      <div class="row form-padding form-top-border">
        <div class="row group col-12 col-sm-6 col-md-4" style="margin-left: 0; margin-right: 0;">
          <!--small class="col-12">ID factura:</small-->
          <select class="form-dropdown col-6" id="prefijo" name="prefijo" required>
            <?php
            $sqlprefijo = $conn->query("SELECT * FROM cdp_prefijos; ");
            echo "<option id='none' name='none' value=''>- - Sin prefijo de factura - -</option>";
            while ($prefijoarray = mysqli_fetch_assoc($sqlprefijo)) {
              echo "<option id=" . $prefijoarray["IDPREFIJO"] . " name=" . $prefijoarray["IDPREFIJO"] . " value=" . $prefijoarray["IDPREFIJO"] . ">" . $prefijoarray["IDPREFIJO"] . "</option>";
            }
            ?>
          </select>
          <div class="col-6">
            <input type="text" id="id" name="id" value="" required /><span class="highlight"></span><span class="bar"></span><label>ID de factura</label>
          </div>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" id="nuip" name="nuip" value="" required /><span class="highlight"></span><span class="bar"></span><label>NUIP del cliente</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" id="nombre" name="nombre" value="" required /><span class="highlight"></span><span class="bar"></span><label>Nombre del cliente</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="number" id="valor" name="valor" value="" required /><span class="highlight"></span><span class="bar"></span><label>Valor de factura (COP$)</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="date" id="fecha" name="fecha" value="<?= date("Y-m-d"); ?>" min="<?= date("Y-m-d"); ?>" max="<?= date("Y-m-d"); ?>" required /><span class="highlight"></span><span class="bar"></span><label>Fecha de factura</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="date" id="vencimiento" name="vencimiento" value="" min="<?= date("Y-m-d"); ?>" required /><span class="highlight"></span><span class="bar"></span><label>Vencimiento de factura</label>
        </div>
        <div class="group col-12">
          <small class="col-12"><b>Concepto de factura:</b></small>
          <textarea class="col-12" id="concepto" name="concepto" maxlength="299" rows="3"></textarea>
        </div>
        <div class="group col-12">
          <input type="submit" class="btn-block btn-material" id="crear" name="crear" value="CREAR FACTURA" />
        </div>
      </div>
    </form>
  </section>
</div>
<?php
require("./footer.php");
?>