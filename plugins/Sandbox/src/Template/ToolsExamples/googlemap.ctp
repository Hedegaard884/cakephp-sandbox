<h2>GoogleMap</h2>
Using the GoogleMapV3 to output a map with pins.

<h3>Data</h3>
<?php
	$data = [
		['name' => 'One', 'lat' => 48.69847, 'lng' => 10.9514, 'role' => 'admin'],
		['name' => 'Two', 'lat' => 47.69847, 'lng' => 11.9514, 'role' => 'user'],
		['name' => 'Three', 'lat' => 47.19847, 'lng' => 11.1514, 'role' => 'user'],
	];
?>

<h3>Example map</h3>
<?php
	$options = [
		'autoScript' => true,
		'zoom' => 6,
		'type' => 'R',
		'geolocate' => true,
		'div' => ['id' => 'someothers'],
		'map' => [
			'navOptions' => ['style' => 'SMALL'],
			'typeOptions' => ['style' => 'HORIZONTAL_BAR', 'pos' => 'RIGHT_CENTER']]
	];
	$result = $this->GoogleMapV3->map($options);
	foreach ($data as $row) {
		$options = [
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'title' => $row['name'],
			'content' => 'User <b>' . $row['name'] . '</b><br />Some <i>info</i>'
		];
		if ($row['role'] === 'admin') {
			$options['icon'] = $this->GoogleMapV3->iconSet('green', 'A');
		}
		$this->GoogleMapV3->addMarker($options);
	}
	$result .= $this->GoogleMapV3->script();
	echo $result;

