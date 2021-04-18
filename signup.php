<?php
$creation = '';
$errors = array(
    "creation" => false,
    "password" => false,
    "username" => false,
);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'partials/_dbconnect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $DOB = $_POST['DOB'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $exists = false;
    //check if this username exists
    $existsql = "SELECT *FROM `list` where `username` = '$username'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        $exists = true;
    }
    else{
        $exists = false;
    }
    if(!$exists){
        if($password == $passwordConf){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `list` (`sno.`, `username`, `email`, `gender`, `DOB`, `password`, `date`) VALUES ('', '$username', '$email', '$gender', '$DOB', '$hash',current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $creation = true;
                $sql = 'CREATE TABLE `notes`.'.$username.'( `sno.` INT(11) NOT NULL AUTO_INCREMENT ,  `title` VARCHAR(50) NOT NULL ,  `description` TEXT NOT NULL ,  `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`sno.`))';
                $result = mysqli_query($conn, $sql);
            }
            else{
                $errors['creation'] = true;
            }
        }
        else{
             $errors['password'] = true;
        }
    }
    else{
        $errors['username'] = true;
    }
    
}
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>Signup</title>
    </head>

    <body>
        <?php require 'partials/_nav.php'; ?>
        <?php
            if($creation){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your account was created successfully
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>';
            }
            if($errors['creation']){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> We could not create your account due to some thechnical issues. We regret for the icnonvenience caused.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>';
            }
            if($errors['password']){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Passwords do not match
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>';
            }
            if($errors['username']){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> This username already exists. Please enter a different username.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>';
            }
        ?>
        </div>
        <div class="container my-3">
            <form action="/notes.com/signup.php" method="post">
                <h1 class="text-center">SignUp to our website</h1>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input maxlength="11" type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" class="custom-select mr-sm-2" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    <option value="needless">Need Not say</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="DOB">Date of Birth</label>
                    <input name="DOB" type="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input maxlength="30" minlength="3" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="passwordConf">Confirm Password</label>
                    <input maxlength="30" name="passwordConf" type="password" class="form-control" id="passwordConf" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>