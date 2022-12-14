<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
$aid=$_SESSION['id'];
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
	
	<title>Financial DashBoard</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">


</head>

<body><br><br><br>
<?php include("includes/header.php");?>

	<div class="ts-main-content">
		<?php include("includes/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
<?php	
$aid=$_SESSION['id'];
$ret="select * from admin where id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>

  
<center><h2 class="page-title" style="margin-top:4%">Welcome <td><?php echo $row->username;?></h2></center>
					
</tr>
									<?php
$cnt=$cnt+1;
									 } ?>

						
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">

<?php
$result ="SELECT sum(fees) FROM cincome where id=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$aid);
$stmt->execute();
$stmt->bind_result($sum);
$stmt->fetch();
$stmt->close();
?>

													<div class="stat-panel-number h1 ">K<?php echo $sum;?></div>
													<div class="stat-panel-title text-uppercase">Total income</div>
												</div>
											</div>
											<a href="cincome.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">

<?php
$aid=$_SESSION['id'];
$result ="SELECT sum(price) FROM expenses where id=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$aid);
$stmt->execute();
$stmt->bind_result($sum);
$stmt->fetch();
$stmt->close();
?>

													<div class="stat-panel-number h1 ">K<?php echo $sum;?></div>
													<div class="stat-panel-title text-uppercase">Total Expenses</div>
												</div>
											</div>
											<a href="Current_expenses.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">

												




												
<?php
$aid=$_SESSION['id'];
$result ="SELECT sum(fees) FROM cincome where id=? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$aid);
$stmt->execute();
$stmt->bind_result($su);
$stmt->fetch();
$stmt->close();

$aid=$_SESSION['id'];
$result ="SELECT sum(price) FROM expenses where id=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$aid);
$stmt->execute();
$stmt->bind_result($sum);
$stmt->fetch();
$stmt->close();
?>

													<div class="stat-panel-number h1 ">K<?php echo $su-$sum;?></div>
													<div class="stat-panel-title text-uppercase">Current Balance </div>
												</div>
											</div>
											<a href="" class="block-anchor panel-footer text-center"> &nbsp; </a>
										</div>
										
									</div>
									
									<div class="col-md-4">
										
													
								</div>
							</div>
						</div>

					
						
						

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}

	</script>

</body>

</html>