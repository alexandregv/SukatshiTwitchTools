<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die('Erreur de connexion à la BDD: ' . $e->getMessage()); }

$status = $bdd->query("SELECT value FROM `vars` where name = 'status'")->fetch()['value'];
?>

<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen"/>
  
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
  <link type="text/css" rel="stylesheet" href="/css/style.css">
  
  <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <title>Game Viewers - Souquatachi</title>
</head>

<body class="disallow-select">
  <header>
    <div class="container">
      <h3>Game Viewers (<span class="<?php echo ($status == 'ON' ? 'orange-text' : 'grey-text'); ?>"><?php echo $status ?></span>)</h3>
      <?php
        if ($status == 'ON')
          echo '<a href="#modal_on_off" class="waves-effect waves-orange btn modal-trigger grey"><i class="material-icons right">lock</i>Désactiver la Game Viewers</a>';
        else
          echo '<a href="/on_off.php" class="waves-effect waves-orange btn modal-trigger orange"><i class="material-icons right">lock_open</i>Activer la Game Viewers</a>';
      ?>
    </div>
  </header>
  
  <main class="valign-wrapper" id="main">
    <div class="container">
      <?php
        if ($status == 'ON')
        {
          $viewers = $bdd->query('SELECT * FROM `game_viewers`');
          if ($viewers->rowCount() > 0)
          {
            ?>
            <table class="striped">
              <thead>
                <tr>
                  <th>Position</th>  
                  <th>Pseudo Twitch</th>
                  <th>Pseudo InGame</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach ($viewers as $viewer)
                {
                  ?>
                  <tr>
                    <td><?= $viewer['id'] ?></td>
                    <td class="allow-select"><?= $viewer['twitch_name'] ?></td>
                    <td <?php if ($viewer['ingame_name'] != '<i>Non spécifié</i>') echo 'class="allow-select"'; ?>><?= $viewer['ingame_name'] ?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
            <?php
          }
          else
            echo '<img src="/img/amumu_sad.gif" alt="amumu_sad.gif" class="valign-wrapper" style="margin-left: auto; margin-right: auto;">';
        }
        else
          echo '<img src="/img/amumu_friend.png" alt="amumu_friend.png" style="margin-left: auto; margin-right: auto;" width="300rem">';
      ?>
    </div>
  </main>
  
  <?php
    if ($status == 'ON')
      echo '<div class="hide-on-small-only" style="margin-right: 20px;"><img src="/img/sukatsHi.png" alt="sukatsHi.png" class="right" width="50" height="50"></div>';
  ?>
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container grey-text text-lighten-4">
        <i class="material-icons inline-icon" style="font-size: 21px;">code</i> with <i class="material-icons inline-icon" style="font-size: 18px;">favorite</i> by <a class="grey-text text-lighten-4" target="_blank" href="https://triinoxys.fr">triinoxys</a>
        <a class="grey-text text-lighten-4 right" target="_blank" href="https://github.com/triinoxys">GitHub</a>
        <span class="grey-text text-lighten-4 right"> | </span>
        <a class="grey-text text-lighten-4 right" target="_blank" href="https://keybase.io/triinoxys">Keybase</a>
      </div>
    </div>
  </footer>
  
  <!-- Modal ON/OFF -->
  <div id="modal_on_off" class="modal">
    <div class="modal-content">
      <h4><i class="material-icons inline-icon" style="font-size: 38px;">warning</i> Attentioooooon <i class="material-icons inline-icon" style="font-size: 38px;">warning</i></h4>
      <p>T'es sûre de vouloir faire ça ? C'est vraiment pas cool, ça va dégager touuuus les gentils viewers, même ceux qui ont pas encoré joué avec twa :c</p>
    </div>
    <div class="modal-footer">
      <a href="/on_off.php" class="btn waves-effect waves-orange grey">Yep, sûre.</a>
      <a href="#!" class="btn waves-effect waves-orange orange modal-close ">Naaaah j'ai missclick</a>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.modal').modal();
      $('.tooltipped').tooltip();
    });
    
    setInterval(function(){
       $("#main").load(window.location.href + " #main" );
    }, 5000);
  </script>
  
  <script src="js/materialize.min.js"></script>
</body>
</html>
