<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="vendor/semantic/semantic.min.css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="vendor/semantic/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <title>Goodies</title>
  </head>
  <body>
    <header>
        <img class="ui medium centered rounded image" src="/images/goodies.jpg">
    </header>
    <div id="menu" class="ui menu">
      <div class="item">
        <a href="/"><div class="ui button">Home</div></a>
      </div>
    </div>
    <section>
      <article class="ui centered grid">
        <div id="signup_form" class="ui red message">
          <h2>Connexion</h2>
          <form class="ui form" action="#" method="post">
            <div class="field">
              <label>Login</label>
              <input type="text" name="login" placeholder="Entrer votre login...">
            </div>
            <div class="field">
              <label>Mot de passe</label>
              <input type="password" name="password" placeholder="Entrer votre mot de passe...">
            </div>
            <button id="validate" class="ui button" type="submit">Valider</button>
          </form>
          <?php
          if(isset($_POST) && !empty($_POST)){
            session_start();
            $id=0;
            $flag=false;
            include_once("database/mock.php");
            foreach ($users["login"] as $key => $value) {
              if ($users["login"][$key]==$_POST["login"]) {
                $id=$key-1;
                $flag=true;
              }
            }
            $erreur=true;
            if ($flag) {
              foreach ($users["password"] as $key => $value) {
                if ($users["password"][$key]==$_POST["password"]) {
                  if (($key-1) == $id) {
                    $erreur=false;
                    $_SESSION["login"]=$users["login"][$id];
                    $_SESSION["password"]=$users["password"][$key];
                    $_SESSION["email"]=$users["email"][$key];
                    $_SESSION["logged"]="connected";
                    header('Location: index.php');
                  }
                }
              }
            }else {
              echo "Utilisateur inexistant<br>";
            }
            if ($erreur) {
              echo "Login ou Mot de passe érroné.";
            }
          }
           ?>
        </div>
      </article>
    </section>
  </body>
</html>
