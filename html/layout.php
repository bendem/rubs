<!DOCTYPE html>
<html lang="fr" id="top">
	<head>
		<meta charset="utf-8">
		<title>Cube testing</title>
		<link rel="stylesheet" href="css/bs.css">
		<link rel="stylesheet" href="css/styles.css">
		<script src="js/jq.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<div class="filters">
			<h2><a href="#top">Filters</a></h2>
			<ul>
				<li><a href="#all">All</a></li>
				<li><a href="#debug">Debug</a></li>
				<li><a href="#info">Info</a></li>
				<li><a href="#warning">Warning</a></li>
				<li><a href="#error">Error</a></li>
			</ul>
			<ul class="pull-right">
				<li><a href="logs">Logs</a></li>
			</ul>
			<div class="close">x</div>
		</div>
		<div class="logs">

			<?php Rubs\Core\Logger::display() ?>

		</div>
		<div class="content">

			<?= $content ?>

		</div>
	</body>
</html>
