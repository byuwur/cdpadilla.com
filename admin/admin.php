<?php
require("./header.php");
if (isset($_POST['delete'])) {
  $deleteuser = trim($_POST['deleteuser']);
  $deleteuser = strip_tags($deleteuser);
  $deleteuser = htmlspecialchars($deleteuser);

  $query = $conn->query(" DELETE FROM cdp_usuarios WHERE IDUSUARIO='$deleteuser'; ");
  if ($query) {
    if ($deleteuser == $_usuario) {
      messageModal("ELIMINAR", "Ha eliminado su propio usuario...", "logout.php?logout", "danger");
      exit;
    } else {
      messageModal("ELIMINAR", "Usuario eliminado.", "admin.php", "danger");
      exit;
    }
  } else {
    messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->errno</small>", "", "danger");
    exit;
  }
}
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-users"></i>ADMINISTRADORES</h1>
    <div class="row form-padding">
      <div class="col-12 col-sm-6 mb-2">Sesión actual:<br><b><?= $_cedula . " - " . $_nombre; ?></b></div>
      <div class="col-12 col-sm-6"><a class="btn-block btn-material" href="admincreate.php"><i class="fas fa-user-plus"></i>AÑADIR USUARIO</a></div>
    </div>
    <?php
    $sql = $conn->query("SELECT IDUSUARIO, NOMBREUSUARIO, CORREOUSUARIO FROM cdp_usuarios; ");
    while ($res = mysqli_fetch_assoc($sql)) {
    ?>
      <div class="row form-padding form-top-border">
        <div class="col-6 col-sm-4 col-md-2">
          <small>NUIP:</small><br><b><?= $res['IDUSUARIO']; ?></b>
        </div>
        <div class="col-6 col-sm-4 col-md-3">
          <small>Correo electrónico:</small><br><b><?= $res['CORREOUSUARIO']; ?></b>
        </div>
        <div class="col-12 col-sm-4 col-md-3 mb-2">
          <small>Nombre:</small><br><b><?= $res['NOMBREUSUARIO'] ?></b>
        </div>
        <div class="col-6 col-md-2">
          <a class="btn btn-block btn-outline-info" href="adminedit.php?user=<?= $res['IDUSUARIO']; ?>"><i class="fas fa-edit"></i>EDITAR USUARIO</a>
        </div>
        <div id="deldiv_<?= $res['IDUSUARIO']; ?>" name="deldiv_<?= $res['IDUSUARIO']; ?>" class="col-6 col-md-2">
          <a class="btn btn-block btn-outline-danger" href="javascript:;" onclick="showDiv_<?= $res['IDUSUARIO']; ?>()"><i class="fas fa-user-slash"></i>BORRAR USUARIO</a>
        </div>
        <div id="deletediv_<?= $res['IDUSUARIO']; ?>" name="deletediv_<?= $res['IDUSUARIO']; ?>" class="col-6 col-md-2">
          <form method="POST" action="">¿Está seguro? Esta es una acción <b>IRREVERSIBLE</b><br>
            <input type="hidden" id="deleteuser" name="deleteuser" value="<?= $res['IDUSUARIO']; ?>">
            <button class="btn btn-block btn-outline-danger" type="submit" id="delete" name="delete"><a>SÍ, BORRAR USUARIO</a></button>
          </form>
        </div>
        <script>
          document.getElementById('deletediv_<?= $res['IDUSUARIO']; ?>').style.display = "none";
          document.getElementById('deletediv_<?= $res['IDUSUARIO']; ?>').style.opacity = "0";

          function showDiv_<?= $res['IDUSUARIO']; ?>() {
            document.getElementById('deletediv_<?= $res['IDUSUARIO']; ?>').style.display = "block";
            document.getElementById('deletediv_<?= $res['IDUSUARIO']; ?>').style.opacity = "1";
            document.getElementById('deldiv_<?= $res['IDUSUARIO']; ?>').style.display = "none";
            document.getElementById('deldiv_<?= $res['IDUSUARIO']; ?>').style.opacity = "0";
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