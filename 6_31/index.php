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
        <title>6.31</title>
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
				<p>Select a movie studio and year to find the relevant movies.</p>
				<form action="index.php" method="post">

					<select name="studio">
						<option value="">Select a studio...</option>

						<?php

							$db->query("SELECT DISTINCT name FROM Studio");

							$studios = $db->getAssocResult();

							foreach($studios as $studio) {

								echo "<option value='" . $studio["name"] . "'>" . $studio["name"] . "</option>\n";

							}

						?>

					</select>

					<input type="submit" value="Search"/>

				</form>
			</div>

			<?php

				$selectedStudio = $_POST["studio"];
				
				if(strlen($selectedStudio) > 0) {
					$db->query("SELECT studioName, SUM(length) 
								FROM Movies 
								WHERE studioName='" . $selectedStudio . "'");

					$searchResult = $db->getAssocResult();

					if(count($searchResult) > 0) {

						echo "<table class='resultTable'>";
						echo "<thead>";
						echo "<tr>";
						echO "<td>Studio Name</td>";
						echo "<td>Sum of all movie lengths (minutes)</td>";
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
