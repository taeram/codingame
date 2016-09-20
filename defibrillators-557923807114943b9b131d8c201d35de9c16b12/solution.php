<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%s", $userLongitude);
fscanf(STDIN, "%s", $userLatitude);
fscanf(STDIN, "%d", $numberOfDefibrillators);

// The decimal numbers use the comma ',' as decimal separator. Convert this to a '.'
$userLongitude = str_replace(',', '.', $userLongitude);
$userLatitude = str_replace(',', '.', $userLatitude);

$closestDefibrillator = null;
$minDistanceToDefibrillator = PHP_INT_MAX;
for ($i = 0; $i < $numberOfDefibrillators; $i++) {
    $line = stream_get_line(STDIN, 256 + 1, "\n");
    list($id, $name, $address, $contactPhoneNumber, $longitude, $latitude) = explode(';', $line);
    
    // The decimal numbers use the comma ',' as decimal separator. Convert this to a '.'
    $longitude = str_replace(',', '.', $longitude);
    $latitude = str_replace(',', '.', $latitude);
    
    $distanceX = ($userLongitude - $longitude) * cos(($latitude + $userLatitude) / 2);
    $distanceY = ($userLatitude - $latitude);
    $distanceToDefibrillator = sqrt(pow($distanceX, 2) + pow($distanceY, 2)) * 6371;
    
    if ($distanceToDefibrillator < $minDistanceToDefibrillator) {
        $minDistanceToDefibrillator = $distanceToDefibrillator;
        $closestDefibrillator = $name;
    }
}

echo ("$closestDefibrillator\n");
