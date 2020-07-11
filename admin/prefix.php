<?php
require("./header.php");
if (isset($_POST['crear'])) {
  $prefijo = trim($_POST['prefijo']);
  $prefijo = strip_tags($prefijo);
  $prefijo = htmlspecialchars($prefijo);

  $sql = $conn->query(" INSERT INTO cdp_prefijos (IDPREFIJO) VALUES ('$prefijo'); ");
  if ($sql) {
    messageModal("CREAR", "Prefijo creado.", "prefix.php", "success");
    exit;
  } else {
    messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->error</small>", "", "danger");
    exit;
  }
}
if (isset($_POST['delete'])) {
  $deleteuser = trim($_POST['deleteuser']);
  $deleteuser = strip_tags($deleteuser);
  $deleteuser = htmlspecialchars($deleteuser);

  $query = $conn->query(" DELETE FROM cdp_prefijos WHERE IDPREFIJO='$deleteuser'; ");
  if ($query) {
    messageModal("ELIMINAR", "Prefijo eliminado.", "prefix.php", "danger");
    exit;
  } else {
    messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->errno</small>", "", "danger");
    exit;
  }
}
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-angle-right"></i>PREFIJOS DE FACTURA</h1>
    <form method="POST" action="">
      <div class="row form-padding">
        <div class="col-12 col-md-4 mb-2">Sesión actual:<br><b><?= $_cedula . " - " . $_nombre; ?></b></div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" id="prefijo" name="prefijo" value="" required /><span class="highlight"></span><span class="bar"></span><label>Texto del nuevo prefijo</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="submit" class="btn-block btn-material" id="crear" name="crear" value="CREAR NUEVO PREFIJO" />
        </div>
      </div>
    </form>
    <?php
    $sql = $conn->query("SELECT * FROM cdp_prefijos; ");
    while ($res = mysqli_fetch_assoc($sql)) {
    ?>
      <div class="row form-padding form-top-border">
        <div class="col-6">
          <small>Prefijo:</small><br><b><?= $res['IDPREFIJO']; ?></b>
        </div>
        <?php $noDashPrefix = str_replace("-", "", $res['IDPREFIJO']); ?>
        <div id="deldiv_<?= $noDashPrefix; ?>" name="deldiv_<?= $noDashPrefix; ?>" class="col-6">
          <a class="btn btn-block btn-outline-danger" href="javascript:;" onclick="showDiv_<?= $noDashPrefix; ?>()"><i class="fas fa-user-slash"></i>BORRAR PREFIJO</a>
        </div>
        <div id="deletediv_<?= $noDashPrefix; ?>" name="deletediv_<?= $noDashPrefix; ?>" class="col-6">
          <form method="POST" action="">¿Está seguro? Esta es una acción <b>IRREVERSIBLE</b><br>
            <input type="hidden" id="deleteuser" name="deleteuser" value="<?= $res['IDPREFIJO']; ?>">
            <button class="btn btn-block btn-outline-danger" type="submit" id="delete" name="delete"><a>SÍ, BORRAR PREFIJO</a></button>
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
      </div>
    <?php
    }
    ?>
  </section>
</div>
<?php
require("./footer.php");
?>