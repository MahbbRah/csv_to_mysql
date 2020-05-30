<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
//Create Connection
$connection = mysqli_connect("localhost", "root", "", "unlimited_leads");

// Check Connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

//Process form
if(isset($_POST["csv_upload_btn"])){
    if($_FILES['file']['name']){
        $filename = explode(".",$_FILES['file']['name']);
        $query = 'INSERT INTO leads_data(company,address,city,state,zip,county,phone,website,contact,title,direct_phone,email,sales,employees,sic_code,industry) VALUES ';
        $query_parts = array();
        // for($x=0; $x<count($column1); $x++){
        //     $query_parts[] = "('" . $column1[$x] . "', '" . $column2[$x] . "')";
        // }
        
        if($filename[1] == "csv"){
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            $countItems = 0;
            while($data = fgetcsv($handle)){

                $countItems += 1;

                //skip first row as this maybe header.
                if($countItems === 1) {
                    continue;
                }

                // $item1 = $data[0];
                // $item2 = $data[1];
                // $item3 = $data[2];
                // $item4 = $data[3];
                // $item5 = $data[4];
                // $item6 = $data[5];
                // $item7 = $data[6];
                // $item8 = $data[7];
                // $item9 = $data[8];
                // $item10 = $data[9];
                // $item11 = $data[10];
                // $item12 = $data[11];
                // $item13 = $data[12];
                // $item14 = $data[13];
                // $item15 = $data[14];
                // $item16 = $data[15];
                $item1 = mysqli_real_escape_string($connection, $data[0]);
                $item2 = mysqli_real_escape_string($connection, $data[1]);
                $item3 = mysqli_real_escape_string($connection, $data[2]);
                $item4 = mysqli_real_escape_string($connection, $data[3]);
                $item5 = mysqli_real_escape_string($connection, $data[4]);
                $item6 = mysqli_real_escape_string($connection, $data[5]);
                $item7 = mysqli_real_escape_string($connection, $data[6]);
                $item8 = mysqli_real_escape_string($connection, $data[7]);
                $item9 = mysqli_real_escape_string($connection, $data[8]);
                $item10 = mysqli_real_escape_string($connection, $data[9]);
                $item11 = mysqli_real_escape_string($connection, $data[10]);
                $item12 = mysqli_real_escape_string($connection, $data[11]);
                $item13 = mysqli_real_escape_string($connection, $data[12]);
                $item14 = mysqli_real_escape_string($connection, $data[13]);
                $item15 = mysqli_real_escape_string($connection, $data[14]);
                $item16 = mysqli_real_escape_string($connection, $data[15]);
                $query_parts[] = "('" . $item1. "', '" . $item2. "', '" . $item3. "', '" . $item4. "', '" . $item5. "', '" . $item6. "', '" . $item7. "', '" . $item8. "', '" . $item9. "', '" . $item10. "', '" . $item11 . "', '" . $item12 . "', '" . $item13 . "', '" . $item14 . "', '" . $item15 . "', '" . $item16 . "')";

                // $sql = "INSERT into leads_data(company,address,city,state,zip,county,phone,website,contact,title,direct_phone,email,sales,employees,sic_code,industry) 
                //             values('$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$item16')";
                // $run_query = mysqli_query($connection, $sql);
                
            }
            fclose($handle);
            $query .= implode(',', $query_parts);
            $run_query = mysqli_query($connection, $query) or trigger_error("Query Failed! SQL:  - Error: ".mysqli_error($connection), E_USER_ERROR);
            echo "total element found: $countItems ";
            if($run_query == true){
                echo "File Import Successful";
            }else{
                // echo "File Import Failed";
            }
        }
    }
}

//Close Connection
mysqli_close($connection);
?>