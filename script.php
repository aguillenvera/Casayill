<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('app:scraping');
$kernel->call('app:update-ves');
$kernel->call('verificar:productos_vencidos');
$kernel->call('app:happy-b');
