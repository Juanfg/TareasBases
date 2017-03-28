<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Professors Management</title>
    <script src="https://use.fontawesome.com/54d2184b0c.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php
                require_once '../models/Teacher.php';
                require_once '../models/User.php';
                session_start();
                if (isset($_SESSION['id_admin'])) {
                    $user_id = $_SESSION['id_admin'];
                }
                else {
                    header('Location: logout.php');
                }
                $db = new Database;

                $Teacher= new Teacher($db);
                $teachers = $Teacher->get();

                $User= new User($db);
                $users = $User->get();
            ?>
            <h3 class="text-center text-info">These are the teachers</h3>
            <h3 class="text-center text-info">What do you want to do?</h3>
            <br>
            <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Last Name</th> 
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach($teachers as $teacher){
                $id;
                $username;
                $password;
                foreach($users as $user){
                    if(strcmp($teacher->user, $user->id) == 0){
                        $id = $user->id;
                        $username = $user->username;
                        $password = $user->password;
                    }
                }
                echo '<tr>
                    <td>'.$teacher->name.'</td>
                    <td>'.$teacher->last_name.'</td> 
                    <td>'.$username.'</td>
                    <td>'.$password.'</td>
                    <td width="15%">
                        <div class="col-xs-1">
							<form action="edit_teacher.php" method="POST">
								<input type="hidden" name="id_user" value='.$id.'>
                                <input type="hidden" name="id_teacher" value='.$teacher->id.'>
								<button class="btn btn-primary"><i class="fa fa-pencil"></i></button>
							</form>
						</div>
                        <div class="col-xs-1 col-xs-offset-1">
                            <form action="destroy_teacher.php" method="POST">
                                <input type="hidden" name="id" value='.$id.'>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>';
            }
            ?>
            </table>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="add_teacher.php">Add New Teacher</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-danger btn-block btn-md" href="admin.php">Back to Management</a>
            </div>
        </div>
    </div>
</body>
</html>