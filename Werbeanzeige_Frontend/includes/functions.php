<?php
# nested functions #############
function in_array_r_two_dim($needle, $haystack, $strict = false) {
    foreach ($haystack as $item):
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))):
            return true;
        endif;
    endforeach;
    return false;
}


# rand img and storing curr showed pictures #############

function create_indices_arr($array){
    $arrayDataLenght = count($array) - 1;
    $arrayIndices = [];

    foreach($array as $index => $data):
        array_push($arrayIndices, $index);
    endforeach;
    return $arrayIndices;
};

function set_first_view($array){
    $currentView = [];
    $arrayLenght = count($array) - 1;
    

    for ($i = 0; $i < 4; $i++):
        $randNum = mt_rand(0, $arrayLenght);
        $currentView[$i] = $randNum;
        while(in_array($randNum, $currentView, true)):
            $randNum = mt_rand(0, $arrayLenght);   
        endwhile;
        $currentView[$i] = $randNum; 
    endfor;
    return $currentView;
};

function set_next_view($imageIndices, $currentView){
    $nextView = [];
    $reducedIndices = [];
    $arrayLenght = count($imageIndices) - 1;

    foreach($imageIndices as $index => $fileName):
        if(!in_array($index, $currentView)):
            array_push($reducedIndices, $index);
        endif;
    endforeach;
    print_r($reducedIndices);

    for ($i = 0; $i < 4; $i++):
        $randNum = mt_rand(0, $arrayLenght);
        //$nextView[$i] = $randNum;
        while(in_array($randNum, $nextView, true) || in_array($randNum, $currentView, true)):
            $randNum = mt_rand(0, $arrayLenght);                    
        endwhile;
        $nextView[$i] = $randNum;
    endfor;
    return $nextView;
};


########### Database access func ##################################################

function fetch_img_data($tableName){
    $array = [];

    try {

        $pdo = new PDO('mysql:host=localhost;dbname=database', 'user', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $meldung = 'Verbindung zur Datenbank erfolgreich.';
    
    } catch(PDOException $e) {
    
        die('Keine Verbindung zur Datenbank möglich.');
        
    }

    try {

        $sql = "SELECT * FROM $tableName";   
        $ergebnis = $pdo->query($sql);
    
        if ($ergebnis->rowCount() > 0) : 
    
            while ($zeile = $ergebnis->fetch()) :
                array_push($array, $zeile);
            endwhile;
    
        
        // Ergebnis freigeben
        unset($ergebnis);
       
        else : 
    
           echo "Keine passenden Einträge gefunden.";
           
        endif;
    
    } catch(PDOException $e) {
    
        // Nicht in Live-Website ausgeben!
        die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());
        
    }
     
    unset($pdo);

};




########### push function ##################################################

function push_curr_view($imageIndices, $currentView){
    
    try {
    
        $pdo = new PDO('mysql:host=localhost;dbname=database', 'user', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $meldung = 'Verbindung zur Datenbank erfolgreich.';
    
    } catch(PDOException $e) {
    
        die('Keine Verbindung zur Datenbank möglich.');
        
    }


    try{
    
        $sql = "CREATE TABLE IF NOT EXISTS curr_view  (
            id INT(11) NOT NULL AUTO_INCREMENT,
            dateiIndex VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
            )";   
                 
        $pdo->exec($sql);
    
    } catch(PDOException $e) {
        // Nicht in Live-Website ausgeben!
        die("FEHLER: Konnte folgenden Createbefehl nicht ausführen: $sql. " . $e->getMessage());
    
    }
    
    try {
    
        $sql = "SELECT * FROM curr_view";   
        $ergebnis = $pdo->query($sql);
        
        if ($ergebnis->rowCount() > 0) :
    
            $resultArr = $ergebnis->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultArr as $arrNum => $data):
                $currentView[$data["id"] - 1] = $data["dateiIndex"];
            endforeach;
            $currentView = set_next_view($imageIndices, $currentView);
    
            // Ergebnis freigeben
            // unset($ergebnis);
       
        else : 
    
            $currentView = set_first_view($imageIndices);
            echo "Keine passenden Einträge gefunden.";
           
        endif;
    
    } catch(PDOException $e) {
    
        // Nicht in Live-Website ausgeben!
        die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());
        
    }

    
    

    try {

        $sql = "SELECT * FROM curr_view"; 
        $ergebnis = $pdo->query($sql);
    
        foreach($currentView as $id => $viewIndex):
            $tableID = $id + 1;

            if ($ergebnis->rowCount() <= 4 && ($ergebnis->fetch() == NULL)) :

                    try {
        
                        $sql = "INSERT INTO curr_view 
                                (
                                    id, 
                                    dateiIndex
                                )
                                VALUES ($tableID, $viewIndex)";
                    
                        $pdo->exec($sql);
                    
                    } catch(PDOException $e) {
                    
                        // Nicht in Live-Website ausgeben!
                        die("FEHLER: Konnte folgenden Insertbefehl nicht ausführen: $sql. " . $e->getMessage());
                    
                    }
        
            else :
                try {
                        $sql = "UPDATE curr_view
                                SET dateiIndex = $viewIndex
                                WHERE id = $tableID";
                                
                    
                        $pdo->exec($sql);
                
                    } catch(PDOException $e) {
                
                    // Nicht in Live-Website ausgeben!
                    die("FEHLER: Konnte folgenden Updatebefehl nicht ausführen: $sql. " . $e->getMessage());
                
                }

            endif;
        endforeach;

    // Ergebnis freigeben
    unset($ergebnis);
    
    } catch(PDOException $e) {
    
        // Nicht in Live-Website ausgeben!
        die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());
        
    } 
     
    // Verbindung schliessen
    unset($pdo);

    return $currentView;
    };


?>
