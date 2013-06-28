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
            $userid = $user['ID'];
            if (isset($_SESSION['username'])){
                if ($_SESSION['userid'] == $userid) {
                    $disabled = '';
                } else {
                    $disabled = 'disabled';
                }
                echo "<div class='userWrap'>
                        <form action='process.php' method='post'>
                            <label for='userid'>Userid</label><input type='text' name='username' value='$userid' disabled> <br>
                            <label for='username'>Username</label><input type='text' name='username' value='$username' disabled> <br>
                            <label for='mail'>E-Mail</label><input type='text' name='mail' value='$usermail' $disabled required><br>
                            <input type='hidden' name='mode' value='userEdit'>";
                if ($_SESSION['userid'] == $userid) {
                    echo    "<label for='pw'>Passwort</label><input type='password' name='pw'><br>
                            <label for='pw_conf'>Passwort wiederholen</label><input type='password' name='pw_conf'><br>
                            <input type='submit' name='submit' value='&Auml;nderungen speichern'>";
                }
                echo "  </form>
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
