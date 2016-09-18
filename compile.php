#!/usr/bin/env php
<?php
$options = getopt("", [
    "haxe:",
    "main:",
    "out:",
]);

foreach (['haxe', 'main', 'out'] as $key) {
    if (!isset($options[$key]) || $options[$key] == '') {
        fwrite(STDERR, "Missing parameter: {$key}\n");
        exit(255);
    }
}

$haxeBase = "/opt/haxe/haxe-{$options['haxe']}";
$haxeStd = "{$haxeBase}/std";

$cmdline = sprintf(
    '/usr/bin/env HAXE_STD_PATH=%s %s -main %s -php %s',
    escapeshellarg($haxeStd),
    escapeshellarg($haxeBase . '/haxe'),
    escapeshellarg($options['main']),
    escapeshellarg($options['out'])
);

$status = null;
passthru($cmdline, $status);
exit($status);
