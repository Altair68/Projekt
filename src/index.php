<html>
    <head>
        <title>Forum</title>
        <?php
            session_start();
            include 'connection.php';
        ?>
    </head>
    <body>
        <?php
            include 'header.php';
        ?>
        <div class="wrapThreadOverview">
            <?php
                $sql = "SELECT * FROM Threads";
                $result = mysql_query($sql);
                echo mysql_error();
                while ($row = mysql_fetch_object($result)) {
                    echo "<article><a href='showthread.php?t=$row->ID'><b>$row->ID</b>|$row->Name|$row->Beschreibung</a></article>";
                    echo "<br>";
                }
                include 'footer.html';
            ?>

            <form action="process.php" method="post">

                <?php
                if (isset($_SESSION['username'])) {
                    echo "<br>
                        <input name=\"Title\" type=\"text\" maxlength=\"40\" placeholder=\"Der Titel\">
                        <br>
                        <textarea name=\"Beschreibung\" maxlength=\"80\" placeholder=\"Die Beschreibung\"></textarea>
                        <input type=\"hidden\" name=\"mode\" value=\"thread\">
                        <br>
                        <input name=\"Submit\" type=\"submit\">";
                }
                ?>

            </form>
        </div>
    </body>
</html>