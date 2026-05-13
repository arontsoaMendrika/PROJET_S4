<?php
$text = "Votre Prescription Ã‰lÃ©gante";
$fixed = mb_convert_encoding($text, 'Windows-1252', 'UTF-8');
echo $fixed;