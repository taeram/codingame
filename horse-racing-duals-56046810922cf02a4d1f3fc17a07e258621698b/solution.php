<?php
fscanf(STDIN, "%d", $numberOfHorses);

$strengths = null;
for ($i = 0; $i < $numberOfHorses; $i++) {
    fscanf(STDIN, "%d", $strength);
    $strengths[] = $strength;
}
sort($strengths);

$minDifference = PHP_INT_MAX;
for ($i=1; $i < count($strengths); $i++) {
    $difference = $strengths[$i] - $strengths[$i - 1];
    if ($difference < $minDifference) {
        $minDifference = $difference;
    }
}

echo "$minDifference\n";
