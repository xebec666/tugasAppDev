<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::statement('SET FOREIGN_KEY_CHECKS=0;');
Schema::dropIfExists('transaction_items');
Schema::dropIfExists('transactions');
Schema::dropIfExists('products');
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

echo "Tables dropped.\n";
