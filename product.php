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
      <div class="item">
        <a href="goodies.php"><div id="active" class="ui button">Goodies</div></a>
      </div>
      <div class="item">
        <a href="#"><div class="ui button">About</div></a>
      </div>
      <div class="right menu">
        <?php
          session_start();
          if (!isset($_SESSION["logged"])) {
          echo ' <div class="item">
              <a href="signup.php"><div id="sign_up" class="ui button">Sign up</div></a>
            </div>
            <div id="login" class="item">
              <a href="login.php"><div class="ui button">Login</div></a>
            </div>';
          }else {
            echo '
            <div class="item">
                <a href="cart.php"><div class="ui button">Panier</div></a>
              </div>
            <div id="logout" class="item">
                <a href="logout.php"><div class="ui button">Logout</div></a>
              </div>
              <div class="item">
                <a href="profil.php"><div id="profil" class="ui button">Profil</div></a>
              </div>';
          }
         ?>
      </div>
    </div>
    <section>
      <article class="ui centered grid">
        <div id="home" class="ui red message">
          <?php
            include_once("database/mock.php");
            $id = $_REQUEST["id"]-1;
            echo '<h2>'.$articles["title"][$id].'</h2>';
            echo '<div class="ui one column grid">';
            echo '<div class="column">
              <div class="ui segment">';
                echo '<img src="'.$articles["image"][$id].'" width="300" height="200">';
                echo "<p>".$articles["description"][$id]."</p>";
                echo '<p style="color: lightcoral;font-weight:bold;font-size:25px ">'.$articles["prix"][$id]." €</p><br>";
                echo '<div class="item">
                  <a href="goodies.php"><div class="ui blue button">Retour à la liste</div></a>';
                  if (!isset($_SESSION["logged"])) {
                    echo '<a href="login.php"><div class="ui button">Login</div></a>';
                  }else {
                    if (isset($_SESSION[$articles["title"][$id]])) {
                      echo '<a href="function/remove.php?title='.$articles["title"][$id].'&id='.$_REQUEST["id"].'&from=product"><div class="ui red button">retirer du panier</div></a>';
                    }else {
                      echo '<a href="function/add.php?title='.$articles["title"][$id].'&id='.$_REQUEST["id"].'&from=product"><div class="ui green button">ajouter au panier</div></a>';
                    }
                  }
                echo '</div>';
            echo'</div>
            </div>';
            echo '</div>';
           ?>
        </div>
      </article>
    </section>
  </body>
</html>
