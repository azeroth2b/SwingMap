<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Swing Map</title>

    <link href="https://fonts.googleapis.com/css?family=Wire+One" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <link rel="stylesheet" href="css/MarkerCluster.css" />
	<link rel="stylesheet" href="css/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

	<div id="map"></div>
	<div id="sidebar">
		<h2>Swing Map</h2>
		<p>Explore scenes and events by clicking on map markers!</p>
		<div id="test">
			<p>Test AirTable Connection:</p>
			<?php
				include("airTable/AirTable.php");
				$AT = new AirTable();
				$scenes = $AT->getScenes();
				foreach ($scenes['records'] as $s) {
					echo $s['fields']['Name'] . "<br/>";
				}
				// var_dump($scenes);

			?>
		</div>
		<div id="footer">
			[ Add your scene | About Us ]
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var bottomPadding = 0;
		var rightPadding = 0;
		if ($(window).width() < 700 && $(window).height() > 350) { bottomPadding = $('#sidebar').height()+30; }
		else { rightPadding = $('#sidebar').width()+30; }
	</script>
	<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
	<script src="js/leaflet.markercluster-src.js"></script>
	<script src="js/main.js" type="text/javascript"></script>

</body>

</html>