<?php
/**
 * Don't let the machines win. You are humanity's last hope...
 **/

fscanf(STDIN, "%d", $mapWidth);
fscanf(STDIN, "%d", $mapHeight);

// Create the map
$map = null;
for ($y = 0; $y < $mapHeight; $y++) {
    $line = stream_get_line(STDIN, 31 + 1, "\n");
    for ($x = 0; $x < $mapWidth; $x++) {
        if (!isset($map[$x])) {
            $map[$x] = null;
        }
        $map[$x][$y] = ($line[$x] == '0' ? true : false);
    }
}

for ($x = 0; $x < $mapWidth; $x++) {
    for ($y = 0; $y < $mapHeight; $y++) {
        if ($map[$x][$y] === false) {
            // Skip empty nodes
            continue;
        }
        
        // Coordinates of this node
        echo "$x $y ";
        
        // Coordinates of the closes neighbour on the right of the node
        $hasRightHandNeighbour = false;
        for ($xr = $x + 1; $xr < $mapWidth; $xr++) {
            if ($map[$xr][$y]) {
                $hasRightHandNeighbour = true;
                echo "$xr $y ";
                break;
            }
        }
        if (!$hasRightHandNeighbour) {
            echo "-1 -1 ";
        }
        
        // Coordinates of the closes bottom neighbour
        $hasBottomNeighbour = false;
        for ($yb = $y + 1; $yb < $mapHeight; $yb++) {
            if ($map[$x][$yb]) {
                $hasBottomNeighbour = true;
                echo "$x $yb\n";
                break;
            }
        }
        if (!$hasBottomNeighbour) {
            echo "-1 -1\n";
        }
    }
}
