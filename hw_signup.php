<?php
$error=array();

if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['cellulare'])&&isset($_POST['email'])){
    $conn=mysqli_connect('localhost','root','','login');
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/',$_POST['username'])){
        $error[]="username non valido";
    }  
    else {
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $query="SELECT username FROM utente WHERE username='$username'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0)
        $error[]="username gia esistente";
    }
    if(strlen($_POST['password'])<8){
        $error[]="caratteri non sufficienti";
    }
    if(!preg_match('/^[0-9]{10,10}$/',$_POST['cellulare'])){
        $error[]="cellulare non valido";
    }
    if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        $error[]="email non valida";
    }         
    if(count($error)==0){
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $password = password_hash($password,PASSWORD_BCRYPT);
        $email=mysqli_real_escape_string($conn,$_POST["email"]);
        $cellulare=mysqli_real_escape_string($conn,$_POST["cellulare"]);
        $query="INSERT INTO utente(username,password,email,cellulare) VALUES('$username','$password','$email','$cellulare')";
        if(mysqli_query($conn,$query))
        {
            session_Start();
            $_SESSION['username']=$_POST['username'];
            $_SESSION['user_id']=mysqli_insert_id($conn);
            header('Location:hw_logged.php');
            mysqli_close($conn);
            exit;
        }
    }
    

}
?>
<html >
<head>
<title>Registrazione Ricetta UNICT</title>
    <metacharset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/Signup.css">
    <script src="./scripts/signup.js" defer="true"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Oswald:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<header>
<h1  id="titolo">
        <em>REGISTRAZIONE</em><br/>
      </h1>
</header>
<body>
          <section class="nuova_vista">
              <main>
          <form method='post'>Registrati
              <div><br></div>
                <div class='username'><label>Username <input type='text' name='username' ></label><span class='errorj'><br></span></div>
                <div class='password'><label>Password <input type='password' name='password'></label><span class='errorj'><br></span></div>
                <div class='cellulare'><label>Cellulare <input type='text' name='cellulare'></label><span class='errorj'><br></span></div>
                <div class='email'><label>E-mail <input type='text' name='email'></label><span class='errorj'><br></span></div>
                    <label>&nbsp;<input type='submit' id="submit" value="Invia" disabled></label>
                    <div class="Login">Hai un account? <a href="hw_login.php">Accedi</a>
          </form>
          </main>
    </section>
</body>
</html>