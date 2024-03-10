<?php header("X-Robots-Tag: noindex, nofollow", true); ?>

<head>
	<style>
		table{
			border-collapse: collapse;	
		}
		table, th, td {
  			border: 1px solid;
			padding: 5px;
			width: 300px;
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

		h2{
			width: 100%;
			border-bottom: 1px solid;
		}
		.no-decoration{
			color: #000;
			text-decoration: none;
		}

		.usage-container{
			display: flex;
			flex-direction: row;
			column-gap: 1em;
		}

		.usage-container>div {
			min-width: 300px;
		}

		.usage-graphic-container{
			display:flex;
			background: #DDD888;
			border: 1px solid;
			padding: 1em;
			height: min-content;
		}

		.usage-graphic{
			background: #DDD888;
		}
		
		.usage-svg-labels{
			display:flex;
			flex-direction: column;
			height: 300px;
		}

		.usage-svg-labels span {
  			display: flex;
  			align-items: center;
			justify-content: center;
			border: 1px solid;
			background-color: #88ddd8;
			padding-left: 1em;
			padding-right: 1em;
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

<h1><a class="no-decoration" href="/">INTERFACE</a></h1>

<div>
<p>Oh hi there!, if you've just stumbled across this then welcome. This is just some private ressource logging of one of my servers.. Soo umm maybe check out my website or sth. <a href="https://dennis-stinauer.de">dennis-stinauer.de</a></p>
</div>

<div>
<h2>DISK SPACE</h2>
<table class="disk-table"><tr><th>SIZE</th><th>USED</th><th>Avail</th><th>Use%</th></tr>
</table>
</div>

<div>
	<h2>PROCESSOR USAGE</h2>
	<div class="usage-container">
		<table class="usage-table">
		<tr><th>CORE (all is the avg across all cores)</th><th>USAGE in %</th></tr>
		</table>
		<div class="usage-graphic-container">
			<svg class="usage-graphic" height="300" width="500" xmlns="http://www.w3.org/2000/svg">
			</svg>
			<div class="usage-svg-labels"></div>
		</div>
	</div>
</div>

<div>
<h2>Temperatures in C</h2>
<table class="temperature-table">
</table>
</div>
