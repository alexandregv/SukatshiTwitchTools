<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die("Connexion à la BDD impossible. @triinoxys ALED"); }

if ($bdd->query("SELECT value FROM `vars` where name = 'enabled'")->fetch()['value'] == 'false')
  die('La Game Viewers est désactivée.');

if ($viewers = $bdd->query('SELECT * FROM `game_viewers`'))
{
  echo 'Game Viewers: ';
  $last = $bdd->query('SELECT MAX(id) FROM `game_viewers`')->fetch()['MAX(id)'];
  foreach ($viewers as $row) {
    echo $row['twitch_name'], ' (#', $row['id'], ')', ($row['id'] != $last ? ', ' : '.');
  }
}
else
  echo 'Pas de viewers enregistrés.';

?>
