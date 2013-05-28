<?php
include 'connection.php';
$id_get = $_GET["t"];
if (isset($_POST['Submit'])) {
    echo "ES LEBT";
}
if($_POST["Content"] != "" and $_POST["Title"] != ""){
    $title = $_POST["Title"];
    $content = $_POST["Content"];
    $user = $_POST["User"];
    $insert = "INSERT INTO Posts (Title, Thread, Content, User, Date) VALUES ('$title', '$id_get', '$content', '$user', CURRENT_TIMESTAMP)";
    $query = mysql_query($insert);
}

$sql = "SELECT * FROM Posts, Users WHERE Thread = $id_get AND Users.ID = Posts.User";
$result = mysql_query($sql);
echo mysql_error();
while ($row = mysql_fetch_object($result)) {
    echo "<a href='showpost.php?p=$row->ID'>$row->ID</a> <br> <h1>$row->Title</h1><br><u>$row->Name</u><article>$row->Content</article>";
    echo "<hr>";
}
?>
<html>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']."?t=$id_get"; ?>" method="post">

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
            <textarea name="Content" maxlength="500" placeholder="Der Content"></textarea>
            <br>
            <input name="Submit" type="submit" value="success">

        </form>
    </body>

</html>