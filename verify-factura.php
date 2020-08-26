<?php
session_start();
require("./_connect.php");
if (isset($_POST['verif-prefijo']) && isset($_POST['verif-factura'])) {
    $id = trim($_POST['verif-prefijo'] . $_POST['verif-factura']);
    $id = strip_tags($id);
    $id = htmlspecialchars($id);
    $sql = $conn->query("SELECT * FROM cdp_facturas WHERE IDFACTURA='$id';");
    $count = mysqli_num_rows($sql);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($sql);
        $rowPago = mysqli_fetch_assoc($conn->query("SELECT * FROM cdp_pagos WHERE cdp_facturas_IDFACTURA='$id';"));
        if ($rowPago['ESTADOPAGO']) {
            $response[] = array(
                "error" => true,
                "status" => "alert-warning",
                "message" => "<strong>La factura \"$id\" existe.</strong><hr><p>Estado del pago: <strong>PAGO</strong></p><hr><p><strong>NO</strong> ES NECESARIO REALIZAR RECAUDO.<br><br>Valor: <strong>\$$row[VALORFACTURA]</strong> (Pagado)<br>Concepto: <strong>$row[CONCEPTOFACTURA]</strong></p>"
            );
        } else {
            $response[] = array(
                "error" => false,
                "status" => "alert-success",
                "message" => "<strong>La factura \"" . $id . "\" SÍ existe.</strong><hr><p>Estado del pago: <strong>PEDIENTE</strong></p><hr><p>Valor: <strong>\$$row[VALORFACTURA]</strong><br>Concepto: <strong>$row[CONCEPTOFACTURA]</strong><br>Vendido a: <strong>$row[NOMBREFACTURA]</strong><br>Vendido el: <strong>$row[FECHAFACTURA]</strong></p>",
                "pago" => $rowPago["ESTADOPAGO"],
                "factura" => $row["IDFACTURA"],
                "concepto" => $row["CONCEPTOFACTURA"],
                "descripcion" => "Pago de la factura '$row[IDFACTURA]'",
                "valor" => $row["VALORFACTURA"]
            );
        }
        //$estadoPago = $rowPago['ESTADOPAGO'];
    } else {
        $response[] = array(
            "error" => true,
            "status" => "alert-danger",
            "message" => "<strong>La factura \"$id\" NO existe.</strong><hr><p>Por favor, verifique el número de venta y su prefijo...</p>"
        );
    }
} else if ($_POST['verif-factura'] == "" || $_POST['verif-factura'] == null) {
    $response[] = array(
        "error" => true,
        "status" => "alert-danger",
        "message" => "<strong>No se ha ingresado ninguna factura.</strong><hr><p>Por favor, ingrese un número de factura de venta...</p>"
    );
}
echo json_encode($response);
