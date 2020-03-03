<?php include 'style.php'; ?>
       
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Mini App</title>
    </head>
    <body>
        <div>
            <form action="/index.php" method = "post">
                <input type="text" id="fname" name="fname" placeholder="Search For A File"><br><br>
                <input type="submit" value="Submit" >
            </form>
        </div>
            <br>    
            <br>
        <div>
            <h1>CSV Into Associative Array</h1>
            <br>
            <br>
            <?php $fname = $_POST ["fname"];                                                    // getting input text
                    $ext = pathinfo($fname, PATHINFO_EXTENSION);                                // geting extension of the file 
                        if($ext == 'csv'){                                                      // checking if it is a CSV file
                            $csv = [];                                                          // creating associative array
                                if (($handle = fopen($fname, "r")) !== false) {                 // open for reading
                                    if (($data = fgetcsv($handle, 1000, ",")) !== false) {      // extract header data
                                        $keys = $data;                                          // save as keys
                                    }
                                while (($data = fgetcsv($handle, 1000, ",")) !== false) {       // loop remaining rows of data
                                    $csv[] = array_combine($keys, $data);                       // push associative subarrays
                                    }
                                fclose($handle);                                                // close when done
                                    }
                            }
                    function build_table($csv){                                                 // creating a function to put data into a table
                        $html .= '<table>';
                        $html .= '<tr>';
                            foreach($csv[0] as $key=>$value){                                   // going through data base to get indexes
                                $html .='<th>' . htmlspecialchars($key) . '</th>';              
                            }
                        $html .= '</tr>';
                            foreach($csv as $key=>$value){                                      // 
                                $html .= '<tr>';
                            foreach($value as $key2=>$value2){
                                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                            }
                        $html .='</tr>';
                            }
                        $html .= '</table>';
                        return $html;
                    }
                    echo build_table($csv);
                    ?>
        </div>
            <br>
            <br>
        <div>
            <h1>XML Into Associative Array</h1>
            <br>
            <br>
            <?php 
            if ($ext == "xml"){
                $ob = simplexml_load_file($fname);
                $json = json_encode($ob);
                $array = json_decode($json, true);       
            }        
            foreach ($array as $arrays){
                echo "<table>" ;               
                echo "<tr>";
            foreach ($arrays[0] as $vardas => $pavarde){
                echo "<th>" . $vardas .  "</th>";
            }
                echo "</tr>";
            foreach ($arrays as $vardas=>$turinys){
                echo "<tr>";
            foreach($turinys as $vardas2=>$pavarde2){
                echo "<td>" . $pavarde2 . "</td>";
            }
                echo "</tr>";
            }
                echo "</table>";
            }
            ?>
            <br>
            <br>
        <div>
            <h1>JSON Into Associative Array</h1>
            <br>
            <br>
            <?php
            if ($ext == 'json'){
                $jsonobj = file_get_contents($fname);
                $jsonobj = json_decode($jsonobj, true);
                    echo "<pre>";
                    echo '<table>'; 
                    echo '<tr>';
                foreach($jsonobj[0] as $key=>$values){
                    echo '<th>'. $key.'</th>';
                    
                }
                    echo '</tr>';
                foreach($jsonobj as $key=>$value){
                    echo '<tr>';
                foreach($value as $keys2=>$values2)
                    echo '<td>' . $values2. '</td>';
                }
                    echo '</tr>';
            }
                    
            ?>
        </div>
    </body>
</html>

