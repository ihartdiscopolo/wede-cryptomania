<?php
require_once('includes/session.php');
require_once('includes/headerFunctions.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>CryptoMania - Exchanges</title>

	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

	<?php displayHeader(); ?>

	<!-- Preloader (same style as index.php) -->
	<img src="images/loading-cat.gif" id="preloader" class="d-block mx-auto my-5" height="800" width="800"
		alt="Loading...">

	<div class="container">

		<!-- Table -->
		<table id="exchanges-table" class="table table-hover">
			<thead>
				<tr>
					<th>Rank</th>
					<th>Name</th>
					<th>Volume USD</th>
					<th>URL</th>
				</tr>
			</thead>

			<tbody>
				<template id="exchanges-template">
					{{#data}}
					<tr>
						<td>{{rank}}</td>
						<td>{{name}}</td>
						<td>{{volumeUsd}}</td>
						<td>
							<a href="{{exchangeUrl}}" target="_blank" class="btn btn-primary btn-sm">
								Visit
							</a>
						</td>
					</tr>
					{{/data}}
				</template>
			</tbody>
		</table>

	</div>

	<?php displayFooter(); ?>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"
		integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>

	<!-- Mustache -->
	<script src="https://unpkg.com/mustache@latest/mustache.min.js"></script>

	<!-- Chart JS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<!-- Custom JS -->
	<script src="js/exchanges.js"></script>

</body>

</html>