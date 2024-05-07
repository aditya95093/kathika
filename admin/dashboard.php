<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">
		<title>Kathika Admin Dashboard</title>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<link rel="stylesheet" href="css/fileinput.min.css">
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<?php include ('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include ('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Dashboard</h2>
						</div>
					</div>
				</div>
			</div>

			
			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap-select.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/dataTables.bootstrap.min.js"></script>
			<script src="js/Chart.min.js"></script>
			<script src="js/fileinput.js"></script>
			<script src="js/chartData.js"></script>
			<script src="js/main.js"></script>

		<!--	<script>

				window.onload = function () {
					var ctx = document.getElementById("dashReport").getContext("2d");
					window.myLine = new Chart(ctx).Line(swirlData, {
						responsive: true,
						scaleShowVerticalLines: false,
						scaleBeginAtZero: true,
						multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
					});

					
					var doctx = document.getElementById("chart-area3").getContext("2d");
					window.myDoughnut = new Chart(doctx).Pie(doughnutData, { responsive: true });

					
					var doctx = document.getElementById("chart-area4").getContext("2d");
					window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, { responsive: true });

				}
			</script> !-->
	</body>

	</html>
<?php } ?>