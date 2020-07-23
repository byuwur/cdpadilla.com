<?php
require("../_connect.php");
require("./_variables.php");
require("../_functions.php");
require("../_values.php");
?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Material Design for Bootstrap fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <!-- Material Design for Bootstrap CSS -->
  <link rel="stylesheet" href="../plugin/bootstrap-material/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="../plugin/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../plugin/css/main.css">
  <title>Comercializadora de Padilla - Espinal</title>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="../plugin/js/jquery-3.5.1.min.js"></script>
  <script src="../plugin/js/popper.js"></script>
  <script src="../plugin/bootstrap-material/js/bootstrap-material-design.js"></script>
  <!--script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script-->
</head>

<body>
<!-- Top Nav -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <a href="./" class="navbar-brand"><img src="../img/logo.jpg" width="32px" height="32px" /><strong class="navbar-toggler">CDPADILLA</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="topNavbar">
      <ul class="navbar-nav mr-auto mt-1">
        <li class="nav-item"><a class="btn btn-dark" href="./"><i class="fas fa-home"></i>Inicio</a></li>
        <li class="nav-item"><a class="btn btn-dark" href="bill.php"><i class="fas fa-file-invoice-dollar"></i>Facturas</a></li>
        <li class="nav-item"><a class="btn btn-dark" href="payment.php"><i class="fas fa-clipboard-check"></i>Pagos</a></li>
        <li class="nav-item"><a class="btn btn-dark" href="admin.php"><i class="fas fa-id-card-alt"></i>Administradores</a></li>
        <!--li class="nav-item dropdown">
          <a class="btn btn-dark dropdown-toggle" href="javascript:;" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-address-card"></i>X</a>
          <div class="dropdown-menu" aria-labelledby="user-menu">
            <a class="dropdown-item alert-dark" href="X"><i class="fas fa-bookmark"></i>X</a>
          </div>
        </li-->
      </ul>
      <ul class="navbar-nav mt-1 text-right">
        <li class="nav-item dropdown">
          <a class="btn btn-dark dropdown-toggle" href="javascript:;" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i><?= $_nombre; ?></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-menu">
            <a class="dropdown-item alert-secondary" href="adminedit.php?user=<?= $_cedula ?>"><i class="fas fa-edit"></i>Editar perfil</a>
            <a class="dropdown-item alert-danger" href="../logout.php?logout"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Top Nav -->
  <!-- Bottom Nav -->
  <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark text-white m-0">
    <li class="navbar-nav nav-item dropup mr-auto">
      <a class="btn btn-light nav-link dropdown-toggle" href="javascript:;" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
      <!--div class="dropdown-menu" aria-labelledby="dropdown10">
        <form action="" method="POST">
          <button id="change-periodo" name="change-periodo" class="dropdown-item" value="X" type="submit">X</button>
        </form>
      </div-->
    </li>
    <small class="text-right">
        &copy;<?= date("Y"); ?> <a href="<?= $_mateusurl; ?>" style="color:#AAA">Mateus [byUwUr]</a>
        &middot; <a href="../privacy_policy" style="color:#AAA">Política de Privacidad</a>
        &middot; Para <?= $_nombreempresa; ?>
    </small>
  </nav>
  <!-- Bottom Nav -->
  <!-- Content Here -->
  <div class="main">