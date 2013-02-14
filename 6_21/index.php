<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/include/classes/Database.class.php");
    
    $db = new Database("db453524503");
    $db->connect();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/include/css/styles.css" rel="stylesheet" type="text/css"/>
        <title>6.1</title>
    </head>
    <body>
        
		<div class="content">
			<div class="navigation">
				<ul>
					<li><a href="/6_1/">6.1</a></li>
					<li><a href="/6_2/">6.2</a></li>
					<li><a href="/6_11/">6.11</a></li>
					<li><a href="/6_12/">6.12</a></li>
					<li><a href="/6_14/">6.14</a></li>
					<li><a href="/6_20/">6.20</a></li>
					<li><a href="/6_21/">6.21</a></li>
					<li><a href="/6_31/">6.31</a></li>
					<li><a href="/6_32/">6.32</a></li>
					<li><a href="/6_34/">6.34</a></li>
				</ul>				
			</div>
			<div class="searchForm">
				<p>Titles used for 2 or more movies.</p>
			</div>

			<?php
                                    $db->query("SELECT title, COUNT(title)
                                                FROM Movies
                                                GROUP BY title
                                                HAVING COUNT(title) > 1");

                                    $searchResult = $db->getAssocResult();

                                    if(count($searchResult) > 0) {

                                            echo "<table class='resultTable'>";
                                            echo "<thead>";
                                            echo "<tr>";
                                            echo "<td>Name</td>";
                                            echo "</tr>";
                                            echo "</thead>";
					    echo "<tbody>";
                                        
                                            foreach($searchResult as $result) {

                                                    echo "<tr>";
                                                    echo "<td>" . $r[0] . "</td>";
                                                    echo "</tr>";

                                            }

                                            echo "</tbody>";
                                            echo "</table>";

                                    }
                                    else {

                                            echo "<p>No results found!</p>"; 

                                    }

			?>
		</div>
    </body>
</html>
