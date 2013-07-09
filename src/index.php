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
                    $dateSQL = "SELECT max(Date) AS Date FROM Posts WHERE Posts.Thread = $row->ID";
                    $dateResult = mysql_query($dateSQL);
                    $dateRow = mysql_fetch_object($dateResult);
                    echo mysql_error();
                    if ($dateRow->Date == null) {
                        echo "
                        <article>
                            <div class='ThreadInfo'><a href='showthread.php?t=$row->ID'><b>$row->ID $row->Name</b></a><br>$row->Beschreibung</div>
                            <div class='ThreadDate'>Erstellt am: $row->Erstellungsdatum<br>Letzte &Aumlnderung: $row->Erstellungsdatum</div>
                        </article>";
                    } else {
                        echo "
                        <article>
                            <div class='ThreadInfo'><a href='showthread.php?t=$row->ID'><b>$row->ID $row->Name</b></a><br>$row->Beschreibung</div>
                            <div class='ThreadDate'>Erstellt am: $row->Erstellungsdatum<br>Letzte &Aumlnderung: $dateRow->Date</div>
                        </article>";

                    }
                    echo "<br>";
                }
                include 'footer.html';
            ?>

            <form class="createForm" action="process.php" method="post">

                <?php
                if (isset($_SESSION['username'])) {
                    echo "<br>
                        <input name='Title' type='text' maxlength='60' placeholder='Der Titel'>
                        <br>
                        <textarea name='Beschreibung' maxlength='200' placeholder='Die Beschreibung'></textarea>
                        <input type='hidden' name='mode' value='thread'>
                        <br>
                        <input name='Submit' type='submit' value='Abschicken'>";
                }
                ?>

            </form>
        </div>
    </body>
</html>