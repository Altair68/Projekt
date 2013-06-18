<html>
    <body>
        <?php
        session_start();
        include 'connection.php';
        include 'header.php';

        if (!isset($_SESSION['username'])){
            echo "<div class='userWrap'>
                    <form>
                        <label for='username'>Username</label><input type='text' name='username' value='$username'> <br>
                        <label for='mail'>E-Mail</label><input type='text' name='mail' value='$usermail'><br>
                        <label for='passwort'>Passwort</label><input type='password' name='passwort'><br>
                        <label for='passwort_conf'>Passwort wiederholen</label><input type='password' name='passwort_conf'><br>
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