<?php
$message = stream_get_line(STDIN, 100 + 1, "\n");

$binary = null;
for ($i = 0; $i < strlen($message); $i++) {
    $letter = decbin(ord($message[$i]));
    if (strlen($letter) < 7) {
        $letter = str_pad($letter, 7, '0', STR_PAD_LEFT);
    }
    $binary .= $letter;
}

$previous = null;
for ($j = 0; $j < strlen($binary); $j++) {
    if ($previous === null || $previous != $binary[$j]) {
        if ($previous != null) {
            echo " ";
        }
        $previous = $binary[$j];
        
        if ($binary[$j] == 0) {
            echo "00 ";
        } else {
            echo "0 ";
        }
    }
    
    echo "0";
}
