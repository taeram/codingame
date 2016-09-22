<?php
fscanf(STDIN, "%d %d %d %d %d %d %d %d",
    $numFloors, // number of floors
    $areaWidth, // width of the area
    $numRounds, // maximum number of rounds
    $exitFloor, // floor on which the exit is found
    $exitPosition, // position of the exit on its floor
    $totalNumClones, // number of generated clones
    $numAdditionalElevators, // ignore (always zero)
    $numElevators // number of elevators
);

$goals = null;
$goals[$exitFloor] = $exitPosition;

for ($i = 0; $i < $numElevators; $i++)
{
    fscanf(STDIN, "%d %d",
        $elevatorFloor, // floor on which this elevator is found
        $elevatorPosition // position of the elevator on its floor
    );
    $goals[$elevatorFloor] = $elevatorPosition;
}

while (true) {
    fscanf(STDIN, "%d %d %s",
        $cloneFloor, // floor of the leading clone
        $clonePos, // position of the leading clone on its floor
        $direction // direction of the leading clone: LEFT or RIGHT
    );

    $action = null;
    if ($clonePos == 0 || $clonePos == $areaWidth - 1) {
        $action = 'BLOCK';
    } else if (isset($goals[$cloneFloor])){
        if ($direction == 'LEFT' && $goals[$cloneFloor] > $clonePos ||
            $direction == 'RIGHT' && $goals[$cloneFloor] < $clonePos)
        {
            $action = 'BLOCK';
        }
    }

    if (!$action) {
        $action = 'WAIT';
    }

    echo("$action\n");
}
