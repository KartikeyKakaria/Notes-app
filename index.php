<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Magic notes</title>
    <style>
        h1,
        h3 {
            text-align: center;
        }
        
        .img-thumbnail{
            display: inline-block;
            border:20px solid black;
            border-radius:40px;
            width:80%;
        }
        .container{
            justify-content:center;
            text-align:center;
            align-items:center;
        }
        hr{
           height:3px;
        background-color:grey;
        }
        footer {
            width: 100%;
            background-color: black;
            /*set back color of footer*/
            padding: 30px 0;
            margin-top: 60px;
        }
        
        footer ul {
            float: left;
            width: 48%;
            margin: 1%;
        }
        
        footer ul h4 {
            font-size: 45px;
            color: beige;
        }
        
        footer ul li {
            list-style-type: none;
            font-size: 25px;
            color: beige;
            /*set color of text of footer*/
        }
    </style>
</head>

<body>
    <?php session_start(); include 'partials/_nav.php';?>
    <div class="container">
        <h1>Welcome to Magic Notes - notes taking made easy!</h1>
    </div>
    <div class="container create">
    <img src="create.PNG" alt="create" class="my-3 mx-2 img-thumbnail">
    <h3>Create Notes</h3>
    </div>
    <hr>
    <div class="container edit">
    <img src="edit.PNG" alt="edit" class="my-3 mx-2 img-thumbnail">
    <h3>Edit Notes</h3>
    </div>
    <hr>
    <div class="container delete">
    <img src="delete.PNG" alt="edit" class="my-3 mx-2 img-thumbnail">
    <h3>Delete Notes</h3>
    </div>
    <hr>
    <div class="container my-5 personal">
    <img src="personal.PNG" alt="edit" class="my-3 mx-2 img-thumbnail">
    <h3>Have your personalized Notes</h3>
    </div>

    <div class="container my-5">
    <h4>Want to access all these cool features? <a href="signup.php">Signup</a> to our website. Its completely free!</h5>
    <small>Already have an account? <a href="login.php">login</a></small>

    </div>
    <footer>
        <div class="wrapper">
            <ul>
                <h4>Info</h4>
                <hr>
                <li>MagicNotes-Amritsar,India</li>
                <li>Address:- XYZ Mall, floor 14</li>
                <li>Contact no.-1234567890</li>
            </ul>
            <!--Add your favourite video here-->
            <img src="create.png" alt="footer" height="315" width=560>
        </div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>