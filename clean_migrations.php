<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::table('migrations')->where('migration', 'like', '%create_products_table%')->delete();
DB::table('migrations')->where('migration', 'like', '%create_transactions_table%')->delete();
DB::table('migrations')->where('migration', 'like', '%create_transaction_items_table%')->delete();

echo "Migration entries deleted.\n";
