<?php
    $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&appid=54cce0c729b20c5317d9f1149edc9faa&units=metric';
    // Get data from openweathermap and store in JSON object
    $data = file_get_contents($url);
    $json = json_decode($data, true);
    // Fetch required fields
    $weather_description = $json['weather'][0]['description'];
    $weather_temperature = $json['main']['temp'];
    $weather_wind = $json['wind']['speed'];          
    $weather_when = date("Y-m-d H:i:s"); // now
    $city = $json['name']; // name of city     
	$icon=$json['weather'][0]['icon'];
	$weather_pressure=$json['main']['pressure']; 
	$weather_humidity=$json['main']['humidity']; 
    $City_name=$json['name'];
    // Build INSERT SQL statement
    $sql_insert = "INSERT INTO weather (weather_description, weather_temperature, weather_wind, weather_when, city,icon,weather_pressure,weather_humidity,City_name)
    VALUES('{$weather_description}', {$weather_temperature}, {$weather_wind}, '{$weather_when}', '{$city}','{$icon}','{$weather_pressure}','{$weather_humidity}','{$City_name}')";
    // Run SQL statement and report errors
    if (!$mysqli -> query($sql_insert)) {
        echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
    }
?>