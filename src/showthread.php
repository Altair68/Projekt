<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    
<?php
session_start();
include 'connection.php';
include 'header.php';
$id_get = $_GET["t"];

$sqlt = "SELECT * FROM Threads WHERE ID = $id_get";
$result = mysql_query($sqlt);
$rowt = mysql_fetch_array($result);

echo "<div class='ThreadName'>".$rowt['Name']."</div><div class='ThreadDate'>".$rowt['Erstellungsdatum']."</div>
    <div class='ThreadDescr'>".$rowt['Beschreibung']."</div>";


$sql = "SELECT Posts.ID, Posts.Title, Users.Name, Posts.Content, Posts.Date FROM Posts, Users WHERE Thread = $id_get AND Users.ID = Posts.User";
$result = mysql_query($sql);
echo mysql_error();
while ($row = mysql_fetch_object($result)) {
    echo "<div class ='Post'>
              <div class='wrapTitleDate'>
                  <div class='PostTitle'>
                    <a href='showpost.php?p=$row->ID'>#$row->ID</a> $row->Title
                  </div>
                  <div class='PostDate'>$row->Date</div>
              </div>
              <div class='wrapPostUserContent'>
                  <div class='PostUser'>
                    $row->Name
                  </div>
                  <div class='PostContent'>
                    $row->Content
                  </div>
              </div>
          </div>";
}
?>
        <form action="insert.php" method="post">

            <?php
            if (isset($_SESSION['username'])) {
                echo "<br>
                    <input name=\"Title\" type=\"text\" maxlength=\"40\" placeholder=\"Der Titel\">
                    <br>
                    <textarea name=\"Content\" maxlength=\"500\" placeholder=\"Der Content\"></textarea>
                    <input type=\"hidden\" name=\"mode\" value=\"post\">
                    <input type=\"hidden\" name=\"threadid\" value=\"$id_get?>\">
                    <br>
                    <input name=\"Submit\" type=\"submit\" value=\"Abschicken\">";
            }
            ?>
        </form>
    </body>

</html>