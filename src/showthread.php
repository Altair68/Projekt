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

echo "<div class='wrapThreadTitle'><div class='ThreadName'>".$rowt['Name']."</div><div class='ThreadDate'>".$rowt['Erstellungsdatum']."</div>
    <div class='ThreadDescr'>".$rowt['Beschreibung']."</div></div>";


$sql = "SELECT Posts.ID AS Postid, Posts.Title, Users.Name, Users.ID as Userid, Posts.Content, Posts.Date FROM Posts, Users WHERE Thread = $id_get AND Users.ID = Posts.User";
$result = mysql_query($sql);
echo mysql_error();
while ($row = mysql_fetch_object($result)) {
    echo "<div class='wrapThread'>
            <div class ='Post'>
              <div class='wrapTitleDate'>
                  <div class='PostTitle'>
                    <a href='showpost.php?p=$row->Postid'>#$row->Postid</a> $row->Title
                  </div>
                  <div class='PostDate'>$row->Date</div>
              </div>
              <div class='wrapPostUserContent'>
                  <div class='PostUser'>
                    <a href='showuser.php?u=$row->Userid'>$row->Name</a>
                  </div>
                  <div class='PostContent'>
                    $row->Content
                  </div>
              </div>
            </div>
          </div>";
}
?>
        <form action="process.php" method="post">

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