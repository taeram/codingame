<?php
$map = null;
$previousY = null;
$destination = null;;
fscanf(STDIN, "%d", $numSurfacePoints);
for ($i = 0; $i < $numSurfacePoints; $i++) {
    fscanf(STDIN, "%d %d",
        $landX, // X coordinate of a surface point. (0 to 6999)
        $landY // Y coordinate of a surface point. By linking all the points together in a sequential fashion, you form the surface of Mars.
    );
    $map[] = array(
        'x' => $landX,
        'y' => $landY
    );

    if ($landY == $previousY) {
        $leftX = $map[count($map) - 2]['x'];
        $rightX = $landX;
        $destination = array(
            'x' => (($rightX - $leftX) / 2 + $leftX),
            'y' => $landY
        );
    }
    $previousY = $landY;
}

if (!$destination) {
    throw new \Exception("Could not find lander destination");
}

$distanceToDestination = null;
$distanceToDestinationRemaining = null;
$gravity = 3.711; // meters / second
$maxVerticalSpeed = 40; // meters / second
$maxHorizontalSpeed = 20; // meters / second
while (true) {
    fscanf(STDIN, "%d %d %d %d %d %d %d",
        $x,
        $y,
        $horizontalSpeed, // the horizontal speed (in m/s), can be negative.
        $verticalSpeed, // the vertical speed (in m/s), can be negative.
        $fuel, // the quantity of remaining fuel in liters.
        $rotation, // the rotation angle in degrees (-90 to 90).
        $power // the thrust power (0 to 4).
    );

    // Set the power
    if (abs($verticalSpeed) > ($maxVerticalSpeed - 1)) {
        $power = 4;
    } else {
        $power = 0;
    }

    // How far to the destination?
    $distanceToDestinationRemaining = abs($x - $destination['x']);
    if (!$distanceToDestination) {
        $distanceToDestination = $distanceToDestinationRemaining;
    }

    $rotateRight = false;
    if ($x - $destination['x'] > 0) {
        $rotateRight = true;
    }

    $isHalfwayPoint = ($distanceToDestinationRemaining <= $distanceToDestination / 2);
    if ($isHalfwayPoint) {
        $rotateRight = !$rotateRight;
    }

    if ($distanceToDestinationRemaining < 250) {
        $angleModifier = 1;
    } else if ($distanceToDestinationRemaining < 1000) {
        $angleModifier = .25;
    } else {
        $angleModifier = .5;
    }

    $rotation = floor(($rotateRight ? 1 : -1) * $angleModifier * 90);

    error_log(print_r(array(
        'distance_to_destination' => $distanceToDestinationRemaining,
        'angle_modifier' => $angleModifier,
        'rotate_right' => $rotateRight,
        'is_halfway_pont' => $isHalfwayPoint
    ), true));

    echo("$rotation $power\n");
}
