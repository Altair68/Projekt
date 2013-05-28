<html>
    <head>
        <title>Forum</title>
        <?php
            include 'connection.php';
        ?>
    </head>
    <body>
        <?php
            include 'header.html';
            $sql = "SELECT * FROM Threads";
            $result = mysql_query($sql);
            echo mysql_error();
            while ($row = mysql_fetch_object($result)) {
                echo "<a href='showthread.php?t=$row->ID'><article></p><b>$row->ID</b>|$row->Name|$row->Beschreibung</article></a>";
                echo "<br>";
            }
            include 'footer.html';
        ?>

        <form action="insert.php" method="post">

            <input name="User" list="userIds">
            <?php
            echo "<datalist id='userIds'>";
            $result = mysql_query("SELECT ID FROM Users");
            while ($line = mysql_fetch_object($result))  {
                echo "<option value='$line->ID'>";
            }
            echo "</datalist>";
            echo mysql_error();
            ?>
            <br>
            <input name="Title" type="text" maxlength="40" placeholder="Der Titel">
            <br>
            <textarea name="Beschreibung" maxlength="500" placeholder="Die Beschreibung"></textarea>
            <input type="hidden" name="mode" value="thread">
            <br>
            <input name="Submit" type="submit">

        </form>

    </body>
</html>