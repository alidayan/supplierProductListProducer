<?php
    $files = getopt("", ["file:", "unique-combinations:"]);

    if (!isset($files["file"])) {
        echo "Please provide a CSV file with parameter file";
    } else if (!isset($files["unique-combinations"])) {
        echo "Please provide a file name to save unique combinations with parameter unique-combinations";
    } else {
        $datas = array_count_values(file(files["file"]));
        $i = 0;
        
        $fp = fopen(files["unique-combinations"], 'w');
        
        foreach($datas as $data => $value) {
            $data = str_replace("\",", "__|,", str_replace(",\"", "__|,", str_replace("\",\"", "__|,",substr($data, 1, -2))));
            $line = explode("__|,", $data);
            
            if($i === 0) {
                array_push($line, "count");
                $i++;
            } else {
                array_push($line, $value);
            }
            
            fputcsv($fp, $line);
            var_dump($line);
        }
        fclose($fp);
    }
?>
