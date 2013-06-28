<html>
    <body>
        <?php
        session_start();
        include 'connection.php';
        include 'header.php';

        if (!isset($_SESSION['username'])){
            echo "<div class='userWrap'>
                    <form action='process.php' method='post'>
                        <label for='username'>Username</label><input type='text' name='username'required> <br>
                        <label for='mail'>E-Mail</label><input type='email' name='mail'required><br>
                        <label for='pw'>Passwort</label><input type='password' name='pw' required><br>
                        <label for='pw_conf'>Passwort wiederholen</label><input type='password' name='pw_conf'required><br>
                        <input type='hidden' name='mode' value='register'>
                        <input type='submit' name='submit' value='&Auml;nderungen speichern'>
                    </form>
                  </div>";
        } else {
            echo "<div class='error'>Sorry du bist schon eingeloggt</div>";
        }

        include 'footer.html';
        ?>
</body>

</html>