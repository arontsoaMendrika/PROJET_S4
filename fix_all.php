<?php
function is_mojibake($content) {
    if (strpos($content, 'Ã') !== false) {
        // Double check it's not a legitimate portuguese word etc, but here it's French so Ã©Ã¨ etc are mojibake
        return true;
    }
    return false;
}

function scan_and_fix($dir) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    $count = 0;
    foreach ($files as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php', 'html', 'css', 'js', 'md', 'sql'])) {
            $path = $file->getRealPath();
            $content = file_get_contents($path);
            
            // Revert all rounds of mojibake
            $fixed = $content;
            
            while (strpos($fixed, 'Ãƒ') !== false) {
               $fixed = mb_convert_encoding($fixed, 'Windows-1252', 'UTF-8');
            }
            while (strpos($fixed, 'Ã') !== false) {
               // Make sure we are not stuck. If replacing fails, break
               $test = mb_convert_encoding($fixed, 'Windows-1252', 'UTF-8');
               if ($test === false || $test === $fixed) break;
               
               // Let's only do it if the output is valid utf-8
               if (!preg_match('//u', $test)) break;
               
               $fixed = $test;
            }
            
            if ($fixed !== $content) {
                file_put_contents($path, $fixed);
                echo "Fixed encoding in: $path\n";
                $count++;
            }
        }
    }
    echo "Fixed $count files in $dir\n";
}
scan_and_fix('app');
scan_and_fix('includes');
scan_and_fix('public');