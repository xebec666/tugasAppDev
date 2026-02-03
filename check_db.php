<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = ['products', 'transactions', 'transaction_items', 'users'];

foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        echo "Table '$table' exists.\n";
    } else {
        echo "Table '$table' DOES NOT EXIST.\n";
    }
}

// Check Foreign Key compatibility
if (Schema::hasTable('products')) {
    $type = DB::select("SHOW COLUMNS FROM products WHERE Field = 'id'")[0]->Type;
    echo "products.id type: $type\n";
}
if (Schema::hasTable('transactions')) {
    $type = DB::select("SHOW COLUMNS FROM transactions WHERE Field = 'id'")[0]->Type;
    echo "transactions.id type: $type\n";
}
// users
if (Schema::hasTable('users')) {
    $type = DB::select("SHOW COLUMNS FROM users WHERE Field = 'id'")[0]->Type;
    echo "users.id type: $type\n";
}
