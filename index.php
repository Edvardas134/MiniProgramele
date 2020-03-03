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
                            foreach($csv[0] as $key=>$value){                                   // going through data base to get key value pairs 
                                $html .='<th>' . htmlspecialchars($key) . '</th>';              
                            }
                        $html .= '</tr>';
                            foreach($csv as $key=>$value){                                      // looping through the array key value pairs
                                $html .= '<tr>';                                                // opening a tag for table
                            foreach($value as $key2=>$value2){                                  // looping through the values selected previously
                                $html .= '<td>' . htmlspecialchars($value2) . '</td>';          // printing the data
                            }
                        $html .='</tr>';
                            }
                        $html .= '</table>';
                        return $html;
                    }
                    echo build_table($csv);                                                     // echoing the table
                    ?>
        </div>
            <br>
            <br>
        <div>
            <h1>XML Into Associative Array</h1>
            <br>
            <br>
            <?php 
            if ($ext == "xml"){                                                                 // checking if the input file is XML
                $ob = simplexml_load_file($fname);                                              // assigning value to  $ob and loading the file
                $json = json_encode($ob);                                                       // encoding the file to json
                $array = json_decode($json, true);                                              // decoding the file to an array 
            }        
            foreach ($array as $arrays){                                                        // looping through the array seleting key value pair 
                echo "<table>" ;               
                echo "<tr>";
            foreach ($arrays[0] as $vardas => $pavarde){                                        // looping through the selected key value pairs to get indexes
                echo "<th>" . $vardas .  "</th>";
            }
                echo "</tr>";
            foreach ($arrays as $vardas=>$turinys){                                             // looping through the selected key value pairs 
                echo "<tr>";
            foreach($turinys as $vardas2=>$pavarde2){                                           // looping through the selected key value pairs to get the data
                echo "<td>" . $pavarde2 . "</td>";
            }
                echo "</tr>";
            }
                echo "</table>";
            }
            ?>
        </div>
            <br>
            <br>
        <div>
            <h1>JSON Into Associative Array</h1>
            <br>
            <br>
            <?php
            if ($ext == 'json'){                                                                // checking if the input file is XML
                $jsonobj = file_get_contents($fname);                                           // assigning value to  $ob and loading the file
                $jsonobj = json_decode($jsonobj, true);                                         // decoding the file to an array
                    echo "<pre>";
                    echo '<table>'; 
                    echo '<tr>';
                foreach($jsonobj[0] as $key=>$values){                                          // looping through the array to get indexes
                    echo '<th>'. $key.'</th>';
                    
                }
                    echo '</tr>';
                foreach($jsonobj as $key=>$value){                                              // looping through the array to select key and value pairs
                    echo '<tr>';
                foreach($value as $keys2=>$values2)                                             // looping through the selected key value pairs to get the data
                    echo '<td>' . $values2. '</td>';
                }
                    echo '</tr>';
            }
                    
            ?>
        </div>
    </body>
</html>

