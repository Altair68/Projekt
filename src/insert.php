<?php
    session_start();
    include 'connection.php';
    if ($_POST["mode"] == "post") {
        $id_get = $_POST["threadid"];
        $title = $_POST["Title"];
        $content = $_POST["Content"];
        $user = $_SESSION["userid"];
        echo $user;
        $insert = "INSERT INTO Posts (Title, Thread, Content, User, Date) VALUES ('$title', '$id_get', '$content', '$user', CURRENT_TIMESTAMP)";
        $query = mysql_query($insert);
        echo mysql_error();
    } elseif ($_POST["mode"] == "thread") {
        $title = $_POST["Title"];
        $content = $_POST["Content"];
        $user = $_SESSION["userid"];
        $insert = "INSERT INTO Threads (Name, Beschreibung, Erstellungsdatum, User) VALUES ('$title', '$content', CURRENT_TIMESTAMP, '$user')";
        $query = mysql_query($insert);
    } elseif ($_POST["mode"] == "login") {
        $username = $_POST['username'];
        $pw = md5($_POST['pw']);
        $sql = "SELECT * FROM Users WHERE Name = '$username' AND Passwort = '$pw';";
        $result = mysql_query($sql);
        echo mysql_error();
        if (mysql_num_rows($result) > 0) {
            echo "Sie werden eingeloggt";
            $data = mysql_fetch_array($result);
            $_SESSION['userid'] = $data['ID'];
            $_SESSION['username'] = $data['Name'];
            $_SESSION['mail'] = $data['Email'];
        } else {
            echo "Sie haben einen falschen User oder ein falsches Passwort eingegeben";
        }
    } elseif ($_POST["mode"] == "logout") {
        session_destroy();
        echo "Sie sind jetzt ausgeloggt";
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
