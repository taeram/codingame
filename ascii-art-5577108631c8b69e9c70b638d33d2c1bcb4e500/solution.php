<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d", $letterWidth);
fscanf(STDIN, "%d", $letterHeight);
$letters = stream_get_line(STDIN, 256 + 1, "\n");

for ($i = 0; $i < $letterHeight; $i++) {
    $row = stream_get_line(STDIN, 1024 + 1, "\n");
    
    for ($j = 0; $j < strlen($letters); $j++) {
        $letter = strtolower($letters[$j]);
        $letterIndex = ord($letter) - ord('a');
        
        // The characters that are not in the intervals [a-z] or [A-Z] will be shown as a question mark in ASCII art.
        if ($letterIndex < 0 || $letterIndex > 26) {
            $letter = "?";
            $letterIndex = 26;
        }
        
        $letterStart = $letterWidth * $letterIndex;
        
        echo(substr($row, $letterStart, $letterWidth));
    }
    
    echo "\n";
}
