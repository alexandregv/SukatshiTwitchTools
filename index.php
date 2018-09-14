<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die('Erreur de connexion à la BDD: ' . $e->getMessage()); }

function get_viewers($bdd) {
  foreach  ($bdd->query('SELECT id, twitch_name, ingame_name FROM game_viewers') as $row) {
    print $row['id'] . "&emsp;";
    print $row['twitch_name'] . "&emsp;";
    print $row['ingame_name'] . "<br>";
  }
}

?>


<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Souquatachi</title>
</head>

<body>
  <h1>Sukatshi - Game Viewers</h1>
  <?php
    get_viewers($bdd);
  ?>
</body>
</html>
