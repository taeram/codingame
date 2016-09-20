<?php
$usedBoost = false;
while (TRUE)
{
    fscanf(STDIN, "%d %d %d %d %d %d",
        $x,
        $y,
        $nextCheckpointX, // x position of the next check point
        $nextCheckpointY, // y position of the next check point
        $nextCheckpointDist, // distance to the next checkpoint
        $nextCheckpointAngle // angle between your pod orientation and the direction of the next checkpoint
    );
    fscanf(STDIN, "%d %d",
        $opponentX,
        $opponentY
    );
    
    if ($nextCheckpointDist < 2000) {
        $thrust = 50;
    } else if ($nextCheckpointDist < 1000) {
        $thrust = 0;
    } else if ($nextCheckpointAngle > 90 or $nextCheckpointAngle < -90) {
        $thrust = 0;
    } else if ($nextCheckpointAngle > 45 or $nextCheckpointAngle < -45) {
        $thrust = 80;
    } else if (!$usedBoost && $nextCheckpointDist > 1500 && ($nextCheckpointAngle < 10 && $nextCheckpointAngle > -10)) {
        $thrust = 'BOOST';
        $usedBoost = true;
    } else {
        $thrust = 100;
    }


    echo ($nextCheckpointX . " " . $nextCheckpointY . " $thrust\n");
}
