<!DOCTYPE html>
<html>

<head>

	<meta charset="UTF-8">

	<title>CryptoMania - Workshop - API</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

	<div class="container">
		<table class="table" id="lorem-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Body</th>
				</tr>
			</thead>
			<tbody>
				<template id="template">
					{{#data}}
					<tr>
						<td>{{id}}</td>
						<td>{{title}}</td>
						<td>{{body}}</td>
					</tr>
					{{/data}}
				</template>
			</tbody>
		</table>
	</div>
	<canvas id="coin-history-chart"></canvas>

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