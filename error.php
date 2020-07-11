<!DOCTYPE html>
<?php
require("./_values.php");
if (isset($_GET['e'])) {
	$_e = $_GET['e'];
	$_sorry = "Lamentamos las molestias. ¿Qué desea hacer?";
	$_out = "Sácame de aquí";
	$_back = "Ir atrás";
	// ---  ERROR MESSAGES ---
	if ($_e == '404') {
		$_estringes = "no encontrado";
		$_estringen = "page not found";
		$_emessage = "Parece que no podemos encontrar el recurso que busca.";
	} else if ($_e == '403') {
		$_estringes = "acceso prohibido";
		$_estringen = "forbidden";
		$_emessage = "Usted no tiene permisos para acceder a este recurso.";
	} else if ($_e == '401') {
		$_estringes = "no autorizado";
		$_estringen = "unauthorized";
		$_emessage = "Es necesario autenticar para obtener una respuesta.";
	} else if ($_e == '400') {
		$_estringes = "solicitud incorrecta";
		$_estringen = "bad request";
		$_emessage = "El servidor no interpreta la solicitud por sintaxis inválida.";
	} else if ($_e == '500') {
		$_estringes = "interno del servidor";
		$_estringen = "internal error";
		$_emessage = "El servidor está en un estado que no puede manejar.";
	} else if ($_e == '502') {
		$_estringes = "entrada incorrecta";
		$_estringen = "bad gateway";
		$_emessage = "El servidor obtuvo una respuesta inválida.";
	} else if ($_e == '503') {
		$_estringes = "servicio no disponible";
		$_estringen = "service unavailable";
		$_emessage = "El servidor no esta listo para manejar la petición.";
	} else if ($_e == '504') {
		$_estringes = "tiempo de espera";
		$_estringen = "gateway timeout";
		$_emessage = "El servidor no puede obtener una respuesta a tiempo.";
	} else {
		$_estringes = "algo salió mal";
		$_estringen = "that's not right";
		$_emessage = "La petición no puede ser procesada en el servidor.";
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $_e; ?> - CDPadilla</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Un placer. Somos MNM." />
	<meta name="keywords" content="MNM, Team, MNM Team, MNM.team();" />
	<meta name="author" content="MNM" />
	<meta property="og:title" content="MNM.team();" />
	<meta property="og:image" content="img/icon.png" />
	<meta property="og:url" content="<?= $_mateusurl; ?>" />
	<meta property="og:site_name" content="MNM.team();" />
	<meta property="og:description" content="Un placer. Somos MNM." />
	<link rel="icon" type="image/png" href="img/icon.png" />
	<meta name="theme-color" content="#222" />
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet" />
	<link rel="stylesheet" href="./plugin/css/animate.mnm.min.css" />
	<link rel="stylesheet" href="./plugin/css/mnm.v1.dark.css" />
	<script type="text/javascript" src="./plugin/js/modernizr.min.js"></script>
	<style type="text/css">
		body {
			font-family: "Quicksand", Arial, sans-serif;
			background-color: #000;
			text-transform: uppercase;
			overflow: hidden;
		}

		svg {
			position: absolute;
			top: 50%;
			left: 50%;
			margin-top: -250px;
			margin-left: -400px;
		}

		.bg,
		.center {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			margin: 0 auto;
		}

		.message-box {
			position: absolute;
			height: 200px;
			width: 400px;
			left: 50%;
			margin-top: 10%;
			color: #FFF;
			font-weight: 400;
		}

		.message-box h1 {
			font-size: 72px;
			line-height: 48px;
		}

		.message-box h6 {
			font-size: 12px;
			line-height: 0;
		}

		.message-box p {
			font-size: 36px;
			line-height: 0;
			margin-bottom: 48px;
		}

		.buttons-con .action-link-wrap a {
			background: #066;
			color: #FFF;
			padding: 8px 24px;
			border-radius: 4px;
			font-weight: bold;
			font-size: 14px;
			transition: all 0.3s linear;
			cursor: pointer;
			text-decoration: none;
			margin-top: 24px;
			margin-right: 12px;
		}

		.buttons-con .action-link-wrap a:hover {
			background: #666;
		}

		#poly1,
		#poly2,
		#poly3,
		#poly4,
		#poly4,
		#poly5 {
			-webkit-animation: float 1s infinite ease-in-out alternate;
			animation: float 1s infinite ease-in-out alternate;
		}

		#poly2 {
			-webkit-animation-delay: 0.2s;
			animation-delay: 0.2s;
		}

		#poly3 {
			-webkit-animation-delay: 0.4s;
			animation-delay: 0.4s;
		}

		#poly4 {
			-webkit-animation-delay: 0.6s;
			animation-delay: 0.6s;
		}

		#poly5 {
			-webkit-animation-delay: 0.8s;
			animation-delay: 0.8s;
		}

		.img {
			margin-top: -10px;
			margin-bottom: -10px;
		}

		@media screen and (max-width: 767px) {

			svg,
			.message-box {
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				margin: 0 auto;
				margin-top: 64px;
				text-align: center;
			}
		}

		@-webkit-keyframes float {
			100% {
				-webkit-transform: translateY(25px);
				transform: translateY(25px);
			}
		}

		@keyframes float {
			100% {
				-webkit-transform: translateY(25px);
				transform: translateY(25px);
			}
		}
	</style>
</head>

<body>
	<div class="bg mnm-heading animate-box" data-animate-effect="fadeInUp" style="background-image:url(img/bg.jpg);background-size:cover;background-repeat:no-repeat;background-position:center;"></div>
	<div class="center">
		<svg width="380px" height="500px" class="heading animate-box" data-animate-effect="fadeInUp" viewBox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
			<g id="page1" stroke="none" stroke-width="5" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				<path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="poly1" stroke="#222" stroke-width="10" sketch:type="MSShapeGroup"></path>
				<path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="poly2" stroke="#444" stroke-width="10" sketch:type="MSShapeGroup"></path>
				<path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="poly3" stroke="#666" stroke-width="10" sketch:type="MSShapeGroup"></path>
				<path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="poly4" stroke="#444" stroke-width="10" sketch:type="MSShapeGroup"></path>
				<path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="poly5" stroke="#222" stroke-width="10" sketch:type="MSShapeGroup"></path>
			</g>
		</svg>
		<div class="message-box">
			<img src="./img/co.png" width="16px" height="12px" class="center animate-box" data-animate-effect="fadeInUp" alt="" /><br>
			<img src="./img/icon.png" width="180px" height="180px" class="img animate-box" data-animate-effect="fadeInUp" alt="logo" />
			<br><a href="<?= $_mateusurl; ?>">MATEUS [BYUWUR]</a><br>ERROR - <small><?= $_estringes; ?></small>
			<h1><?= $_e; ?></h1>
			<p><?= $_estringen; ?></p>
			<div class="buttons-con animate-box" data-animate-effect="fadeInUp">
				<h6><?= $_emessage; ?></h6>
				<h6><?= $_sorry; ?></h6>
				<div class="action-link-wrap">
					<a onclick="history.back(-1)" class="link-button link-back-button"><?= $_back; ?></a>
					<a href="./" class="link-button"><?= $_out; ?></a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./plugin/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="./plugin/js/waypoints.min.js"></script>
	<script type="text/javascript" src="./plugin/js/mnm.v1.js"></script>
</body>

</html>