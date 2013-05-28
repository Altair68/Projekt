<?php
include 'connection.php';
$id_get = $_GET["p"];

$sql = "SELECT * FROM Posts WHERE ID = $id_get";
$result = mysql_query($sql);
echo mysql_error();
while ($row = mysql_fetch_object($result)) {
    echo "$row->ID <br> <h1>$row->Title</h1><br><article>$row->Content</article>";
}
?>