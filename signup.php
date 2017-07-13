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
          <h2>Inscription</h2>
          <form class="ui form" action="#" method="post">
            <div class="field">
              <label>Email</label>
              <input type="text" name="email" placeholder="Entrer votre email...">
            </div>
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
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo '<p>email invalide</p>';
              }else {
                include_once('database/connexion.php');
                $pdo = new PDO ("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS);
                  $stmt = $pdo->prepare("INSERT INTO user (login, email, password) VALUES (:login, :email, :password);");
                  $stmt->bindParam(':login', $_POST["login"]);
                  $stmt->bindParam(':email', $_POST["email"]);
                  $stmt->bindParam(':password', $_POST["password"]);
                  $stmt->execute();
                $_SESSION["login"]=$_POST["login"];
                $_SESSION["email"]=$_POST["email"];
                $_SESSION["logged"]="connected";
                header('Location: index.php');
              }
           }
           ?>
        </div>
      </article>
    </section>
  </body>
</html>
