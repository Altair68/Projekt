<?php
include 'connection.php';
$id_get = $_GET["p"];

$sql = "SELECT Posts.ID, Posts.Title, Users.Name, Posts.Content FROM Posts, Users WHERE Posts.ID = $id_get AND Users.ID = Posts.User";
$result = mysql_query($sql);
echo mysql_error();
while ($row = mysql_fetch_object($result)) {
    echo "$row->ID <br> <h1>$row->Title</h1><br><u>$row->Name</u><article>$row->Content</article>";
}
?>