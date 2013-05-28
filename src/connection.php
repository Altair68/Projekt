<?php
$mysqlhost = "localhost"; // MySQL-Host angeben
$mysqluser = "forum"; // MySQL-User angeben
$mysqlpwd = "asdf123"; // Passwort angeben

$connection = mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die ("Verbindungsversuch fehlgeschlagen");
$database = "Forum";
mysql_select_db($database, $connection) or die ("Die Datenbank konnte nicht ausgewählt werden.");
?>