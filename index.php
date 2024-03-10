<?php header("X-Robots-Tag: noindex, nofollow", true); ?>

<head>
	<style>
		table{
			border-collapse: collapse;	
		}
		table, th, td {
  			border: 1px solid;
			padding: 5px;
			width: 100%;
		}
		th{
			background: #88ddd8;
		}
		td{
			background: #ddd888;
		}
		body{
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			row-gap: 20px;
		}
		div{
			padding: 10px;
			width: 300px;
			border: 1px solid;
			background: #cacaca;
			border-radius: 5px;
		}
		h2{
			width: 100%;
			border-bottom: 1px solid;
		}
		.no-decoration{
			color: #000;
			text-decoration: none;
		}
		@media screen and (max-width: 1230px){
			body, p, table, td, th{
				font-size: 35px;			
			}
			div{
				width: 90% !important;
			}		
		}
	</style>
	<script>
		let RESTURL = "<?php echo "https://" . $_SERVER['SERVER_NAME'] . "/rest.php"; ?>";
	</script>
	<script src="/jquery.min.js"></script>
	<script src="/data.js"></script>
</head>

<?php

$output_disk = array();
exec('df -h | grep dev/md127 | awk \'{print "<tr><td>"$2"</td><td>"$3"</td><td>"$4"</td><td>"$5"</td></tr>"}\'', $output_disk);

$output_top = array();
exec('mpstat -u -P ALL 1 1 | awk \'
	NR == 1 {next}
	NR == 2 {next}
	NR == 3 {next}
	NR > 20 {next}
        {sum[$2] += $3; sum[$2] += $4; sum[$2] += $5;}
	END { for (i in sum) {
            print "<tr><td>"i"</td><td>"sum[i]"</td></tr>"}
        }
\' | sort -nk1', $output_top);

$output_temp = array();
exec('sensors | grep -E "Core|Sensor" | awk \'{print "<tr><td>"$1" "$2"</td><td>"$3"</td></tr>"} \'', $output_temp);

?>
<h1><a class="no-decoration" href="/">INTERFACE</a></h1>

<div>
<p>Oh hi there!, if you've just stumbled across this then welcome. This is just some private ressource logging of one of my servers.. Soo umm maybe check out my website or sth. <a href="https://dennis-stinauer.de">dennis-stinauer.de</a></p>
</div>

<div>
<h2>DISK SPACE</h2>
<table><tr><th>SIZE</th><th>USED</th><th>Avail</th><th>Use%</th></tr>
<?php
foreach($output_disk as $line){ 
      echo $line;
}
?>
</table>
</div>

<div>
<h2>PROCESSOR USAGE</h2>
<table>
<tr><th>CORE (all is the avg across all cores)</th><th>USAGE in %</th></tr>
<?php
foreach($output_top as $line){ 
        echo $line;
    }
?>
</table>
</div>


<div>
<h2>Temperatures in C</h2>
<table>
<?php
foreach($output_temp as $line){ 
        echo $line;
    }
?>
</table>
</div>
