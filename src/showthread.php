<html>
    <body>
    
<?php
session_start();
include 'connection.php';
include 'header.php';
include 'bbcode.php';
$id_get = $_GET["t"];

$sqlt = "SELECT * FROM Threads WHERE ID = $id_get";
$result = mysql_query($sqlt);
$rowt = mysql_fetch_array($result);

echo "<div class='wrapContent'>";

echo "<div class='wrapThreadTitle'><div class='ThreadName'>".$rowt['Name']."</div><div class='ThreadDate'>".$rowt['Erstellungsdatum']."</div>
    <div class='ThreadDescr'>".$rowt['Beschreibung']."</div></div>";


$sql = "SELECT Posts.ID AS Postid, Posts.Title, Users.Name, Users.ID as Userid, Posts.Content as Content, Posts.Date FROM Posts, Users WHERE Thread = $id_get AND Users.ID = Posts.User ORDER BY Posts.Date";
$result = mysql_query($sql);
echo mysql_error();
while ($row = mysql_fetch_object($result)) {
    echo "<div class='wrapThread'>
            <div class ='Post'>
              <div class='wrapTitleDate'>
                  <div class='PostTitle'>
                    <a href='showpost.php?p=$row->Postid'>#$row->Postid</a> $row->Title
                  </div>
                  <div class='PostDate'>
                    $row->Date<br>
                    <input type='button' class='quoteButton' content='$row->Content' value='Quote'>";
    if ($_SESSION['admin'] == 1 or $row->Userid == $_SESSION['userid']) {
        echo "
                <form class='deleteForm' action='process.php' method='post'>
                    <input type='submit' value=''>
                    <input type='hidden' name='id' value='$row->Postid'>
                    <input type='hidden' name='mode' value='deletePost'>
                </form>";
    }
    $sqlPostCount = "SELECT count(p.ID) as Count FROM Posts p WHERE p.User = $row->Userid";
    $resultPostCount = mysql_query($sqlPostCount);
    $rowPostCount = mysql_fetch_object($resultPostCount);
    $postCount = $rowPostCount->Count;

    $sqlThreadCount = "SELECT count(t.ID) as Count FROM Threads t WHERE t.User = $row->Userid";
    $resultThreadCount = mysql_query($sqlThreadCount);
    $rowThreadCount = mysql_fetch_object($resultThreadCount);
    $threadCount = $rowThreadCount->Count;

    $bbcontent = parse_bbcode($row->Content);
    echo "        </div>
              </div>
              <div class='wrapPostUserContent'>
                  <div class='PostUser'>
                    <a href='showuser.php?u=$row->Userid'>$row->Name</a> <br>
                    <b>Posts</b>: $postCount<br>
                    <b>Threads:</b> $threadCount
                  </div>
                  <div class='PostContent'>
                    $bbcontent
                  </div>
              </div>
            </div>
          </div>";
}
?>
        <form class="createForm" action="process.php" method="post">

            <?php
            if (isset($_SESSION['username'])) {
                echo "<br>
                    <input name='Title' id='title' type='text' maxlength='100' placeholder='Der Titel'>
                    <br>
                    <textarea name='Content' id='editor' class='editor' maxlength='2000' placeholder='Der Content'></textarea>
                    <input type='hidden' name='mode' value='post'>
                    <input type='hidden' name='threadid' value='$id_get?>'>
                    <br>
                    <input name='Submit' type='submit' value='Abschicken'>";
            }
            ?>
        </form>
    </div>
    </body>

</html>