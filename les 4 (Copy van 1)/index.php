<!DOCTYPE html>
<html>

<head>

	<meta charset="UTF-8">

	<title>CryptoMania - Workshop - API</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

	<div class="container">
		<table class="table" id="coins-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>symbol</th>
					<th>Price USD</th>
					<th>More info</th>
				</tr>
			</thead>
			<tbody>
				<template id="template">
					{{#data}}
						<tr>
							<td><img src="https://static.coincap.io/assets/icons/{{symbolLowerCase}}@2x.png" class="crypto-icons" height="30" width="30">{{symbol}}</td>
							<td>{{id}}</td>
							<td>{{priceUsd}}</td>
							<td><button type="button" class="btn btn-primary coin-info-btn" data-bs-toggle="modal"
									data-bs-target="#exampleModal" id="{{id}}">
									More info
								</button></td>
						</tr>
					{{/data}}
				</template>
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Something Went Wrong</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					ERROR: 404 Not Found
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<!-- Mustache -->
	<script src="https://unpkg.com/mustache@latest/mustache.min.js"></script>

	<!-- Custom js  -->
	<script src="js/main.js"></script>
</body>

</html>