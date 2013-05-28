<?php
    include 'connection.php';
    if ($_POST["mode"] == "post") {
        $id_get = $_POST["threadid"];
        $title = $_POST["Title"];
        $content = $_POST["Content"];
        $user = $_POST["User"];
        $insert = "INSERT INTO Posts (Title, Thread, Content, User, Date) VALUES ('$title', '$id_get', '$content', '$user', CURRENT_TIMESTAMP)";
        $query = mysql_query($insert);
        echo mysql_error();
    } elseif ($_POST["mode"] == "thread") {
        $title = $_POST["Title"];
        $content = $_POST["Content"];
        $user = $_POST["User"];
        $insert = "INSERT INTO Threads (Name, Beschreibung, Erstellungsdatum, User) VALUES ('$title', '$content', CURRENT_TIMESTAMP, '$user')";
        $query = mysql_query($insert);
    }
?>
<html>
<head>
    <meta http-equiv="refresh" content="1; URL='javascript:history.back()'">
</head>
<body>
    <noscript>Bitte manuell auf zurück drücken, wenn du schon alles selbst machen willst (NoScript)</noscript>
</body>
</html>
