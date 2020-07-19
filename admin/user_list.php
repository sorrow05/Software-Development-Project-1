<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){
	header('location:index.php');
}
else{
	if(isset($_REQUEST['hidden'])){
		$eid=intval($_GET['hidden']);
		$status="0";
		$sql = "UPDATE contactus SET Status=:status WHERE  id=:eid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
		$query -> execute();
		$msg="Booking Successfully Cancelled";
	}
	if(isset($_REQUEST['public'])){
		$aeid=intval($_GET['public']);
		$status=1;
		$sql = "UPDATE user_info SET Status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
		$query -> execute();
		$msg="Booking Successfully Confirmed";
	}
	if(isset($_REQUEST['del'])){
		$did=intval($_GET['del']);
		$sql = "DELETE FROM user_info WHERE  id=:did";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':did',$did, PDO::PARAM_STR);
		$query -> execute();
		$msg="Record deleted Successfully ";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>APNG Online Shop | Customer List  </title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		.succWrap{
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Customer List</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Customer Info</div>
							<div class="panel-body">
								<?php
								if($error){?>
									<div class="errorWrap">
										<strong>ERROR</strong>:<?php echo htmlentities($error); ?>
									</div><?php
								}
								else if($msg){?>
									<div class="succWrap">
										<strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
									</div><?php
								}?>
								<a href="download_records.php" style="color:red; font-size:16px;">Download Customer List</a>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Password</th>
											<th>Mobile Number</th>
											<th>Address1</th>
											<th>Address2</th>
											<th>action </th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Password</th>
											<th>Mobile Number</th>
											<th>Address1</th>
											<th>Address2</th>
											<th>action </th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$sql = "SELECT * from  user_info ";
										$query = $dbh -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0){
											foreach($results as $result){?>
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php echo htmlentities($result->first_name);?></td>
													<td><?php echo htmlentities($result->last_name);?></td>
													<td><?php echo htmlentities($result->email);?></td>
													<td><?php echo htmlentities($result->user_password);?></td>
													<td><?php echo htmlentities($result->mobile);?></td>
													<td><?php echo htmlentities($result->address1);?></td>
													<td><?php echo htmlentities($result->address2);?></td>
													<td>
														<a href="user_list.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to delete this record')"> Delete</a>
													</td>
												</tr>
												<?php $cnt=$cnt+1;
											}
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
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
</body>
</html>
<?php } ?>
