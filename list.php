<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die("Connexion à la BDD impossible. @triinoxys ALED"); }

echo 'Game Viewers: ';

$last = $bdd->query('SELECT MAX(id) FROM game_viewers')->fetch()['MAX(id)'];
foreach ($bdd->query('SELECT id, twitch_name FROM game_viewers') as $row) {
  echo $row['twitch_name'], ' (#', $row['id'], ')', ($row['id'] != $last ? ', ' : '.');
}

?>
