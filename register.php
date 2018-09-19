<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die("Connexion à la BDD impossible. @triinoxys ALED"); }

if (!isset($_GET['twitch_name']))
  die("Une erreur est survenue. @triinoxys ALED");

if ($bdd->query("SELECT value FROM `vars` where name = 'enabled'")->fetch()['value'] == 'false')
  die('La Game Viewers est désactivée.');

if ($resp = $bdd->query("SELECT id FROM `game_viewers` where twitch_name = '" . $_GET['twitch_name'] . "'")->fetch())
  die("@" . $_GET['twitch_name'] . " tu es déjà enregistré (#" . $resp['id'] . ").");

if (isset($_GET['ingame_name']) && $_GET['ingame_name'] != "")
  $bdd->query("INSERT INTO `game_viewers`(`twitch_name`, `ingame_name`) VALUES ('" . $_GET['twitch_name'] . "', '" . $_GET['ingame_name'] . "')");
else
  $bdd->query("INSERT INTO `game_viewers`(`twitch_name`) VALUES ('" . $_GET['twitch_name'] . "')");

echo "@", $_GET['twitch_name'], " enregistré (#", $bdd->query("SELECT id FROM `game_viewers` where twitch_name = '" . $_GET['twitch_name'] . "'")->fetch()['id'], ").";

?>

