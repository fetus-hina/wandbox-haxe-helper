#!/usr/bin/env php
<?php
$options = getopt("", [
    "dir:",
    "main:",
    "php:",
]);

foreach (['dir', 'main', 'php'] as $key) {
    if (!isset($options[$key]) || $options[$key] == '') {
        fwrite(STDERR, "Missing parameter: {$key}\n");
        exit(255);
    }
}

$phpPath = sprintf('/opt/wandbin/php/php-%s/bin/php', $options['php']);
if (!file_exists($phpPath) || !is_executable($phpPath)) {
    fwrite(STDERR, "Please specify a valid PHP version.\n");
    exit(255);
}

$cmdline = sprintf(
    '/usr/bin/env %s %s',
    escapeshellarg($phpPath),
    escapeshellarg(sprintf(
        '%s/%s.php',
        $options['dir'],
        $options['main']
    ))
);

$status = null;
passthru($cmdline, $status);
exit($status);
