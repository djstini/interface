<?php
header("X-Robots-Tag: noindex, nofollow", true); 
header('Content-Type: application/json; charset=utf-8');


$output_disk = array();
exec('df -h | grep dev/md127 | awk \'{print "{size: "$2", used: "$3", available: "$4", percentage: "$5", },"}\'', $output_disk);

$output_top = array();
exec('mpstat -u -P ALL 1 1 | awk \'
	NR == 1 {next}
	NR == 2 {next}
	NR == 3 {next}
	NR > 20 {next}
        {sum[$2] += $3; sum[$2] += $4; sum[$2] += $5;}
	END { for (i in sum) {
            print "{ core: "i", usage: "sum[i]", },"}
        }
\' | sort -nk1', $output_top);

$output_temp = array();
exec('sensors | grep -E "Core|Sensor" | awk \'{print "{ core: "$1" "$2", temp: "$3", },"} \'', $output_temp);

?>
{
disk: [
    <?php
    foreach($output_disk as $line){ 
        echo $line;
    }
    ?>
],
top: [
    <?php
    foreach($output_top as $line){ 
            echo $line;
        }
    ?>
],
temps: [
    <?php
    foreach($output_temp as $line){ 
            echo $line;
        }
    ?>    
],
}
