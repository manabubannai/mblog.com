<?php
header('Content-Type: text/plain');
echo 'DIR: ' . __DIR__ . "\n";
echo 'Expected config: ' . dirname(__DIR__, 2) . '/config.php' . "\n";
echo 'Exists: ' . (file_exists(dirname(__DIR__, 2) . '/config.php') ? 'YES' : 'NO') . "\n";
echo 'PHP: ' . PHP_VERSION . "\n";
