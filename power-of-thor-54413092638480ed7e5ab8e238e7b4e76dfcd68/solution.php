<?php
fscanf(STDIN, "%d %d %d %d",
    $lightX, // the X position of the light of power
    $lightY, // the Y position of the light of power
    $initialThorX, // Thor's starting X position
    $initialThorY // Thor's starting Y position
);

$thorX = $initialThorX;
$thorY = $initialThorY;

while (TRUE)
{
    fscanf(STDIN, "%d",
        $remainingTurns // The remaining amount of turns Thor can move. Do not remove this line.
    );


    $deltaX = $thorX - $lightX;
    $deltaY = $thorY - $lightY;
    $degreesToGoal = abs(atan2($deltaY, $deltaX) * (180 / M_PI) - 180);
    
    if ($degreesToGoal > 315 || $degreesToGoal == 0) {
        $direction = "E";
        $thorX++;
    } else if ($degreesToGoal > 0 && $degreesToGoal <= 45) {
        $direction = "NE";
        $thorX++;
        $thorY--;
    } else if ($degreesToGoal > 45 && $degreesToGoal <= 90) {
        $direction = "N";
        $thorY++;
    } else if ($degreesToGoal > 90 && $degreesToGoal <= 135) {
        $direction = "NW";
        $thorX--;
        $thorY--;
    } else if ($degreesToGoal > 135 && $degreesToGoal <= 180) {
        $direction = "W";
        $thorX--;
    } else if ($degreesToGoal > 180 && $degreesToGoal <= 225) {
        $direction = "SW";
        $thorX--;
        $thorY++;
    } else if ($degreesToGoal > 225 && $degreesToGoal <= 270) {
        $direction = "S";
        $thorY++;
    } else if ($degreesToGoal > 270 && $degreesToGoal <= 315) {
        $direction = "SE";
        $thorX++;
        $thorY++;
    }

    // error_log(var_export(array(
    //     'thor_x' => $thorX,
    //     'thor_y' => $thorY,
    //     'degrees_to_goal' => $degreesToGoal,
    //     'direction' => $direction
    //     )
    //     , true)
    // );
    
    // A single line providing the move to be made: N NE E SE S SW W or NW
    echo("$direction\n");
}
