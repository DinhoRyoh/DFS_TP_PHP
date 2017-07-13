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
        <a href="goodies.php"><div class="ui button">Goodies</div></a>
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
                <a href="cart.php"><div id="active" class="ui button">Panier</div></a>
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
            $total=0;
            echo '<h2>Votre Panier</h2>';
            echo '<div class="ui three column grid">';
            foreach ($articles["title"] as $key => $value) {
              $id = $key-1;
              if (isset($_SESSION[$value])) {
                $total+=$articles["prix"][$key];
                echo '<div class="column">
                  <div class="ui segment">';
                    echo "<h2>".$value."</h2>";
                    echo '<a href="product.php?id='.$articles["id"][$key].'"><img src="'.$articles["image"][$key].'" width="300" height="200"></a>';
                    echo "<p>".$articles["description"][$key]."</p>";
                    echo '<p style="color: lightcoral;font-weight:bold;font-size:25px ">'.$articles["prix"][$key]." €</p>";
                    echo '<div class="item">';
                    echo '<a href="function/remove.php?title='.$articles["title"][$key].'&id='.$key.'&from=cart"><div class="ui red button">retirer du panier</div></a>';
                    echo '</div>';
                echo'</div>
                </div>';
              }
            }
            echo '</div>';
            echo "<h3> TOTAL : <em style='color: lightcoral;font-weight:bold;'>".$total." €</em></h3>";
            echo '<div class="item"><a href="mail.php?name='.$_SESSION['login'].'&mail='.$_SESSION['email'].'"><div class="ui yellow button">Commander</div></a></div>';

           ?>
        </div>
      </article>
    </section>
  </body>
</html>
