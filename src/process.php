<?php
session_start();
include 'connection.php';
include 'header.php';
$refresh = 'javascript:history.back()';

if ($_POST["mode"] == "post") {
    post();
} elseif ($_POST["mode"] == "thread") {
    thread();
} elseif ($_POST["mode"] == "login") {
    login();
} elseif ($_POST["mode"] == "logout") {
    logout();
} elseif ($_POST["mode"] == "register") {
    $refresh = register();
} elseif ($_POST["mode"] == "userEdit") {
    userEdit();
} elseif ($_POST["mode"] == "deletePost") {
    deletePost();
} elseif ($_POST["mode"] == "quotePost") {
    quotePost();
}

function post()
{
    echo "<div class='error'>Post wird erstellt</div>";
    $id_get = htmlspecialchars($_POST["threadid"]);
    $title = htmlspecialchars($_POST["Title"]);
    $content = $_POST["Content"];
    $user = $_SESSION["userid"];
    $editedContent = replaceUmlaute($content);
    $editedTitle = replaceUmlaute($title);
    $insert = "INSERT INTO Posts (Title, Thread, Content, User, Date) VALUES ('$editedTitle', '$id_get', '$editedContent', '$user', CURRENT_TIMESTAMP)";
    mysql_query($insert);
    echo mysql_error();
}

function replaceUmlaute($stringToEdit)
{
    $search = array("\n", "ä", "Ä", "ö", "Ö", "ü", "Ü",);
    $replace = array("<br>", "&auml;", "&Auml;", "&ouml;", "&Ouml;", "&uuml;", "&Uuml;");
    return str_replace($search, $replace, $stringToEdit);
}

function thread()
{
    echo "<div class='error'>Thread wird erstellt</div>";
    $title = htmlspecialchars($_POST["Title"]);
    $content = htmlspecialchars($_POST["Beschreibung"]);
    $editedContent = replaceUmlaute($content);
    $editedTitle = replaceUmlaute($title);
    $user = $_SESSION["userid"];
    $insert = "INSERT INTO Threads (Name, Beschreibung, Erstellungsdatum, User) VALUES ('$editedTitle', '$editedContent', CURRENT_TIMESTAMP, '$user')";
    $query = mysql_query($insert);
}

function login()
{
    $username = $_POST['username'];
    $pw = md5($_POST['pw']);
    $sql = "SELECT * FROM Users WHERE Name = '$username' AND Passwort = '$pw';";
    $result = mysql_query($sql);
    echo mysql_error();
    if (mysql_num_rows($result) > 0) {
        echo "<div class='error'>Sie werden eingeloggt</div>";
        $data = mysql_fetch_array($result);
        $_SESSION['userid'] = $data['ID'];
        $_SESSION['username'] = $data['Name'];
        $_SESSION['mail'] = $data['Email'];
        $_SESSION['admin'] = $data['Admin'];
    } else {
        echo "<div class='error'>Sie haben einen falschen User oder ein falsches Passwort eingegeben</div>";
    }
}

function logout()
{
    session_destroy();
    echo "<div class='error'>Sie sind jetzt ausgeloggt</div>";
}

/**
 * @return string
 */
function register()
{
    $username = trim($_POST["username"]);
    $email = trim($_POST["mail"]);
    $pw = $_POST["pw"];
    $pw_conf = $_POST["pw_conf"];
    $refresh = 'register.php';

    if ($pw != $pw_conf) {
        echo "<div class='error'>Die Passw&ouml;rter stimmen nicht &uuml;berein</div>";
        return $refresh;
    } else {
        $sql = "SELECT * FROM Users WHERE Name LIKE '$username'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) != 0) {
            echo "<div class='error'>Der User existiert bereits</div>";
            return $refresh;
        } else {
            $sql = "SELECT * FROM Users WHERE Email LIKE '$email'";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) != 0) {
                echo "<div class='error'>Die Mail-Adresse wird bereits benutzt</div>";
                return $refresh;
            } else {
                $refresh = 'index.php';
                $pw_enc = md5($pw);
                $sql = "INSERT INTO Users (Name,Passwort,Email) VALUES ('$username','$pw_enc','$email');";
                mysql_query($sql);
                return $refresh;
            }
        }
    }
}

function userEdit()
{
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

function deletePost()
{
    $id = $_POST['id'];
    $statement = "DELETE FROM Posts WHERE ID = $id";
    mysql_query($statement);
    echo mysql_error();
}

function quotePost() {
    alert($_POST['Content']);
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="2; URL='<?php echo $refresh?>">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <noscript>Bitte manuell auf zurück drücken, wenn du schon alles selbst machen willst (NoScript)</noscript>
</body>
</html>
