<div class="container">
    <?php
        //require connection file
        require 'root_config.php';
        //select table name
        $table = 'devices';

        try{

            // create db
            $s="CREATE TABLE IF NOT EXISTS $table (
                ID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                RegNo VARCHAR(50) NOT NULL,
                SerialNo VARCHAR(255) NOT NULL UNIQUE KEY,
                Model VARCHAR(255) NOT NULL,
                Status INT(1) NOT NULL,
                Comment VARCHAR(255) NOT NULL,
                DATETIME TIMESTAMP NOT NULL 
            )";
            //use exec() because no results are returned
            $conn->exec($s);
            echo "TABLE $table CREATED SUCCESSFULLY"; 
            
                        
        }catch (PDOException $e){
            echo "Table Creation Failed: ".$e->getMessage();
        }
        $conn = null;
    ?>
</div>
