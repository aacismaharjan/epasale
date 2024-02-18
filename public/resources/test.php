<?php
$filename = "example.txt";
$file = fopen($filename, "r+");

if ($file) {
    // Read from the file
    $content = fread($file, filesize($filename));
    echo "File Content: " . $content . "\n";

    // Write to the file
    fwrite($file, "Additional content.\n");
    
    // Move the pointer to the beginning for r+ mode
    fseek($file, 0);
    
    // Read again after writing
    $newContent = fread($file, filesize($filename));
    echo "Updated Content: " . $newContent;

    fclose($file);
} else {
    echo "Unable to open file!";
}

?>