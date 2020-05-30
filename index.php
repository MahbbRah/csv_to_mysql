<?php

    require'conf/db.config.php';

    $file =  'TX_4.csv';
    $table =  'leads_data';
    $insertedResponse = DB::query('
    LOAD DATA LOCAL INFILE "'.$file.'" INTO TABLE '.$table.' FIELDS TERMINATED by \',\' LINES TERMINATED BY \'\n\'');

    var_dump($insertedResponse);

?>