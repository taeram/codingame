<?php
fscanf(STDIN, "%d %d",
    $buildingWidth, // width of the building.
    $buildingHeight // height of the building.
);
fscanf(STDIN, "%d",
    $maxTurns // maximum number of turns before game over.
);
fscanf(STDIN, "%d %d",
    $batmanX,
    $batmanY
);

$minX = 0;
$maxX = $buildingWidth - 1;
$minY = 0;
$maxY = $buildingHeight - 1;
while (true) {
    fscanf(STDIN, "%s",
        $bombDir // the direction of the bombs from batman's current location (U, UR, R, DR, D, DL, L or UL)
    );

    if (substr_count($bombDir, 'L')) {
        $maxX = $batmanX - 1;
    } else if (substr_count($bombDir, 'R')) {
        $minX = $batmanX + 1;
    } else {
        $minX = $maxX = $batmanX;
    }

    if (substr_count($bombDir, 'U')) {
        $maxY = $batmanY - 1;
    } else if (substr_count($bombDir, 'D')) {
        $minY = $batmanY + 1;
    } else {
        $minY = $maxY = $batmanY;
    }

    $batmanX = floor(($minX + $maxX) / 2);
    $batmanY = floor(($minY + $maxY) / 2);

    // the location of the next window Batman should jump to.
    echo("$batmanX $batmanY\n");
}
