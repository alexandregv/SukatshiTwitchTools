<?php
require "secrets.php";

try { $bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass); }
catch (Exception $e) { die('Erreur de connexion à la BDD: ' . $e->getMessage()); }

if ($bdd->query("SELECT value FROM `vars` where name = 'status'")->fetch()['value'] == 'OFF')
  $bdd->query("UPDATE `vars` SET value = 'ON' WHERE name = 'status'");
else
  $bdd->query("UPDATE `vars` SET value = 'OFF' WHERE name = 'status'");

$bdd->query("TRUNCATE TABLE `game_viewers`");
header('Location: /');
?>