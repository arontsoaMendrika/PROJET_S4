<?php
// Function to convert a file to UTF-8 without BOM if it's not already
function to_utf8($file) {
    if (!file_exists($file)) return;
    $content = file_get_contents($file);
    if ($content === false) return;

    // Check if the current content is valid UTF-8
    $is_utf8 = preg_match('//u', $content);

    // If it's valid UTF-8, make sure it has no BOM
    if ($is_utf8) {
        if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
            $content = substr($content, 3);
            file_put_contents($file, $content);
            echo "Removed BOM from: $file\n";
        }
        return; // Already UTF-8
    }

    // If not UTF-8, assume it's Windows-1252 / ISO-8859-1
    $content_utf8 = mb_convert_encoding($content, 'UTF-8', 'Windows-1252');
    if ($content_utf8 !== false) {
        file_put_contents($file, $content_utf8);
        echo "Converted to UTF-8: $file\n";
    }
}

function process_dir($dir) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php', 'html', 'css', 'js', 'md', 'sql'])) {
            to_utf8($file->getRealPath());
        }
    }
}

process_dir('app');
process_dir('includes');
process_dir('public');
process_dir('system');
process_dir('tests');
to_utf8('index.php');
to_utf8('spark');
to_utf8('schema_regimes.sql');
to_utf8('schema.sql');