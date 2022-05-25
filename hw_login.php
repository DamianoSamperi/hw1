<?php
session_start();
if(isset($_SESSION["username"]))
        {
            header('Location:hw_logged.php');
            exit;
        }
if(isset($_POST['username'])&& isset($_POST['password'])){
  $conn=mysqli_connect('localhost','root','','login');
  $username=mysqli_real_escape_string($conn,$_POST['username']);
  $password=mysqli_real_escape_string($conn,$_POST['password']);
  $query="SELECT * FROM utente WHERE username='$username'";
  $res=mysqli_query($conn,$query);
  if(mysqli_num_rows($res)>0)
  {
     $entry = mysqli_fetch_assoc($res);
     if (password_verify($_POST['password'],$entry['password'])){
        $_SESSION['username']=$_POST['username'];
        $_SESSION['user_id']=$entry['id'];
        header('Location:hw_logged.php');
        mysqli_close($conn);
        exit;
     }
  }
  $error = "Username e/o password errati.";
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Ricetta UNICT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/login.css">
    <script src="./scripts/login.js" defer="true"></script>
    <script src="./scripts/carica.js" defer="true"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Oswald:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">

  </head>
  <body>
    <header>
      <nav>
        <div id="links">
          <div>
        <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<span class='errorj'>$error</span>";
                }
                
            ?>
          <a class="button">Login</a>
          <form class="Hidden" method="post" >
            <input type="text" name="username" placeholder='username'>
            <input type="password" name="password" placeholder='Password'>
            <input type="submit" id="submit" value="Invia">
            <!-- <br><a id="Signup" href="hw_signup.php">Registrati</a> -->
            <div class="Signup">Non hai un account? <a href="hw_signup.php">Iscriviti</a>
          </form>
          </div>
        </div>
		<!-- <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div> -->
      </nav>

      <h1  id="titolo">
        <em>Ricette Unict</em><br/>
      </h1>

    </header>
    <section class="nuova_vista">
    </section>
    <footer>
        <div> Damiano Samperi 1000003371</div>
    </footer>
  </body>
</html>
