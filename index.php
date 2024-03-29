<?php header("X-Robots-Tag: noindex, nofollow", true); ?>

<head>
		<style>
		@font-face {
		  font-family: "Dotfont";
		  src: url("dotfont.ttf");
		}
		table{
			border-collapse: collapse;	
			width: 100%;
			min-width: 300px;
		}
		table, th, td {
  			border: 1px solid;
			padding: 5px;
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
background-color: #ddd888;
background-image:  linear-gradient(30deg, #888ddd 12%, transparent 12.5%, transparent 87%, #888ddd 87.5%, #888ddd), linear-gradient(150deg, #888ddd 12%, transparent 12.5%, transparent 87%, #888ddd 87.5%, #888ddd), linear-gradient(30deg, #888ddd 12%, transparent 12.5%, transparent 87%, #888ddd 87.5%, #888ddd), linear-gradient(150deg, #888ddd 12%, transparent 12.5%, transparent 87%, #888ddd 87.5%, #888ddd), linear-gradient(60deg, #888ddd77 25%, transparent 25.5%, transparent 75%, #888ddd77 75%, #888ddd77), linear-gradient(60deg, #888ddd77 25%, transparent 25.5%, transparent 75%, #888ddd77 75%, #888ddd77);
background-size: 44px 77px;
background-position: 0 0, 0 0, 22px 39px, 22px 39px, 0 0, 22px 39px;
font-family: "Dotfont", Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
}

		h2{
			width: 100%;
			border-bottom: 1px solid;
		}

		.info-wrapper{
			display: flex;
			flex-wrap: wrap;
			column-gap: 2em;
			row-gap: 2em;
		}

		.info-item{
			background: #fff;
			padding: 1em;
			border: 2px solid black;
			box-shadow: .2em .2em #535353;
			width: min-content;
			height: min-content;
			transform: scale(1);
			transition: 250ms;
			margin: 0;
		}

		h1{
			font-size: 80px;
			font-weight: bold;
			color: black;
			-webkit-text-fill-color: white;
			-webkit-text-stroke-width: 3px;
			-webkit-text-stroke-color: black;
		}

		.info-item:hover{
			transform: scale(1.1);
			z-index: 10000;
			box-shadow: .5em .5em black;
			margin: 2em;
		}

		.entry-text{
			background: #fff;
			padding: 1em;
			box-shadow: .2em .2em #535353;
			border: 2px solid #000;
		}

		.no-decoration{
			color: #000;
			text-decoration: none;
		}

		.usage-container{
			display: flex;
			flex-direction: row;
			column-gap: 1em;
			row-gap: 1em;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			width: 100%;
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

		@media screen and (max-width: 800px){
			.info-item:hover{
				margin: 2em 0 !important;
				transform: scale(1, 1.1) !important;
			}
		}
	</style>
	<script>
		let RESTURL = "<?php echo "https://" . $_SERVER['SERVER_NAME'] . "/rest.php"; ?>";
	</script>
	<script src="/jquery.min.js"></script>
	<script src="/data.js"></script>
</head>

<h1><a class="no-decoration header" href="/">INTERFACE</a></h1>

<div>
<p class="entry-text">Oh hi there!, if you've just stumbled across this then welcome. This is just some private ressource logging of one of my servers.. Soo umm maybe check out my website or sth. <a href="https://dennis-stinauer.de">dennis-stinauer.de</a></p>
</div>
<div class="info-wrapper">
	<div class="info-item">
	<h2>DISK SPACE</h2>
	<table class="disk-table"><tr><th>SIZE</th><th>USED</th><th>Avail</th><th>Use%</th></tr>
	</table>
	</div>

	<div class="info-item">
	<h2>PROCESSOR USAGE</h2>
	<div class="usage-container">
		<table class="usage-table">
		<tr><th>CORE (all is the avg across all cores)</th><th>USAGE in %</th></tr>
		</table>
	</div>
	</div>
	<div class="info-item">
	<h2>USAGE GRAPH</h2>	
	<div class="usage-graphic-container">
			<svg class="usage-graphic" height="300" width="500" xmlns="http://www.w3.org/2000/svg">
			</svg>
			<div class="usage-svg-labels"></div>
		</div>
	</div>
	<div class="info-item">
	<h2>Temperatures in C</h2>
	<table class="temperature-table">
	<tr><th>Sensor</th><th>Temperature</th></tr>
	</table>
	</div>
</div>
