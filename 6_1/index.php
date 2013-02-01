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
        <!-- NICE LABEL --->
        <form action="index.php" method="post">
            <label for="studio">Studio:</label>
            <select name="studio">
                <option value="">Select a studio...</option>
                
                <?php
                
                    $db->query("SELECT DISTINCT name FROM Studio");
                    
                    $studios = $db->getAssocResult();
                    
                    foreach($studios as $studio) {
                        
                        echo "<option value='" . $studio["name"] . "'>" . $studio["name"] . "</option>";
                    
                    }
                
                ?>
                
            </select>
            
        </form>
        
        <?php
            
            
            
            
            
            $db->query("SELECT * FROM Movies");
            
            echo "<pre>";
            print_r($db->getAssocResult());
            echo "</pre>";
            
        ?>
    </body>
</html>
