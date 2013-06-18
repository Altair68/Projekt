<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <img src=""/>
        <br/>
        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            echo"<div style='float: left'>
                    <form action=\"process.php\" method=\"post\">
                        <input type=\"text\" name=\"username\" placeholder='Benutzername'>
                        <input type=\"password\" name=\"pw\" placeholder='Passwort'>
                        <input type=\"hidden\" name=\"mode\" value=\"login\">
                        <input type=\"submit\" value=\"Login\">
                    </form>
                </div>
                <form action='register.php' method='post'>
                    <input type='submit' value='Registrieren'>
                </form>";
        } else {
            echo "Sie sind eingeloggt als ".$_SESSION['username']."";
            echo"<form action=\"process.php\" method=\"post\">
                    <input type=\"hidden\" name=\"mode\" value=\"logout\">
                    <input type=\"submit\" value=\"Logout\">
                </form>";
            }
        ?>
    </header>
</body>
</html>