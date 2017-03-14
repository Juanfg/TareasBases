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
            <h3 class="text-center text-info">Select your teacher</h3>
            <div class="col-md-12">
                <form action="teacher_schedule.php" method="post">
                    <select name="id_teacher" class="form-control">
                        <?php
                            require_once '../models/Teacher.php';
                            $db = new Database;
                            $Teacher = new Teacher($db);
                            $teachers = $Teacher->get();
                            foreach ($teachers as $teacher) {
                                echo '<option value="' . $teacher->id . '">' . $teacher->name . ' ' . $teacher->last_name . '</option>';
                            }
                        ?>
                    </select>
                    &nbsp
                    <input class="btn btn-success btn-block btn-md" type="submit" value="Seleccionar"></input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
