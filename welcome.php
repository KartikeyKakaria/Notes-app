<?php
session_start();
include 'partials/_dbconnect.php';
if(isset($_SESSION['username'])){
    $table = $_SESSION['username'];
    $insert = false;
$insertErr = false;
$update = false;
$updateErr = false;
$delete = false;
$deleteErr = false;
$err = '';
if($conn){
    if(isset($_GET['delete'])){
        $sno = $_GET['delete'];
        // echo $sno;
        $sql = "DELETE FROM `$table` WHERE `$table`.`sno.` = $sno";
        $result = mysqli_query($conn, $sql);
        if($result){
            $delete = true;
        }
        else{
            $deleteErr = true;
        }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['snoEdit'])){
            // echo "yes";
            // exit();
            //Update record
            $sno = $_POST['snoEdit'];
            $title = $_POST['titleEdit'];
            $description = $_POST['descriptionEdit'];
            $sql = "UPDATE `$table` SET `title` = '$title', `description` = '$description' WHERE `$table`.`sno.` = $sno";
            $result = mysqli_query($conn, $sql);
            if($result){
                $update = true;
            }
            else{
                $updateErr = true;
                $err = mysqli_error($conn);
            }
        }
        else{

            $title = $_POST['title'];
            $desc = $_POST['description'];
            $sql = "INSERT INTO `$table`(`sno.`, `title`, `description`, `time`) VALUES ('', '$title', '$desc', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $insert = true;
            }
            else{
                $insertErr = true;
                echo mysqli_error($conn);
            }
        }
    }

}
else{
    die('sorry we failed to connect');
}
}
else{
    header("location: login.php");
}
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

        <title>Welcome <?php echo $_SESSION['username']?></title>
    </head>

    <body>
        <!--Edit modal-->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="editModalLabel">Edit Note</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="welcome.php?update=true" method="POST">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            <div class="mb-3">
                                <label for="title" class="form-label">Note title</label>
                                <input class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">

                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Note description</label>
                                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--Navigation bar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/notes.com/">Magic Notes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/notes.com/">Home</a>
                        </li>
                        <?php
        if(isset($_SESSION['username'])){
          echo '<li class="nav-item">
          <a href="/notes.com/welcome.php" class="nav-link">MyNotes</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/notes.com/logout.php">Logout</a>
      </li>';
        }
        else{
          echo '<li class="nav-item">
          <a class="nav-link" href="/notes.com/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/notes.com/signup.php">SignUp</a>
        </li>';
        }
      ?>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <?php
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note was added successfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($insertErr){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> We could not add your not due to some technical issues. We regret for the inconvenience caused.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note was updated successfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($updateErr){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> We could not update your not due to some technical issues. We regret for the inconvenience caused. 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note was deleted successfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($deleteErr){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> We could not delete your not due to some technical issues. We regret for the inconvenience caused. 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
            <div class="container my-4">
                <form action="welcome.php" method="POST">
                    <div class="mb-3">
                    <h1>Welcome <?php echo $_SESSION['username']?></h1>                       <label for="title" class="form-label">Note title</label>
                        <input class="form-control" id="title" name="title" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Note description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Create Note</button>
                </form>
            </div>
            <hr>
            <div class="container">
                <table id="notes" class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
        $sql = "SELECT * FROM `$table`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        $row = '';
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $sno++;
                    echo "<tr>
                    <th scope='row'>$sno</th>
                    <td>".$row['title']."</td>
                    <td>".$row['description']."</td>
                    <td><button id='d".$row['sno.']."' class='delete btn btn-danger'>Delete</button> 
                    <button id=".$row['sno.']." type='button' class='edit btn btn-primary'>Edit</button></td>
                  </tr>";
                }
            }
        
        ?>
                    </tbody>
                </table>

            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#notes').DataTable();
                });
            </script>
            <script>
                const edits = document.getElementsByClassName('edit');
                Array.from(edits).forEach((element, index) => {
                    element.addEventListener('click', e => {
                        let tr = e.target.parentNode.parentNode;
                        let title = tr.getElementsByTagName('td')[0].innerText;
                        let desc = tr.getElementsByTagName('td')[1].innerText;
                        const titleEdit = document.getElementById('titleEdit');
                        const descriptionEdit = document.getElementById('descriptionEdit');
                        let snoEdit = document.getElementById('snoEdit');
                        titleEdit.value = title;
                        descriptionEdit.value = desc;
                        snoEdit.value = e.target.id;
                        console.log('edit', title, desc, e.target.id);
                        $('#editModal').modal('toggle')
                    })
                })
                const deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element, index) => {
                    element.addEventListener('click', e => {
                        let tr = e.target.parentNode.parentNode;
                        let title = tr.getElementsByTagName('td')[0].innerText;
                        let desc = tr.getElementsByTagName('td')[1].innerText;
                        let deleteWant = confirm('Are you sure you want to delete this note');
                        sno = e.target.id.substr(1, );
                        if (deleteWant) {
                            window.location = "/notes.com/welcome.php?delete=" + sno;
                        }

                    })
                })
            </script>

    </body>

    </html>