<?php

// Create necessary writable directories in /tmp for serverless environment
$dirs = [
    '/tmp/views',
    '/tmp/sessions',
    '/tmp/cache',
    '/tmp/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Forward Vercel requests to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
