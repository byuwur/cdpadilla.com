<?php
session_start();
require("../_connect.php");
if (!empty($_SESSION['admin'])){
    $sql = $conn->query("SELECT IDUSUARIO, NOMBREUSUARIO, CORREOUSUARIO FROM cdp_usuarios WHERE IDUSUARIO='$_SESSION[admin]';");
    $count = mysqli_num_rows($sql);
    if ($count == 1) {
        $res = mysqli_fetch_assoc($sql);
        $_cedula = $res['IDUSUARIO'];
        $_nombre = $res['NOMBREUSUARIO'];
        $_correo = $res['CORREOUSUARIO'];
    } else {
        echo "<script>alert('El usuario no existe.');</script>";
        header("Location: ../logout.php?logout");
        echo '<script type="text/javascript"> window.location = ../logout.php?logout; </script>';
    }
} else {
    header("Location: ../logout.php?logout");
    echo '<script type="text/javascript"> window.location = ../logout.php?logout; </script>';
}
?>