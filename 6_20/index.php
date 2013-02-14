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
        <title>6.20</title>
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
				<p>Select a movie star to find the people that produced movies they were in.</p>
				<form action="index.php" method="post">

					<select name="starName">
						<option value="">Select a star...</option>

						<?php

							$db->query("SELECT DISTINCT starName FROM StarsIn");

							$studios = $db->getAssocResult();

							foreach($studios as $studio) {

								echo "<option value='" . $studio["starName"] . "'>" . $studio["starName"] . "</option>\n";

							}

						?>

					</select>

					<input type="submit" value="Search"/>

				</form>
			</div>

			<?php

				$selectedStar = $_POST["starName"];
				
				if(strlen($selectedStar) > 0) {
					$db->query("SELECT MovieExec.name
								FROM MovieExec
								INNER JOIN Movies
									ON MovieExec.`cert#` = Movies.`producerC#`
								INNER JOIN StarsIn
									ON Movies.title = StarsIn.movieTitle AND
									   StarsIn.starName='" . $selectedStar . "'");

					$searchResult = $db->getAssocResult();

					if(count($searchResult) > 0) {

						echo "<table class='resultTable'>";
						echo "<thead>";
						echo "<tr>";
						echO "<td>Movie Exec</td>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";

						foreach($searchResult as $result) {

							echo "<tr>";

							foreach($result as $r) {

								echo "<td>" . $r . "</td>";

							}

							echo "</tr>";


						}

						echo "</tbody>";
						echo "</table>";

					}
					else {
						
						echo "<p>No results found!</p>"; 
						
					}
					
				}
				else {
					
					echo "<p>No results found!</p>"; 
					
				}

			?>
		</div>
    </body>
</html>
