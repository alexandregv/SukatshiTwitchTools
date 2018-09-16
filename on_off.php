<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die('Erreur de connexion à la BDD: ' . $e->getMessage()); }

if ($bdd->query("SELECT value FROM `vars` where name = 'enabled'")->fetch()['value'] == 'false')
  $bdd->query("UPDATE `vars` SET value = 'true' WHERE name = 'enabled'");
else
  $bdd->query("UPDATE `vars` SET value = 'false' WHERE name = 'enabled'");

$bdd->query("TRUNCATE TABLE `game_viewers`");
header('Location: /');
?>

