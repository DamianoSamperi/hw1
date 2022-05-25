<html>
    <?php
    session_start();
    $conn=mysqli_connect('localhost','root','','login');
    $username =mysqli_real_escape_string($conn,$_SESSION['username']);
    $query= "SELECT * FROM utente WHERE username='$username'";
    $res_1=mysqli_query($conn,$query);
    $userinfo=mysqli_fetch_assoc($res_1);
    if(!isset($_SESSION['username'])){
      header("Location: hw_login.php");
    }
    if (isset($_FILES['img'])&&is_uploaded_file($_FILES['img']['tmp_name'])) {
        $file = $_FILES['img'];
        $type = exif_imagetype($file['tmp_name']);
        $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg');
        if (isset($allowedExt[$type])) {
          if ($file['size'] < 7000000) {
            $fileNameNew = uniqid('', true).".".$allowedExt[$type];
            $fileDestination = 'images/'.$fileNameNew;
            move_uploaded_file($file['tmp_name'], $fileDestination);    
          } 
        }
      }
      if(isset($_POST['carica'])){
        $conn=mysqli_connect('localhost','root','','login');
       $username =mysqli_real_escape_string($conn,$_SESSION['username']);
       $user=mysqli_real_escape_string($conn,$_SESSION['user_id']);
       $query= "SELECT username FROM utente WHERE username='$username' ";
       $res=mysqli_query($conn,$query);
       if(mysqli_num_rows($res)>0){
         $label=mysqli_real_escape_string($conn,$_POST['titolo']);
         $preparazione=mysqli_real_escape_string($conn,$_POST['preparazione']);  
         $query2="INSERT INTO creations(user_id,username,label,preparazione,img) VALUES('$user','$username','$label','$preparazione','$fileDestination')";
         mysqli_query($conn, $query2);
         mysqli_close($conn); 
         $invio=true;
         header("Location: hw_logged.php");}
        }
     
    
    ?>
  <head>
    <meta charset="utf-8">
    <title>Ricetta UNICT</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/hmw.css">
    <script src="./scripts/logged.js" defer="true"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Oswald:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">

  </head>
  <body>
    <header>
      <nav>
      <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
        <div class="links" id="link">
        <span class="Logout"><a class='button' href="hw_logout.php">Logout</a></span>
          <button class="Hidden" id="Ritorna">Torna alla Home</button>
          <a class="button" id="Ricerca">Cerca</a>
          <form class="Hidden" method='post' id="Ricerca">
            <input name='input' type="text" id="ricetta" placeholder='Inserisci richiesta'>
            <select name="scelta" id="scelta">
              <option value="rc" selected>Ricetta</option>
              <option value="us" >Utente</option>
            </select>
            <input type="submit" id="submit" value="Cerca">
          </form>
        </div>
        </nav>

      <h1  id="titolo">
        <?php 
        echo "<em>Benvenuto ".$userinfo['username']."</em>" ;
        ?>
      </h1>

    </header>
    <main class='left'>
     <main>
      <section class="mostra_preferiti">
      </section>
      <section class="mostra_creati">
      </section>
     </main>
     <main class='interno'>
     <section class="nuova_vista">
     </section>
     <section class="creati" >
      <form method="post"  enctype="multipart/form-data"  id="Crea_ricetta" class='Hidden'>
          <div><input name='titolo' type="text" id="Titolo_creazione" placeholder='Inserisci titolo'></div><br>
          <div><textarea name="preparazione" rows="10" cols="50" id="preparazione" placeholder='Inserisci preparazione'></textarea></div><br>
         <div>Scegli immagine <input name="img" type="file" id="img" accept='.jpg, .jpeg, image/png'/></div><br>
         <div> <input type="submit" name="carica" value="carica" /></div>
       </form>
       <section id='inserimento'></section>
     </section>
     <section class="Spotify"></section>
      </main>
    </main>
  </body>
  <footer class='absolute'>
     <div class="prova">Puoì mostrare le tue ricette preferite premendo sull'icone stella, <br> mostrare le ricette da te create o in caso crearne una premendo sull'icona del post</div>
     <div class='footer'>Svillupato da Damiano Samperi 1000003371</div>  
    </footer>
</html>
