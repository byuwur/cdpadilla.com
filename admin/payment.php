<?php
require("./header.php");
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-clipboard-check"></i>GESTIÓN DE PAGOS</h1>
    <div class="row form-padding">
      <div class="col-12 col-sm-4 mb-2">Sesión actual:<br><b><?= $_cedula . " - " . $_nombre; ?></b></div>
      <div class="col-12 col-sm-8"><i class="fas fa-angle-down"></i><i class="fas fa-info-circle"></i><i class="fas fa-angle-down"></i><br><b>Los registros de los pagos presentados a continuación son generados una vez se ha iniciado una pasarela de pago.</b></div>
    </div>
    <?php
    $sql = $conn->query("SELECT * FROM cdp_pagos; ");
    while ($res = mysqli_fetch_assoc($sql)) {
    ?>
      <div class="row form-padding form-top-border">
        <div class="col-6 col-md-3">
          <small>ID factura:</small><br><a href="bill.php#<?= $res['cdp_facturas_IDFACTURA']; ?>"><b><?= $res['cdp_facturas_IDFACTURA']; ?></b></a>
        </div>
        <div class="col-6 col-md-3">
          <small>Estado de pago:</small><br>
          <b><?php echo $res['ESTADOPAGO']; if ($res['ESTADOPAGO']) echo " - PAGO"; else echo " - PENDIENTE" ?></b>
        </div>
        <div class="col-6 col-md-3">
          <small>Tipo de documento del pagador:</small><br><b><?= $res['TIPODOCPAGO']; ?></b>
        </div>
        <div class="col-6 col-md-3 mb-2">
          <small>NUIP del pagador:</small><br><b><?= $res['NUIPPAGO'] ?></b>
        </div>
        <div class="col-12 col-md-4 mb-2">
          <small>Nombre del pagador:</small><br><b><?= $res['NOMBREPAGO'] ?></b>
        </div>
        <div class="col-6 col-md-4">
          <small>Correo del pagador:</small><br><b><?= $res['CORREOPAGO']; ?></b>
        </div>
        <div class="col-6 col-md-4">
          <small>Teléfono del pagador:</small><br><b><?= $res['TELEFONOPAGO']; ?></b>
        </div>
      </div>
    <?php
    }
    ?>
  </section>
</div>
<?php
require("./footer.php");
?>