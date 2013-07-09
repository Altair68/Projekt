<?php
    include 'connection.php';
    include 'header.php';
    $id_get = $_GET["p"];
    $sql = "SELECT Posts.ID, Posts.Title, Users.Name, Posts.Content FROM Posts, Users WHERE Posts.ID = $id_get AND Users.ID = Posts.User";
    $result = mysql_query($sql);
    echo mysql_error();
    while ($row = mysql_fetch_object($result)) {
        echo "<div class='wrapContent'>
                  <div class='wrapThread'>
                    <div class ='Post'>
                      <div class='wrapTitleDate'>
                          <div class='PostTitle'>
                            #$row->ID $row->Title
                          </div>
                          <div class='PostDate'>
                            $row->Date
                          </div>
                      </div>
                      <div class='wrapPostUserContent'>
                          <div class='PostUser'>
                            $row->Name
                          </div>
                          <div class='PostContent'>
                            $row->Content
                          </div>
                      </div>
                    </div>
                  </div>
             </div>";
    }
?>