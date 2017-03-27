<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center text-info">Welcome to the Consulting Management System</h3>
            <h3 class="text-center text-info">Please Login</h3>
            <br>
            <div class="col-md-3">
                <form action="teacher_menu.php" method="post">
                    <?php
                        session_start();
                        if (isset($_SESSION['id_users'])) {
                            unset($_SESSION['id_users']);
                        }
                    ?>
                    <label for="Username">Username:</label>
                        <input type="text" name="username" class="form-control" >
                    <br>
                    <label for="Password">Password:</label>
                        <input type="password" name="password" class="form-control" >
                    <br>
                    <input class="btn btn-success btn-block btn-md" type="submit" value="Login"></input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>