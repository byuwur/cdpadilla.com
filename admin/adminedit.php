<?php
require("./header.php");

$user = trim($_GET['user']);
$user = strip_tags($user);
$user = htmlspecialchars($user);

$datosuser = $conn->query(" SELECT * FROM cdp_usuarios WHERE IDUSUARIO='$user'; ");
$datosuserarray = mysqli_fetch_assoc($datosuser);

if (isset($_POST['cambiar'])) {
  $nombre = trim($_POST['nombre']);
  $nombre = strip_tags($nombre);
  $nombre = htmlspecialchars($nombre);
  $correo = trim($_POST['correo']);
  $correo = strip_tags($correo);
  $correo = htmlspecialchars($correo);

  $sql = $conn->query(" UPDATE cdp_usuarios SET NOMBREUSUARIO='$nombre', CORREOUSUARIO='$correo' WHERE IDUSUARIO='$datosuserarray[IDUSUARIO]'; ");
  if ($sql) {
    if ((isset($_POST['password0']) != "" || isset($_POST['password0']) != null) && (isset($_POST['password1']) != "" || isset($_POST['password1']) != null)) {
      $pass0 = trim($_POST['password0']);
      $pass0 = strip_tags($pass0);
      $pass0 = htmlspecialchars($pass0);
      $pass1 = trim($_POST['password1']);
      $pass1 = strip_tags($pass1);
      $pass1 = htmlspecialchars($pass1);
      $passwordactual = hash('sha256', $pass0);
      $passwordnueva = hash('sha256', $pass1);

      $queryverifpass = $conn->query(" SELECT IDUSUARIO FROM cdp_usuarios WHERE IDUSUARIO = '$datosuserarray[IDUSUARIO]' AND PASSUSUARIO = '$passwordactual'; ");
      $count = mysqli_num_rows($queryverifpass);
      if ($count != 1) {
        messageModal("EDITAR", "Perfil actualizado. ", "admin.php", "success");
      } else {
        $query = $conn->query(" UPDATE cdp_usuarios SET PASSUSUARIO = '$passwordnueva' WHERE IDUSUARIO='$datosuserarray[IDUSUARIO]'; ");
        if ($query) {
          if ($datosuserarray['USERUSUARIO'] == $_usuario) {
            messageModal("EDITAR", "Perfil actualizado. Contraseña actualizada. Vuelva a iniciar sesión.", "../logout.php?logout", "success");
          } else {
            messageModal("EDITAR", "Perfil actualizado. Contraseña actualizada.", "admin.php", "success");
          }
        } else {
          messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->error</small>", "admin.php", "danger");
        }
      }
    }
  } else {
    messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->error</small>", "admin.php", "danger");
  }
}
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-edit"></i>EDITAR ADMINISTRADOR - "<?= $user; ?>"</h1>
    <form method="POST" action="">
      <div class="row form-padding form-top-border">
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" disabled value="<?= $datosuserarray['IDUSUARIO'] ?>" /><span class="highlight"></span><span class="bar"></span><label>Cédula</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" id="nombre" name="nombre" value="<?= $datosuserarray['NOMBREUSUARIO'] ?>" required /><span class="highlight"></span><span class="bar"></span><label>Nombre completo</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="email" id="correo" name="correo" value="<?= $datosuserarray['CORREOUSUARIO'] ?>" required /><span class="highlight"></span><span class="bar"></span><label>Correo electrónico</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="password" id="password0" name="password0" autocomplete="off" /><span class="highlight"></span><span class="bar"></span><label>Contraseña actual (si es requerido)</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="password" id="password1" name="password1" autocomplete="off" /><span class="highlight"></span><span class="bar"></span><label>Nueva contraseña (si es requerido)</label>
        </div>
        <div class="group col-12">
          <input type="submit" class="btn-block btn-material" id="cambiar" name="cambiar" value="ACTUALIZAR ADMINISTRADOR">
        </div>
      </div>
    </form>
  </section>
</div>
<?php
require("./footer.php");
?>