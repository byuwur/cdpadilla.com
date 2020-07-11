<?php
function randomString() {
	$cadena = "";
	$opc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
	for ($i = 0; $i <= 16; $i++)
		$cadena .= substr($opc, rand(0, strlen($opc)), 1);
	return $cadena;
}
function messageModal(String $title, String $message, String $redirect, String $state) {
    echo '<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"><div class="modal-content">
      <div class="alert alert-' . $state . ' mb-0"><h4 id="infoModalLabel">' . $title . '</h4></div>
      <div class="alert alert-dark mb-0">' . $message . '</div>
      <div class="text-right m-2"><a href="' . $redirect . '" class="btn btn-raised btn-success">Entendido</a></div>
    </div></div></div><script type="application/javascript">$("#infoModal").modal("show");</script>';
}
?>