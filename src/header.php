<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <script src="lib/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
    <script src="lib/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
    <script src="lib/jquery-cookie/jquery-cookie.js"></script>
    <script src="lib/farbtastic/farbtastic.js"></script>
    <script src="lib/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/farbtastic/farbtastic.css">
    <link rel="stylesheet" type="text/css" href="lib/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="header">
            <a href="\">
                <div class='caption'>
                    Das ist ein Forum
                </div>
                <div class='subCaption'>
                    Das ist das Thema des Forums
                </div>
            </a>
            <br/>
            <?php
            session_start();
            if (!isset($_SESSION['username'])) {
                echo"<div style='float: left'>
                    <form action='process.php' method='post'>
                        <input type='text' name='username' placeholder='Benutzername'>
                        <input type='password' name='pw' placeholder='Passwort'>
                        <input type='hidden' name='mode' value='login'>
                        <input type='submit' value='Login'>
                    </form>
                </div>
                <form action='register.php' method='post'>
                    <input type='submit' value='Registrieren'>
                </form>";
            } else {
                echo "Sie sind eingeloggt als ".$_SESSION['username']."";
                echo"<form action='process.php' method='post'>
                    <input type='hidden' name='mode' value='logout'>
                    <input type='submit' value='Logout'>
                </form>";
            }
            ?>
        </div>
    </header>
    <div class='colorChooser'>
        <img src='http://www.w3schools.com/tags/colormap.gif' width='50px' height='50px'>
        <form action="" style="width: 400px;">
            <div class="form-item"><label for="color">Color:</label><input type="text" id="color" name="color" value="#123456" /></div><div id="picker"></div>
        </form>
    </div>
</body>
</html>