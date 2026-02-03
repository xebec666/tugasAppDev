<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = ['reviews', 'product_images', 'order_items'];
foreach ($tables as $table) {
    try {
        echo "Table: $table\n";
        $columns = DB::select("DESCRIBE $table");
        foreach ($columns as $col) {
            echo "{$col->Field} | {$col->Type} | {$col->Key}\n";
        }
        echo "----------------\n";
    } catch (\Exception $e) {
        echo "$table not found or error.\n";
    }
}
