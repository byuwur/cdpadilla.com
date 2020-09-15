<?php
require("./header.php");
if (isset($_POST['delete'])) {
  $deleteuser = trim($_POST['deleteuser']);
  $deleteuser = strip_tags($deleteuser);
  $deleteuser = htmlspecialchars($deleteuser);
  $fechafactura = trim($_POST['fechafactura']);
  $fechafactura = strip_tags($fechafactura);
  $fechafactura = htmlspecialchars($fechafactura);

  if ($fechafactura == date("Y-m-d")) {
    $queryPagos = $conn->query(" DELETE FROM cdp_pagos WHERE cdp_facturas_IDFACTURA='$deleteuser'; ");
    $query = $conn->query(" DELETE FROM cdp_facturas WHERE IDFACTURA='$deleteuser'; ");
    if ($query) {
      messageModal("ELIMINAR", "Registro eliminado.", "bill.php", "danger");
      exit;
    } else {
      messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->errno</small>", "", "danger");
      exit;
    }
  } else {
    echo "<script>console.log('No se puede borrar $deleteuser');</script>";
  }
}
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-file-invoice-dollar"></i>FACTURAS</h1>
    <div class="row form-padding">
      <div class="col-12 col-sm-4 mb-2">Sesión actual:<br><b><?= $_cedula . " - " . $_nombre; ?></b></div>
      <div class="col-12 col-sm-4"><a class="btn-block btn-material" href="prefix.php"><i class="fas fa-angle-right"></i>VER PREFIJOS DE FACTURA</a></div>
      <div class="col-12 col-sm-4"><a class="btn-block btn-material" href="billcreate.php"><i class="fas fa-user-plus"></i>AÑADIR FACTURA</a></div>
    </div>
    <?php
    $sql = $conn->query("SELECT * FROM cdp_facturas; ");
    while ($res = mysqli_fetch_assoc($sql)) {
    ?>
      <div id="<?= $res['IDFACTURA']; ?>" class="row form-padding form-top-border">
        <div class="col-6 col-md-3">
          <small>ID factura:</small><br><b><?= $res['IDFACTURA']; ?></b>
        </div>
        <div class="col-6 col-md-3">
          <small>Valor factura:</small><br><b>COP$<?= $res['VALORFACTURA']; ?></b>
        </div>
        <div class="col-6 col-md-3">
          <small>NUIP cliente:</small><br><b><?= $res['NUIPFACTURA']; ?></b>
        </div>
        <div class="col-6 col-md-3 mb-2">
          <small>Nombre cliente:</small><br><b><?= $res['NOMBREFACTURA'] ?></b>
        </div>
        <div class="col-12 col-md-6 mb-2">
          <small>Concepto factura:</small><br><b><?= $res['CONCEPTOFACTURA'] ?></b>
        </div>
        <div class="col-6 col-md-3">
          <small>Fecha factura:</small><br><b><?= $res['FECHAFACTURA']; ?></b>
        </div>
        <div class="col-6 col-md-3">
          <small>Vencimiento factura:</small><br><b><?= $res['VENCIMIENTOFACTURA']; ?></b>
        </div>

        <?php
        if ($res['FECHAFACTURA'] == date("Y-m-d")) {
          $noDashPrefix = str_replace("-", "", $res['IDFACTURA']);
        ?>
          <div id="deldiv_<?= $noDashPrefix; ?>" name="deldiv_<?= $noDashPrefix; ?>" class="col-12">
            <a class="btn btn-block btn-outline-danger" href="javascript:;" onclick="showDiv_<?= $noDashPrefix; ?>()"><i class="fas fa-user-slash"></i>BORRAR FACTURA</a>
          </div>
          <div id="deletediv_<?= $noDashPrefix; ?>" name="deletediv_<?= $noDashPrefix; ?>" class="col-12">
            <form method="POST" action="">¿Está seguro? Esta es una acción <b>IRREVERSIBLE</b><br>
              <input type="hidden" id="deleteuser" name="deleteuser" value="<?= $res['IDFACTURA']; ?>">
              <input type="hidden" id="fechafactura" name="fechafactura" value="<?= $res['FECHAFACTURA']; ?>">
              <button class="btn btn-block btn-outline-danger" type="submit" id="delete" name="delete"><a>SÍ, BORRAR FACTURA</a></button>
            </form>
          </div>
          <script>
            document.getElementById('deletediv_<?= $noDashPrefix; ?>').style.display = "none";
            document.getElementById('deletediv_<?= $noDashPrefix; ?>').style.opacity = "0";

            function showDiv_<?= $noDashPrefix; ?>() {
              document.getElementById('deletediv_<?= $noDashPrefix; ?>').style.display = "block";
              document.getElementById('deletediv_<?= $noDashPrefix; ?>').style.opacity = "1";
              document.getElementById('deldiv_<?= $noDashPrefix; ?>').style.display = "none";
              document.getElementById('deldiv_<?= $noDashPrefix; ?>').style.opacity = "0";
            }
          </script>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
  </section>
</div>
<?php
require("./footer.php");
?>