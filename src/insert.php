<html>

<?php
    include 'connection.php';
    if ($_POST["mode"] == "post") {
        if($_POST["Content"] != "" and $_POST["Title"] != ""){
            $title = $_POST["Title"];
            $content = $_POST["Content"];
            $user = $_POST["User"];
            $insert = "INSERT INTO Posts (Title, Thread, Content, User, Date) VALUES ('$title', '$id_get', '$content', '$user', CURRENT_TIMESTAMP)";
            $query = mysql_query($insert);
        }
    } elseif ($_POST["mode"] == "thread") {
        if($_POST["Beschreibung"] != "" and $_POST["Title"] != ""){
            $title = $_POST["Title"];
            $content = $_POST["Content"];
            $user = $_POST["User"];
            $insert = "INSERT INTO Threads (Name, Beschreibung, Erstellungsdatum, User) VALUES ('$title', '$content', CURRENT_TIMESTAMP, '$user')";
            $query = mysql_query($insert);
        }
    }
?>