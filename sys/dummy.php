<?php
    


       
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $db = new PDO("mysql:host=localhost;dbname=db_cars", "root", "");
                $SQL = "SELECT * FROM model WHERE brand_id = ?;";
                $prep = $db->prepare($SQL);
                $prep->execute([$id]);
                $res = $prep->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($res);
            ?>
      
               

