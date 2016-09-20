<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $n // the number of temperatures to analyse
);
$temps = stream_get_line(STDIN, 256 + 1, "\n"); // the n temperatures expressed as integers ranging from -273 to 5526
error_log($temps);

if ($n == 0) {
    echo("0\n");
} else {
    $temps = explode(' ', $temps);
    sort($temps);
    
    $closestToZero = null;
    $closestToZeroValue = PHP_INT_MAX;
    for ($i = 0; $i < $n; $i++) {
        if (abs($temps[$i]) <= $closestToZeroValue) {
            if ($closestToZeroValue != null) {
                $closestToZero = null;
            }
            $closestToZeroValue = abs($temps[$i]);
            $closestToZero[] = $temps[$i];
        }
    }
}

sort($closestToZero);
echo($closestToZero[count($closestToZero) - 1] . "\n");
