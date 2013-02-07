<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/include/classes/Database.class.php");
    
    $db = new Database("db453524503");
    $db->connect();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
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
			
			<select name="year">
				<option value="">Select a year...</option>
				<?php
				
					$db->query("SELECT DISTINCT year FROM Movies ORDER BY year ASC");
					
					$years = $db->getAssocResult();
					
					foreach($years as $year) {
						
						echo "<option value='" . $year["year"] . "'>" . $year["year"] . "</option>\n";
						
					}
					
				?>				
			</select>
			
			<input type="submit" value="Search"/>
            
        </form>
        
        <?php
            			
			$selectedStudio = $_POST["studio"];
			$selectedYear	= $_POST["year"];
			
            $db->query("SELECT * FROM Movies WHERE studioName='" . $selectedStudio . "' AND year=" . $selectedYear);
            
			$searchResult = $db->getAssocResult();
			
			
			echo "<table>";
			echo "<thead>";
			echo "<tr>";
			echO "<td>Title</td>";
			echo "<td>Year</td>";
			echo "<td>Length</td>";
			echo "<td>Genre</td>";
			echo "<td>Studio Name</td>";
			echo "<td>Producer C#</td>";
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
			
            echo "<pre>";
            print_r($searchResult);
            echo "</pre>";
            
        ?>
    </body>
</html>
