<html>
    <body>
        <?php
        session_start();
        include 'connection.php';
        include 'header.php';
        $userid = $_GET["u"];

        $sql = "SELECT * FROM Users WHERE ID = $userid";
        $result = mysql_query($sql);

        if (mysql_num_rows($result) != "") {
            $user = mysql_fetch_array($result);
            $username = $user['Name'];
            $usermail = $user['Email'];
            if (isset($_SESSION['username'])){
                echo "<div class='userWrap'>
                        <form>
                            <label for='userid'>Userid</label><input type='text' name='username' value='$userid' disabled> <br>
                            <label for='username'>Username</label><input type='text' name='username' value='$username' disabled> <br>
                            <label for='mail'>E-Mail</label><input type='text' name='mail' value='$usermail' disabled><br>
                            <label for='passwort'>Passwort</label><input type='password' name='passwort'><br>
                            <label for='passwort_conf'>Passwort wiederholen</label><input type='password' name='passwort_conf'><br>
                            <input type='submit' name='submit' value='&Auml;nderungen speichern'>
                        </form>
                      </div>";
            } else {
                echo "<div class='error'>Sorry du musst eingeloggt sein um das Profil zu sehen.</div>";
            }
        } else {
            echo "<div class='error'>Der Benutzer ist nicht vorhanden.</div>";
        }

        include 'footer.html';
        ?>
    </body>

</html>
