<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/notes.com">Magic Notes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/notes.com">Home <span class="sr-only">(current)</span></a>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>