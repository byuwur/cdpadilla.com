<?php
require("./header.php");
if (isset($_POST['crear'])) {
  $cedula = trim($_POST['cedula']);
  $cedula = strip_tags($cedula);
  $cedula = htmlspecialchars($cedula);
  $nombre = trim($_POST['nombre']);
  $nombre = strip_tags($nombre);
  $nombre = htmlspecialchars($nombre);
  $correo = trim($_POST['correo']);
  $correo = strip_tags($correo);
  $correo = htmlspecialchars($correo);
  $pass0 = trim($_POST['password0']);
  $pass0 = strip_tags($pass0);
  $pass0 = htmlspecialchars($pass0);
  $pass1 = trim($_POST['password1']);
  $pass1 = strip_tags($pass1);
  $pass1 = htmlspecialchars($pass1);

  if ($pass0 != $pass1) {
    messageModal("VERIFICAR", "Verifique las contraseñas.", "", "warning");
    exit;
  } else {
    $password = hash('sha256', $pass1);
    $sql = $conn->query(" INSERT INTO cdp_usuarios (IDUSUARIO, NOMBREUSUARIO, CORREOUSUARIO, PASSUSUARIO) VALUES ('$cedula', '$nombre', '$correo', '$password'); ");
    if ($sql) {
      messageModal("CREAR", "Administrador creado.", "admin.php", "success");
      exit;
    } else {
      messageModal("ERROR", "Algo salió mal. Intente más tarde.<br><small>Error $conn->error</small>", "", "danger");
      exit;
    }
  }
}
?>
<div class="container text-center">
  <section class="content">
    <h1><i class="fas fa-user-plus"></i>CREAR ADMINISTRADOR</h1>
    <form method="POST" action="">
      <div class="row form-padding form-top-border">
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" id="cedula" name="cedula" value="" required /><span class="highlight"></span><span class="bar"></span><label>Cédula</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="text" id="nombre" name="nombre" value="" required /><span class="highlight"></span><span class="bar"></span><label>Nombre completo</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="email" id="correo" name="correo" value="" required /><span class="highlight"></span><span class="bar"></span><label>Correo electrónico</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="password" id="password0" name="password0" autocomplete="off" required /><span class="highlight"></span><span class="bar"></span><label>Contraseña</label>
        </div>
        <div class="group col-12 col-sm-6 col-md-4">
          <input type="password" id="password1" name="password1" autocomplete="off" required /><span class="highlight"></span><span class="bar"></span><label>Confirmar contraseña</label>
        </div>
        <div class="group col-12">
          <input type="submit" class="btn-block btn-material" id="crear" name="crear" value="CREAR ADMINISTRADOR" />
        </div>
      </div>
    </form>
  </section>
</div>
<?php
require("./footer.php");
?>