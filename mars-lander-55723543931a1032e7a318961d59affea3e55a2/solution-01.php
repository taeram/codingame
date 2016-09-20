<?php
fscanf(STDIN, "%d",
    $surfaceN // the number of points used to draw the surface of Mars.
);
for ($i = 0; $i < $surfaceN; $i++)
{
    fscanf(STDIN, "%d %d",
        $landX, // X coordinate of a surface point. (0 to 6999)
        $landY // Y coordinate of a surface point. By linking all the points together in a sequential fashion, you form the surface of Mars.
    );
}

$maxX = 7000;
$maxY = 3000;
$gravity = 3.711; // meters / second
$maxVerticalSpeed = 40; // meters / second
$maxHorizontalSpeed = 20; // meters / second

// game loop
while (TRUE)
{
    fscanf(STDIN, "%d %d %d %d %d %d %d",
        $X,
        $Y,
        $hSpeed, // the horizontal speed (in m/s), can be negative.
        $vSpeed, // the vertical speed (in m/s), can be negative.
        $fuel, // the quantity of remaining fuel in liters.
        $rotate, // the rotation angle in degrees (-90 to 90).
        $power // the thrust power (0 to 4).
    );

    
    error_log(print_r(array(
        'x' => $X,
        'y' => $Y,
        'x_speed' => $hSpeed,
        'y_speed' => $vSpeed,
        'fuel' => $fuel,
        'rotate' => $rotate,
        'power' => $power
    ), 1));
    
    if (abs($vSpeed) > $maxVerticalSpeed) {
        $power = 4;
    } else if (abs($vSpeed) > $maxVerticalSpeed / 2) {
        $power = 3;
    } else if (abs($vSpeed) > $maxVerticalSpeed / 3) {
        $power = 2;
    } else { 
        $power = 0;
    }
    
    // 2 integers: rotate power. rotate is the desired rotation angle (should be 0 for level 1), 
    // power is the desired thrust power (0 to 4).
    echo("$rotate $power\n");
}
?>
