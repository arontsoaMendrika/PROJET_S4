<?php
function fix_mojibake($content) {
    // Level 2 Mojibake (Double encoded)
    $replacements_l2 = [
        'Ãƒâ€°' => 'É',
        'ÃƒÂ©' => 'é',
        'ÃƒÂ¨' => 'è',
        'ÃƒÂª' => 'ê',
        'ÃƒÂ«' => 'ë',
        'ÃƒÂ'  => 'à',
        'ÃƒÂ¢' => 'â',
        'ÃƒÂ§' => 'ç',
        'ÃƒÂ´' => 'ô',
        'ÃƒÂ®' => 'î',
        'ÃƒÂ¯' => 'ï',
        'ÃƒÂ»' => 'û',
        'ÃƒÂ¹' => 'ù',
        'Ã¢â‚¬â„¢' => "'",
        'Ã¢â‚¬â€œ' => '—', // em dash
        // some may appear slightly differently due to windows-1252 weirdness, let's also fix single level:
        'Ã‰' => 'É',
        'Ã©' => 'é',
        'Ã¨' => 'è',
        'Ãª' => 'ê',
        'Ã«' => 'ë',
        'Ã ' => 'à', // A grave is Ã followed by non-breaking space (0xA0) or just raw bytes
        "Ã\xA0" => 'à',
        'Ã¢' => 'â',
        'Ã§' => 'ç',
        'Ã´' => 'ô',
        'Ã®' => 'î',
        'Ã¯' => 'ï',
        'Ã»' => 'û',
        'Ã¹' => 'ù',
        'â€™' => "'",
        'â€”' => '—'
    ];

    foreach ($replacements_l2 as $bad => $good) {
        $content = str_replace($bad, $good, $content);
    }
    return $content;
}

function scan_and_fix($dir) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($files as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php', 'html', 'css', 'js', 'md', 'sql'])) {
            $path = $file->getRealPath();
            $content = file_get_contents($path);
            $fixed = fix_mojibake($content);
            if ($fixed !== $content) {
                file_put_contents($path, $fixed);
                echo "Fixed text in: $path\n";
            }
        }
    }
}
scan_and_fix('app');
scan_and_fix('includes');