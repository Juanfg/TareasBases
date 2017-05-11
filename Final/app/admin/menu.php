<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Professor-Student</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php
                session_start();
                if (isset($_SESSION['admin_id'])) {
                    $user_id = $_SESSION['admin_id'];
                }
                else {
                    header('Location: ../logout.php');
                }
            ?>
            <h3 class="text-center text-info">Welcome admin </h3>
            <h3 class="text-center text-info">What do you want to do?</h3>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="manage_student.php">Manage Students</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="manage_teacher.php">Manage Teacher</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-danger btn-block btn-md" href="../logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>