<?php
session_start();
if (isset($_SESSION['admin']))
  header("Location: admin/");
require("./header.php");
//require("./_variables.php");
if (isset($_POST['btn-login'])) {
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  $pass = trim($_POST['password']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  if (empty($email)) {
    messageModal("ERROR", "Ingrese su usuario.", "", "danger");
    exit;
  }
  if (empty($pass)) {
    messageModal("ERROR", "Ingrese su contraseña.", "", "danger");
    exit;
  }
  $password = hash('sha256', $pass);
  $res = $conn->query("SELECT * FROM cdp_usuarios WHERE CORREOUSUARIO = '$email'; ");
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $row = mysqli_fetch_assoc($res);
    if ($password == $row['PASSUSUARIO']) {
      $_SESSION['admin'] = $row['IDUSUARIO'];
      header("Location: admin/");
    } else {
      messageModal("ERROR", "Credenciales incorrectas. Intente de nuevo.", "", "danger");
      exit;
    }
  } else {
    messageModal("ERROR", "No hay coincidencias. Revise sus credenciales.", "", "danger");
    exit;
  }
}
if (isset($_POST['btn-forget'])) {
  $email = trim($_POST['forget-email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  if (empty($email)) {
    messageModal("ERROR", "Ingrese su usuario.", "", "danger");
    exit;
  }
  $res = $conn->query("SELECT * FROM cdp_usuarios WHERE CORREOUSUARIO = '$email'; ");
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $row = mysqli_fetch_assoc($res);
    $passtemp = randomString();
    $hashpasstemp =  hash('sha256', $passtemp);
    $nombre = $row['NOMBREUSUARIO'];

    $mail_asunto = "Recuperar contraseña, $_nombreempresa";

    $mail_header = "From: mateus@mnm.team\r\n";
    $mail_header .= "MIME-Version: 1.0\r\n";
    $mail_header .= "Content-type: text/html; charset=iso-8859-1\r\n";

    $mail_message = ' <html> <head> <title> Recuperar contraseña </title> </head> <body>
      <p>Hola, <strong>' . $nombre . '</strong>.</p>
      <p>Se ha pedido una recuperación de contraseña a su cuenta: <strong>' . $email . '</strong>.</p>
      <p>Ingrese a: <strong><a href="' . $_url . '" target="_blank">' . $_url . '</a></strong>
      con su <strong>correo electrónico.</strong></p>
      Se le notifica que su nueva contraseña temporal con la que deberá iniciar sesión es:<br>
      <strong>' . $passtemp . '</strong><br><br>
      Sugerimos que cambie su contraseña inmediatamente después de iniciar sesión.
      <br><br>Gracias por usar nuestros servicios.<br><br>Atentamente, Mateus de MNM.
    </body> </html> ';

    $query = $conn->query(" UPDATE cdp_usuarios SET PASSUSUARIO = '$hashpasstemp' WHERE CORREOUSUARIO='$email'; ");

    if ($query) {
      mail($email, $mail_asunto, $mail_message, $mail_header);
      messageModal("RECUPERACIÓN", "Se ha enviado una contraseña temporal a su correo electrónico. (Sugerimos que revise su carpeta de spam y que cambie su contraseña inmediatamente después.)", "", "success");
    } else {
      messageModal("ERROR", "Algo no salió bien. Intente de nuevo.", "", "danger");
    }
  } else {
    messageModal("ERROR", "No hay coincidencias. Revise sus credenciales.", "", "danger");
  }
}
?>
<link rel="stylesheet" href="plugin/css/login.css">
<!-- Main Content -->
<div class="main-bg" style="background: linear-gradient(rgba(128, 64, 0, 0.33), rgba(0, 0, 0, 0.66)),url(img/bg.jpg) no-repeat center;
background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;background-size: cover;-ms-background-size: cover;min-height: 100vh;">
  <!-- title -->
  <h1>Comercializadora de Padilla<br>[Facturas]</h1>
  <!-- //title -->
  <div class="sub-main">
    <div class="image-style" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(128, 64, 0, 0.25)),url(img/logo.jpg) no-repeat center;
    background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;background-size: cover;-ms-background-size: cover;min-height: 370px;">
    </div>
    <!-- vertical tabs -->
    <div class="vertical-tab">
      <div id="section1" class="section">
        <input type="radio" name="sections" id="option1" checked />
        <label for="option1" class="icon-left"><span class="icon fas fa-user-circle" aria-hidden="true"></span>INICIAR SESIÓN</label>
        <article>
          <form action="" method="POST">
            <h3 class="legend">INGRESE AQUÍ</h3>
            <div class="input">
              <span class="fas fa-envelope" aria-hidden="true"></span>
              <input type="email" placeholder="Correo electrónico" name="email" required />
            </div>
            <div class="input">
              <span class="fas fa-key" aria-hidden="true"></span>
              <input type="password" placeholder="Contraseña" name="password" required />
            </div>
            <input type="submit" class="btn submit" name="btn-login" value="INGRESAR" />
          </form>
        </article>
      </div>
      <div id="section3" class="section">
        <input type="radio" name="sections" id="option3" />
        <label for="option3" class="icon-left"><span class="icon fas fa-lock" aria-hidden="true"></span>¿OLVIDÓ SU CONTRASEÑA?</label>
        <article>
          <form action="" method="POST">
            <h3 class="legend last">RECUPERAR CONTRASEÑA</h3>
            <p class="para-style">Ingrese el correo de la cuenta para recibir un nuevo acceso con una contraseña provicional. (Revise también la carpeta de spam.)</p>
            <p class="para-style-2"><strong>¿Necesita ayuda?</strong> Considere <a href="#">contactar a su administrador.</a></p>
            <div class="input">
              <span class="fas fa-envelope" aria-hidden="true"></span>
              <input type="email" placeholder="Correo electrónico" name="forget-email" required />
            </div>
            <input type="submit" class="btn submit" name="btn-forget" value="RECUPERAR" />
          </form>
        </article>
      </div>
      <div id="section2" class="section">
        <a href="./"><label for="option2" class="icon-left"><span class="fas fa-chevron-circle-left" aria-hidden="true"></span><span class="fas fa-file-invoice-dollar" aria-hidden="true"></span>RECAUDOS</label></a>
        <!--input type="radio" name="sections" id="option2" />
        <article>
          <form action="#" method="post">
            <h3 class="legend">REGISTRESE AQUÍ</h3>
            <p class="para-style">Ingrese los datos para enviar una solicitud de creación de la cuenta.</p>
            <p class="para-style-2"><strong>¿Necesita ayuda?</strong> Considere <a href="#">contactar a su administrador.</a></p>
            <div class="input">
              <span class="fas fa-id-card" aria-hidden="true"></span>
              <input type="text" placeholder="Número de identificación" name="name" required />
            </div>
            <div class="input">
              <span class="fas fa-user" aria-hidden="true"></span>
              <input type="text" placeholder="Nombre completo" name="name" required />
            </div>
            <div class="input">
              <span class="fas fa-envelope" aria-hidden="true"></span>
              <input type="text" placeholder="Correo electrónico" name="name" required />
            </div>
            <input type="submit" class="btn submit" name="btn-register" value="SOLICITAR" />
          </form>
        </article-->
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
?>