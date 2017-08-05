<?php include('Includes/database.php') ?>
<?php include('Includes/functions.php') ?>
<?php session_start(); ?>
<?php

	if(isset($_POST['submit'])) {
		if (empty($_POST['room_no']) && empty($_POST['room_name']) && empty($_POST['room_level'])){
			$_SESSION['error'] = "All Fields Is Required";
		}else if (empty($_POST['room_no'])) {
			$_SESSION['error'] = "Room No Is Required";
		}else if (empty($_POST['room_name'])) {
			$_SESSION['error'] = "Room Name Is Required";
		}else if (empty($_POST['room_level'])) {
			$_SESSION['error'] = "Room Level Is Required";
		}else {
			$room_no = mysqli_real_escape_string($con,$_POST['room_no']);
			$room_name = mysqli_real_escape_string($con,$_POST['room_name']);
			$room_level = mysqli_real_escape_string($con,$_POST['room_level']);
			$dateTime = getDateTime();

			$sql = "INSERT INTO room (room_number,room_name,floor_level,date_added) VALUES('$room_no','$room_name','$room_level','$dateTime')";

			$exec = mysqli_query($con,$sql);
			if ($exec) {
				$_SESSION['success'] = "Room Added Successfully";
			}else {
				$_SESSION['error'] = "Opps.. Something Went Wrong please try again";
				printf(mysqli_error($con));
			}

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Classroom Management System</title>
	<link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
</head>
<body>
<div class="header">
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="" class="navbar-brand">Classroom CMS</a>
			</div>
		</div>
	</div>
</div>
<div>
	<nav class="navi">
		<div class="container">
			<div class="row">
				<ul class="nav-btn">
					<a href="dashboard.php"><li>Dashboard</li></a>
					<a href="room.php"><li>Classrooms</li></a>
					<a href="set_schedule.php"><li>Set Schedule</li></a>
					<a href="schedule.php"><li>Schedule</li></a>
					<a href="account.php"><li>Accounts</li></a>
				</ul>
				<div style="float: right;font-weight: bolder;font-size: 22px;color: silver;padding: 4px;margin-top: -2.8px;">
					-- New Classroom --
				</div>
			</div>
		</div>
	</nav>
</div>
<div class="container">
<div class="row">
	<div class="col-md-2 room-side-nav">
		<nav class="">
			<ul>
				<li><a href="room.php">Classrooms</a></li>
				<li><a href="new_classroom.php">New Classroom</a></li>
			</ul>
		</nav>
	</div>
	<div class="col-md-10 room-main">
		<div id="room-main" style="padding-top: 10px;">
			<div class="col-md-8 ">
				<div class="new-room-form-header">
					-- Register New Classroom --
				</div>
				<?php echo errorMessage(); ?>
				<?php echo successMessage(); ?>
				<form method="POST" action="new_classroom.php">
					<div class="form-group">
						<label for="room_no">Room No *</label>
						<input type="text" name="room_no" class="form-control">
					</div>
					<div class="form-group">
						<label for="room_name">Room name *</label>
						<input type="text" name="room_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="room_level">Floor Level *</label>
						<input type="text" name="room_level" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Register Room" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</div>
</body>
</html>