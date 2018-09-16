<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die('Erreur de connexion à la BDD: ' . $e->getMessage()); }

if ($bdd->query("SELECT value FROM `vars` where name = 'enabled'")->fetch()['value'] == 'false')
  $status = 'OFF';
else
  $status = 'ON';

function list_viewers($bdd)
{
  if ($viewers = $bdd->query('SELECT * FROM `game_viewers`'))
  {
    foreach ($viewers as $row) {
      print $row['id'] . "&emsp;";
      print $row['twitch_name'] . "&emsp;";
      print $row['ingame_name'] . "<br>";
    }
  }
  else
    echo 'Pas de viewers enregistrés.';
}

?>


<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Viewers</title>
</head>

<body>
  <h1>Souquatachi - Game Viewers (<?php echo $status ?>)</h1>
  
  <a href="/on_off.php"><?php echo ($status == 'ON' ? 'Désactiver' : 'Activer'); ?> la Game Viewers</a>
  <br><br>
  <?php
    if ($status == 'ON')
      list_viewers($bdd);
  ?>
</body>
</html>
