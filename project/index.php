<?php

require_once('includes/session.php');
require_once('includes/headerFunctions.php');
?>

<!DOCTYPE html>
<html>

<head>

	<meta charset="UTF-8">

	<title>CryptoMania - Workshop - API</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

	<?php
	displayHeader();
	?>

	<image src="images/loading-cat.gif" id="preloader" class="d-block mx-auto my-5" height="800" width="800"
		alt="Loading...">

		<div class="container">
			<table class="table" id="coins-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Price USD</th>
						<th>Price Euro</th>
						<th>Market Cap</th>
						<th>%24Hr</th>
						<th>Add to Wallet</th>
					</tr>
				</thead>
				<tbody>
					<template id="template">
						{{#data}}
						<tr>
							<td><img src="https://static.coincap.io/assets/icons/{{symbolLowerCase}}@2x.png"
									class="crypto-icons" height="30" width="30">{{symbol}}</td>
							<td>{{id}}</td>
							<td>{{priceUsd}}</td>
							<td>{{priceEur}}</td>
							<td>{{marketCapUsd}}</td>
							<td>{{changePercent24Hr}}</td>
							<td>
								<button type="button" class="btn btn-primary btn-open-modal-cryptofolio"
									data-bs-toggle="modal" data-bs-target="#exampleModal" id="{{id}}">
									Add to wallet
								</button>
							</td>
						</tr>
						{{/data}}
					</template>
				</tbody>
			</table>
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div id="modal-content-cryptofolio">

					</div>

					<div class="modal-footer">
						<button type="button" id="closeModal" class="btn btn-secondary"
							data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<template id="cryptofolio-modal-template">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="coin-name">{{coinName}} ({{coinSymbol}})</span>
				</h5>
				<p id="coin-id" hidden>{{coinId}}</p>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h4>Price</h4>
				<p id="coin-price" hidden>{{coinPrice}}</p>
				<p>$ {{coinPrice}}</p>
				<div id="flex-row">
					<div class="row">
						<h4>Market Cap</h4>
						<p id="coin-market-cap">{{coinMarketCap}}</p>
					</div>
					<div class="row">
						<h4>Volume</h4>
						<p id="coin-volume">{{volumeUsd24Hr}}</p>
					</div>
					<div class="row">
						<h4>Supply</h4>
						<p id="coin-supply">{{maxSupply}}</p>
					</div>
				</div>

				<canvas id="coin-history-chart"></canvas>

				<?php
				if (isset($_SESSION['user'])) {
					?>
					Amount: <input type="number" id="amount-coins" min="1" value="1">
					<br />
					<br />
					<button type="button" class="btn btn-primary" id="js-add-coin-btn" data-bs-dismiss="modal">Add to
						cryptofolio</button>
					<?php
				}
				?>
			</div>
		</template>

		<?php
		displayFooter();
		?>

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

		<!-- Custom js  -->
		<script src="js/main.js"></script>
</body>

</html>