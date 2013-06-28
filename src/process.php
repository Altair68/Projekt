<?php
    session_start();
    include 'connection.php';
    $refresh = 'javascript:history.back()';
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
    } elseif ($_POST["mode"] == "register") {
        $username = trim($_POST["username"]);
        $email = trim($_POST["mail"]);
        $pw = $_POST["pw"];
        $pw_conf = $_POST["pw_conf"];
        $refresh = 'register.php';

        if ($pw != $pw_conf) {
            echo "<div class='error'>Die Passw&ouml;rter stimmen nicht &uuml;berein</div>";
        } else {
            $sql = "SELECT * FROM Users WHERE Name LIKE '$username'";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) != 0) {
                echo "<div class='error'>Der User existiert bereits</div>";
            } else {
                $sql = "SELECT * FROM Users WHERE Email LIKE '$email'";
                $result = mysql_query($sql);
                if (mysql_num_rows($result) != 0) {
                    echo "<div class='error'>Die Mail-Adresse wird bereits benutzt</div>";
                } else {
                    $refresh = 'index.php';
                    $pw_enc = md5($pw);
                    $sql = "INSERT INTO Users (Name,Passwort,Email) VALUES ('$username','$pw_enc','$email');";
                    mysql_query($sql);
                }
            }
        }
    } elseif ($_POST["mode"] == "userEdit") {
        $email = $_POST['mail'];
        $pw = $_POST['pw'];
        $pw_conf = $_POST['pw_conf'];
        $userid = $_SESSION['userid'];

        if ($pw != '') {
            if ($pw != $pw_conf) {
                echo "<div class='error'>Die Passw&ouml;rter stimmen nicht &uuml;berein</div>";
            } else {
                $pw_enc = md5($pw);
                $sql = "UPDATE Users SET Passwort = '$pw_enc', Email = '$email' WHERE ID = $userid";
            }
        } else {
            $sql = "UPDATE Users SET Email = '$email' WHERE ID = $userid";
        }
        mysql_query($sql);
        mysql_error();
    }
?>
<html>
<head>
    <meta http-equiv="refresh" content="1; URL='<?php echo $refresh?>">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <noscript>Bitte manuell auf zurück drücken, wenn du schon alles selbst machen willst (NoScript)</noscript>
</body>
</html>
