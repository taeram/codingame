<?php

fscanf(STDIN, "%d",
    $N // Number of elements which make up the association table.
);

fscanf(STDIN, "%d",
    $Q // Number Q of file names to be analyzed.
);

$mimeTypes = null;
for ($i = 0; $i < $N; $i++) {
    fscanf(STDIN, "%s %s",
        $ext, // file extension
        $mimeType // MIME type.
    );
    $ext = strtolower($ext);
    $mimeTypes[$ext] = $mimeType;
}

for ($i = 0; $i < $Q; $i++) {
    $fileName = stream_get_line(STDIN, 500 + 1, "\n"); // One file name per line.
    $fileExt = substr($fileName, strrpos($fileName, '.') + 1);
    $fileExt = strtolower($fileExt);
    
    if (isset($mimeTypes[$fileExt])) {
        echo $mimeTypes[$fileExt] . "\n";
    } else {
        echo "UNKNOWN\n";
    }
}

